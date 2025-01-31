<?php

namespace App\Http\Controllers;

use App\Models\PersonalScore;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class RateItController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now('Asia/Bangkok');
        $startRound1 = Carbon::create($now->year, 3, 1); // เริ่ม 1 มีนาคม
        $endRound1 = Carbon::create($now->year, 9, 30); // จบ 30 กันยายน
        $startRound2 = Carbon::create($now->month < 3 ? $now->year - 1 : $now->year, 10, 1); // เริ่ม 1 ตุลาคม
        $endRound2 = Carbon::create($now->month < 3 ? $now->year : $now->year + 1, 2, 28); // จบ 28 กุมภาพันธ์

        // $startRound1 = Carbon::create($now->year, 1, 1); // เริ่ม 1 มกราคม
        // $endRound1 = Carbon::create($now->year, 6, 30); // จบ 30 มิถุนายน
        // $startRound2 = Carbon::create($now->year, 7, 1); // เริ่ม 1 กรกฎาคม
        // $endRound2 = Carbon::create($now->year, 12, 31); // จบ 31 ธันวาคม


        $evaluationRound = null;
        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $user = Auth::user();

        // ดึงข้อมูลบุคลากรในกลุ่มเดียวกัน ยกเว้นตัวเอง
        $groupMembers = User::where('group_num', $user->group_num)
            ->where('id', '!=', $user->id)
            ->get();

        // ดึงข้อมูลบุคคลที่ยังไม่ได้รับการประเมินจาก user นี้
        $personals = User::where('group_num', $user->group_num)
            ->where('id', '!=', $user->id)
            ->whereDoesntHave('rateIts', function ($query) use ($user, $evaluationRound) {
                $query->where('user_num', $user->id)
                    ->where('round', $evaluationRound); // ใช้ evaluationRound
            })
            ->get()
            ->filter(function ($personal) use ($evaluationRound) {
                return $personal->round === $evaluationRound; // ใช้ Accessor
            });

        // เช็คว่าผู้ใช้ประเมินครบทุกคนหรือยัง
        $hasCompletedEvaluation = $personals->isEmpty();

        return view('page.rate_it.index', compact('personals', 'hasCompletedEvaluation', 'evaluationRound', 'now'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $question = Question::all();

        return view('page.rate_it.create', compact('personal', 'question'));
    }

    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Bangkok');
        $startRound1 = Carbon::create($now->year, 3, 1); // เริ่ม 1 มีนาคม
        $endRound1 = Carbon::create($now->year, 9, 30); // จบ 30 กันยายน
        $startRound2 = Carbon::create($now->month < 3 ? $now->year - 1 : $now->year, 10, 1); // เริ่ม 1 ตุลาคม
        $endRound2 = Carbon::create($now->month < 3 ? $now->year : $now->year + 1, 2, 28); // จบ 28 กุมภาพันธ์

        // $startRound1 = Carbon::create($now->year, 1, 1); // เริ่ม 1 มกราคม
        // $endRound1 = Carbon::create($now->year, 6, 30); // จบ 30 มิถุนายน
        // $startRound2 = Carbon::create($now->year, 7, 1); // เริ่ม 1 กรกฎาคม
        // $endRound2 = Carbon::create($now->year, 12, 31); // จบ 31 ธันวาคม

        $evaluationRound = null;
        if ($now->between($startRound1, $endRound1)) {
            $evaluationRound = 1;
        } elseif ($now->between($startRound2, $endRound2)) {
            $evaluationRound = 2;
        }

        $validator = Validator::make($request->all(), [
            'personal_num' => 'required',
            'question_num' => 'required|array',
            'score' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }

        try {
            // คำนวณคะแนนรวมจาก array ของ score
            $total_score = array_sum($request->score);

            // บันทึกข้อมูล
            PersonalScore::create([
                'personal_num' => $request->personal_num,
                'question_num' => json_encode($request->question_num),  // ถ้าต้องการเก็บข้อมูลของ question_num ในรูปแบบ array
                'score' => json_encode($request->score),  // เก็บข้อมูล score เป็น JSON
                'total_score' => $total_score,  // ใส่คะแนนรวมใน total_score
                'user_num' => Auth::id(),  // ใช้ ID ของผู้ที่ล็อกอิน
                'round' => $evaluationRound,
            ]);

            return redirect()->route('page.rate_it.index')->with('success', 'ประเมินคะเเนนสำเร็จ!');
        } catch (\Throwable $th) {
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.rate_it.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}
