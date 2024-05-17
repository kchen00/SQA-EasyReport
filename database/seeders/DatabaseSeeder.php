<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SchoolClassSeeder::class,
            StudentSeeder::class,
            UserSeeder::class,
            SubjectsSeeder::class,
        ]);
    }
}
