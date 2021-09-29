<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
       // $pass = Hash::make('123456');
        //echo($pass);
        if($request->isMethod('post'))
        {
            $data = $request->all();
          //  echo "<pre>"; print_r($data); die;


            if(Auth::guard('admin')->attempt(['email'=> $data['email'],'password'=> $data['password']]))
            {
                return Redirect::route('dashboard');
                // return redirect('admin/dashboard');
            } else{
                // Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
        }
        return view('admin.auth.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
