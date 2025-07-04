<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorys')->insert([
            [
                'name' => 'Pengecekan',
                'department_id' => 1,
            ],
            [
                'name' => 'Perbaikan',
                'department_id' => 1,
            ],
            [
                'name' => 'Konfigurasi',
                'department_id' => 1,
            ],
            [
                'name' => 'Instalasi',
                'department_id' => 1,
            ],
            [
                'name' => 'Pemasangan',
                'department_id' => 1,
            ],
            [
                'name' => 'Penambahan',
                'department_id' => 1,
            ],
            [
                'name' => 'Pemindahan',
                'department_id' => 1,
            ],
            [
                'name' => 'Other',
                'department_id' => 1,
            ],
            [
                'name' => 'Pengecekan',
                'department_id' => 2,
            ],
            [
                'name' => 'Perbaikan',
                'department_id' => 2,
            ],
            [
                'name' => 'Konfigurasi',
                'department_id' => 2,
            ],
            [
                'name' => 'Instalasi',
                'department_id' => 2,
            ],
            [
                'name' => 'Pemasangan',
                'department_id' => 2,
            ],
            [
                'name' => 'Penambahan',
                'department_id' => 2,
            ],
            [
                'name' => 'Pemindahan',
                'department_id' => 2,
            ],
            [
                'name' => 'Other',
                'department_id' => 2,
            ],
            [
                'name' => 'Pembuatan',
                'department_id' => 3,
            ],
            [
                'name' => 'Penambahan',
                'department_id' => 3,
            ],
            [
                'name' => 'Revisi',
                'department_id' => 3,
            ],
        ]);
    }
}
