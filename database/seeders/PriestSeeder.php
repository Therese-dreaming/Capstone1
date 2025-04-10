<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PriestSeeder extends Seeder
{
    public function run()
    {
        $priests = [
            [
                'name' => 'Fr. John Doe',
                'email' => 'john.doe@church.com',
                'password' => Hash::make('password123'),
                'role' => 'priest'
            ],
            [
                'name' => 'Fr. James Smith',
                'email' => 'james.smith@church.com',
                'password' => Hash::make('password123'),
                'role' => 'priest'
            ],
            // Add more priests as needed
        ];

        foreach ($priests as $priest) {
            User::create($priest);
        }
    }
}
