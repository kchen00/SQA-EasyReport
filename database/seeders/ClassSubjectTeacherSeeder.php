<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClassSubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();
        $subject_teacher = [
            [
                "subject_id"=>1,
                "user_id"=>2,
                "schoolclass_id"=>1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>2,
                "user_id"=>3,
                "schoolclass_id"=>3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>3,
                "user_id"=>5,
                "schoolclass_id"=>1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>4,
                "user_id"=>6,
                "schoolclass_id"=>5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>1,
                "user_id"=>5,
                "schoolclass_id"=>2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>2,
                "user_id"=>6,
                "schoolclass_id"=>6,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>2,
                "user_id"=>5,
                "schoolclass_id"=>4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>4,
                "user_id"=>7,
                "schoolclass_id"=>2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

        ];

        foreach($subject_teacher as $data) {
            DB::table("class_subject_teacher")->insert($data);
        }
    }
}
