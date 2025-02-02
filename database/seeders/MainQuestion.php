<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainQuestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('main_question')->insert([
            [
                'main_question_name' => 'การมุ่งผลสัมฤทธิ์',
                'main_question_multiply' => '0.2'
            ],
            [
                'main_question_name' => 'บริการที่ดี',
                'main_question_multiply' => '0.1'
            ],
            [
                'main_question_name' => 'การสั่งสมความเชี่ยวชาญในงานอาชีพ',
                'main_question_multiply' => '0.2'
            ],
            [
                'main_question_name' => 'จริยธรรม',
                'main_question_multiply' => '0.1'
            ],
            [
                'main_question_name' => 'ความร่วมเเรงร่วมใจ',
                'main_question_multiply' => '0.1'
            ],
        ]);
    }
}
