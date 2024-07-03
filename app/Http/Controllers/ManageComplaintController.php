<?php

namespace App\Http\Controllers;

use App\Models\ManageComplaint;
use Illuminate\Http\Request;
use App\Models\ManageAmc;
use App\Models\ManageParty;
use App\Models\ManageComplaintTemplate;
use App\Models\User;
use App\Models\AmcPeroductDetail;
use App\Models\ManageSolutionTemplate;
use App\Models\CallUpdateItem;
use App\Models\ContractType;
use App\Models\ManageProduct;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageComplaintController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-complaint-list|manage-complaint-create|manage-complaint-edit|manage-complaint-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-complaint-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-complaint-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-complaint-delete', ['only' => ['destroy']]);
         $this->middleware('permission:call-register-list', ['only' => ['callRegister']]);
         $this->middleware('permission:complaint-summary-list', ['only' => ['complaintSummary']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->start_date) && $request->start_date)
        {
            $startDate = $request->start_date;
        }
        else
        {
            $startDate = Carbon::now()->format('Y-m-01');
        }
        if(isset($request->end_date) && $request->end_date)
        {
            $endDate = $request->end_date;
        }
        else
        {
            $endDate = Carbon::now()->format('Y-m-d');
        }
        $admin_id = admin_id();
        $data = ManageComplaint::where('manage_complaints.admin_id',$admin_id)
        ->whereDate('manage_complaints.created_at', '>=', $startDate)
        ->whereDate('manage_complaints.created_at', '<=', $endDate)
        ->join('manage_amcs','manage_complaints.amc_no','=','manage_amcs.id','LEFT')
        ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
        ->join('manage_complaint_templates','manage_complaints.complaint_id','=','manage_complaint_templates.id','LEFT')
        ->join('manage_parties as complaint_user','manage_complaints.complaint_by','=','complaint_user.id','LEFT')
        ->join('users as handover','manage_complaints.handover_to','=','handover.id','LEFT')
        ->select('manage_complaints.id as id','manage_complaints.admin_id','manage_complaints.comp_by_mobile_number as mobile','manage_complaints.description as description','manage_complaints.priority as priority','manage_complaints.handover as handover','manage_complaints.handover_date as handover_date','manage_complaints.handover_time as handover_time','manage_complaints.created_at as created_at','manage_complaints.status as status','manage_complaints.service_date','manage_complaints.is_free','manage_amcs.amc_no','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_complaint_templates.title as complait_title','complaint_user.party_name as complait_by','handover.name as handover');
        if(isset($request->type) && $request->type)
        {
            switch ($request->type) {
                case 'free':
                    $data->where('is_free',1);
                    break;
                case 'complaint':
                    $data->where('is_free',0);
                    break;

                default:
                    # code...
                    break;
            }
        }
        $data = $data->get();

        return view('manage_complaint.index',compact('data','startDate','endDate'));
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
        ->join('manage_parties','manage_amcs.party_id','manage_parties.id','LEFT')
        ->select('manage_amcs.*','manage_parties.party_name as party_name')
        ->get();
        $amc=[];
        foreach ($amcData as $value)
        {
            $amc += [$value['id'] => $value['amc_no'].', '.$value['party_name'].', '.$value['amc_type']];
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
            'handover_date' => 'required_if:handover,1',
        ],[
            'amc_no.required'=> 'Please select party/amc',
            'product_id.required' => 'Please select product',
            'complaint_by.required' => 'Please select complaint by',
            'comp_by_mobile_number.required'=> 'Please enter comp.by mobile no',
            'complaint_id.required'=> 'Please select complaint',
            'description.required' => 'Please enter description',
            'priority.required'=> 'Please select priority',
            'handover_to.required_if' => 'Please select handover to',
            'handover_date.required_if' => 'Please select date'
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
    public function edit($id)
    {
        $data = ManageComplaint::find($id);

        $admin_id = admin_id();
        if($data->admin_id == $admin_id)
        {
            $amcData = ManageAmc::where(['manage_amcs.admin_id' => $admin_id])
            ->join('manage_parties','manage_amcs.party_id','manage_parties.id')
            ->select('manage_amcs.*','manage_parties.party_name as party_name')
            ->get();
            $amc=[];
            foreach ($amcData as $value)
            {
                $amc += [$value['id'] => $value['amc_no'].', '.$value['party_name'].', '.$value['amc_type']];
            }

            $parties = ManageParty::where('admin_id',$admin_id)->get()->pluck('party_name','id')->toArray();
            $complaint = ManageComplaintTemplate::where('admin_id',$admin_id)->get()->pluck('title','id')->toArray();

            $executiveRole =Role::where(['admin_id'=>$admin_id,'name'=>'Executive'])->pluck('id')->first();
            $executive = User::where(['admin_id'=>$admin_id,'role_id'=>$executiveRole])->get()->pluck('name','id')->toArray();
            return view('manage_complaint.edit',compact('data','amc','parties','complaint','executive'));
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
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'handover_date' => 'required_if:handover,1',
        ],[
            'amc_no.required'=> 'Please select party/amc',
            'product_id.required' => 'Please select product',
            'complaint_by.required' => 'Please select complaint by',
            'comp_by_mobile_number.required'=> 'Please enter comp.by mobile no',
            'complaint_id.required'=> 'Please select complaint',
            'description.required' => 'Please enter description',
            'priority.required'=> 'Please select priority',
            'handover_to.required_if' => 'Please select handover to',
            'handover_date.required_if' => 'Please select date'
        ]);

        $input = $request->all();
        $data = ManageComplaint::find($id);
        $admin_id = admin_id();
        if($data->admin_id == $admin_id)
        {
            $input['handover_date'] = date('Y-m-d',strtotime($request->handover_date));
            $data->update($input);

            return redirect()->route('manage_complaint.index')->with('success','complate update successfully');
        }
        else
        {
            return redirect()->route('manage_complaint.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageComplaint  $manageComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ManageComplaint::find($id);
        $admin_id = admin_id();
        if($data->admin_id == $admin_id)
        {
            $data->delete();

            return redirect()->route('manage_complaint.index')->with('success','complate template delete successfully');
        }
        else
        {
            return redirect()->route('manage_complaint.index')->with('success','Somthing wrong');
        }
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

    public function callUpdate($id)
    {
        $data = ManageComplaint::where('manage_complaints.id',$id)
        ->join('manage_amcs','manage_complaints.amc_no','=','manage_amcs.id','LEFT')
        ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
        ->select('manage_complaints.id','manage_complaints.admin_id','manage_complaints.created_at','manage_complaints.update_date','manage_complaints.status','manage_complaints.attend_by','manage_complaints.solution_id','manage_complaints.call_description','manage_complaints.call_remark','manage_amcs.id as amc_no','manage_amcs.amc_type','manage_amcs.start_date','manage_amcs.end_date','manage_parties.party_name')
        ->first();

        $admin_id = admin_id();

        if($data->admin_id == $admin_id)
        {
            $parties = ManageParty::where('admin_id',$admin_id)->get()->pluck('party_name','id')->toArray();
            $soluction = ManageSolutionTemplate::where('admin_id',$admin_id)->get()->pluck('title','id')->toArray();
            $executiveRole =Role::where(['admin_id'=>$admin_id,'name'=>'Executive'])->pluck('id')->first();
            $executive = User::where(['admin_id'=>$admin_id,'role_id'=>$executiveRole])->get()->pluck('name','id')->toArray();
            $product = ContractType::where('admin_id',$admin_id)->get()->pluck('product_name','id');
            return view('manage_complaint.call_update',compact('data','parties','executive','soluction','product'));
        }
        else
        {
            return redirect()->back()->with('success','Somthing wrong');
        }
    }

    public function callUpdatePost(Request $request,$id)
    {
        $this->validate($request, [
            'update_date' => 'required',
            'status' => 'required',
            'attend_by' => 'required',
            'solution_id' => 'required',
            'call_description' => 'required',

        ],[
            'update_date.required' => 'Please select date',
            'status.required' => 'Please select status',
            'attend_by.required' => 'Please select attend by',
            'solution_id.required' => 'Please select solution',
            'call_description.required' => 'Please enter description',
        ]);
        $input = $request->all();
        $admin_id = admin_id();
        $manageComplaint = ManageComplaint::find($id);
        if($admin_id == $manageComplaint->admin_id)
        {
            $manageComplaint->update($input);

            $complaint_id = $id;
            CallUpdateItem::where('complaint_id',$complaint_id)->delete();
            $itemsDetails = [];
            if(isset($request->get_ids) && $request->get_ids)
            {
                foreach($request->get_ids as $id)
                {
                    $itemsDetails = [];
                    $itemsDetails=[
                        'admin_id' => $admin_id,
                        'complaint_id' => $complaint_id,
                        'item_name' => $input['item_name_'.$id],
                        'used_qty' => $input['used_qty_'.$id],
                        'rate' => $input['rate_'.$id],
                        'amount' => $input['amount_'.$id],
                    ];
                    if($itemsDetails)
                    {
                        $itemsCreate = CallUpdateItem::create($itemsDetails);
                    }
                }
            }
            return redirect()->route('manage_complaint.index')->with('success','Complaint call update successfully');
        }
        else
        {
            return redirect()->route('manage_complaint.index')->with('success','Somthing wrong');
        }
    }

    public function itemAdd(Request $request)
    {
        $item_id = $request->item_name;
        $used_qty = $request->used_qty;
        $rate = $request->rate;
        $amount = $request->amount;

        $uniqId = uniqid();

        $product = ContractType::find($item_id);

        $html = '<tr id="row_'.$uniqId.'">
                    <td>'.$product->product_name.'
                        <input type="hidden" value="'.$item_id.'" name="item_name_'.$uniqId.'" id="item_name_'.$uniqId.'">
                    </td>
                    <td>'.$used_qty.'
                        <input type="hidden" value="'.$used_qty.'" name="used_qty_'.$uniqId.'" id="used_qty_'.$uniqId.'">
                    </td>
                    <td>'.$rate.'
                        <input type="hidden" value="'.$rate.'" name="rate_'.$uniqId.'" id="rate_'.$uniqId.'">
                    </td>
                    <td>'.$amount.'
                        <input type="hidden" value="'.$amount.'" name="amount_'.$uniqId.'" id="amount_'.$uniqId.'">
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="productRemove(`'.$uniqId.'`)"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                        <input type="hidden" name="get_ids[]" value="'.$uniqId.'">
                    </td>
                </tr>';
                echo json_encode(['id'=>$uniqId,'html'=>$html]);
    }

    public function callRegister(Request $request)
    {
        if(isset($request->start_date) && $request->start_date)
        {
            $startDate = $request->start_date;
        }
        else
        {
            $startDate = Carbon::now()->format('Y-m-01');
        }
        if(isset($request->end_date) && $request->end_date)
        {
            $endDate = $request->end_date;
        }
        else
        {
            $endDate = Carbon::now()->format('Y-m-d');
        }
        $admin_id = admin_id();
        $data = ManageComplaint::where('manage_complaints.admin_id',$admin_id)
        ->whereDate('manage_complaints.created_at', '>=', $startDate)
        ->whereDate('manage_complaints.created_at', '<=', $endDate)
        ->join('manage_amcs','manage_complaints.amc_no','=','manage_amcs.id','LEFT')
        ->join('manage_parties','manage_amcs.party_id','=','manage_parties.id','LEFT')
        ->join('manage_complaint_templates','manage_complaints.complaint_id','=','manage_complaint_templates.id','LEFT')
        ->join('manage_parties as complaint_user','manage_complaints.complaint_by','=','complaint_user.id','LEFT')
        ->join('users as handover','manage_complaints.handover_to','=','handover.id','LEFT')
        ->select('manage_complaints.id as id','manage_complaints.comp_by_mobile_number as mobile','manage_complaints.description as description','manage_complaints.priority as priority','manage_complaints.handover as handover','manage_complaints.handover_date as handover_date','manage_complaints.handover_time as handover_time','manage_complaints.created_at as created_at','manage_complaints.status as status','manage_complaints.service_date','manage_complaints.is_free','manage_complaints.update_date','manage_complaints.call_remark','manage_amcs.id','manage_amcs.amc_no','manage_amcs.amc_type as amc_type','manage_amcs.start_date as start_date','manage_amcs.end_date as end_date','manage_parties.party_name','manage_parties.contact_person_name','manage_parties.city','manage_parties.mobile_no','manage_complaint_templates.title as complait_title','complaint_user.party_name as complait_by','handover.name as handover')
        ->get();

        return view('call_reports.call_register',compact('startDate','endDate','data'));
    }

    public function complaintSummary(Request $request)
    {
        if(isset($request->start_date) && $request->start_date)
        {
            $startDate = $request->start_date;
        }
        else
        {
            $startDate = Carbon::now()->format('Y-m-01');
        }
        if(isset($request->end_date) && $request->end_date)
        {
            $endDate = $request->end_date;
        }
        else
        {
            $endDate = Carbon::now()->format('Y-m-d');
        }
        $admin_id = admin_id();

        $data = ManageComplaint::where('manage_complaints.admin_id',$admin_id)
        ->whereDate('manage_complaints.service_date', '>=', $startDate)
        ->whereDate('manage_complaints.service_date', '<=', $endDate)
        ->join('manage_complaint_templates','manage_complaints.complaint_id','=','manage_complaint_templates.id')
        ->groupBy('manage_complaint_templates.title','manage_complaints.complaint_id')
        ->select('manage_complaint_templates.title as complait_title',DB::raw('count(manage_complaints.complaint_id) as total'))
        ->get();

        return view('call_reports.complaint_summary',compact('data','startDate','endDate'));
    }

    public function getComplaintDetails(Request $request)
    {
        $complaint_id = $request->complaint_id;

        $data = ManageComplaintTemplate::find($complaint_id);

        return response()->json($data);
    }

    public function getAmcPartyDetails(Request $request)
    {
        $party = $request->party;

        $data = ManageParty::find($party);

        return response()->json($data);
    }

    public function getSolutionDetails(Request $request)
    {
        $id = $request->solution;
        $data = ManageSolutionTemplate::find($id);
        $description = '';
        if($data){
            $description = $data->description;
        }

        return response()->json($data);
    }
}
