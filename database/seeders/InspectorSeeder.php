<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InspectorSeeder extends Seeder
{
    public function run()
    {
        DB::table('inspectors')->insert([
            [
                'inspector_id' => 1,
                'national_id' => '12345678901234',
                'years of experience' => 5,
                'field of experience' => 'Apartments',
                'fee' => 1000,
                'account_balance' => 5000,
                'outstanding_balance' => 2000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'inspector_id' => 2,
                'national_id' => '23456789012345',
                'years of experience' => 8,
                'field of experience' => 'Buildings',
                'fee' => 1500,
                'account_balance' => 7000,
                'outstanding_balance' => 3000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
