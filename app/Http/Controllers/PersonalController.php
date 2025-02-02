<?php

namespace App\Http\Controllers;

use App\Models\PersonalScore;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    //
    public function index () {
        $personals = PersonalScore::all();
        return view('admin.personal.index', compact('personals'));
    }

    public function updateRound()
    {
        try {
            // อัปเดตคอลัมน์ round ที่มีค่าเป็น 1 และ 2 ให้เป็น null
            PersonalScore::whereIn('round', [1, 2])
                ->update(['round' => null]);

            return redirect()->route('admin.personal.index')->with('success', 'อัปเดตค่า round สำเร็จ!');
        } catch (\Exception $e) {
            return redirect()->route('admin.personal.index')->with('error', 'เกิดข้อผิดพลาดในการอัปเดต');
        }
    }
}
