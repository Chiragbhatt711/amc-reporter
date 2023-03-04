<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('manage_supplier.index');
    }

    public function create()
    {

    }
}
