<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-group-list|product-group-create|product-group-edit|product-group-delete', ['only' => ['index','store']]);
         $this->middleware('permission:product-group-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-group-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-group-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $groups = ProductGroup::where('admin_id',$admin_id)->get();
        return view('product_group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_group.create');
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
            'group' => 'required|unique:product_groups,group,NULL,id,admin_id,'. admin_id(),
        ],[
            'group.required'=> 'Please enter group',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();

        $create = ProductGroup::create($input);

        return redirect()->route('product_group.index')->with('success','Group create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGroup $productGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = ProductGroup::find($id);
        $admin_id = admin_id();
        if($group->admin_id == $admin_id)
        {
            return view('product_group.edit',compact('group'));
        }
        else
        {
            return redirect()->route('product_group.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'group' => 'required|unique:product_groups,group,'.$id.',id,admin_id,'. admin_id(),
        ],[
            'group.required'=> 'Please enter group',
        ]);

        $input = $request->all();
        $group = ProductGroup::find($id);
        $admin_id = admin_id();
        if($group->admin_id == $admin_id)
        {
            $group->update($input);

            return redirect()->route('product_group.index')->with('success','Group update successfully');
        }
        else
        {
            return redirect()->route('product_group.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = ProductGroup::find($id);
        $admin_id = admin_id();
        if($group->admin_id == $admin_id)
        {
            $group->delete();

            return redirect()->route('product_group.index')->with('success','Group delete successfully');
        }
        else
        {
            return redirect()->route('product_group.index')->with('success','Somthing wrong');
        }
    }
}
