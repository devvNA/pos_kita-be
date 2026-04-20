<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //add roles

        \App\Models\Role::create(['name' => 'owner', 'id' => 1]);
        \App\Models\Role::create(['name' => 'manager', 'id' => 2]);
        \App\Models\Role::create(['name' => 'kasir', 'id' => 3]);
    }
}
