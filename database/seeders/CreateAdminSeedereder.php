<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminSeedereder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkExist = Role::where(['name'=>'Administrator'])->get()->count();
        if($checkExist == 0)
        {
            $role = Role::create(['name' => 'Administrator']);
        }
        else
        {
           $role = Role::where(['name'=>'Administrator'])->first();
        }

        $checkAdminExist = User::where(['email'=>'admin@gmail.com'])->first();

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        if(!$checkAdminExist)
        {
            $user = User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('chirag123'),
                'is_active' => '1',
                'role_id' => $role->id,
                'admin_id'=> '1'
            ]);

            $user->assignRole([$role->id]);
        }
        else
        {
            $checkAdminExist->assignRole([$role->id]);
        }
    }
}
