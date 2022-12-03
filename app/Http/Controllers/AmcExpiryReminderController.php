<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageParty;
use App\Models\ManageTax;
use App\Models\ContractType;
use App\Models\AmcSchedulePaymentDetail;
use App\Models\AmcScheduleServiceDetail;

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

    public function amcRenew($id)
    {
        $manageAmc = ManageAmc::find($id);
        $admin_id = admin_id();
        if($manageAmc->admin_id == $admin_id)
        {
            $party = ManageParty::select('id','party_name','city')->where('admin_id',$admin_id)->get();
            $tax = ManageTax::where('admin_id',$admin_id)->get()->pluck('profile_name','id')->toArray();
            $product = ContractType::where('contract_types.admin_id',$admin_id)
                    ->join('brands','contract_types.brand','brands.id')
                    ->join('contract_models','contract_types.model','contract_models.id')
                    ->select('contract_types.id','contract_types.product_code as product_code','contract_types.product_name as product_name','brands.name as brand','contract_models.name as model')
                    ->get();

            $partyName = [];
            foreach($party as $data)
            {
                $partyName += [$data->id => $data->party_name.','.$data->city];
            }

            $products = [];
            foreach($product as $data)
            {
                $products += [$data->id => $data->product_code.','.$data->product_name.','.$data->brand.','.$data->model];
            }
            $day = ['Auto' => 'Auto'];
            for($i=1;$i<=31;$i++)
            {
                $day +=[$i => $i];
            }
            $service = AmcScheduleServiceDetail::where('amc_id',$id)->get();
            $payment = AmcSchedulePaymentDetail::where('amc_id',$id)->get();
            return view('amc_expiry_reminder.amc_renew',compact('manageAmc','partyName','tax','products','day','service','payment'));
        }
        else
        {
            return redirect()->back()->with('success','Somthing wrong');
        }
    }
}
