<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();
        $classes_subjects = [
            [
                "school_class_id"=>1,
                "subject_id"=>1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "school_class_id"=>1,
                "subject_id"=>2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "school_class_id"=>1,
                "subject_id"=>3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "school_class_id"=>2,
                "subject_id"=>1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "school_class_id"=>2,
                "subject_id"=>2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                "school_class_id"=>2,
                "subject_id"=>3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];

        foreach($classes_subjects as $data) {
            DB::table("schoolclass_subject")->insert($data);
        }
    }
}
