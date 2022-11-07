<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractModel;

class ContractModelController extends Controller
{
    public function create(Request $request)
    {
        $admin_id = admin_id();
        $model = $request->model;
        $createModel = ContractModel::create(['admin_id'=>$admin_id,'name'=>$model]);

        return $createModel;
    }
}
