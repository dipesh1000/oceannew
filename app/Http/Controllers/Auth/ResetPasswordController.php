<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redis;

class ResetPasswordController extends Controller
{
    public function getResetForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = $request->_token;
        $response = DB::table('reset_passwords')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
  
        Mail::send('email.verify', ['token' => $token], function($message) use($request){
            $message->from('admin@gmail.com');
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        if($response){
            Toastr::success('Success', 'We have e-mailed your password reset link!');
            return redirect()->back();
        }else{
            Toastr::error('Error', 'Error Please Send Correct Email');
            return redirect()->back();
        }
    }
    public function getResetPasswordForm($token)
    {
        return view('auth.reset_password_form', [ "token" => $token ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
            $updatePassword = DB::table('reset_passwords')->where(['email' => $request->email, 'token' => $request->token])->first();
            
            if(!$updatePassword) {
                Toastr::error('Error', 'Invalid token!');
                return back();
            }
            $user = User::where('email', $request->email)->update([ 
                'password' => Hash::make($request->password)
             ]);
            if($user) {
                Toastr::success('Success', 'password updated successfully');
                DB::table('reset_passwords')->where([
                    'email' => $request->email
                ])->delete();
                
                return redirect('/login')->with('message', 'Your Passwrod has been changes');
            }else {
                Toastr::error('Error', 'something went wrong!');
                return back();
            }
            
        
    }
}
