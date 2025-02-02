<?php

namespace App\Http\Controllers;

use App\Models\Assessment02Score;
use App\Models\MainQuestion;
use App\Models\OtherQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HeadShip02Controller extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->tier_num !== 4) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้'); // ส่งกลับข้อผิดพลาด 403
        }

        $personals = User::where('group_num', $user->group_num)
            ->whereNotIn('tier_num', [4, 11, 12])
            ->where('role',  'user')
            ->get();
        return view('page.capacity_rate_it.assessment_02.index', compact('personals'));
    }

    public function create($id)
    {
        $personal = User::findOrFail($id);
        $MainQuestion = MainQuestion::all();
        $OtherQuestion = OtherQuestion::all();
        return view('page.capacity_rate_it.assessment_02.create', compact('MainQuestion', 'OtherQuestion', 'personal'));
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
            'main_question_num' => 'required|array',
            'other_question_num' => 'required|array',
            'main_score' => 'required|array',
            'other_score' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }

        try {

            $multiply = 20;
            $total_main_score = array_sum($request->main_score);
            $total_other_score = array_sum($request->other_score);
            $total_score = $total_main_score + $total_other_score;
            $points = $total_score * $multiply;

            Assessment02Score::create([
                'personal_num' => $request->personal_num,
                'main_question_num' => json_encode($request->main_question_num),
                'other_question_num' => json_encode($request->other_question_num),
                'main_score' => json_encode($request->main_score),
                'other_score' => json_encode($request->other_score),
                'total_score' => $total_score,
                'points' =>  $points,
                'user_num' => Auth::id(),
                'round' => $evaluationRound,
            ]);
            return redirect()->route('page.capacity_rate_it.assessment_02.index')->with('success', 'ประเมินคะเเนนสำเร็จ!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error occurred while storing data: ' . $th->getMessage());

            return redirect()->route('page.capacity_rate_it.assessment_02.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}
