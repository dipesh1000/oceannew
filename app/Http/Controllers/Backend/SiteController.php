<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SiteSetting;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){

        return view ('admin.site');

    }

    public function update(Request $request)
    {

        $inputs = $request->all();
        foreach ($inputs as $inputKey => $inputValue) {
            if ( $inputKey == 'logo') {
                $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                if($sitesetting)
                {
                    if(file_exists($sitesetting->value)){
                        unlink($sitesetting->value);
                    }
                }

                $inputValue = $this->uploadImage( $request['logo'], 'upload/site/');
            }
            if ( $inputKey == 'favicon') {
                $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                if($sitesetting)
                {
                    if(file_exists($sitesetting->value)){
                        unlink($sitesetting->value);
                    }
                }

                $inputValue = $this->uploadImage( $request['favicon'], 'upload/site/');
            }


            SiteSetting::updateOrCreate( [ 'key' => $inputKey ], [ 'value' => $inputValue ] );

        }
        return redirect()->back()->with('success', 'Successfully Updated.');

    }


    public function uploadImage($file, $path){
        if ($file) {

            $uploadedfile =  time() . '.' . $file->getClientOriginalName();

            $destinationPath = public_path($path);
            $file->move($destinationPath, $uploadedfile);
            return $path.$uploadedfile;

        }
        return null;
    }
}
