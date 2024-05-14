<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Student::create([
                'name' => 'Student ' . $i,
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'contact_information' => rand(1000000000, 9999999999), // Generate random 10-digit number
                'date_of_birth' => now()->subYears(rand(17, 25))->subMonths(rand(0, 11))->subDays(rand(0, 30)),
            ]);
        }
    }
}
