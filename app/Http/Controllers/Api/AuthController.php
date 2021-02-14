<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    
}
