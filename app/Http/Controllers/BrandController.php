<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $admin_id = admin_id();
        $brands = Brand::where('admin_id',$admin_id)->get();

        return view('brand.index',compact('brands'));
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $admin_id = admin_id();
        $brand = $request->name;
        $createBrand = Brand::create(['admin_id'=>$admin_id,'name'=>$brand]);

        return redirect()->route('brand.index')->with('success','Brand created successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $admin_id = admin_id();

        if($brand->admin_id == $admin_id)
        {
            return view('brand.edit',compact('brand'));
        }
        else
        {
            return redirect()->route('brand.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $brand = Brand::find($id);
        $admin_id = admin_id();

        if($brand->admin_id == $admin_id)
        {
            $brand->update(['name'=>$request->name]);

            return redirect()->route('brand.index')->with('success','Brand updated successfully');
        }
        else
        {
            return redirect()->route('brand.index')->with('success','Somthing wrong');
        }
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $admin_id = admin_id();

        if($brand->admin_id == $admin_id)
        {
            $brand->delete();

            return redirect()->route('brand.index')->with('success','Brand deleted successfully');
        }
        else
        {
            return redirect()->route('brand.index')->with('success','Somthing wrong');
        }
    }

    public function createBrand(Request $request)
    {
        $admin_id = admin_id();
        $brand = $request->brand;
        $createBrand = Brand::create(['admin_id'=>$admin_id,'name'=>$brand]);

        return $createBrand;
    }
}
