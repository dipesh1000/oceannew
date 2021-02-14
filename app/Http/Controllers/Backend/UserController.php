<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserRequestUpdate;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{


    public function index(){
        $users = User::all();
        return view('admin.user.index', compact('users'));

    }

    public function create(){

        $roles = EloquentRole::all();
        return view('admin.user.create', compact('roles'));

    }


    public function store(UserRequest $request){

        try{
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->image = imageupload('/upload/user/', $request->file('image'));
            $response = $user->save();
            if($response){
                $user->roles()->attach($request->role);
                $activation = Activation::create($user);
                if ($request->activate){

                    Activation::complete($user, $activation->code);
                    return redirect()->back()->with('success', 'User Successfully Created and Activate.');
                }else{
                    $code = $activation->code;
                    $sent = Mail::send('email.activate', compact('user', 'code'), function ($m) use ($user) {
                        $m->to($user->email)
                            ->subject('Activate Your Account');
                    });
                    return redirect()->back()->with('success', 'User Successfully Created. Check User Email For Activation');
                }
            }else{
                return redirect()->back()->with('error', 'Error while Creating User!!');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Creating User!!');
        }


    }


    public function edit($id)
    {
        $user = User::find($id);
        if($user){
            $roles = EloquentRole::all();
            return view('admin.user.edit', compact('roles', 'user'));
        }else{
            return redirect()->back()->with('errors', 'User Not Found!!! Refresh your page.');
        }
    }

    public function update(UserRequestUpdate $request){

        try{
            $user = User::where('id', $request->user_id)->first();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            if ($request->hasFile('image')){
                imageDelete($user);
                $user->image = imageupload('/upload/user/', $request->file('image'));
            }
            $response = $user->update();
            if($response){
                $user->roles()->sync($request->role);
                if ($request->activate){
                    Activation::create($user);
                    return redirect()->back()->with('success', 'User Successfully Updated and Activate.');
                }

                return redirect()->back()->with('success', 'User Successfully Updated.');
            }else{
                return redirect()->back()->with('error', 'Error while Updating User!!');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating User!!');
        }


    }

}
