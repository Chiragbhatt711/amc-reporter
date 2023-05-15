<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Group;
use App\Models\Brand;
use App\Models\ContractModel;
use App\Models\ContractType;

class ContractTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:contract-type-list|contract-type-create|contract-type-edit|contract-type-delete', ['only' => ['index','store']]);
         $this->middleware('permission:contract-type-create', ['only' => ['create','store']]);
         $this->middleware('permission:contract-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:contract-type-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $admin_id = admin_id();
        $contractType = ContractType::where('contract_types.admin_id',$admin_id)
                ->join('groups','contract_types.group','=','groups.id','LEFT')
                ->join('brands','contract_types.brand','=','brands.id','LEFT')
                ->join('contract_models','contract_types.model','=','contract_models.id','LEFT')
                ->select('contract_types.*','groups.name as group','brands.name as brand','contract_models.name as model')
                ->get();

        return view('contract_type.index',compact('contractType'));
    }

    public function create()
    {
        $roleId = Role::where('name','=','Admin')->first();
        $role_id = $roleId->id;
        $userRole = auth()->user()->role_id;

        if($userRole == $role_id)
        {
            $admin_id = auth()->user()->id;
        }
        else
        {
            $admin_id = auth()->user()->admin_id;
        }
        $group = Group::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
        $brand = Brand::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
        $model = ContractModel::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();

        return view('contract_type.create',compact('group','brand','model'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'group' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
        ],[
            'group.required'=> 'Please select group',
            'product_code.required' => 'Please enter product code',
            'product_name.required' => 'Please enter product name',
            'product_description.required' => 'Please enter product description',
        ]);

        $input = $request->all();
        $input['admin_id'] = admin_id();
        $create = ContractType::create($input);

        return redirect()->route('contract_type.index')->with('success','Contract type create uccessfully');
    }

    public function edit($id)
    {
        $contractType = ContractType::find($id);
        $admin_id = admin_id();
        if($contractType->admin_id == $admin_id)
        {
            $group = Group::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
            $brand = Brand::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
            $model = ContractModel::where('admin_id',$admin_id)->get()->pluck('name','id')->toArray();
            return view('contract_type.edit',compact('contractType','group','brand','model'));
        }
        else
        {
            return redirect()->route('contract_type.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'group' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
        ],[
            'group.required'=> 'Please select group',
            'product_code.required' => 'Please enter product code',
            'product_name.required' => 'Please enter product name',
            'product_description.required' => 'Please enter product description',
        ]);

        $input = $request->all();
        $contractType = ContractType::find($id);
        $admin_id = admin_id();
        if($contractType->admin_id == $admin_id)
        {
            $contractType->update($input);

            return redirect()->route('contract_type.index')->with('success','Contract update successfully');
        }
        else
        {
            return redirect()->route('contract_type.index')->with('success','Somthing wrong');
        }
    }

    public function destroy($id)
    {
        $contractType = ContractType::find($id);
        $admin_id = admin_id();
        if($contractType->admin_id == $admin_id)
        {
            $contractType->delete();

            return redirect()->route('contract_type.index')->with('success','Contract delete successfully');
        }
        else
        {
            return redirect()->route('contract_type.index')->with('success','Somthing wrong');
        }
    }
}
