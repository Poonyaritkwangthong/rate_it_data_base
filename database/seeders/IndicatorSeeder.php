<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indicator')->insert([
            [
                'indicator_name' => 'ปรับปรุง API KTB Paotang',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'ปรับปรุง API ส่งยาทางไปรษณีย์',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'ปรับปรุง API Patho',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา API Lab Q Diagnosis Auto',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา API Drug Alert',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'ปรับปรุง Dashboard ER OR IPD',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'ปรับปรุง API NeoQ',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา API Patient Data EKG',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา API V/S Monitor',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา API ส่งข้อมูล PHR',
                'other_question_num' =>'1',
            ],
            [
                'indicator_name' => 'พัฒนา โปรเเกรม OPD SCREEN OPD Alert Drug form Pharmacist',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'พัฒนา API Line OA PPK Nurse News and attach file',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'โปรเเกมจัดตารางเวร Versions Local',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'พัฒนา Dashboard indicator bedsore',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'พัฒนา Dashboard กองการพยาบาล',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'พัฒนา Dashboard กลุ่มการพยาบาล',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'โปรเเกรมจัดเก็บตัวชี้วัด indicator bedsore',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'ปรับปรุงเว็ปไซต์กลุ่มการ',
                'other_question_num' =>'2',
            ],
            [
                'indicator_name' => 'Looker studio',
                'other_question_num' =>'3',
            ],
            [
                'indicator_name' => 'Policy digital privacy',
                'other_question_num' =>'3',
            ],
            [
                'indicator_name' => 'PPK๑๑ OPD IPD EMR',
                'other_question_num' =>'3',
            ],
            [
                'indicator_name' => 'โปรเเกรมอื่นๆที่ใช้ภายใน',
                'other_question_num' =>'3',
            ],
        ]);
    }
}
