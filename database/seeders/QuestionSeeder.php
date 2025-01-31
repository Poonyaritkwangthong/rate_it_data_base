<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('question')->insert([
            ['question_name' => 'question_01'],
            ['question_name' => 'question_02'],
            ['question_name' => 'question_03'],
            ['question_name' => 'question_04'],
            ['question_name' => 'question_05'],
            ['question_name' => 'question_06'],
            ['question_name' => 'question_07'],
            ['question_name' => 'question_08'],
            ['question_name' => 'question_09'],
            ['question_name' => 'question_10'],
            ['question_name' => 'question_11'],
            ['question_name' => 'question_12'],
            ['question_name' => 'question_13'],
            ['question_name' => 'question_14'],
            ['question_name' => 'question_15'],
        ]);
    }
}
