<?php

namespace App\Http\Controllers;

use App\Models\PersonalScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    //
    public function index()
    {
        $UserId = Auth::User()->id;
        $FullScore = 100;
        $percentage = 100;

        // กำหนดช่วงเวลาของแต่ละรอบ
        $rounds = [
            'round1' => ['start' => '03-01', 'end' => '09-30'], // มีนา-กันยา
            'round2' => ['start' => '10-01', 'end' => '02-28'], // ตุลา-มีนา
        ];

        $currentYear = now()->year;

        // เก็บผลลัพธ์แยกรอบ
        $results = [];

        foreach ($rounds as $key => $round) {
            $startDate = $key === 'round2' ? $currentYear . '-' . $round['start'] : $currentYear . '-' . $round['start'];
            $endDate = $key === 'round2' ? ($currentYear + 1) . '-' . $round['end'] : $currentYear . '-' . $round['end'];

            // คำนวณคะแนนรวมของผู้ใช้ในช่วงเวลา
            $PersonalScores = PersonalScore::selectRaw('SUM(total_score) as total_score_sum')
                ->where('personal_num', $UserId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('personal_num')
                ->first();

            // นับจำนวน user_num ของผู้ใช้ในช่วงเวลา
            $TotalUser = PersonalScore::where('personal_num', $UserId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            // คำนวณคะแนนเฉลี่ยและเปอร์เซ็นต์
            $totalScoreSum = $PersonalScores ? $PersonalScores->total_score_sum : 0;
            $AverageTotalScoreGroupByUser = ($TotalUser > 0) ? number_format($totalScoreSum / $TotalUser) : 0;
            $PercentageScore = ($TotalUser > 0) ? number_format($AverageTotalScoreGroupByUser / $FullScore * $percentage, ) : 0;

            // บันทึกผลลัพธ์ใน array
            $results[$key] = [
                'FullScore' => $FullScore,
                'Percentage' => $percentage,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'totalScoreSum' => $totalScoreSum,
                'TotalUser' => $TotalUser,
                'AverageTotalScoreGroupByUser' => $AverageTotalScoreGroupByUser,
                'PercentageScore' => $PercentageScore,
            ];
        }

        // ส่งข้อมูลไปยัง view
        return view('page.user.index', compact('FullScore', 'results', 'percentage', 'PercentageScore' ,'AverageTotalScoreGroupByUser', 'TotalUser'));
    }
}
