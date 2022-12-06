<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'bappy@dev.local',
            'role' => 'admin',
            'status' => 1,
            'branch_id' => 1,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'info@aircitybd.com',
            'role' => 'admin',
            'status' => 1,
            'branch_id' => 1,
            'password' => Hash::make('aircitybd'),
        ]);
        User::create([
            'name' => 'Authot',
            'email' => 'authot@dev.local',
            'role' => 'authot',
            'status' => 1,
            'branch_id' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
