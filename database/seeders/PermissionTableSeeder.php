<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionArr = [
            [
                'name' => 'permission-list',
                'guard_name' => 'web',
                'order_by' => '1'
            ],
            [
                'name' => 'permission-create',
                'guard_name' => 'web',
                'order_by' => '2'
            ],
            [
                'name' => 'permission-edit',
                'guard_name' => 'web',
                'order_by' => '3'
            ],
            [
                'name' => 'permission-delete',
                'guard_name' => 'web',
                'order_by' => '4'
            ],
            [
                'name' => 'role-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'role',
                'order_by' => '1'
            ],
            [
                'name' => 'role-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'role',
                'order_by' => '2'
            ],
            [
                'name' => 'role-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'role',
                'order_by' => '3'
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'role',
                'order_by' => '4'
            ],

            [
                'name' => 'user-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'user',
                'order_by' => '1'
            ],
            [
                'name' => 'user-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'user',
                'order_by' => '2'
            ],
            [
                'name' => 'user-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'user',
                'order_by' => '3'
            ],
            [
                'name' => 'user-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'user',
                'order_by' => '4'
            ],

            [
                'name' => 'contract-type-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'contract-type',
                'order_by' => '1'
            ],
            [
                'name' => 'contract-type-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'contract-type',
                'order_by' => '2'
            ],
            [
                'name' => 'contract-type-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'contract-type',
                'order_by' => '3'
            ],
            [
                'name' => 'contract-type-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'contract-type',
                'order_by' => '4'
            ],
        ];

        foreach ($permissionArr as $permission)
        {
            $checkExist = Permission::where(['name'=>$permission['name']])->get()->count();
            if($checkExist == 0)
            {
                Permission::create($permission);
            }
            else
            {
                Permission::where(['name'=>$permission['name']])->update($permission);
            }
        }
    }
}
