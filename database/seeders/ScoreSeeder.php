<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($student_id = 1; $student_id <= 50; $student_id++) {
            // Loop through subject_id 1 to 10
            for ($subject_id = 1; $subject_id <= 10; $subject_id++) {
               Score::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'score' => rand(50, 100),
                    'full_marks' => 100,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
