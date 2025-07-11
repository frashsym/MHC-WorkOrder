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
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa',
                'username' => 'userbiasa',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('qwertyuiop'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
