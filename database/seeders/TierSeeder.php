<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tiers')->insert([
            ['tier_name' => 'ชำนาญการ'],
            ['tier_name' => 'ชำนาญการพิเศษ'],
            ['tier_name' => 'เชี่ยวชาญ'],
            ['tier_name' => 'เชี่ยวชาญพิเศษ'],
            ['tier_name' => 'ปฏิบัติการ'],
            ['tier_name' => 'วิชาการ'],
            ['tier_name' => 'อาวุโส'],
            ['tier_name' => 'ผู้เชี่ยวชาญ'],
            ['tier_name' => 'ผู้ช่วยวิจัย'],
            ['tier_name' => 'ฝ่ายบริหาร'],
        ]);
    }
}
