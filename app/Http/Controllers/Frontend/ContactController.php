<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Contact;

class ContactController extends Controller
{
    public function getContactPage()
    {
        return view('frontend.contact.index');
    }
    public function storeContact(Request $request)
    {
    
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $postData = new Contact;
        $postData->name = $request->name;
        $postData->email = $request->email;
        $postData->subject = $request->subject;
        $postData->phone = $request->phone;
        $postData->message = $request->message;
        $postData->save();
        return redirect()->back()->with('success', 'Thank You For Contact!!!');
    }
}
