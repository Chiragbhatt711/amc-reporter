<?php

namespace App\Http\Controllers;

use App\Models\ManageReceipt;
use Illuminate\Http\Request;
use App\Models\ManageParty;
use App\Models\ManageAmc;
use Illuminate\Support\Facades\DB;

class ManageReceiptController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-receipt-list|manage-receipt-create|manage-receipt-edit|manage-receipt-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-receipt-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-receipt-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-receipt-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $receipt = ManageReceipt::where('manage_receipts.admin_id',$admin_id)
            ->join('manage_parties','manage_receipts.party_id','manage_parties.id','LEFT')
            ->join('manage_amcs','manage_receipts.amc_id','manage_amcs.id')
            ->select('manage_receipts.*','manage_parties.party_name as party_name','manage_parties.contact_person_name as contact_person_name','manage_parties.city as city','manage_amcs.id as amc_no','manage_amcs.amc_type as amc_type')
            ->get();

        return view('manage_receipt.index',compact('receipt'));
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
        $partyName = [];
        foreach($party as $data)
        {
            $partyName += [$data->id => $data->party_name.','.$data->city];
        }
        $paymentMode = [
            'Cash' => 'Cash',
            'Cheque' => 'Cheque',
            'DD' => 'DD',
            'Net Transfer/RTGS/NEFT' => 'Net Transfer/RTGS/NEFT',
            'Other' => 'Other',
        ];
        return view('manage_receipt.create',compact('partyName','paymentMode'));
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
            'amc_id' => 'required',
            'date' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required',
            'payment_date' =>'required',

        ],[
            'party_id.required'=> 'Please select party',
            'amc_id.required'=> 'Please select amc no',
            'date.required' => 'Please enter date',
            'payment_mode.required' => 'Please select mode of payment',
            'amount.required' => 'Please enter amount',
            'payment_date.required' => 'Please enter payment date',
        ]);

        $input = $request->all();
        $admin_id = admin_id();
        $input['admin_id'] = $admin_id;
        $insert = ManageReceipt::create($input);

        return redirect()->route('manage_receipt.index')->with('success','Manage receipt create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(ManageReceipt $manageReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt = ManageReceipt::find($id);

        $admin_id = admin_id();
        if($receipt->admin_id == $admin_id)
        {
            $party = ManageParty::select('id','party_name','city')->where('admin_id',$admin_id)->get();
            $partyName = [];
            foreach($party as $data)
            {
                $partyName += [$data->id => $data->party_name.','.$data->city];
            }
            $paymentMode = [
                'Cash' => 'Cash',
                'Cheque' => 'Cheque',
                'DD' => 'DD',
                'Net Transfer/RTGS/NEFT' => 'Net Transfer/RTGS/NEFT',
                'Other' => 'Other',
            ];
            return view('manage_receipt.edit',compact('receipt','partyName','paymentMode'));
        }
        else
        {
            return redirect()->route('manage_receipt.index')->with('success','Somthing with wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'party_id' => 'required',
            'amc_id' => 'required',
            'date' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required',
            'payment_date' =>'required',

        ],[
            'party_id.required'=> 'Please select party',
            'amc_id.required'=> 'Please select amc no',
            'date.required' => 'Please enter date',
            'payment_mode.required' => 'Please select mode of payment',
            'amount.required' => 'Please enter amount',
            'payment_date.required' => 'Please enter payment date',
        ]);

        $input = $request->all();
        $admin_id = admin_id();
        $receipt = ManageReceipt::find($id);

        if($receipt->admin_id == $admin_id)
        {
            $receipt->update($input);
            return redirect()->route('manage_receipt.index')->with('success','Manage receipt update successfully');
        }
        else
        {
            return redirect()->route('manage_receipt.index')->with('success','Somthing with wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_id = admin_id();
        $receipt = ManageReceipt::find($id);

        if($receipt->admin_id == $admin_id)
        {
            $receipt->delete();
            return redirect()->route('manage_receipt.index')->with('success','Manage receipt delete successfully');
        }
        else
        {
            return redirect()->route('manage_receipt.index')->with('success','Somthing with wrong');
        }
    }

    public function getAmcNumber(Request $request)
    {
        $admin_id = admin_id();
        $party_id = $request->party_id;

        $amcData = ManageAmc::where(['admin_id' => $admin_id,'party_id' => $party_id])->get();
        $data=[];
        foreach ($amcData as $value)
        {
            $data += [$value['id'] => $value['id'].', '.$value['amc_type'].', '.$value['start_date'].' To '.$value['end_date']];
        }

        return json_encode($data);
    }

    public function getDueAmount(Request $request)
    {
        $amc_no = $request->amc_no;

        $id = "";
        if(isset($request->id) && $request->id)
        {
            $id = $request->id;
        }

        $row = ManageAmc::where('manage_amcs.id',$amc_no)
        ->select('manage_amcs.total_amount as total_amount')
        ->get()->toArray();

        $receipt = ManageReceipt::where('amc_id',$amc_no);
        if($id)
        {
            $receipt->where('id','!=',$id);
        }
        $receipt = $receipt->select(DB::raw('SUM(amount) as amount'))
        ->groupBy('manage_receipts.amc_id')
        ->get()->toArray();

        $dueAmount = 0;
        if(isset($row[0]['total_amount']))
        {
            $dueAmount = $row[0]['total_amount'];
            if(isset($receipt[0]['amount']))
            {
                $dueAmount = $row[0]['total_amount'] - $receipt[0]['amount'];
            }
        }


        return $dueAmount;
    }
}
