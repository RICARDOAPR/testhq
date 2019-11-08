<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required|email|min:6',
            'password' => 'required',
          );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) 
        {
            // $return['meta']['code'] = 400;
            // $return['meta']['error_message'] = $validator->errors()->all()[0];
            
            return redirect()->back()->with('error', $validator->errors()->all()[0]);

        }

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) 
        {
            return redirect('/home');
        }
        else
        {
            return redirect('login');
        }      
    }
  
}
