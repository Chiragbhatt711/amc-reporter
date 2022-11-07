<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmcController extends Controller
{
    public function index()
    {
        return view('amc.index');
    }
}
