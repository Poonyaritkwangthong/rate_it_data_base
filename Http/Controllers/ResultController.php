<?php

namespace App\Http\Controllers;

use App\Models\Assessment01Score;
use App\Models\OtherQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class ResultController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $personals = User::where('id', $user->id)
            ->where('group_num', $user->group_num)
            ->get();

        return view('page.result.index', compact('personals'));
    }

    public function show($id)
    {
        $personal = Assessment01Score::with(['personal', 'user'])
            ->where('personal_num', $id)
            ->firstOrFail();
            $other_question = OtherQuestion::pluck('other_question_name', 'id')->toArray();
        return view('page.result.show', compact('personal', 'other_question'));
    }
}
