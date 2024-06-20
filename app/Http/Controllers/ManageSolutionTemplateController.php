<?php

namespace App\Http\Controllers;

use App\Models\ManageSolutionTemplate;
use Illuminate\Http\Request;

class ManageSolutionTemplateController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-solution-template-list|manage-solution-template-create|manage-solution-template-edit|manage-solution-template-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-solution-template-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-solution-template-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-solution-template-delete', ['only' => ['destroy']]);

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
        $solutionTemplate = ManageSolutionTemplate::where('admin_id',$admin_id)->get();
        return view('manage_solution_template.index',compact('solutionTemplate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_solution_template.create');
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
        ],[
            'title.required'=> 'Please enter title',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();
        $create = ManageSolutionTemplate::create($input);

        return redirect()->route('manage_solution_template.index')->with('success','Solution template create uccessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageSolutionTemplate  $manageSolutionTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ManageSolutionTemplate $manageSolutionTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageSolutionTemplate  $manageSolutionTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solutionTemplate = ManageSolutionTemplate::find($id);
        $admin_id = admin_id();
        if($solutionTemplate->admin_id == $admin_id)
        {
            return view('manage_solution_template.edit',compact('solutionTemplate'));
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
     * @param  \App\Models\ManageSolutionTemplate  $manageSolutionTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ],[
            'title.required'=> 'Please enter title',
        ]);

        $input = $request->all();
        $solutionTemplate = ManageSolutionTemplate::find($id);
        $admin_id = admin_id();
        if($solutionTemplate->admin_id == $admin_id)
        {
            $solutionTemplate->update($input);

            return redirect()->route('manage_solution_template.index')->with('success','Solution template update successfully');
        }
        else
        {
            return redirect()->route('manage_solution_template.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageSolutionTemplate  $manageSolutionTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solutionTemplate = ManageSolutionTemplate::find($id);
        $admin_id = admin_id();
        if($solutionTemplate->admin_id == $admin_id)
        {
            $solutionTemplate->delete();

            return redirect()->route('manage_solution_template.index')->with('success','Solution template delete successfully');
        }
        else
        {
            return redirect()->route('manage_solution_template.index')->with('success','Somthing wrong');
        }
    }
}
