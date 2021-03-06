<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Session;

class AuthController extends Controller
{
    
    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }

    public function home()
    {

        return view('home');
    }
    public function dashboard(Request $request)
    {

        $data=array();
        if(Auth::check()){
            $user = Auth::user();

           $searchvalue = $user->companySymbol;
            if($searchvalue!=""){
                $string = file_get_contents("https://www.alphavantage.co/query?function=OVERVIEW&symbol=".$searchvalue."&apikey=LY4Q54W6B5494F80");
                $arr = json_decode($string, true);

                // check if the array key exists
                if ( ! empty( $arr)) {
                    // loop over the contents of Time Series
                    $data=  $arr;

                    return view('home', compact('data'));

                }
            }

        }
        return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
}
