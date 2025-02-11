<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'User One',
                'email' => 'user1@mail.com',
                'mobile_number' => '01000000001',
                'street' => 'abs',
                'district' => 'bca',
                'city' => 'cba',
                'password' => Hash::make('password'),
                'role' => 'Inspector',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@mail.com',
                'mobile_number' => '01000000002',
                'street' => 'abs',
                'district' => 'bca',
                'city' => 'cba',
                'password' => Hash::make('password'),
                'role' => 'client',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
