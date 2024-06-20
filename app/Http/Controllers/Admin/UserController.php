<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Arr;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {

        $admin_id = admin_id();

        $users = User::orderBy('users.id','ASC')->where(['users.admin_id'=>$admin_id,'role_id'=>2])
            ->join('roles','users.role_id','=','roles.id')
            ->select('users.*','roles.name as role')
            ->paginate(10);

        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        $admin_id = admin_id();
        $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();

        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_number' => 'required',
            'role_id' => 'required',
            'password'=> 'required',
        ],[
            'first_name.required'=> 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'email.required' => 'Please enter email',
            'mobile_number.required' => 'Pleaseb enter mobile number',
            'role_id.required' => 'Please select role',
            'password.required' => 'Please enter password',
        ]);

        $admin_id = admin_id();

        $input = $request->all();
        if(isset($input['password']) && $input['password'])
        {
            $input['password'] = Hash::make($input['password']);
        }
        $input['admin_id'] = $admin_id;
        $input['is_active'] = 1;
        $input['name'] = $input['first_name'].' '.$input['last_name'];

        $user = User::create($input);
        $role = Role::where('id', $request->input('role_id'))->select('name')->first()->toArray();
        $user->assignRole($role['name']);

        return redirect()->route('admin.users.index')->with('success','User create successfully');
    }

    public function edit($id)
    {
        $admin_id = admin_id();
        $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
        return view('admin.users.edit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'mobile_number' => 'required',
            'role_id' => 'required',
            'password'=> 'required',
        ],[
            'first_name.required'=> 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'email.required' => 'Please enter email',
            'mobile_number.required' => 'Pleaseb enter mobile number',
            'role_id.required' => 'Please select role',
            'password.required' => 'Please enter password',
        ]);

        $input = $request->all();
        $user = User::find($id);

        if(isset($input['password']) && $input['password'] != $user->password)
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            $input = Arr::except($input,array('password'));
        }

        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $role = Role::where('id', $request->input('role_id'))->select('name')->first()->toArray();
        $user->assignRole($role['name']);

        return redirect()->route('admin.users.index')
                        ->with('success','User update successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
                        ->with('success',__('User delete successfully'));
    }

    public function manageUser($id)
    {
        $users = User::orderBy('users.id','ASC')->where(['users.admin_id'=>$id])
        ->join('roles','users.role_id','=','roles.id')
        ->select('users.*','roles.name as role')
        ->paginate(10);

        return view('admin.users.user_list',compact('users','id'));
    }

    public function createUser($id)
    {
        $roles = Role::orderBy('id','ASC')->where('admin_id',$id)->get()->pluck('name','id')->toArray();

        return view('admin.users.user_create',compact('roles','id'));
    }

    public function userStore(Request $request,$id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_number' => 'required',
            'role_id' => 'required',
            'password'=> 'required',
        ],[
            'first_name.required'=> 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'email.required' => 'Please enter email',
            'mobile_number.required' => 'Pleaseb enter mobile number',
            'role_id.required' => 'Please select role',
            'password.required' => 'Please enter password',
        ]);

        $admin_id = $id;

        $input = $request->all();
        if(isset($input['password']) && $input['password'])
        {
            $input['password'] = Hash::make($input['password']);
        }
        $input['admin_id'] = $admin_id;
        $input['is_active'] = 1;
        $input['name'] = $input['first_name'].' '.$input['last_name'];

        $user = User::create($input);
        $role = Role::where('id', $request->input('role_id'))->select('name')->first()->toArray();
        $guardName = 'web';
        $role = Role::findByName($role['name'], $guardName);
        $user->assignRole($role);
        // $user->assignRole($role['name'],['guard_name' => 'web']);

        return redirect()->route('admin.manage_user',$id)->with('success','User create successfully');
    }
}
