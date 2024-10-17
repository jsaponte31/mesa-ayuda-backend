<?php

namespace Database\Seeders;

use App\Models\Help_desk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class help_deskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $help_desk = [
            [
                'name' => 'MESA AYUDA SISTEMAS',
                'area_id' => 1,
                'administrater_id' => 2,
            ],
            [
                'name' => 'MESA AYUDA INFRAESTRUCTURA',
                'area_id' => 2,
                'administrater_id' => 3,
            ],
            [
                'name' => 'MESA AYUDA CONTABILIDAD',
                'area_id' => 3,
                'administrater_id' => 4,
            ],
            [
                'name' => 'MESA AYUDA TALENTO HUMANO',
                'area_id' => 4,
                'administrater_id' => 5,
            ],
        ];

        foreach ($help_desk as $help_desk) {
            Help_desk::create($help_desk);
        }
    }
}
