<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('groups')->insert([
            ['group_name' => 'กลุ่มงานการพยาบาล'],
            ['group_name' => 'กลุ่มงานเวชศาสตร์ฟื้นฟู'],
            ['group_name' => 'กลุ่มงานเภสัชกรรม'],
            ['group_name' => 'กลุ่มงานรังสีวิทยา'],
            ['group_name' => 'กลุ่มงานห้องปฏิบัติการทางการแพทย์'],
            ['group_name' => 'กลุ่มงานวิสัญญีวิทยา'],
            ['group_name' => 'กลุ่มงานโภชนาการ'],
            ['group_name' => 'กลุ่มงานจิตเวชและสุขภาพจิต'],
            ['group_name' => 'กลุ่มงานเวชระเบียน'],
            ['group_name' => 'กลุ่มงานอายุรกรรม'],
            ['group_name' => 'กลุ่มงานศัลยกรรม'],
            ['group_name' => 'กลุ่มงานกุมารเวชกรรม'],
            ['group_name' => 'กลุ่มงานสูติ-นรีเวชกรรม'],
            ['group_name' => 'กลุ่มงานออร์โธปิดิกส์'],
            ['group_name' => 'กลุ่มงานผู้ป่วยวิกฤต (ICU)'],
        ]);
    }
}
