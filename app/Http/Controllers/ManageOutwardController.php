<?php

namespace App\Http\Controllers;

use App\Models\InwardProduct;
use Illuminate\Http\Request;
use App\Models\ManageOutward;
use App\Models\Supplier;
use App\Models\ManageProduct;
use App\Models\OutwardProduct;
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
        $type = ['Retail Sales' => 'Retail Sales','Scrap'=>'Scrap','Branch Transfer'=>'Branch Transfer'];
        $products = ManageProduct::where('admin_id',$admin_id)->select('product_name','id')->get()->pluck('product_name','id')->toArray();
        return view('manage_outward.create',compact('type','products'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'inward_date' => 'required',
            'outward_type' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'rate' => 'required',
            'amount' => 'required',

        ],[
            'inward_date.required' => 'Please Enter outward date',
            'outward_type.required' => 'Please select outward type',
            'product_id.required' => 'Please select product',
            'qty.required' => 'Please enter qty',
            'rate.required' => 'Please enter rate',
            'amount.required' => 'Please enter amount',
        ]);
        $input = $request->all();
        $admin_id = admin_id();

        $inwardArray = [
            'admin_id' => $admin_id,
            'inward_date' => $request->inward_date,
            'outward_type' => $request->outward_type,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
        ];

        $outward = ManageOutward::create($inwardArray);

        $ids = $request->get_ids;
        if(isset($ids) && $ids)
        {
            foreach ($ids as $id)
            {
                $product=[];
                $product=[
                    'admin_id' => $admin_id,
                    'outward_id' => $outward->id,
                    'product_id' => $input['product_id_'.$id],
                    'qty' => $input['qty_'.$id],
                    'rate' => $input['rate_'.$id],
                    'amount' => $input['amount_'.$id],
                ];
                if($product)
                {
                    OutwardProduct::create($product);
                }
            }
        }
        return redirect()->route('manage_outward.index')->with('success','Outward create successfully');
    }

    public function getProductDetail(Request $request)
    {
        $productId = $request->product_id;
        $product = ManageProduct::where('id',$productId)->select('mrp','min_qty')->first();
        $totalInward = InwardProduct::where('product_id',$productId)->select(DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')->get()->pluck('qty')->toarray();
        $totalOutward = OutwardProduct::where('product_id',$productId)->select(DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')->get()->pluck('qty')->toarray();
        $totalProduct = $totalInward[0] - $totalOutward[0];
        return json_encode(['product'=>$product,'qty'=>$totalProduct]);
    }
}
