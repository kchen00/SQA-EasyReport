<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 2; $i <= 10; $i++) {
            User::create([
                'name' => "Teacher " . $i,
                'email' => "teacher" . $i . "@example.com",
                'password' => "teacher",
            ]);

            Teacher::create([
                'user_id' => $i,
                'assigned_class' => $i,
            ]);
        }
    }
}
