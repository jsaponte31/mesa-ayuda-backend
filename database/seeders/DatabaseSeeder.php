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
        $this->call(rolSeeder::class);
        $this->call(areaSeeder::class);
        $this->call(status_requestSeeder::class);
        $this->call(userSeeder::class);
        $this->call(help_deskSeeder::class);
    }
}
