<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
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
        ->whereDate('amc_schedule_payment_details.installment_date', '>=', $toDay)
        ->whereDate('amc_schedule_payment_details.installment_date', '<=', $endDate)
        ->select('manage_amcs.id as amc_no','manage_parties.party_name as compny','manage_parties.contact_person_name as person_name','amc_schedule_payment_details.installment_date as due_date',DB::raw('SUM(amc_schedule_payment_details.installment_amount) as totle_amount, SUM(manage_receipts.amount) as paid_amount'))
        ->orderBy('amc_schedule_payment_details.installment_date','DESC')
        ->groupBy('manage_amcs.id')
        ->get();
        // dd($paymentTicker);
        return view('amc_dashboard',compact('day','amcTicker','paymentDay','paymentTicker'));
    }
}
