<?php

namespace App\Http\Controllers;

use App\Models\ManageReceipt;
use Illuminate\Http\Request;
use App\Models\ManageParty;

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
        return view('manage_receipt.create',compact('partyName'));
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
}
