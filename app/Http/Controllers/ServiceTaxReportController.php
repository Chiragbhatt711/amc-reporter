<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ManageAmc;
use Illuminate\Support\Facades\DB;

class ServiceTaxReportController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->start_date) && $request->start_date)
        {
            $startDate = $request->start_date;
        }
        else
        {
            $startDate = Carbon::now()->format('Y-m-d');
        }
        if(isset($request->end_date) && $request->end_date)
        {
            $endDate = $request->end_date;
        }
        else
        {
            $endDate = Carbon::now()->addMonth()->format('Y-m-d');
        }
        $admin_id = admin_id();

        $data = ManageAmc::where('manage_amcs.admin_id',$admin_id)
        ->whereBetween('manage_amcs.start_date',[$startDate,$endDate])
        ->join('manage_taxes','manage_amcs.tax','manage_taxes.id','LEFT')
        ->join('manage_parties','manage_amcs.party_id','manage_parties.id','LEFT')
        ->select('manage_amcs.id as id','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_amcs.contract_amount as basic_amount','manage_parties.party_name as party_name','manage_parties.contact_person_name as contact_person','manage_parties.city as city',DB::raw('SUM(manage_taxes.tax_percentage_1 + manage_taxes.tax_percentage_2 + manage_taxes.tax_percentage_3 + manage_taxes.tax_percentage_4 + manage_taxes.tax_percentage_5) as tax'))
        ->groupBy('manage_amcs.id','manage_amcs.amc_type','manage_amcs.start_date','manage_amcs.end_date','manage_amcs.contract_amount','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city')
        ->get();
        // dd($data);
        return view('service_tax_report.index',compact('data','startDate','endDate'));
    }
}
