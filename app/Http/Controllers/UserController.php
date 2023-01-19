<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Arr;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $admin_id = admin_id();

        $users = User::orderBy('users.id','ASC')->where('users.admin_id',$admin_id)
            ->join('roles','users.role_id','=','roles.id')
            ->select('users.*','roles.name as role')
            ->get();

        return view('users.index',compact('users'));
    }

    public function create()
    {
        $admin_id = admin_id();
        $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();

        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
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

        return redirect()->route('users.index')->with('success','User create uccessfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if($user)
        {
            if($user->admin_id == auth()->user()->id || $user->admin_id = auth()->user()->admin_id)
            {
                $admin_id = admin_id();
                $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
                return view('users.edit',compact('user','roles'));
            }
            else
            {
                return redirect()->route('users.index')->with('success','Somthing wrong');
            }
        }
        else
        {
            return redirect()->route('users.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
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

        return redirect()->route('users.index')
                        ->with('success','User update successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success',__('User delete successfully'));
    }
}
