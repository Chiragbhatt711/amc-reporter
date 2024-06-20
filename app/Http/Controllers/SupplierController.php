<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-supplier-list|manage-supplier-create|manage-supplier-edit|manage-supplier-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manage-supplier-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-supplier-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-supplier-delete', ['only' => ['destroy']]);

         $this->middleware('license_validation')->only('create','store','edit','update','destroy');
    }

    public function index()
    {
        $admin_id = admin_id();
        $data = Supplier::where('admin_id',$admin_id)->get();

        return view('manage_supplier.index',compact('data'));
    }

    public function create()
    {
        return view('manage_supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'person_name' => 'required',
            'supplier_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state'=> 'required',
            'country'=> 'required',
            'pincode'=> 'required',
            'phone_no'=> 'required',
            'e_mail'=> 'required',
        ],[
            'company_name.required'=> 'Please enter company name',
            'person_name.required' => 'Please enter person name',
            'supplier_type.required' => 'Please supplier type',
            'address.required' => 'Pleaseb enter address',
            'city.required' => 'Please enter city',
            'state.required' => 'Please enter state',
            'country.required' => 'Please enter country',
            'pincode.required' => 'Please enter pincode',
            'phone_no.required' => 'Please enter phone no',
            'e_mail.required' => 'Please enter e-mail',
        ]);

        $admin_id = admin_id();

        $input = $request->all();
        $input['admin_id'] = $admin_id;

        $create = Supplier::create($input);

        return redirect()->route('manage_supplier.index')->with('success','Supplier create successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        if($supplier->admin_id == auth()->user()->id || $supplier->admin_id = auth()->user()->admin_id)
        {
            return view('manage_supplier.edit',compact('supplier'));
        }
        else
        {
            return redirect()->route('manage_supplier.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'person_name' => 'required',
            'supplier_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state'=> 'required',
            'country'=> 'required',
            'pincode'=> 'required',
            'phone_no'=> 'required',
            'e_mail'=> 'required',
        ],[
            'company_name.required'=> 'Please enter company name',
            'person_name.required' => 'Please enter person name',
            'supplier_type.required' => 'Please supplier type',
            'address.required' => 'Pleaseb enter address',
            'city.required' => 'Please enter city',
            'state.required' => 'Please enter state',
            'country.required' => 'Please enter country',
            'pincode.required' => 'Please enter pincode',
            'phone_no.required' => 'Please enter phone no',
            'e_mail.required' => 'Please enter e-mail',
        ]);

        $admin_id = admin_id();

        $input = $request->all();

        $supplier = Supplier::find($id);
        $supplier->update($input);

        return redirect()->route('manage_supplier.index')->with('success','Supplier update successfully');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if($supplier->admin_id == auth()->user()->id || $supplier->admin_id = auth()->user()->admin_id)
        {
            $supplier->delete();
            return redirect()->route('manage_supplier.index')->with('success','Supplier delete successfully');
        }
        else
        {
            return redirect()->route('manage_supplier.index')->with('success','Somthing wrong');
        }
    }
}
