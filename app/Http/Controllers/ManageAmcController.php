<?php

namespace App\Http\Controllers;

use App\Models\ManageAmc;
use Illuminate\Http\Request;
use App\Models\ManageParty;
use App\Models\ContractType;
use App\Models\ManageTax;
use App\Models\AmcPeroductDetail;
use App\Models\AmcSchedulePaymentDetail;
use App\Models\AmcScheduleServiceDetail;
use App\Models\ManageComplaint;
use Carbon\Carbon;
use DB;

class ManageAmcController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-amc-list|manage-amc-create|manage-amc-edit|manage-amc-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-amc-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-amc-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-amc-delete', ['only' => ['destroy']]);
         $this->middleware('permission:party-ledger-summary-list', ['only' => ['partyLedgerSummary']]);
         $this->middleware('permission:party-ledger-details-list', ['only' => ['partyLedgerDetail']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $manageAmc = ManageAmc::where('manage_amcs.admin_id',$admin_id)
            ->join('manage_parties','manage_amcs.party_id','manage_parties.id')
            ->join('manage_taxes','manage_amcs.tax','manage_taxes.id')
            ->select('manage_amcs.id as id','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_amcs.contract_amount as contract_amount','manage_parties.party_name as party_name','manage_parties.contact_person_name as person_name','manage_parties.city as city','manage_parties.mobile_no as mobile_no','manage_taxes.tax_lable_name as tax')
            ->get();
        // dd($manageAmc);
        return view('manage_amc.index',compact('manageAmc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_id = admin_id();
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
        return view('manage_amc.create',compact('partyName','products','day','tax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'party_id' => 'required',
            'amc_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'product_id' => 'required',
            'qty' => 'required',

        ],[
            'party_id.required' => 'Please select party name',
            'amc_type.required' => 'Please select amc type',
            'start_date.required' => 'Please select start date',
            'end_date.required' => 'Please select end date',
            'product_id.required' => 'Please select product',
            'qty.required' => 'Please enter qty',
        ]);
        $input = $request->all();
        $admin_id = admin_id();
        $manageAmc = [
            'admin_id' => $admin_id,
            'party_id' => $request->party_id,
            'amc_type' => $request->amc_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'note' => $request->note,
            'contract_amount' => $request->contract_amount,
            'tax' => $request->tax_id,
            'service_day' => $request->service_day,
            'no_of_service' => $request->no_of_service,
            'no_of_installment' => $request->no_of_installment,
            'total_amount' => $request->total_amount,
        ];
        $manageAmcCreate = ManageAmc::create($manageAmc);
        $amc_id = $manageAmcCreate->id;
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
                        'amc_no' => $amc_id,
                        'service_date' => $input['service_'.$i],
                        'complaint_by' => $request->party_id,
                        'description' => $i.' Free service',
                        'is_free' => 1
                    ];
                }
                if($scheduleServiceDetails)
                {
                    // $scheduleServiceCreate = AmcScheduleServiceDetail::create($scheduleServiceDetails);
                    $scheduleServiceCreate = ManageComplaint::create($scheduleServiceDetails);
                }
            }
        }

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
        return redirect()->route('manage_amc.index')->with('success','Manage amc create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageAmc  $manageAmc
     * @return \Illuminate\Http\Response
     */
    public function show(ManageAmc $manageAmc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageAmc  $manageAmc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
            $service = ManageComplaint::where(['amc_no'=>$id,'is_free'=>'1'])->get();
            $payment = AmcSchedulePaymentDetail::where('amc_id',$id)->get();
            return view('manage_amc.edit',compact('manageAmc','partyName','tax','products','day','service','payment'));
        }
        else
        {
            return redirect()->back()->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageAmc  $manageAmc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'party_id' => 'required',
            'amc_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'product_id' => 'required',
            'qty' => 'required',

        ],[
            'party_id.required' => 'Please select party name',
            'amc_type.required' => 'Please select amc type',
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
            ManageComplaint::where('amc_no',$amc_id)->delete();
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
                            'amc_no' => $amc_id,
                            'service_date' => $input['service_'.$i],
                            'complaint_by' => $request->party_id,
                            'description' => $i.' Free service',
                            'is_free' => 1
                        ];
                    }
                    if($scheduleServiceDetails)
                    {
                        $scheduleServiceCreate = ManageComplaint::create($scheduleServiceDetails);
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
            return redirect()->route('manage_amc.index')->with('success','Manage amc update successfully');
        }
        else
        {
            return redirect()->route('manage_amc.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageAmc  $manageAmc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manageAmc = ManageAmc::find($id);
        $admin_id = admin_id();
        if($manageAmc && $manageAmc->admin_id == $admin_id)
        {
            $manageAmc->delete();
            AmcPeroductDetail::where('amc_id',$id)->delete();
            AmcScheduleServiceDetail::where('amc_id',$id)->delete();
            AmcSchedulePaymentDetail::where('amc_id',$id)->delete();

            return redirect()->route('manage_amc.index')->with('success','Manage amc delete successfully');
        }
        else
        {
            return redirect()->route('manage_amc.index')->with('success','Somthing wrong');
        }
    }

    public function product_add(Request $request)
    {
        $product_id = $request->product_id;
        $qty = $request->qty;
        $note = $request->note;
        $uniqId = uniqid();

        $product = ContractType::where('contract_types.id',$product_id)
                ->join('brands','contract_types.brand','brands.id')
                ->join('contract_models','contract_types.model','contract_models.id')
                ->select('contract_types.id','contract_types.product_code as product_code','contract_types.product_name as product_name','contract_types.brand as brand_id','brands.name as brand','contract_types.model as model_id','contract_models.name as model')
                ->first();

        $html = '<tr id="row_'.$uniqId.'">
                    <td>'.$product->product_code.'
                        <input type="hidden" value="'.$product->product_code.'" name="product_code_'.$uniqId.'" id="product_code_'.$uniqId.'">
                    </td>
                    <td>'.$product->product_name.'
                        <input type="hidden" value="'.$product->id.'" name="product_id_'.$uniqId.'" id="product_id_'.$uniqId.'">
                    </td>
                    <td>'.$product->model.'
                        <input type="hidden" value="'.$product->model_id.'" name="model_id_'.$uniqId.'" id="model_id_'.$uniqId.'">
                    </td>
                    <td>'.$product->brand.'
                        <input type="hidden" value="'.$product->brand_id.'" name="brand_id_'.$uniqId.'" id="brand_id_'.$uniqId.'">
                    </td>
                    <td>'.$qty.'
                        <input type="hidden" value="'.$qty.'" name="qty_'.$uniqId.'" id="qty_'.$uniqId.'">
                    </td>
                    <td>'.$note.'
                        <input type="hidden" value="'.$note.'" name="note_'.$uniqId.'" id="note_'.$uniqId.'">
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="productRemove(`'.$uniqId.'`)"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                        <input type="hidden" name="get_ids[]" value="'.$uniqId.'">
                    </td>
                </tr>';

        echo json_encode(['id'=>$uniqId,'html'=>$html]);
    }

    public function partyLedgerSummary(Request $request)
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
            ->whereDate('manage_amcs.start_date', '>=', $startDate)
            ->whereDate('manage_amcs.start_date', '<=', $endDate)
            ->join('manage_parties','manage_amcs.party_id','manage_parties.id')
            ->join('manage_receipts','manage_amcs.id','manage_receipts.amc_id')
            ->select('manage_amcs.id','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_parties.opening_balance','manage_amcs.total_amount',DB::raw('SUM(manage_receipts.amount) as amount_recieve'))
            ->groupBy('manage_amcs.id','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_parties.opening_balance','manage_amcs.total_amount','manage_receipts.amc_id')
            ->get();

        return view('manage_amc.party_ledger_summary',compact('data','startDate','endDate'));
    }

    public function partyLedgerDetail(Request $request)
    {
        $data = [];
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

        $party = ManageParty::select('id','party_name')->where('admin_id',$admin_id)->get()->pluck('party_name','id')->toArray();
        $amc = ManageAmc::where(['admin_id' => $admin_id])->get();
        $amcData=[];
        foreach ($amc as $value)
        {
            $amcData += [$value['id'] => $value['id'].', '.$value['amc_type'].', '.$value['start_date'].' To '.$value['end_date']];
        }

        $party_id = '';
        if(isset($request->look_in) && $request->look_in)
        {
            if($request->look_in == "Part Wise")
            {
                if($request->party)
                {
                    $party_id = $request->party;
                    $data = ManageAmc::where('party_id',$request->party)
                    ->whereDate('start_date', '>=', $startDate)
                    ->whereDate('start_date', '<=', $endDate)
                    ->get();
                }
            }
            else if($request->look_in == "AMC Wise")
            {
                if($request->amc)
                {
                    $amc_id = $request->amc;
                    $data = ManageAmc::where('id',$request->amc)
                    ->whereDate('start_date', '>=', $startDate)
                    ->whereDate('start_date', '<=', $endDate)
                    ->get();

                    $amc_data = ManageAmc::where('id',$request->amc)
                    ->whereDate('start_date', '>=', $startDate)
                    ->whereDate('start_date', '<=', $endDate)
                    ->first();
                    if($amc_data)
                    {
                        $party_id = $amc_data->party_id;
                    }
                }
            }
        }

        $partyDetails = [];
        if($party_id)
        {
            $partyDetails = ManageParty::where('id',$party_id)->select('opening_balance','created_at')->first();
        }
        // dd($data);

        return view('manage_amc.party_ledger_detail',compact('data','startDate','endDate','party','amcData','party_id','partyDetails'));
    }

    public function AmcProductDetails(Request $request)
    {
        $product = ContractType::where('contract_types.id',$request->product_id)
                ->join('brands','contract_types.brand','brands.id')
                ->join('contract_models','contract_types.model','contract_models.id')
                ->select('contract_types.id','contract_types.product_code as product_code','contract_types.product_name as product_name','brands.name as brand','contract_models.name as model','contract_types.product_description')
                ->first();

        return response()->json($product);
    }
}
