<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priorities')->insert([
            ['priority' => 'Low',],
            ['priority' => 'Medium',],
            ['priority' => 'High',],
            ['priority' => 'Critical',],
        ]);
    }
}
