<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                "grade" => "A",
                "lower_bound" => 80,
                "upper_bound" => 100
            ],
            [
                "grade" => "A-",
                "lower_bound" => 75,
                "upper_bound" => 79
            ],
            [
                "grade" => "B+",
                "lower_bound" => 70,
                "upper_bound" => 74
            ],
            [
                "grade" => "B",
                "lower_bound" => 65,
                "upper_bound" => 69
            ],
            [
                "grade" => "B-",
                "lower_bound" => 60,
                "upper_bound" => 64
            ],
            [
                "grade" => "C+",
                "lower_bound" => 55,
                "upper_bound" => 59
            ],
            [
                "grade" => "C",
                "lower_bound" => 50,
                "upper_bound" => 54
            ],
            [
                "grade" => "C-",
                "lower_bound" => 45,
                "upper_bound" => 49
            ],
            [
                "grade" => "D+",
                "lower_bound" => 40,
                "upper_bound" => 44
            ],
            [
                "grade" => "D",
                "lower_bound" => 35,
                "upper_bound" => 39
            ],
            [
                "grade" => "E",
                "lower_bound" => 0,
                "upper_bound" => 34
            ],
            [
                "grade" => "F",
                "lower_bound" => 0,
                "upper_bound" => 0
            ]
        ];


        foreach($grades as $grade) {
            DB::table('grade')->insert($grade);
        };
    }
}
