<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractModel;

class ContractModelController extends Controller
{
    public function index()
    {
        $admin_id = admin_id();
        $models = ContractModel::where('admin_id',$admin_id)->get();

        return view('model.index',compact('models'));
    }

    public function create()
    {
        return view('model.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $admin_id = admin_id();
        $model = $request->name;
        $createModel = ContractModel::create(['admin_id'=>$admin_id,'name'=>$model]);

        return redirect()->route('model.index')->with('success','Model created successfully');
    }

    public function edit($id)
    {
        $model = ContractModel::find($id);
        $admin_id = admin_id();

        if($model->admin_id == $admin_id)
        {
            return view('model.edit',compact('model'));
        }
        else
        {
            return redirect()->route('model.index')->with('success','Somthing wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=> 'this field is required',
        ]);

        $model = ContractModel::find($id);
        $admin_id = admin_id();

        if($model->admin_id == $admin_id)
        {
            $model->update(['name'=>$request->name]);

            return redirect()->route('model.index')->with('success','Model updated successfully');
        }
        else
        {
            return redirect()->route('model.index')->with('success','Somthing wrong');
        }
    }

    public function destroy($id)
    {
        $model = ContractModel::find($id);
        $admin_id = admin_id();

        if($model->admin_id == $admin_id)
        {
            $model->delete();

            return redirect()->route('model.index')->with('success','Model deleted successfully');
        }
        else
        {
            return redirect()->route('model.index')->with('success','Somthing wrong');
        }
    }

    public function createModel(Request $request)
    {
        $admin_id = admin_id();
        $model = $request->model;
        $createModel = ContractModel::create(['admin_id'=>$admin_id,'name'=>$model]);

        return $createModel;
    }
}
