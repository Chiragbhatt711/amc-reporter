<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        if(Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return view('admin.login');
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);


        if(Auth::guard('admin')->attempt(['email'=> $email,'password'=>$password,'role_id'=>1,'is_active'=>1]))
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput()->withErrors(['error' => 'Invalid Credentials!!']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
