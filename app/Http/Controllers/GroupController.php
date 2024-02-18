<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        $admin_id = admin_id();
        $groups = Group::where('admin_id',$admin_id)->get();

        return view('group.index',compact('groups'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $admin_id = admin_id();
        $group = $request->name;
        $createGroup = Group::create(['admin_id'=>$admin_id,'name'=>$group]);

        return redirect()->route('group.index')->with('success','Group created successfully');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        $admin_id = admin_id();

        if($group->admin_id == $admin_id)
        {
            return view('group.edit',compact('group'));
        }
        else
        {
            return redirect()->route('group.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $group = Group::find($id);
        $admin_id = admin_id();

        if($group->admin_id == $admin_id)
        {
            $group->update(['name'=>$request->name]);

            return redirect()->route('group.index')->with('success','Group updated successfully');
        }
        else
        {
            return redirect()->route('group.index')->with('success','Somthing wrong');
        }
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $admin_id = admin_id();

        if($group->admin_id == $admin_id)
        {
            $group->delete();

            return redirect()->route('group.index')->with('success','Group deleted successfully');
        }
        else
        {
            return redirect()->route('group.index')->with('success','Somthing wrong');
        }
    }

    public function createGroup(Request $request)
    {
        $admin_id = admin_id();
        $group = $request->group;
        $create_group = Group::create(['admin_id'=>$admin_id,'name'=>$group]);

        return $create_group;
    }
}
