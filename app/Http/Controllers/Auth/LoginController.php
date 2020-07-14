<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) //using the attempt() method we do not need to hash the passwords manually
            {
                //if successful redirect to admin dashboard
                return redirect()->intended(route('add.movies'));
            }

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
    }
}
