<?php

namespace App\Http\Controllers;

use App\Models\ManageProduct;
use App\Models\OutwardProduct;
use Illuminate\Http\Request;
use DB;

class StockManagmentController extends Controller
{
    public function stockRegister()
    {
        $admin_id = admin_id();
        $data = ManageProduct::where('manage_products.admin_id', $admin_id)
            ->leftJoin('product_groups', 'manage_products.group_id', '=', 'product_groups.id')
            ->leftJoin('inward_products', 'manage_products.id', '=', 'inward_products.product_id')
            ->select('manage_products.*', 'product_groups.group as group',
                    DB::raw('COALESCE(SUM(inward_products.qty), 0) as inward_qty'))
            ->groupBy('inward_products.product_id')
            ->get();
        $mainData = [];
        foreach ($data as $key => $value) {
            $productId = $value->id;
            $outward = OutwardProduct::where('product_id',$productId)
                ->select(DB::raw('COALESCE(SUM(qty), 0) as outward_qty'))
                ->groupBy('product_id')
                ->get();
            $value['outward_qty'] = $outward[0]->outward_qty;
            array_push($mainData,$value);
        }

        return view('stock_register.index',compact('mainData'));
    }
}
