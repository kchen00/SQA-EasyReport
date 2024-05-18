<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubjectTeacherSeeder extends Seeder
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
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>1,
                "user_id"=>3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>1,
                "user_id"=>4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>2,
                "user_id"=>5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>4,
                "user_id"=>6,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "subject_id"=>5,
                "user_id"=>7,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

        ];

        foreach($subject_teacher as $data) {
            DB::table("subject_teacher")->insert($data);
        }
    }
}
