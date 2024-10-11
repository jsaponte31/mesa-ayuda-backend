<?php

namespace Database\Seeders;

use App\Models\area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class areaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            ['name' => 'SISTEMAS'],
            ['name' => 'INFRAESTRUCTURA'],
            ['name' => 'CONTABILIDAD'],
            ['name' => 'TALENTO HUMANO'],
        ];

        foreach ($areas as $area) {
            area::create($area);
        }
    }
}
