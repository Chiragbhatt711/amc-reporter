<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageComplaint;
use App\Models\ManageOutward;
use App\Models\ManageProduct;
use App\Models\OutwardProduct;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $admin_id = admin_id();
        $toDay = Carbon::now()->format('Y-m-d');
        $day = isset($request->day) && $request->day ? $request->day : 30;
        if($day)
        {
            $endDate = Carbon::now()->addDay($day)->format('Y-m-d');
        }
        $amcTicker = ManageAmc::where('manage_amcs.admin_id',$admin_id)
        ->whereDate('manage_amcs.end_date', '>=', $toDay)
        ->whereDate('manage_amcs.end_date', '<=', $endDate)
        ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
        ->select('manage_amcs.id','manage_amcs.end_date','manage_parties.party_name as compny','manage_parties.contact_person_name as person_name')
        ->get();

        $paymentDay = isset($request->payment_day) && $request->payment_day ? $request->payment_day : 30;
        if($paymentDay)
        {
            $endDate = Carbon::now()->addDay($paymentDay)->format('Y-m-d');
        }

        $paymentTicker = ManageAmc::where('manage_amcs.admin_id',$admin_id)
        ->join('amc_schedule_payment_details','manage_amcs.id','=','amc_schedule_payment_details.amc_id','LEFT')
        ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
        ->join('manage_receipts','manage_amcs.id','=','manage_receipts.amc_id','LEFT')
        ->leftJoin('amc_schedule_payment_details as payment', function($payment)use($toDay,$endDate){
            $payment->on('manage_amcs.id','=','payment.amc_id')
                ->whereDate('payment.installment_date', '>=', $toDay)
                ->whereDate('payment.installment_date', '<=', $endDate)
                ->orderBy('receipt.id','desc')->limit(1);
        })
        ->whereDate('amc_schedule_payment_details.installment_date', '>=', $toDay)
        ->whereDate('amc_schedule_payment_details.installment_date', '<=', $endDate)
        ->select('manage_amcs.id as amc_no','manage_parties.party_name as compny','manage_parties.contact_person_name as person_name','payment.installment_date as due_date',DB::raw('SUM(amc_schedule_payment_details.installment_amount) as totle_amount, SUM(manage_receipts.amount) as paid_amount'))
        // ->orderBy('amc_schedule_payment_details.installment_date','DESC')
        ->groupBy('manage_amcs.id')
        ->get();
        // dd($paymentTicker);
        return view('amc_dashboard',compact('day','amcTicker','paymentDay','paymentTicker'));
    }

    public function callDashboard()
    {
        $admin_id = admin_id();
        $pendingComplaint = ManageComplaint::where('admin_id',$admin_id)
            ->where('status',null)
            ->count();
        $completeComplaint = ManageComplaint::where('admin_id',$admin_id)
            ->whereNotNull('status')
            ->count();
        return view('call_dashboard',compact('pendingComplaint','completeComplaint'));
    }

    public function stockDashboard(Request $request)
    {
        $admin_id = admin_id();
        $toDay = Carbon::now()->format('Y-m-d');
        $day = isset($request->day) && $request->day ? $request->day : 30;
        if($day)
        {
            $endDate = Carbon::now()->subDay($day)->format('Y-m-d');
        }

        $data = ManageProduct::where('manage_products.admin_id', $admin_id)
            ->leftJoin('inward_products', 'manage_products.id', '=', 'inward_products.product_id')
            ->select('manage_products.*',
                    DB::raw('COALESCE(SUM(inward_products.qty), 0) as inward_qty'))
            ->groupBy('inward_products.product_id')
            ->get();
        $stockSummary = [];
        foreach ($data as $key => $value) {
            $productId = $value->id;
            $outward = OutwardProduct::where('product_id',$productId)
                ->select(DB::raw('COALESCE(SUM(qty), 0) as outward_qty'))
                ->groupBy('product_id')
                ->get();
            $value['outward_qty'] = isset($outward[0]->outward_qty) && $outward[0]->outward_qty ? $outward[0]->outward_qty : 0;
            array_push($stockSummary,$value);
        }


        $OutWard = OutwardProduct::where('outward_products.admin_id', $admin_id)
            ->whereDate('outward_products.created_at', '<=', $toDay)
            ->whereDate('outward_products.created_at', '>=', $endDate)
            ->leftJoin('manage_products', 'outward_products.product_id', '=', 'manage_products.id')
            ->select('manage_products.*',
                    DB::raw('COALESCE(SUM(outward_products.qty), 0) as outward_qty'))
            ->groupBy('outward_products.product_id')
            ->get();

        return view('stock_dashboard',compact('stockSummary','OutWard','day'));
    }
}
