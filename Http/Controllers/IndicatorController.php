<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function index () {
        $indicators = Indicator::with(['mainQuestion', 'otherQuestion'])->get();

        // Grouping by main_question_num and other_question_num
        $groupedIndicators = $indicators->groupBy(['main_question_num', 'other_question_num']);

        return view('page.capacity_rate_it.indicators.index', compact('groupedIndicators'));
    }
}
