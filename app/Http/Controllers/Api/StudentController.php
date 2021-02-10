<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequestUpdate;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseAPI;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class StudentController extends Controller
{
    //
    use ResponseAPI;

    public function studentProfile(Request $request)
    {
        
        $user = User::find(Auth::id());
        return $user;
        // dd($user->roles[0]['name']);
        if($user->roles->isNotEmpty())
        {
          
            if($user->roles[0]['name']=="student")
            {
                return $this->success("User Retrieved",$user,) ;
            }
        }
        else
        {
         
            return $this->error("User is not student");
        }
       
        
    }

    public function activateUser()
    {
        $user = Sentinel::findById(Auth::id());
        $activation = Activation::completed($user);
        if(!$activation)
        {
            $activation = Activation::create($user);
            Activation::complete($user, $activation->code);
            return response()->json(['message'=>'User Activated','user'=>$activation]);
        }
       
        return response()->json(['message'=>'User Already Activated','user'=>$user->activations()->get()]);

    }

    public function studentProfileUpdate(Request $request)
    {
        $id = Auth::id();
        $user = Sentinel::findById($id);
        if($user->roles->isNotEmpty())
        {
          
            if($user->roles[0]['name']=="student")
            {
                $updated_user = $user->update([
                    "first_name" => $request->first_name ?? $user->first_name,
                    "last_name"=> $request->last_name ?? $user->last_name,
                    "role" =>  $user->role,
                    "email" => $request->email ?? $user->email
                ]);
                return $this->success("User Updated",$user) ;
            }
        }
        else
        {
         
            return $this->error("User is not student");
        }
    }

 
}
