<?php

namespace App\Http\Controllers;

use App\Models\ManageComplaintTemplate;
use Illuminate\Http\Request;

class ManageComplaintTemplateController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-complaint-template-list|manage-complaint-template-create|manage-complaint-template-edit|manage-complaint-template-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-complaint-template-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-complaint-template-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-complaint-template-delete', ['only' => ['destroy']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $complaintTemplate = ManageComplaintTemplate::where('admin_id',$admin_id)->get();
        return view('manage_complaint_template.index',compact('complaintTemplate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_complaint_template.create');
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
            'title' => 'required',
            'priority' => 'required',
        ],[
            'title.required'=> 'Please enter title',
            'priority.required' => 'Please select priority',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();
        $create = ManageComplaintTemplate::create($input);

        return redirect()->route('manage_complaint_template.index')->with('success','Complaint template create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageComplaintTemplate  $manageComplaintTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ManageComplaintTemplate $manageComplaintTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageComplaintTemplate  $manageComplaintTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaintTemplate = ManageComplaintTemplate::find($id);
        $admin_id = admin_id();
        if($complaintTemplate->admin_id == $admin_id)
        {
            return view('manage_complaint_template.edit',compact('complaintTemplate'));
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
     * @param  \App\Models\ManageComplaintTemplate  $manageComplaintTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'priority' => 'required',
        ],[
            'title.required'=> 'Please enter title',
            'priority.required' => 'Please select priority',
        ]);

        $input = $request->all();
        $complaintTemplate = ManageComplaintTemplate::find($id);
        $admin_id = admin_id();
        if($complaintTemplate->admin_id == $admin_id)
        {
            $complaintTemplate->update($input);

            return redirect()->route('manage_complaint_template.index')->with('success','complate template update successfully');
        }
        else
        {
            return redirect()->route('manage_complaint_template.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageComplaintTemplate  $manageComplaintTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaintTemplate = ManageComplaintTemplate::find($id);
        $admin_id = admin_id();
        if($complaintTemplate->admin_id == $admin_id)
        {
            $complaintTemplate->delete();

            return redirect()->route('manage_complaint_template.index')->with('success','complate template delete successfully');
        }
        else
        {
            return redirect()->route('manage_complaint_template.index')->with('success','Somthing wrong');
        }
    }
}
