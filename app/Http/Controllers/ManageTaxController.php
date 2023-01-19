<?php

namespace App\Http\Controllers;

use App\Models\ManageTax;
use Illuminate\Http\Request;

class ManageTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $tax = ManageTax::where('admin_id',$admin_id)->get();
        return view('manage_tax.index',compact('tax'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_tax.create');
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
            'profile_name' => 'required',
            'tax_lable_name' => 'required',
            'tax_caption_1' => 'required',
            'tax_percentage_1' => 'required|numeric',

        ],[
            'profile_name.required'=> 'Please enter profile name',
            'tax_lable_name.required' => 'Please enter tax lable name',
            'tax_caption_1.required'=> 'Please enter tax caption 1',
            'tax_percentage_1.required'=> 'Please enter tax percentage 1',
            'tax_percentage_1.numeric'=> 'Please enter only number',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();

        $create = ManageTax::create($input);

        return redirect()->route('manage_tax.index')->with('success','Tax create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageTax  $manageTax
     * @return \Illuminate\Http\Response
     */
    public function show(ManageTax $manageTax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageTax  $manageTax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manageTax = ManageTax::find($id);
        $admin_id = admin_id();
        if($manageTax->admin_id == $admin_id)
        {
            return view('manage_tax.edit',compact('manageTax'));
        }
        else
        {
            return redirect()->route('manage_tax.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageTax  $manageTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'profile_name' => 'required',
            'tax_lable_name' => 'required',
            'tax_caption_1' => 'required',
            'tax_percentage_1' => 'required|numeric',

        ],[
            'profile_name.required'=> 'Please enter profile name',
            'tax_lable_name.required' => 'Please enter tax lable name',
            'tax_caption_1.required'=> 'Please enter tax caption 1',
            'tax_percentage_1.required'=> 'Please enter tax percentage 1',
            'tax_percentage_1.numeric'=> 'Please enter only number',
        ]);
        $input = $request->all();
        $ManageTax = ManageTax::find($id);
        $admin_id = admin_id();
        if($ManageTax->admin_id == $admin_id)
        {
            $ManageTax->update($input);

            return redirect()->route('manage_tax.index')->with('success','Tax update successfully');
        }
        else
        {
            return redirect()->route('manage_tax.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageTax  $manageTax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ManageTax = ManageTax::find($id);
        $admin_id = admin_id();
        if($ManageTax->admin_id == $admin_id)
        {
            $ManageTax->delete();

            return redirect()->route('manage_tax.index')->with('success','Tax delete successfully');
        }
        else
        {
            return redirect()->route('manage_tax.index')->with('success','Somthing wrong');
        }
    }

    public function getTex(Request $request)
    {
        $id = $request->tax_id;
        $ManageTax = ManageTax::find($id);

        $totalTax = $ManageTax->tax_percentage_1 + $ManageTax->tax_percentage_2 + $ManageTax->tax_percentage_3 + $ManageTax->tax_percentage_4 + $ManageTax->tax_percentage_5;

        return $totalTax;
    }
}
