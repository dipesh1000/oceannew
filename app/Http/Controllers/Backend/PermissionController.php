<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\PermissionModule;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function userPermission(){
        $permissions = PermissionModule::all();
        return view('admin.user.permission.permission', compact('permissions'));
    }



    public function userPermissionStore(Request $request){

        $this->validate($request, [
            'name' => 'required',

        ]);

        try{
            PermissionModule::create([
                'name' => $request->name,
            ]);
            return redirect()->back()->with('success', 'Permission Successfully Created.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Creating Permission');
        }

    }
    public function userPermissionUpdate(Request $request){

        $this->validate($request, [
            'name' => 'required',

        ]);

        try{
            $permission = PermissionModule::where('id', $request->permission_id)->first();
            $permission->update([
                'name' => $request->name,
            ]);
            return redirect()->back()->with('success', 'Permission Successfully Updated.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Permission');
        }

    }


    public function userPermissionEdit($id){
        $permission = PermissionModule::find($id);
        return view('admin.user.permission.edit', compact('permission'));
    }

    public function userPermissionDelete($id){

        try{
            $permission = PermissionModule::find($id);
            $permission->delete();
            return redirect()->back()->with('success', 'Permission Successfully Deleted.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Permission while Deleting Role');
        }

    }
}
