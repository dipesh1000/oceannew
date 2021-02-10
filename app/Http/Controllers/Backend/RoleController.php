<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\PermissionModule;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use Sentinel;

class RoleController extends Controller
{

    public function userRole(){
        $roles = EloquentRole::all();
        return view('admin.user.role.role', compact('roles'));
    }



    public function userRoleStore(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',

        ]);

        try{
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            return redirect()->back()->with('success', 'Role Successfully Created.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Creating Role');
        }

    }
    public function userRoleUpdate(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',

        ]);

        try{
            $role = EloquentRole::where('id', $request->role_id)->first();
            $role->update([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            return redirect()->back()->with('success', 'Role Successfully Updated.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Role');
        }

    }


    public function userRoleEdit($id){
        $role = Sentinel::findRoleById($id);
        return view('admin.user.role.edit', compact('role'));
    }

    public function userRolePermission($id){
        $role = Sentinel::findRoleById($id);
        $permissions = PermissionModule::all();
        return view('admin.user.role.permission', compact('role', 'permissions'));
    }

    public function userRoleDelete($id){

        try{
            $role = Sentinel::findRoleById($id);
            $role->delete();
            return redirect()->back()->with('success', 'Role Successfully Deleted.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Deleting Role');
        }

    }
    public function userRolePermissionStore(Request $request){

        try{
            $role = EloquentRole::where('id', $request->role_id)->first();
            $rpermissions = $request->permissions;
            if($rpermissions){
                $perKeys = [];
                foreach ($rpermissions as $key => $rpermission){
                    if($rpermission == "full.permission"){
                        $role->permissions = ['full.permission' => true];
                        $role->save();
                        return redirect()->back()->with('success', 'Permission Successfully Updated.');
                    }elseif ($rpermission == "no.permission"){
                        $role->permissions = null;
                        $role->save();
                        return redirect()->back()->with('success', 'Permission Successfully Updated.');
                    }else{

                        $perKeys[$rpermission] =true;
                    }
                    $role->permissions = $perKeys;
                }
            }else{
                $role->permissions = null;
            }

            $role->save();
            return redirect()->back()->with('success', 'Permission Successfully Updated.');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Permission');
        }

    }
}
