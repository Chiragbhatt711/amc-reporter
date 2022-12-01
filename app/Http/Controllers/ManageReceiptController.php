<?php

namespace App\Http\Controllers;

use App\Models\ManageReceipt;
use Illuminate\Http\Request;
use App\Models\ManageParty;
use App\Models\ManageAmc;
use Illuminate\Support\Facades\DB;

class ManageReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage_receipt.index');
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
            'Net Transfer/RTGS/NEFT',
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
        //
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
    public function edit(ManageReceipt $manageReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageReceipt $manageReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageReceipt  $manageReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageReceipt $manageReceipt)
    {
        //
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

        $row = ManageAmc::where('manage_amcs.id',$amc_no)
            ->join('manage_receipts','manage_amcs.id','=','manage_receipts.amc_id','LEFT')
            ->select('manage_amcs.total_amount as total_amount',DB::raw('SUM(manage_receipts.amount) as amount'))
            ->groupBy('manage_receipts.amc_id','total_amount')
            ->get()->toArray();

        $dueAmount = $row[0]['total_amount'] - $row[0]['amount'];

        return $dueAmount;
    }
}
