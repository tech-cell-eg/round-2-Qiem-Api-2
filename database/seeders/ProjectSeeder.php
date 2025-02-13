<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'company_id'   => 1,
                'offer_id'     => 1,
                'status'       => 'ended',
                'description'  => 'مشروع تطوير موقع إلكتروني',
                'comment'      => 'في انتظار الموافقة من الإدارة',
                'resume_file'  => 'resumes/project1.pdf',
                'is_paid'      => false,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
                'inspector_id'    => null
            ],
            [
                'company_id'   => 2,
                'offer_id'     => 2,
                'status'       => 'active',
                'description'  => 'مشروع تطبيق موبايل',
                'comment'      => 'تمت الموافقة على المشروع',
                'resume_file'  => 'resumes/project2.pdf',
                'is_paid'      => true,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
                'inspector_id'    => null
            ],
        ]);
    }
}
