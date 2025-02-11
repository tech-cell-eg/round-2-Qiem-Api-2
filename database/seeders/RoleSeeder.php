<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
<<<<<<< HEAD

=======
use Spatie\Permission\Models\Permission;
>>>>>>> main

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD

        Role::firstOrCreate(['name' => 'client']);

=======
        // إنشاء الأدوار
        $individualClientRole = Role::create(['name' => 'individual_client']); // عميل فرد
        $companyClientRole = Role::create(['name' => 'company_client']);       // عميل شركة
        $inspectorRole = Role::create(['name' => 'inspector']);                // معاين
        $evaluationCompanyRole = Role::create(['name' => 'evaluation_company']); // شركة تقييم

        // إنشاء الأذونات
        Permission::create(['name' => 'view-notifications']); // إذن لعرض الإشعارات
        Permission::create(['name' => 'create-reports']);     // إذن لإنشاء تقارير
        Permission::create(['name' => 'edit-profile']);       // إذن لتعديل الملف الشخصي
        Permission::create(['name' => 'delete-account']);     // إذن لحذف الحساب

        // ربط الأذونات بالأدوار
        $inspectorRole->givePermissionTo(['create-reports','view-notifications']);
        $evaluationCompanyRole->givePermissionTo(['create-reports', 'view-notifications']);
        $individualClientRole->givePermissionTo(['edit-profile','delete-account']);
        $companyClientRole->givePermissionTo(['edit-profile', 'delete-account']);
>>>>>>> main
    }
}
