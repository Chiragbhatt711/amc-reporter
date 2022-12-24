<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use Carbon\Carbon;

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
        return view('amc_dashboard',compact('day','amcTicker'));
    }
}
