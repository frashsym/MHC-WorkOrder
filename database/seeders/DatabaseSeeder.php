<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
            PrioritySeeder::class,
            PicSeeder::class,
            ProgressSeeder::class,
            RoleSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
