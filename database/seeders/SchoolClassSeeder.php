<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=10; $i++) {
            SchoolClass::create([
                "name" => "Class " . $i,
                "capacity" => rand(20, 30),
                "class_teacher" => rand(2, 10)
            ]);
        }

    }
}
