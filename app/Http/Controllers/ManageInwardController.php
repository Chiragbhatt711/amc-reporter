<?php

namespace App\Http\Controllers;

use App\Models\InwardProduct;
use App\Models\ManageInward;
use App\Models\ManageProduct;
use Illuminate\Http\Request;
use App\Models\Supplier;

class ManageInwardController extends Controller
{
    public function index()
    {
        return view('manage_inward.index');
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

        ],[
            'inward_date.required' => 'Please Enter inward date',
            'supplier_id.required' => 'Please select supplier',
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
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
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
                <td>'.$product->group.'
                    <input type="hidden" value="'.$product->group.'" name="group'.$uniqId.'" id="group'.$uniqId.'">
                </td>
                <td>'.$product->product_code.'
                    <input type="hidden" value="'.$product->product_code.'" name="product_code_'.$uniqId.'" id="product_code_'.$uniqId.'">
                </td>
                <td>'.$product->product_name.'
                    <input type="hidden" value="'.$request->product_id.'" name="product_id_'.$uniqId.'" id="product_id_'.$uniqId.'">
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
