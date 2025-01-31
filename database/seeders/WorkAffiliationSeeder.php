<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkAffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('work_affiliations')->insert([
            ['work_affiliation_name' => 'กลุ่มภารกิจด้านการพยาบาล(IT)'],
            ['work_affiliation_name' => 'กลุ่มภารกิจด้านการพยาบาลและเทคโนโลยีสารสนเทศ'],
            ['work_affiliation_name' => 'ฝ่ายการพยาบาล'],
            ['work_affiliation_name' => 'หน่วยพัฒนาระบบงานพยาบาล'],
            ['work_affiliation_name' => 'แผนกบริหารเวชสารสนเทศทางการพยาบาล'],
            ['work_affiliation_name' => 'แผนกพยาบาลเวชปฏิบัติ'],
            ['work_affiliation_name' => 'แผนกการพยาบาลผู้ป่วยหนัก (ICU)'],
            ['work_affiliation_name' => 'แผนกการพยาบาลผู้ป่วยนอก (OPD)'],
            ['work_affiliation_name' => 'แผนกฉุกเฉิน (ER)'],
            ['work_affiliation_name' => 'หน่วยสนับสนุนและพัฒนาเทคโนโลยีทางการพยาบาล'],
        ]);
    }
}
