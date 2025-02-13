<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OfferSeeder extends Seeder
{
    public function run()
    {
        DB::table('offers')->insert([
            [
                'company_id'     => 1,
                'real_estate_id' => 1,
                'details'        => 'عرض خاص على الشقة لمدة محدودة',
                'amount'         => 1500000,
                'status'         => 'hold on',
                'client_id'      => 1,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => 2,
                'real_estate_id' => 2,
                'details'        => 'خصم 10% عند الدفع الكاش',
                'amount'         => 5000000,
                'status'         => 'accepted',
                'client_id'      => 2,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}
