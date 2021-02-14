<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
// use JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',  //password_confirmation field name
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
         }
     
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $role = Sentinel::findRoleByName('student');
        $user->attach($role);
      
        $token = JWTAuth::fromUser($user);
         
        
        return response()->json(compact('user','token'),201);

    }
    public function login(Request $request)
        {
            
            $credentials = $request->only('email', 'password');
       
          
            try {
                if (!$user = Sentinel::forceAuthenticate($credentials)) 
                {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
       
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }catch (NotActivatedException $e) {
                return response()->json(['error' => $e->getMessage()], 403);
            }
            catch(ThrottlingException $e)
            {
                return response()->json(['error' => $e->getMessage()], 403);
            }
           
            $token = JWTAuth::fromUser($user);
         
            $token = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => $user
            ];
            return response()->json(compact('token'));
        }
    public function resetPassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(30);
        $response = DB::table('reset_passwords')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
    
            Mail::send('email.verify', ['token' => $token], function($message) use($request){
            $message->from('admin@gmail.com');
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        if($response){

            return response()->json(['Success'=>'We have e-mailed your password reset link!','token'=>$token]);
        }else{

            return redirect()->json(['Success'=>'We have e-mailed your password reset link!']);
        }
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

                return response()->json(['Error'=>'Invalid token!!']);
         
            }
            $user = User::where('email', $request->email)->update([ 
                'password' => Hash::make($request->password)
             ]);
            if($user) {
                return response()->json(['Success'=>'password updated successfully!!']);
                DB::table('reset_passwords')->where([
                    'email' => $request->email
                ])->delete();
                
                return redirect('/login')->with('message', 'Your Passwrod has been changes');
            }else {
                return response()->json(['Error'=>'Something Went Wrong!!']);
              
            }
            
        
    }
    public function logout()
    {
        Auth::logout();

        return response()->json(['message'=>'Logout Successfully']);
    }

    
}
