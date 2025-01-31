<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherQuestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('other_question')->insert([
            [
                'other_question_name' => 'พัฒนาโปรเเกรมของโรงพยาบาล',
                'other_question_multiply' => '0.1',
                'other_question_weight' => '0.4'
            ],
            [
                'other_question_name' => 'พัฒนาโปรเเกรมของกลุ่มการพยาบาล',
                'other_question_multiply' => '0.1',
                'other_question_weight' => '0.4'
            ],
            [
                'other_question_name' => 'สอนบุคลากรในการใช้โปรเเกรม',
                'other_question_multiply' => '0.1',
                'other_question_weight' => '0.2'
            ],
        ]);
    }
}
