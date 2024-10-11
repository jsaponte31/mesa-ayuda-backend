<?php

namespace Database\Seeders;

use App\Models\rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'USUARIO'],
            ['name' => 'ADMINISTRADOR DE AREA'],
            ['name' => 'TECNICO'],
            ['name' => 'SUPERADMINISTRADOR'],
        ];

        foreach ($roles as $rol) {
            rol::create($rol);
        }
    }
}
