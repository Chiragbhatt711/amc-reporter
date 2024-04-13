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
    function __construct()
    {
         $this->middleware('permission:manage-outward-list|manage-outward-create|manage-outward-edit|manage-outward-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-outward-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-outward-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-outward-delete', ['only' => ['destroy']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }

    public function index()
    {
        $admin_id = admin_id();
        $outward = ManageOutward::where('manage_outwards.admin_id',$admin_id)
        ->join('outward_products','manage_outwards.id','=','outward_products.outward_id','LEFT')
        ->groupBy('manage_outwards.id')
        ->select('manage_outwards.id','manage_outwards.inward_date','manage_outwards.note','manage_outwards.outward_type',DB::raw('COUNT(outward_products.id) as total_product'),DB::raw('SUM(outward_products.qty) as total_qty'),DB::raw('SUM(outward_products.amount) as total_amount'))
        ->get();

        return view('manage_outward.index',compact('outward'));
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

        $outwardArray = [
            'admin_id' => $admin_id,
            'inward_date' => $request->inward_date,
            'outward_type' => $request->outward_type,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
        ];

        $outward = ManageOutward::create($outwardArray);

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

    public function edit($id)
    {
        $outward = ManageOutward::find($id);
        $admin_id = admin_id();
        $type = ['Retail Sales' => 'Retail Sales','Scrap'=>'Scrap','Branch Transfer'=>'Branch Transfer'];
        $products = ManageProduct::where('admin_id',$admin_id)->select('product_name','id')->get()->pluck('product_name','id')->toArray();
        return view('manage_outward.edit',compact('outward','type','products'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'inward_date' => 'required',
            'outward_type' => 'required',

        ],[
            'inward_date.required' => 'Please Enter outward date',
            'outward_type.required' => 'Please select outward type',
        ]);

        $input = $request->all();
        $admin_id = admin_id();
        $outward = ManageOutward::find($id);

        $outwardArray = [
            'admin_id' => $admin_id,
            'inward_date' => $request->inward_date,
            'outward_type' => $request->outward_type,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
        ];

        $outward->update($outwardArray);

        $ids = $request->get_ids;
        if(isset($ids) && $ids)
        {
            OutwardProduct::where('outward_id',$outward->id)->delete();
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
        return redirect()->route('manage_outward.index')->with('success','Outward update successfully');
    }

    public function destroy($id)
    {
        $admin_id = admin_id();
        $inward = ManageOutward::find($id);
        if($inward->admin_id == $admin_id)
        {
            $inward->delete();
            OutwardProduct::where('outward_id',$id)->delete();
            return redirect()->route('manage_inward.index')->with('success','Inward delete successfully');
        }
        else
        {
            return redirect()->route('manage_inward.index')->with('success','Somthing wrong');
        }
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
