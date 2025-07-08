<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'name' => 'Computer',
                'department_id' => 1,
            ],
            [
                'name' => 'Access Point',
                'department_id' => 1,
            ],
            [
                'name' => 'TV Cable',
                'department_id' => 1,
            ],
            [
                'name' => 'Smart TV',
                'department_id' => 1,
            ],
            [
                'name' => 'Ethernet',
                'department_id' => 1,
            ],
            [
                'name' => 'CCTV',
                'department_id' => 1,
            ],
            [
                'name' => 'PABX',
                'department_id' => 1,
            ],
            [
                'name' => 'Printer',
                'department_id' => 1,
            ],
            [
                'name' => 'Email',
                'department_id' => 1,
            ],
            [
                'name' => 'Elektrikal',
                'department_id' => 2,
            ],
            [
                'name' => 'Plumbing',
                'department_id' => 2,
            ],
            [
                'name' => 'Event',
                'department_id' => 2,
            ],
            [
                'name' => 'Civil',
                'department_id' => 2,
            ],
            [
                'name' => 'Furniture',
                'department_id' => 2,
            ],
            [
                'name' => 'Decoration',
                'department_id' => 2,
            ],
            [
                'name' => 'Welding',
                'department_id' => 2,
            ],
            [
                'name' => 'AC',
                'department_id' => 2,
            ],
            [
                'name' => 'Other',
                'department_id' => 2,
            ],
        ]);
    }
}
