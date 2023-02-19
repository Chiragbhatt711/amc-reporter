<?php

namespace App\Http\Controllers;

use App\Models\ManageProduct;
use Illuminate\Http\Request;
use App\Models\ProductGroup;

class ManageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $products = ManageProduct::where('manage_products.admin_id',$admin_id)
            ->join('product_groups','manage_products.group_id','=','product_groups.id')
            ->select('manage_products.*','product_groups.group as group')
            ->get();
        return view('manage_product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_id = admin_id();
        $unit = unit();
        $group = ProductGroup::where('admin_id',$admin_id)->select('id','group')->get()->pluck('group','id')->toArray();
        return view('manage_product.create',compact('group','unit'));
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
            'group_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'mrp' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'unit' =>'required',
            'opening_qty' =>'required|numeric',

        ],[
            'group_id.required'=> 'Please select group',
            'brand.required' => 'Please enter brand',
            'model.required' => 'Please enter model',
            'product_code.required' => 'Please enter product code',
            'product_name.required' => 'Please enter product name',
            'mrp.required' => 'Please enter mrp',
            'min_qty.required' => 'Please enter minimum qty',
            'unit.required' => 'Please select unit',
            'opening_qty.required' => 'Please enter opening qty',
        ]);
        $input = $request->all();
        $input['admin_id'] = admin_id();

        $create = ManageProduct::create($input);

        return redirect()->route('manage_product.index')->with('success','Product create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageProduct  $manageProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ManageProduct $manageProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageProduct  $manageProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = ManageProduct::find($id);

        $admin_id = admin_id();
        $unit = unit();
        $group = ProductGroup::where('admin_id',$admin_id)->select('id','group')->get()->pluck('group','id')->toArray();
        if($product->admin_id == $admin_id)
        {
            return view('manage_product.edit',compact('product','unit','group'));
        }
        else
        {
            return redirect()->back()->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageProduct  $manageProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'mrp' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'unit' =>'required',
            'opening_qty' =>'required|numeric',

        ],[
            'group_id.required'=> 'Please select group',
            'brand.required' => 'Please enter brand',
            'model.required' => 'Please enter model',
            'product_code.required' => 'Please enter product code',
            'product_name.required' => 'Please enter product name',
            'mrp.required' => 'Please enter mrp',
            'min_qty.required' => 'Please enter minimum qty',
            'unit.required' => 'Please select unit',
            'opening_qty.required' => 'Please enter opening qty',
        ]);
        $input = $request->all();

        $product = ManageProduct::find($id);
        $admin_id = admin_id();
        if($product->admin_id == $admin_id)
        {
            $product->update($input);

            return redirect()->route('manage_product.index')->with('success','Product update successfully');
        }
        else
        {
            return redirect()->route('manage_product.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageProduct  $manageProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ManageProduct::find($id);
        $admin_id = admin_id();
        if($product->admin_id == $admin_id)
        {
            $product->delete();

            return redirect()->route('manage_product.index')->with('success','Product delete successfully');
        }
        else
        {
            return redirect()->route('manage_product.index')->with('success','Somthing wrong');
        }
    }
}
