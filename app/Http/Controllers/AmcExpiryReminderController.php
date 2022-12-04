<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageParty;
use App\Models\ManageTax;
use App\Models\ContractType;
use App\Models\AmcSchedulePaymentDetail;
use App\Models\AmcScheduleServiceDetail;
use App\Models\AmcPeroductDetail;

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

    public function amcRenewUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'product_id' => 'required',
            'qty' => 'required',

        ],[
            'start_date.required' => 'Please select start date',
            'end_date.required' => 'Please select end date',
            'product_id.required' => 'Please select product',
            'qty.required' => 'Please enter qty',
        ]);
        $input = $request->all();
        $admin_id = admin_id();
        $manageAmc = ManageAmc::find($id);
        if($admin_id == $manageAmc->admin_id)
        {
            $manageAmc->update($input);

            $amc_id = $id;
            AmcPeroductDetail::where('amc_id',$amc_id)->delete();
            $amcProductDetails = [];
            if(isset($request->get_ids) && $request->get_ids)
            {
                foreach($request->get_ids as $id)
                {
                    $amcProductDetails = [];
                    $amcProductDetails=[
                        'admin_id' => $admin_id,
                        'amc_id' => $amc_id,
                        'product_id' => $input['product_id_'.$id],
                        'product_qty' => $input['qty_'.$id],
                        'note' => $input['note_'.$id],
                    ];
                    if($amcProductDetails)
                    {
                        $amcProductCreate = AmcPeroductDetail::create($amcProductDetails);
                    }
                }
            }
            AmcScheduleServiceDetail::where('amc_id',$amc_id)->delete();
            $scheduleServiceDetails = [];
            if(isset($input['no_of_service']) && $input['no_of_service'])
            {
                $service = $input['no_of_service'];
                for($i=1; $i <= $service; $i++)
                {
                    $scheduleServiceDetails = [];
                    if(isset($input['service_'.$i]) && $input['service_'.$i])
                    {
                        $scheduleServiceDetails = [
                            'admin_id' => $admin_id,
                            'amc_id' => $amc_id,
                            'service_date' => $input['service_'.$i],
                        ];
                    }
                    if($scheduleServiceDetails)
                    {
                        $scheduleServiceCreate = AmcScheduleServiceDetail::create($scheduleServiceDetails);
                    }
                }
            }

            AmcSchedulePaymentDetail::where('amc_id',$amc_id)->delete();
            $schedulePaymentDetails = [];
            if(isset($input['no_of_installment']) && $input['no_of_installment'])
            {
                $schedulePayment = $input['no_of_installment'];
                for($i=1; $i <= $schedulePayment; $i++)
                {
                    $schedulePaymentDetails = [];
                    if(isset($input['installmetn_'.$i]) && $input['installmetn_'.$i])
                    {
                        $schedulePaymentDetails = [
                            'admin_id' => $admin_id,
                            'amc_id' => $amc_id,
                            'installment_date' => $input['installmetn_'.$i],
                            'installment_amount' => $input['amount_'.$i],
                        ];
                    }
                    if($schedulePaymentDetails)
                    {
                        $amcSchedulePaymentCreate = AmcSchedulePaymentDetail::create($schedulePaymentDetails);
                    }
                }
            }
            return redirect()->route('amc_expiry_reminder')->with('success','Manage amc renew successfully');
        }
        else
        {
            return redirect()->route('amc_expiry_reminder')->with('success','Somthing wrong');
        }
    }
}
