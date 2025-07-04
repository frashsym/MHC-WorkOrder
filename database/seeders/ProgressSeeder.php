<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('progress')->insert([
            ['status' => 'Schedule',],
            ['status' => 'On Progress',],
            ['status' => 'Hold',],
            ['status' => 'Finished',],
            ['status' => 'Cancel',],
        ]);
    }
}
