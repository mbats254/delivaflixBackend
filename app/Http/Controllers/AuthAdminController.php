<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Admin;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.admin_login');
    }
    public function login_post_admin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            ]);
            dd($request->email);
            // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) //using the attempt() method we do not need to hash the passwords manually
            // {
            //     //if successful redirect to admin dashboard
            //     return redirect()->intended(route('add.movies'));
            // }

    }
    public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('guest:admin')->except('logout'); //use the guest middleware but also use the admin guard
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        // $this->middleware('guest')->except('logout');
        return redirect('/admin/login');
    }
}
