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
        User::create([
            'name' => 'مستخدم 1',
            'email' => 'user1@example.com',
            'city' => 'القاهرة',
            'phone' => '01234567890',
            'password' => bcrypt('password123'), // تأكد من استخدام كلمة مرور مشفرة
        ]);

        User::create([
            'name' => 'مستخدم 2',
            'email' => 'user2@example.com',
            'city' => 'الإسكندرية',
            'phone' => '01123456789',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'مستخدم 3',
            'email' => 'user3@example.com',
            'city' => 'الجيزة',
            'phone' => '01098765432',
            'password' => bcrypt('password123'),
        ]);
    }
}
