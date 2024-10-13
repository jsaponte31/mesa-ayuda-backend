<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->username = 'admin';
        $user->password = bcrypt('admin');
        $user->phone = '123456789';
        $user->is_active = true;
        $user->rol_id = 4;
        $user->save();
    }
}
