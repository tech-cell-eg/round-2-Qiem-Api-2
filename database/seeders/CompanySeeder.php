<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'company_id' => 1,
                'tax_number' => '123456789',
                'authorization' => 'Authorized',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'company_id' => 2,
                'tax_number' => '987654321',
                'authorization' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
