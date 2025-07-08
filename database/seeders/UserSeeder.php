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
                'email' => 'admin@example.com',
                'department_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa',
                'username' => 'userbiasa',
                'email' => 'user@example.com',
                'department_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
