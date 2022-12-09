<?php

namespace App\Http\Controllers;

use App\Models\ManageComplaint;
use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageParty;
use App\Models\ManageComplaintTemplate;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ManageComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage_complaint.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_id = admin_id();

        $amcData = ManageAmc::where(['manage_amcs.admin_id' => $admin_id])
        ->join('manage_parties','manage_amcs.party_id','manage_parties.id')
        ->select('manage_amcs.*','manage_parties.party_name as party_name')
        ->get();
        $amc=[];
        foreach ($amcData as $value)
        {
            $amc += [$value['id'] => $value['id'].', '.$value['party_name'].', '.$value['amc_type']];
        }

        $parties = ManageParty::where('admin_id',$admin_id)->get()->pluck('party_name','id')->toArray();
        $complaint = ManageComplaintTemplate::where('admin_id',$admin_id)->get()->pluck('title','id')->toArray();

        $executiveRole =Role::where(['admin_id'=>$admin_id,'name'=>'Executive'])->pluck('id')->first();
        $executive = User::where(['admin_id'=>$admin_id,'role_id'=>$executiveRole])->get()->pluck('name','id')->toArray();
        return view('manage_complaint.create',compact('amc','parties','complaint','executive'));
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
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function show(ManageComplaint $manageComplaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageComplaint $manageComplaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageComplaint $manageComplaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageComplaint $manageComplaint)
    {
        //
    }
}
