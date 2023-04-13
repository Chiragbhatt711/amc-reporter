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

    public function MonthWiseItemStock(Request $request)
    {
        if(isset($request->month))
        {
            $year = date('Y',strtotime($request->month));
            $month = date('m',strtotime($request->month));
        }
        else
        {
            $year = date('Y');
            $month = date('m');
        }
        // dd($month.' '.$year);
        $admin_id = admin_id();
        $data = ManageProduct::where('manage_products.admin_id', $admin_id)
            ->leftJoin('product_groups', 'manage_products.group_id', '=', 'product_groups.id')
            ->leftJoin('inward_products', 'manage_products.id', '=', 'inward_products.product_id')
            ->whereYear('manage_products.created_at', $year)
            ->whereMonth('manage_products.created_at', $month)
            ->select('manage_products.*', 'product_groups.group as group',
                    DB::raw('COALESCE(SUM(inward_products.qty), 0) as inward_qty'))
            ->groupBy('inward_products.product_id')
            ->get();
        $mainData = [];
        foreach ($data as $key => $value) {
            $productId = $value->id;
            $outward = OutwardProduct::where('product_id',$productId)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->select(DB::raw('COALESCE(SUM(qty), 0) as outward_qty'))
                ->groupBy('product_id')
                ->get();
            $value['outward_qty'] = isset($outward[0]->outward_qty) && $outward[0]->outward_qty ? $outward[0]->outward_qty : 0;
            array_push($mainData,$value);
        }

        return view('stock_managment.month_wish_item_stock',compact('mainData'));
    }

    public function minimumItemStockReport()
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
            $value['outward_qty'] = isset($outward[0]->outward_qty) && $outward[0]->outward_qty ? $outward[0]->outward_qty : 0;
            array_push($mainData,$value);
        }

        return view('stock_managment.minimum_item_stock',compact('mainData'));
    }
}
