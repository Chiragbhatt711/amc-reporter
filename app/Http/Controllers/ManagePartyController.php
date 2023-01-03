<?php

namespace App\Http\Controllers;

use App\Models\ManageParty;
use Illuminate\Http\Request;

class ManagePartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $manageParty = ManageParty::where('admin_id',$admin_id)->get();
        return view('manage_party.index',compact('manageParty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('manage_party.create');
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
            'party_name' => 'required',
            'contact_person_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'mobile_no' =>'required',
            'email' =>'required',

        ],[
            'party_name.required'=> 'Please enter party name',
            'contact_person_name.required' => 'Please enter contact person name',
            'address.required' => 'Please enter address',
            'city.required' => 'Please enter city',
            'state.required' => 'Please enter state',
            'country.required' => 'Please enter country',
            'pincode.required' => 'Please enter pincode',
            'mobile_no.required' => 'Please enter mobile no',
            'email.required' => 'Please enter email',
        ]);

        $input = $request->all();
        $admin_id = admin_id();
        $input['admin_id'] = $admin_id;

        $create = ManageParty::create($input);

        return redirect()->route('manage_party.index')->with('success','Party create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageParty  $manageParty
     * @return \Illuminate\Http\Response
     */
    public function show(ManageParty $manageParty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageParty  $manageParty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manageParty = ManageParty::find($id);
        $admin_id = admin_id();
        if($manageParty->admin_id == $admin_id)
        {
            return view('manage_party.edit',compact('manageParty'));
        }
        else
        {
            return redirect()->route('manage_party.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageParty  $manageParty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'party_name' => 'required',
            'contact_person_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'mobile_no' =>'required',
            'email' =>'required',

        ],[
            'party_name.required'=> 'Please enter party name',
            'contact_person_name.required' => 'Please enter contact person name',
            'address.required' => 'Please enter address',
            'city.required' => 'Please enter city',
            'state.required' => 'Please enter state',
            'country.required' => 'Please enter country',
            'pincode.required' => 'Please enter pincode',
            'mobile_no.required' => 'Please enter mobile no',
            'email.required' => 'Please enter email',
        ]);

        $input = $request->all();
        $manageParty = ManageParty::find($id);
        $admin_id = admin_id();
        if($manageParty->admin_id == $admin_id)
        {
            $manageParty->update($input);

            return redirect()->route('manage_party.index')->with('success','Party update successfully');
        }
        else
        {
            return redirect()->route('manage_party.index')->with('success','Somthing wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageParty  $manageParty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manageParty = ManageParty::find($id);
        $admin_id = admin_id();
        if($manageParty->admin_id == $admin_id)
        {
            $manageParty->delete();

            return redirect()->route('manage_party.index')->with('success','Party delete successfully');
        }
        else
        {
            return redirect()->route('manage_party.index')->with('success','Somthing wrong');
        }
    }
}
