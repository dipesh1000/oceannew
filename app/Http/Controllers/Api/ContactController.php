<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    //
    public function storeContact(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'subject'=>'required',
                'phone'=>'required'
                // 'g-recaptcha-response' => 'required|captcha',
            ]);
            $postData = new Contact();
            $postData->name = $request->name;
            $postData->email = $request->email;
            $postData->subject = $request->subject;
            $postData->phone = $request->phone;
            $postData->message = $request->message;
            $postData->save();
            return response()->json(['success'=> 'Thank You For Contact!!!']);
        }
        catch(ValidationException $e)
        {
            foreach($e->errors() as $key=>$data)
            {
                return response()->json([$key => $data[0]]);
            }
         
        }
    
 
       
    }
}
