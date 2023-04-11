<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\ManageAmc;
use App\Models\AmcPeroductDetail;
use App\Models\CallUpdateItem;
use App\Models\InwardProduct;
use App\Models\ManageReceipt;
use App\Models\OutwardProduct;

if(!function_exists('admin_id'))
{
    function admin_id()
    {
        $roleId = Role::where('name','=','Admin')->first();
        $role_id = $roleId->id;
        $userRole = auth()->user()->role_id;

        if($userRole == $role_id)
        {
            $admin_id = auth()->user()->id;
        }
        else
        {
            $admin_id = auth()->user()->admin_id;
        }
        return $admin_id;
    }
}


function getAmcProductDetails($id)
{
    $product = AmcPeroductDetail::where('amc_id',$id)
        ->join('contract_types','amc_peroduct_details.product_id','=','contract_types.id','LEFT')
        ->join('brands','contract_types.brand','=','brands.id','LEFT')
        ->join('contract_models','contract_types.model','=','contract_models.id','LEFT')
        ->select('amc_peroduct_details.product_id','amc_peroduct_details.product_qty as qty','amc_peroduct_details.note as note','contract_types.product_code as product_code','contract_types.product_name as product_name','brands.name as brand','contract_models.name as model')
        ->get();

    return $product;

}

function callUpdateItems($id)
{
    $items = CallUpdateItem::where('complaint_id',$id)
        ->select('item_name','used_qty','rate','amount')
        ->get();
    return $items;
}

if(!function_exists('getAmcReceipt'))
{
    function getAmcReceipt($id)
    {
        $receipt = ManageReceipt::where('amc_id',$id)->select('id','payment_mode','date','amount')->get();

        return $receipt;
    }
}

if(!function_exists('unit'))
{
    function unit()
    {
        $unit = [
            'Pcs' => 'Pcs',
            'Nos' => 'Nos',
            'Kg' => 'Kg',
            'gm' => 'gm',
            'in' => 'in',
            'mg' => 'mg',
            'ml' => 'ml',
            'm' => 'm',
            'ft' => 'ft',
        ];

        return $unit;
    }
}

if(!function_exists('getInwardProductDetails'))
{
    function getInwardProductDetails($id)
    {
        $product = InwardProduct::where('inward_products.inward_id',$id)
            ->join('manage_products','inward_products.product_id','=','manage_products.id','LEFT')
            ->join('product_groups','manage_products.group_id','product_groups.id','LEFT')
            ->select('inward_products.id','manage_products.product_code','manage_products.product_name','product_groups.group as group','inward_products.product_id',DB::raw('SUM(inward_products.qty) as qty'),DB::raw('SUM(inward_products.rate) as rate'),DB::raw('SUM(inward_products.amount) as amount'))
            ->groupBy('inward_products.product_id')
            ->get();
        return $product;
    }
}

if(!function_exists('getOutwardProductDetails'))
{
    function getOutwardProductDetails($id)
    {
        $product = OutwardProduct::where('outward_products.outward_id',$id)
            ->join('manage_products','outward_products.product_id','=','manage_products.id','LEFT')
            ->join('product_groups','manage_products.group_id','product_groups.id','LEFT')
            ->select('outward_products.id','manage_products.product_code','manage_products.product_name','product_groups.group as group','outward_products.product_id',DB::raw('SUM(outward_products.qty) as qty'),DB::raw('SUM(outward_products.rate) as rate'),DB::raw('SUM(outward_products.amount) as amount'))
            ->groupBy('outward_products.product_id')
            ->get();
        return $product;
    }
}

?>
