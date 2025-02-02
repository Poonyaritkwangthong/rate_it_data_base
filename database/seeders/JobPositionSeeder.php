<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('job_positions')->insert([
            ['job_position_name' => 'แพทย์ทั่วไป'],
            ['job_position_name' => 'แพทย์ศัลยกรรม'],
            ['job_position_name' => 'พยาบาลวิชาชีพ'],
            ['job_position_name' => 'เภสัชกร'],
            ['job_position_name' => 'นักเทคนิคการแพทย์'],
            ['job_position_name' => 'นักกายภาพบำบัด'],
            ['job_position_name' => 'นักโภชนาการ'],
            ['job_position_name' => 'เจ้าหน้าที่ห้องปฏิบัติการ'],
            ['job_position_name' => 'ผู้ช่วยพยาบาล'],
            ['job_position_name' => 'เจ้าหน้าที่เวชระเบียน'],
        ]);
    }
}
