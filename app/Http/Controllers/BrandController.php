<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function create(Request $request)
    {
        $admin_id = admin_id();
        $brand = $request->brand;
        $createBrand = Brand::create(['admin_id'=>$admin_id,'name'=>$brand]);

        return $createBrand;
    }
}
