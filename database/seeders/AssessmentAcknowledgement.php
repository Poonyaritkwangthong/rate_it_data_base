<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentAcknowledgement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('assessment_acknowledgement')->insert([
            [
                'assessment_acknowledgement_name' => 'ได้เเจ้งผลการประเมินเเละผู้รับผลการประเมินรับทราบเเล้ว'
            ],
            [
                'assessment_acknowledgement_name' => 'ได้เเจ้งผลการประเมิน'
            ],
        ]);
    }
}
