<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pics')->insert([
            [
                'name' => 'Ilhan',
                'department_id' => 1,
            ],
            [
                'name' => 'Farras',
                'department_id' => 1,
            ],
            [
                'name' => 'Hadi',
                'department_id' => 2,
            ],
            [
                'name' => 'Rudi',
                'department_id' => 2,
            ],
            [
                'name' => 'Lukman',
                'department_id' => 2,
            ],
            [
                'name' => 'Sukma',
                'department_id' => 3,
            ],
            [
                'name' => 'Ara',
                'department_id' => 3,
            ],
        ]);
    }
}
