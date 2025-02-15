<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::create([
            'company_id' => 1,
            'real_estate_id' => 1,
            'message' => 'نعتقد أن هذا العقار يقع في مكان جيد ولكن عدد الغرف قليل بالنسبة للمساحة.',
            'status' => 'pending',
        ]);

        Request::create([
            'company_id' => 2,
            'real_estate_id' => 2,
            'message' => 'هذا العقار مناسب تمامًا لاحتياجاتنا.',
            'status' => 'accepted',
        ]);
    }
}
