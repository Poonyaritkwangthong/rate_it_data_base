<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Comments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('comments')->insert([
            [
                'comment_name' => 'เห็นด้วย กับผลการประเมิน'
            ],
            [
                'comment_name' => 'มีความเห็นต่าง'
            ],
        ]);
    }
}
