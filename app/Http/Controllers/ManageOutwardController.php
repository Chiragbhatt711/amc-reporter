<?php

namespace App\Http\Controllers;

use App\Models\InwardProduct;
use Illuminate\Http\Request;
use App\Models\ManageOutward;
use App\Models\Supplier;
use App\Models\ManageProduct;
use DB;

class ManageOutwardController extends Controller
{
    public function index()
    {
        $admin_id = admin_id();
        // $inward = ManageOutward::where('manage_inwards.admin_id',$admin_id)
        // ->join('suppliers','manage_inwards.supplier_id','=','suppliers.id','LEFT')
        // ->join('inward_products','manage_inwards.id','=','inward_products.inward_id','LEFT')
        // ->groupBy('manage_inwards.id')
        // ->select('manage_inwards.id','manage_inwards.inward_date','manage_inwards.note','suppliers.person_name','suppliers.company_name','suppliers.supplier_type','suppliers.city',DB::raw('COUNT(inward_products.id) as total_product'),DB::raw('SUM(inward_products.qty) as total_qty'),DB::raw('SUM(inward_products.amount) as total_amount'))
        // ->get();

        return view('manage_outward.index');
    }

    public function create()
    {
        $admin_id = admin_id();
        $type = ['Retail Sales','Scrap','Branch Transfer'];
        $products = ManageProduct::where('admin_id',$admin_id)->select('product_name','id')->get()->pluck('product_name','id')->toArray();
        return view('manage_outward.create',compact('type','products'));
    }

    public function getProductDetail(Request $request)
    {
        $productId = $request->product_id;
        $product = ManageProduct::where('id',$productId)->select('mrp','min_qty')->first();
        $totalProduct = InwardProduct::where('product_id',$productId)->select(DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')->get()->pluck('qty')->toarray();

        return json_encode(['product'=>$product,'qty'=>$totalProduct[0]]);
    }
}
