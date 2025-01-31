<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    //
    public function index () {
        $questions = Question::all();
        return view('/admin/question/index', compact('questions'));
    }

    public function create () {
        return view('/admin/question/create');
    }

    public function store (Request $request) {
        $validator = Validator::make( $request->all(), [
            'question_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }
        try {
            Question::create([
                'question_name' => $request->question_name
            ]);
            return redirect()->route('admin.question.index')->with('success', 'เพิ่มคำถามสำเร็จ!');
        } catch (\Throwable $th) {
            Log::error('Error occurred while storing data: ' . $th->getMessage());
            return redirect()->route('admin.question.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }

    public function edit ($id) {
        return view('/admin/question/edit');
    }

    public function update (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'question_name' => 'required',
            'question_status' => 'required',
            'question_multiply' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'ข้อมูลผิดพลาด',
                'error' => $validator->errors(),
            ], 422);
        }

        try {
            Question::updateOrCreate([
                'question_name' => $request->question_name,
                'question_status' => $request->question_status,
                'question_multiply' => $request->question_multiply,
            ]);
            return redirect()->route('admin.question.index')->with('success', 'เเก้ไขสำเร็จ');
        } catch (\Throwable $th) {
            Log::error('Error occurred while storing data: ' . $th->getMessage());
            return redirect()->route('admin.question.index')->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    }
}
