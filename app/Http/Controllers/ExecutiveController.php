<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Arr;
use DB;

class ExecutiveController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-executive-list|manage-executive-create|manage-executive-edit|manage-executive-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-executive-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-executive-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-executive-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $roles = Role::where('admin_id',$admin_id)->where('name','=','Executive')->get()->pluck('id')->toArray();
        $roleId = '';
        if($roles)
        {
            $roleId = $roles[0];
        }

        $users = User::orderBy('users.id','ASC')->where('users.admin_id',$admin_id)
            ->join('roles','users.role_id','=','roles.id')
            ->where('role_id',$roleId)
            ->select('users.*','roles.name as role')
            ->get();
        return view('manage_executive.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_id = admin_id();
        $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->where('name','=','Executive')->get()->pluck('name','id')->toArray();

        return view('manage_executive.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('manage_executive.index')->with('success','Executive create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user)
        {
            if($user->admin_id == auth()->user()->id || $user->admin_id = auth()->user()->admin_id)
            {
                $admin_id = admin_id();
                $roles = Role::orderBy('id','ASC')->where('admin_id',$admin_id)->where('name','=','Executive')->get()->pluck('name','id')->toArray();
                return view('manage_executive.edit',compact('user','roles'));
            }
            else
            {
                return redirect()->route('manage_executive.index')->with('success','Somthing wrong');
            }
        }
        else
        {
            return redirect()->route('manage_executive.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('manage_executive.index')
                        ->with('success','Executive update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $admin_id = admin_id();
        if($user->admin_id == $admin_id)
        {
            $user->delete();
            return redirect()->route('manage_executive.index')
                            ->with('success',__('Executive delete successfully'));
        }
        else
        {
            return redirect()->route('manage_executive.index')->with('success','Somthing wrong');
        }
    }
}
