<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $admin_id = admin_id();


        $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->get();

        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('menu_name', 'ASC')->orderBy('order_by','ASC')->get()->where('guard_name','=','web')->where('menu_name','!=',NULL)->groupBy('menu_name');

        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $admin_id = admin_id();

        $input['name'] = $request->name;
        $input['admin_id'] = $admin_id;

        $role = Role::create($input);

        if($request['permission'])
        {
            $role->syncPermissions($request->input('permission'));
        }
        return redirect()->route('roles.index')
                        ->with('role create successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        if(isset($role))
        {
            if($role->admin_id == auth()->user()->id || $role->admin_id = auth()->user()->admin_id)
            {
                $permissions = Permission::orderBy('menu_name', 'ASC')->orderBy('order_by','ASC')->get()->where('guard_name','=','web')->where('menu_name','!=',NULL)->groupBy('menu_name');

                $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                    ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                    ->all();

                return view('roles.edit',compact('role','permissions','rolePermissions'));
            }
            else
            {
                return redirect()->route('roles.index')->with('success','Somthing wrong');
            }
        }
        else
        {
            return redirect()->route('roles.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        if($request['permission'])
        {
            $role->syncPermissions($request->input('permission'));
        }
        else
        {
            $request['permission'] = [0];
            $role->syncPermissions($request['permission']);
        }

        return redirect()->route('roles.index')
                        ->with('success','Permission update successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if($role)
        {
            $role->delete($role);

            return redirect()->route('roles.index')
                        ->with('success','Role delete successfully');
        }
        else{
            return redirect()->route('roles.index')->with('success','Somthing wrong');

        }

    }
}
