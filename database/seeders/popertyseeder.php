<?php

namespace Database\Seeders;

use App\Models\Property;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class popertyseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('properties')->insert([
            [
                'user_id' => 1,
                'address' => 'شارع الملك، حي الفهد',
                'type' => 'سكني',
                'area' => 150,
                'city' => 'القاهرة',
                'region' => 'المعادي',
                'details' => 'منزل فاخر مع حديقة كبيرة',
                'advantages' => 'موقع مميز، مساحات واسعة',
                'notes' => 'قريب من الخدمات والمرافق',
            ],
            [
                'user_id' => 2,
                'address' => 'شارع النصر، حي الزمالك',
                'type' => 'تجاري',
                'area' => 300,
                'city' => 'الإسكندرية',
                'region' => 'المنتزه',
                'details' => 'مكتب فاخر في موقع استراتيجي',
                'advantages' => 'قريب من المولات التجارية',
                'notes' => 'مساحة كبيرة مناسبة لمختلف الأعمال',
            ],
            [
                'user_id' => 3,
                'address' => 'شارع التحرير، وسط المدينة',
                'type' => 'سكني',
                'area' => 200,
                'city' => 'القاهرة',
                'region' => 'وسط البلد',
                'details' => 'شقة فاخرة قريبة من المعالم السياحية',
                'advantages' => 'إطلالة رائعة، سهولة الوصول للمواصلات',
                'notes' => 'مناسبة للأسر الصغيرة',
            ],
        ]);
    }
}
