<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleArr = [
            [
                'name' => 'Administrator',
                'admin_id'=> '1',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Admin',
                'admin_id'=> '1',
                'guard_name' => 'web'
            ]
        ];

        foreach ($roleArr as $role)
        {
            $checkExist = Role::where(['name'=>$role['name']])->get()->count();
            if($checkExist == 0)
            {
                Role::create($role);
            }
        }
    }
}
