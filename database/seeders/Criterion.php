<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Criterion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('criterion')->insert([
            [
                'criterion_name' => 'ดีเด่น'
            ],
            [
                'criterion_name' => 'ดีมาก'
            ],
            [
                'criterion_name' => 'ดี'
            ],
            [
                'criterion_name' => 'พอใช้'
            ],
            [
                'criterion_name' => 'ต้องปรับปรุง'
            ],
        ]);
    }
}
