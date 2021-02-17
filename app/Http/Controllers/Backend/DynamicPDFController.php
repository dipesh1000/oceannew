<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\MasterOrder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use PDF;
class DynamicPDFController extends Controller
{
    //
    public function index()
    {
      
        $order = MasterOrder::with('orderDetails')->first();
   
        return view('email.billing',compact('order'));
    }

    public function pdf($id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $user = Sentinel::getUser();
        $order = MasterOrder::with('orderDetails')->where(['id'=>$id,'user_id'=>$user->id])->first();
        if($order)
        {
        // $view= view('email.billing',compact('order'))->render();
        $pdf = PDF::loadView("email.billing",compact('order'));
        $pdf->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
        }
        else
        {
           return "No Masterorder Find";
        }
       

    }


}
