<?php

namespace App\Http\Controllers;

use App\Models\InwardProduct;
use App\Models\ManageInward;
use App\Models\ManageProduct;
use Illuminate\Http\Request;
use App\Models\Supplier;
use DB;

class ManageInwardController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-inward-list|manage-inward-create|manage-inward-edit|manage-inward-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-inward-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-inward-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-inward-delete', ['only' => ['destroy']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }

    public function index()
    {
        $admin_id = admin_id();
        $inward = ManageInward::where('manage_inwards.admin_id',$admin_id)
        ->join('suppliers','manage_inwards.supplier_id','=','suppliers.id','LEFT')
        ->join('inward_products','manage_inwards.id','=','inward_products.inward_id','LEFT')
        ->groupBy('manage_inwards.id')
        ->select('manage_inwards.id','manage_inwards.inward_date','manage_inwards.note','manage_inwards.reference_no','suppliers.person_name','suppliers.company_name','suppliers.supplier_type','suppliers.city',DB::raw('COUNT(inward_products.id) as total_product'),DB::raw('SUM(inward_products.qty) as total_qty'),DB::raw('SUM(inward_products.amount) as total_amount'))
        ->get();

        return view('manage_inward.index',compact('inward'));
    }

    public function create()
    {
        $admin_id = admin_id();
        $supplierArray = Supplier::where('admin_id',$admin_id)->select('id','company_name','person_name','supplier_type','city')->get();
        $supplier = [];
        foreach ($supplierArray as $key => $value) {
            $supplier[$value->id] = $value->person_name.', '.$value->city;
        }
        $products = ManageProduct::where('admin_id',$admin_id)->select('product_name','id')->get()->pluck('product_name','id')->toArray();
        return view('manage_inward.create',compact('supplier','products'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'inward_date' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'rate' => 'required',
            'amount' => 'required',
            'reference_no' => 'required',

        ],[
            'inward_date.required' => 'Please Enter inward date',
            'supplier_id.required' => 'Please select supplier',
            'product_id.required' => 'Please select product',
            'qty.required' => 'Please enter qty',
            'rate.required' => 'Please enter rate',
            'amount.required' => 'Please enter amount',
            'reference_no.required' => 'Please enter reference no',
        ]);
        $input = $request->all();
        $admin_id = admin_id();

        $inwardArray = [
            'admin_id' => $admin_id,
            'inward_date' => $request->inward_date,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
            'reference_no' => $request->reference_no
        ];

        $inward = ManageInward::create($inwardArray);

        $ids = $request->get_ids;
        if(isset($ids) && $ids)
        {
            foreach ($ids as $id)
            {
                $product=[];
                $product=[
                    'admin_id' => $admin_id,
                    'inward_id' => $inward->id,
                    'product_id' => $input['product_id_'.$id],
                    'qty' => $input['qty_'.$id],
                    'rate' => $input['rate_'.$id],
                    'amount' => $input['amount_'.$id],
                ];
                if($product)
                {
                    InwardProduct::create($product);
                }
            }
        }
        return redirect()->route('manage_inward.index')->with('success','Inward create successfully');
    }

    public function edit($id)
    {
        $inward = ManageInward::find($id);

        $admin_id = admin_id();
        $supplierArray = Supplier::where('admin_id',$admin_id)->select('id','company_name','person_name','supplier_type','city')->get();
        $supplier = [];
        foreach ($supplierArray as $key => $value) {
            $supplier[$value->id] = $value->person_name.', '.$value->city;
        }
        $products = ManageProduct::where('admin_id',$admin_id)->select('product_name','id')->get()->pluck('product_name','id')->toArray();

        return view('manage_inward.edit',compact('inward','supplier','products'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'inward_date' => 'required',
            'supplier_id' => 'required',
            'reference_no' => 'required',

        ],[
            'inward_date.required' => 'Please Enter inward date',
            'supplier_id.required' => 'Please select supplier',
            'reference_no' => $request->reference_no
        ]);

        $input = $request->all();
        $admin_id = admin_id();
        $inward = ManageInward::find($id);

        $inwardArray = [
            'admin_id' => $admin_id,
            'inward_date' => $request->inward_date,
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
            'reference_no' => $request->reference_no
        ];

        $inward->update($inwardArray);

        $ids = $request->get_ids;
        if(isset($ids) && $ids)
        {
            InwardProduct::where('inward_id',$inward->id)->delete();
            foreach ($ids as $id)
            {
                $product=[];
                $product=[
                    'admin_id' => $admin_id,
                    'inward_id' => $inward->id,
                    'product_id' => $input['product_id_'.$id],
                    'qty' => $input['qty_'.$id],
                    'rate' => $input['rate_'.$id],
                    'amount' => $input['amount_'.$id],
                ];
                if($product)
                {
                    InwardProduct::create($product);
                }
            }
        }
        return redirect()->route('manage_inward.index')->with('success','Inward update successfully');
    }

    public function destroy($id)
    {
        $admin_id = admin_id();
        $inward = ManageInward::find($id);
        if($inward->admin_id == $admin_id)
        {
            $inward->delete();

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
        return json_encode($product);
    }

    public function addProduct(Request $request)
    {
        $product = ManageProduct::where('manage_products.id',$request->product_id)
            ->join('product_groups','manage_products.group_id','product_groups.id','LEFT')
            ->select('manage_products.product_code','manage_products.product_name','product_groups.group')
            ->first();
        $uniqId = uniqid();
        $amount = $request->qty * $request->rate;
        $html = '<tr id="row_'.$uniqId.'">
                <td>'.$product->product_name.'
                    <input type="hidden" value="'.$request->product_id.'" name="product_id_'.$uniqId.'" id="product_id_'.$uniqId.'">
                </td>
                <td>'.$product->product_code.'
                    <input type="hidden" value="'.$product->product_code.'" name="product_code_'.$uniqId.'" id="product_code_'.$uniqId.'">
                </td>
                <td>'.$product->group.'
                    <input type="hidden" value="'.$product->group.'" name="group'.$uniqId.'" id="group'.$uniqId.'">
                </td>
                <td>'.$request->qty.'
                    <input type="hidden" value="'.$request->qty.'" name="qty_'.$uniqId.'" id="qty_'.$uniqId.'">
                </td>
                <td>'.$request->rate.'
                    <input type="hidden" value="'.$request->rate.'" name="rate_'.$uniqId.'" id="rate_'.$uniqId.'">
                </td>
                <td>'.$amount.'
                    <input type="hidden" value="'.$amount.'" name="amount_'.$uniqId.'" id="amount_'.$uniqId.'">
                </td>

                <td>
                    <a href="javascript:void(0)" onclick="removeProduct(`'.$uniqId.'`)"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                    <input type="hidden" name="get_ids[]" value="'.$uniqId.'">
                </td>
            </tr>';
        return json_encode($html);
    }
}
