<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone_number'=> '0778657480',
                'password' => Hash::make('admin@123'),
                'role'=>'Admin',
            ]
            );
    }
}
