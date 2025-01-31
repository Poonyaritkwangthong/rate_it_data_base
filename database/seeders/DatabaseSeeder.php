<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            QuestionSeeder::class,
            GroupSeeder::class,
            JobPositionSeeder::class,
            JobTypeSeeder::class,
            TierSeeder::class,
            WorkAffiliationSeeder::class,
            MainQuestion::class,
            OtherQuestion::class,
            IndicatorSeeder::class,
            EvaluationComponentSeeder::class,
            Comments::class,
            AssessmentAcknowledgement::class,
            Criterion::class,
        ]);
    }
}
