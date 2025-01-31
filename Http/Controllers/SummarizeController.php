<?php

namespace App\Http\Controllers;

use App\Models\Assessment01Score;
use App\Models\Assessment02Score;
use App\Models\AssessmentAcknowledgement;
use App\Models\Comments;
use App\Models\Criterion;
use App\Models\EvaluationComponent;
use App\Models\SummarizePart01;
use App\Models\SummarizePart02;
use App\Models\SummarizePart03;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SummarizeController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->tier_num !== 4) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }

        $groupMembers = User::where('group_num', $user->group_num)
            ->where('id', '!=', $user->id)
            ->get();

        $personals = User::where('group_num', $user->group_num)
            ->where('tier_num', '!=', 4)
            ->where('role',  'user')
            ->get();
        return view('page.capacity_rate_it.summarize.index', compact('personals'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->get();
        $summarize_03 = SummarizePart03::all();

        return view('page.capacity_rate_it.summarize.create', compact('personal', 'assessment_01', 'assessment_02', 'evaluation_component', 'criterion_choice', 'assessment_acknowledgement_choice', 'comment_choice' , 'summarize_03'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            //summarize_part_01
            'personal_num' => 'required',
            'evaluation_component_num' => 'required|array',
            'points' => 'required|array',
            'points_multiply' => 'required|array',
            'total_points' => 'required',
            'criterion_num' => 'required',
            'round' => 'required',
            //summarize_part_02
            'skill_to_dev' => 'required|array',
            'dev_method' => 'required|array',
            'dev_time' => 'required|array',
            //summarize_part_03
            'personal_date' => 'required',
            'personal_signature' => [
                'nullable',
                'string',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
            'assessment_acknowledgement_num' => 'required|array',
            'evaluation_date' => 'required',
            'witness_num' => 'nullable',
            'witness_signature' => 'nullable',
            'witness_date' => 'nullable',
            'evaluator_signature' => [
                'nullable',
                'string',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }
        $personalSignaturePath = $this->saveSignatureImage($request->personal_signature, 'personal');
        $witnessSignaturePath = $this->saveSignatureImage($request->witness_signature, 'witness');
        $evaluatorSignaturePath = $this->saveSignatureImage($request->evaluator_signature, 'evaluator');

        try {
            SummarizePart01::create([
                'personal_num' => $request->personal_num,
                'evaluation_component_num' => json_encode($request->evaluation_component_num),
                'points' => json_encode($request->points),
                'points_multiply' => json_encode($request->points_multiply),
                'total_points' => $request->total_points,
                'criterion_num' => $request->criterion_num,
                'evaluator_num' => Auth::id(),
                'round' => $request->round,
            ]);
            SummarizePart02::create([
                'personal_num' => $request->personal_num,
                'skill_to_dev' => json_encode($request->skill_to_dev),
                'dev_method' => json_encode($request->dev_method),
                'dev_time' => json_encode($request->dev_time),
                'evaluator_num' => Auth::id(),
                'round' => $request->round,
            ]);
            SummarizePart03::create([
                'personal_num' => $request->personal_num,
                'personal_date' => $request->personal_date,
                'personal_signature' => $personalSignaturePath,
                'assessment_acknowledgement_num' => json_encode($request->assessment_acknowledgement_num),
                'evaluation_date' => $request->evaluation_date,
                // 'witness_num' => $request->witness_num,
                // 'witness_signature' => $witnessSignaturePath,
                // 'witness_date' => $request->witness_date,
                'evaluator_num' => Auth::id(),
                'evaluator_signature' => $evaluatorSignaturePath,
                'round' => $request->round,
            ]);

            return redirect()->route('page.capacity_rate_it.summarize.index')->with('success', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.summarize.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
    private function saveSignatureImage($base64Image, $prefix)
    {
        if (!$base64Image) {
            return null;
        }

        // ✅ ตรวจสอบว่าเป็น Base64 จริงไหม
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            $imageType = $matches[1]; // ประเภทไฟล์ (png, jpg ฯลฯ)
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1); // เอาเฉพาะข้อมูล Base64
            $base64Image = base64_decode($base64Image);

            // ✅ ตั้งชื่อไฟล์ (random + timestamp)
            $fileName = time() . '_' . Str::random(10) . '.' . $imageType;

            // ✅ กำหนดโฟลเดอร์ตามประเภทลายเซ็น
            $folder = "/signatures/{$prefix}"; // เช่น /signatures/personal, /signatures/witness, /signatures/evaluator
            $filePath = "{$folder}/{$fileName}";

            // ✅ บันทึกไฟล์ลง storage
            Storage::disk('public')->put($filePath, $base64Image);

            return $filePath;
        }

        return null;
    }
}
