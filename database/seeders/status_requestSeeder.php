<?php

namespace Database\Seeders;

use App\Models\status_request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class status_requestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_requests = [
            ['name' => 'CREADA'],
            ['name' => 'ASIGNADA'],
            ['name' => 'EN PROCESO'],
            ['name' => 'FINALIZADA'],
        ];

        foreach ($status_requests as $status_request) {
            status_request::create($status_request);
        }
    }
}
