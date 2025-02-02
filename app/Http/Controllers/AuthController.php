<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\JobPosition;
use App\Models\JobType;
use App\Models\Tier;
use App\Models\User;
use App\Models\WorkAffiliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // ป้องกัน Session Fixation

            // ตรวจสอบ role ของผู้ใช้
            if (Auth::user()->role === 'user') {
                return redirect()->route('page.rate_it.index')->with('message', 'เข้าสู่ระบบสำเร็จ');
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('admin.question.index')->with('message', 'เข้าสู่ระบบสำเร็จ');
            }
        }

        // กรณีที่ข้อมูลล็อกอินไม่ถูกต้อง
        return back()->withErrors([
            'user_name' => 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง!',
            'password' => 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง!'
        ]);
    }


    public function showRegisterForm()
    {
        $group = Group::all();
        $job_position = JobPosition::all();
        $job_type = JobType::all();
        $tier = Tier::all();
        $work_affiliation = WorkAffiliation::all();
        return view('register', compact('group', 'job_position', 'job_type' ,'tier' ,'work_affiliation'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|unique:users',
            'password' => 'required|min:8|confirmed',
            'group_num' => 'required',
            'job_position_num' => 'required',
            'job_type_num' => 'required',
            'tier_num' => 'required',
            'work_affiliation_num' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user', // ค่าเริ่มต้นคือ user
            'group_num' => $request->group_num,
            'job_position_num' => $request->job_position_num,
            'job_type_num' => $request->job_type_num,
            'tier_num' => $request->tier_num,
            'work_affiliation_num' => $request->work_affiliation_num,
        ]);

        return redirect('/login')->with('success', 'ลงทะเบียนสำเร็จ!');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ล็อกเอาต์ผู้ใช้
        $request->session()->invalidate(); // ทำให้เซสชันปัจจุบันไม่สามารถใช้งานได้อีก
        $request->session()->regenerateToken(); // สร้าง CSRF Token ใหม่เพื่อความปลอดภัย

        // เปลี่ยนเส้นทางไปยังหน้า Login
        return redirect('/login');
    }
}
