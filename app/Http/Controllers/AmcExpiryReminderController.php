<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use Carbon\Carbon;

class AmcExpiryReminderController extends Controller
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
        ->whereBetween('manage_amcs.end_date',[$startDate,$endDate])
        ->join('manage_parties','manage_amcs.party_id','manage_parties.id')
        ->select('manage_amcs.id as id','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_parties.party_name as party_name','manage_parties.contact_person_name as person_name','manage_parties.city as city','manage_parties.mobile_no as mobile_no')
        ->get();
        
        return view('amc_expiry_reminder.index',compact('data','startDate','endDate'));
    }
}
