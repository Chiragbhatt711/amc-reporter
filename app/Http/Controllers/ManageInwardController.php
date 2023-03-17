<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageInwardController extends Controller
{
    public function index()
    {
        return view('manage_inward.index');
    }
}
