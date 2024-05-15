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
        // Dummy data
        $classes = [
            [
                'name' => 'Class 1A',
                'capacity' => 30,
                'class_teacher' => 'John Doe',
                'subject_offered' => 'Mathematics',
            ],
            [
                'name' => 'Class 1B',
                'capacity' => 28,
                'class_teacher' => 'Jane Smith',
                'subject_offered' => 'Science',
            ],
            [
                'name' => 'Class 2A',
                'capacity' => 29,
                'class_teacher' => 'David Brown',
                'subject_offered' => 'English',
            ],
            [
                'name' => 'Class 2B',
                'capacity' => 25,
                'class_teacher' => 'Sarah Johnson',
                'subject_offered' => 'History',
            ],
            [
                'name' => 'Class 3A',
                'capacity' => 32,
                'class_teacher' => 'Michael Wilson',
                'subject_offered' => 'Geography',
            ],
            [
                'name' => 'Class 3B',
                'capacity' => 30,
                'class_teacher' => 'Emily Taylor',
                'subject_offered' => 'Art',
            ],
            [
                'name' => 'Class 4A',
                'capacity' => 31,
                'class_teacher' => 'Olivia Martinez',
                'subject_offered' => 'Music',
            ],
            [
                'name' => 'Class 4B',
                'capacity' => 27,
                'class_teacher' => 'Daniel Anderson',
                'subject_offered' => 'Physical Education',
            ],
            [
                'name' => 'Class 5A',
                'capacity' => 30,
                'class_teacher' => 'Sophia Garcia',
                'subject_offered' => 'Computer Science',
            ],
            [
                'name' => 'Class 5B',
                'capacity' => 26,
                'class_teacher' => 'James Rodriguez',
                'subject_offered' => 'Literature',
            ],
        ];

        // Insert data into the database
        foreach ($classes as $class) {
            SchoolClass::create($class);
        }
    }
}
