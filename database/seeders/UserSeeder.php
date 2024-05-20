<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "james bond",
            'ic' => '123',
            'age' => 1234,
            'address' => '1234',
            'gender' => 'Men',
            'contact' => '0101111',
            'email' => "jamesbond007".'@example.com',
            'role' => User::ROLE_ADMIN,
            'password' => "007007",
        ]);

        for($i=1; $i<=10; $i++) {
            User::create([
                'name' => "teacher ". $i,
                'ic' => $i.$i.$i,
                'age' => $i,
                'address' => $i,
                'gender' => rand(0, 1) == 0 ? 'Men' : 'Women',
                'contact' => '0101111',
                'email' => "teacher". $i .'@example.com',
                'role' => User::ROLE_TEACHER,
                'password' => "teacher",
            ]);
        }
    }

}
