<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\MasterOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class DynamicPDFController extends Controller
{
    //
    public function index()
    {
      
        $order = MasterOrder::with('orderDetails')->first();
   
        return view('email.billing',compact('order'));
    }

    public function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $order = MasterOrder::with('orderDetails')->first();
        $view= view('email.billing',compact('order'))->render();
        $pdf->loadHTML($view);
        
        return $pdf->stream();
    }
}
