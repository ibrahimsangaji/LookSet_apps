<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@demo.com',
                'password' => bcrypt('user'),
                'role' => 'staff',
            ],
            [
                'name' => 'Supervisor',
                'email' => 'sp_user@demo.com',
                'password' => bcrypt('user'),
                'role' => 'supervisor',
            ]
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
