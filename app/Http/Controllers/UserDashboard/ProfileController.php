<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function userProfile()
    {
        $users = Sentinel::getUser();
        return view('userdashboard.profile.index', compact('users'));
    }
    public function userProfileEdit($id)
    {
        $users = User::findOrFail($id);
        return view('userdashboard.profile.edit', compact('users'));
    }
    public function updateProfile(Request $request, $id)
    {   
        try {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email' => 'required|email',
            // 'new_password' => 'required',
            // 'password_confirmation' => 'same:new_password',
        ]);
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        // $user->password = Hash::make($request->new_password);
        if ($request->hasFile('image')){
            imageDelete($user);
            $user->image = imageupload('/upload/profile/image/', $request->file('image'));
        }
        $user->update();

        return redirect('/profile')->with('success', 'Data is successfully updated');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Error While Checkout');
        }
    }
}
