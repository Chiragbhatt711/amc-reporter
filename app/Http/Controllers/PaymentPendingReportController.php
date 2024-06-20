<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use DB;

class PaymentPendingReportController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:payment-pending-report-list|payment-pending-report-create|payment-pending-report-edit|payment-pending-report-delete', ['only' => ['index','store']]);
         $this->middleware('permission:payment-pending-report-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-pending-report-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-pending-report-delete', ['only' => ['destroy']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }

    public function index()
    {
        $admin_id = admin_id();
        $amcData = ManageAmc::where('manage_amcs.admin_id',$admin_id)
            ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
            ->select('manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_parties.mobile_no','manage_amcs.id as amc_no','manage_amcs.amc_type','manage_amcs.start_date','manage_amcs.end_date','manage_amcs.total_amount')
            ->get();
        $report = [];
        if($amcData)
        {
            foreach($amcData as $value)
            {
                $amc_no = $value['amc_no'];

                $row = ManageAmc::where('manage_amcs.id',$amc_no)
                ->join('manage_receipts','manage_amcs.id','=','manage_receipts.amc_id','LEFT')
                ->select('manage_amcs.total_amount as total_amount',DB::raw('SUM(manage_receipts.amount) as amount'))
                ->groupBy('manage_receipts.amc_id','total_amount')
                ->get()->toArray();
                $pendingAmount = $row[0]['total_amount'] - $row[0]['amount'];
                $value['pending_amount'] = $pendingAmount;
                $report[] = $value;
            }
        }

        return view('payment_pending_report.index',compact('report'));
    }
}
