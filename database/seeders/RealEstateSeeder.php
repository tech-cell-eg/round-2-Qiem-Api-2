<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RealEstateSeeder extends Seeder
{
    public function run()
    {
        DB::table('real_estates')->insert([
            [
                'type'         => 'شقة',
                'street'       => 'شارع التحرير',
                'district'     => 'الدقي',
                'city'         => 'الجيزة',
                'area'         => '120 متر',
                'region'       => 'غرب القاهرة',
                'advantages'   => 'تشطيب سوبر لوكس، موقع مميز',
                'more_details' => 'قريبة من المترو والمدارس',
                'client_id'    => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'type'         => 'فيلا',
                'street'       => 'شارع التسعين',
                'district'     => 'التجمع الخامس',
                'city'         => 'القاهرة',
                'area'         => '500 متر',
                'region'       => 'شرق القاهرة',
                'advantages'   => 'حمام سباحة، جراج خاص',
                'more_details' => 'موقع راقي وخدمات متكاملة',
                'client_id'    => 2,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
