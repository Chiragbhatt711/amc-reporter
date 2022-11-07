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

class ManageAmcController extends Controller
{
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
            'amc_type.required' => 'Please select party name',
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
            'contract_amount' => $request->total_amount,
            'tax' => $request->tax_id,
            'service_day' => $request->service_day,
            'no_of_service' => $request->no_of_service
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

            return view('manage_amc.edit',compact('manageAmc','partyName','tax','products','day'));
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
    public function update(Request $request, ManageAmc $manageAmc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageAmc  $manageAmc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageAmc $manageAmc)
    {
        //
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
}
