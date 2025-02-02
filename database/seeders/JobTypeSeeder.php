<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_types')->insert([
            ['job_type_name' => 'งานประจำ'],
            ['job_type_name' => 'งานพาร์ทไทม์'],
            ['job_type_name' => 'งานสัญญาจ้าง'],
            ['job_type_name' => 'งานชั่วคราว'],
            ['job_type_name' => 'งานฝึกงาน'],
            ['job_type_name' => 'งานอาสาสมัคร'],
            ['job_type_name' => 'งานเวรผลัดกลางวัน'],
            ['job_type_name' => 'งานเวรผลัดกลางคืน'],
            ['job_type_name' => 'งานแบบเรียกตามความต้องการ'],
            ['job_type_name' => 'งานที่ปรึกษาทางการแพทย์'],
        ]);
    }
}
