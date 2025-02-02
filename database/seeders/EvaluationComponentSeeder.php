<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('evaluation_component')->insert([
            [
                'component_name' => 'องค์ประกอบ ๑ ผลสัมฤทธิ์ของงาน',
                'weight_score' => '0.7'
            ],
            [
                'component_name' => 'องค์ประกอบที่ ๒ พฤติกรรมการปฏิบัติราชการ(สมรรถนะ)',
                'weight_score' => '0.3'
            ],
        ]);
    }
}
