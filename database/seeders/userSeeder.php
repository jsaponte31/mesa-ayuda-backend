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
        //1
        $user = new User();
        $user->username = 'admin';
        $user->name = 'administrador';
        $user->password = bcrypt('admin');
        $user->phone = '123456789';
        $user->is_active = true;
        $user->rol_id = 4;
        $user->save();

        //administradores de area
        $users = [
            [//2
                'username' => 'sistemas',
                'name' => 'administrador1',
                'password' => bcrypt('admin1'),
                'phone' => '123456789',
                'is_active' => true,
                'rol_id' => 2,
            ],
            [//3
                'username' => 'infraestructura',
                'name' => 'administrador2',
                'password' => bcrypt('admin2'),
                'phone' => '123456789',
                'is_active' => true,
                'rol_id' => 2,
            ],
            [//4
                'username' => 'contabilidad',
                'name' => 'administrador3',
                'password' => bcrypt('admin3'),
                'phone' => '123456789',
                'is_active' => true,
                'rol_id' => 2,
            ],
            [//5
                'username' => 'talento_humano',
                'name' => 'administrador4',
                'password' => bcrypt('admin4'),
                'phone' => '123456789',
                'is_active' => true,
                'rol_id' => 2,
            ],
        ];

        foreach ($users as $usernew) {
            $user = new User();
            $user->username = $usernew['username'];
            $user->name = $usernew['name'];
            $user->password = $usernew['password'];
            $user->phone = $usernew['phone'];
            $user->is_active = $usernew['is_active'];
            $user->rol_id = $usernew['rol_id'];
            $user->save();
        }
    }
}
