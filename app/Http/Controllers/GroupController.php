<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{

    public function create(Request $request)
    {
        $admin_id = admin_id();
        $group = $request->group;
        $create_group = Group::create(['admin_id'=>$admin_id,'name'=>$group]);

        return $create_group;
    }
}
