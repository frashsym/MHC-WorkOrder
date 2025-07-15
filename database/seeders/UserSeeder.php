<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin MHC',
                'username' => 'adminmhc',
                'role_id' => 1,
                'email' => 'admin@gmail.com',
                'department_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ilhan',
                'username' => 'ilhan',
                'role_id' => 2,
                'email' => 'ilhan@gmail.com',
                'department_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Farras',
                'username' => 'farras',
                'role_id' => 2,
                'email' => 'farras@gmail.com',
                'department_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hadi',
                'username' => 'hadi',
                'role_id' => 2,
                'email' => 'hadi@gmail.com',
                'department_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rudi',
                'username' => 'rudi',
                'role_id' => 2,
                'email' => 'rudi@gmail.com',
                'department_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lukman',
                'username' => 'lukman',
                'role_id' => 2,
                'email' => 'lukman@gmail.com',
                'department_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sukma',
                'username' => 'sukma',
                'role_id' => 2,
                'email' => 'sukma@gmail.com',
                'department_id' => 3,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ara',
                'username' => 'ara',
                'role_id' => 2,
                'email' => 'ara@gmail.com',
                'department_id' => 3,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
