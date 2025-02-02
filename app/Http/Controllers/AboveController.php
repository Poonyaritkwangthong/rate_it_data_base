<?php

namespace App\Http\Controllers;

use App\Models\AboveComment;
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


class AboveController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->tier_num !== 11) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }


        $personals = User::where('group_num', $user->group_num)
            ->whereNotIn('tier_num', [4, 11, 12]) // 1 = รองผู้อำนวยการ
            ->where('role',  'user')
            ->get();
        return view('page.capacity_rate_it.above.index', compact('personals'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $summarize_01 = SummarizePart01::where('personal_num', $personal->id)->get();
        $summarize_02 = SummarizePart02::where('personal_num', $personal->id)->get();
        $summarize_03 = SummarizePart03::where('personal_num', $personal->id)->get();
        $assessment_01 = Assessment01Score::where('personal_num', $personal->id)->get();
        $assessment_02 = Assessment02Score::where('personal_num', $personal->id)->get();

        $evaluation_component = EvaluationComponent::all();
        $criterion_choice = Criterion::all();
        $assessment_acknowledgement_choice = AssessmentAcknowledgement::all();
        $comment_choice = Comments::all();
        // dd( $summarize_03);
        return view('page.capacity_rate_it.above.create', compact(
            'personal',
            'summarize_01',
            'summarize_02',
            'summarize_03',
            'criterion_choice',
            'assessment_acknowledgement_choice',
            'comment_choice',
            'evaluation_component',
            'assessment_01',
            'assessment_02',
        ));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            //summarize_part_01
            'personal_num' => 'required',
            'above_comment_num' => 'required',
            'above_comment_detail' => 'nullable',
            'above_signature' => [
                'nullable' => '',
                'string' => '',
                'regex:/^data:image\/(png|jpg|jpeg);base64,/i'
            ],
            'round' => 'required',
            'above_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }
        $aboveSignaturePath = $this->saveSignatureImage($request->above_signature, 'above');

        try {

            AboveComment::create([
                'personal_num' => $request->personal_num,
                'above_comment_num' => $request->above_comment_num,
                'above_comment_detail' => $request->above_comment_detail,
                'above_signature' => $aboveSignaturePath,
                'above_date' => $request->above_date,
                'above_num' => Auth::id(),
                'round' => $request->round,
            ]);

            return redirect()->route('page.capacity_rate_it.above  .index')->with('success', 'เพิ่มเเบบสรุปผลการปฏิบัติราชการสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.above.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
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
            $folder = "images/signatures/{$prefix}"; // เช่น /signatures/personal, /signatures/witness, /signatures/evaluator
            $filePath = "/storage/{$folder}/{$fileName}";

            // ✅ บันทึกไฟล์ลง storage
            Storage::disk('public')->put($filePath, $base64Image);

            return $filePath;
        }

        return null;
    }
}
