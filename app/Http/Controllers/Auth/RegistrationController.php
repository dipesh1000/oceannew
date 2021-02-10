<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendConfirmedEmail;
use App\Jobs\WelcomeVarifyEmail;
use App\Mail\RegisterUserMail;
use App\Mail\WelcomeUserMail;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Sentinel;

class RegistrationController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'min:6|required',
            'phone' => 'unique:users'
        ]);
        $user = Sentinel::registerAndActivate($request->all());

        dispatch(new WelcomeVarifyEmail($user));
        
        return redirect()->route('login'); 
    }
}
