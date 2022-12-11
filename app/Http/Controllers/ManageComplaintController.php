<?php

namespace App\Http\Controllers;

use App\Models\ManageComplaint;
use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageParty;
use App\Models\ManageComplaintTemplate;
use App\Models\User;
use App\Models\AmcPeroductDetail;
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
        $admin_id = admin_id();
        $data = ManageComplaint::where('manage_complaints.admin_id',$admin_id)
        ->join('manage_amcs','manage_complaints.amc_no','=','manage_amcs.id','LEFT')
        ->join('manage_parties','manage_complaints.complaint_by','=','manage_parties.id','LEFT')
        ->join('manage_complaint_templates','manage_complaints.complaint_id','=','manage_complaint_templates.id','LEFT')
        ->join('users as complaint_user','manage_complaints.complaint_by','=','complaint_user.id','LEFT')
        ->join('users as handover','manage_complaints.handover_to','=','handover.id','LEFT')
        ->select('manage_complaints.id as id','manage_complaints.comp_by_mobile_number as mobile','manage_complaints.description as description','manage_complaints.priority as priority','manage_complaints.handover as handover','manage_complaints.handover_date as handover_date','manage_complaints.handover_time as handover_time','manage_complaints.created_at as created_at','manage_amcs.id as amc_no','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_complaint_templates.title as complait_title','complaint_user.name as complait_by','handover.name as handover')
        ->get();
        return view('manage_complaint.index',compact('data'));
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
        $this->validate($request, [
            'amc_no' => 'required',
            'product_id' => 'required',
            'complaint_by' => 'required',
            'comp_by_mobile_number' => 'required',
            'complaint_id' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'handover_to' => 'required_if:handover,1',
        ],[
            'amc_no.required'=> 'Please select party/amc',
            'product_id.required' => 'Please select product',
            'complaint_by.required' => 'Please select complaint by',
            'comp_by_mobile_number.required'=> 'Please enter comp.by mobile no',
            'complaint_id.required'=> 'Please select complaint',
            'description.required' => 'Please enter description',
            'priority.required'=> 'Please select priority',
            'handover_to.required_if' => 'Please select handover to',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();
        $create = ManageComplaint::create($input);

        return redirect()->route('manage_complaint.index')->with('success','Complaint create successfully');
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

    public function amcParty(Request $request)
    {
        $amc_no = $request->amc_no;
        $product = AmcPeroductDetail::where('amc_id',$amc_no)
        ->join('contract_types','amc_peroduct_details.product_id','=','contract_types.id','LEFT')
        ->select('contract_types.id','contract_types.product_name as product_name',)
        ->groupBy('contract_types.id','product_name')
        ->get()->toArray();

        return json_encode($product);
    }
}
