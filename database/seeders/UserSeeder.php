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
                'phone' => '01000000001',
                'city' => 'Cairo',
                'street' => 'Street 1',
                'email_verified_at' => now(),
                'district' => 'District A',
                'password' => Hash::make('password'),
                'role' => 'Inspector',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'whatsapp_link' => 'https://wa.me/0123456789',
                'comments' => 'First test user',
                'sms_number' => '0123456789',
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@mail.com',
                'phone' => '01000000002',
                'city' => 'Alexandria',
                'street' => 'Street 2',
                'email_verified_at' => now(),
                'district' => 'District B',
                'password' => Hash::make('password'),
                'role' => 'Client',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'whatsapp_link' => 'https://wa.me/0987654321',
                'comments' => 'Second test user',
                'sms_number' => '0987654321',
            ],
        ]);
    }
}
