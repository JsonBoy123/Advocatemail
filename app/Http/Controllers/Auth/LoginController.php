<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegisterController;
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('verify.template');
   
    }

    function doLogin(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (\Auth::attempt($request->only(["email", "password"]))) {
            $catgId = Auth::user()->role_id;
            if ($catgId == 1){
                return redirect('/dashboard');
            } elseif ($catgId == 3){
                return redirect('/dashboard');
            }
            else{
                return redirect('/guest');
            }
        }
        else{
            return back()->with('errors','Your Password Not Correct');
        }
    }
}
