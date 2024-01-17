<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-list',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'daily-report-list',
            'daily-report-create',
            'daily-report-edit',
            'daily-report-delete',
            'letter-list',
            'letter-create',
            'letter-edit',
            'letter-delete',
            'category-letter-list',
            'category-letter-create',
            'category-letter-edit',
            'category-letter-delete',
            'invoice-list',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
