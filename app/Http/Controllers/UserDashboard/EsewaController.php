<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Model\MasterOrder;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EsewaController extends Controller
{
    public function success(Request $request)
    {
        if($request->oid && $request->amt &&$request->refId)
        {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data =[
            'amt'=> $request->amt,
            'rid'=> $request->refId,
            'pid'=> $request->oid,
            'scd'=> 'epay_payment'
            ];
            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            
            $response_code = $this->get_response('response_code',$response);
            if($response_code =='Success')
            {
                DB::beginTransaction();
                $user = Sentinel::getUser();
                $carts = Cart::content();
                $count = count($carts);
                $courses = [];
                try {
                    $masterOrder = new MasterOrder();
                    $masterOrder->user_id = $user->id;
                    $masterOrder->invoice_no = $request->oid;
                    $masterOrder->status = MasterOrder::STATUS_ACTIVE;
                    $masterOrder->grandTotal = $request->amt;
                    $masterOrder->payment_method = 'Esewa';
                    $masterOrder->save();
                } catch (\Throwable $e) {
                    DB::rollback();
                    return redirect('/esewa/response')->with('errors', 'Error While Checkout');
                }
                if($count > 0) {
                    try {
                        foreach ($carts as $cart) { 
                            $order = new Order();
                            $order->purchaseble_id = $cart->id;
                            $order->master_order_id = $masterOrder->id;
                            $order->purchaseble_type = get_class(getCoursesByType($cart));
                            $order->order_date = Carbon::now()->toDateTimeString();
                            if(hasOfferPrice(getCoursesByType($cart))){
                                $order->price = getCoursesByType($cart)->offer_price ;
                            }
                            $checkout = $order->save();
                            $courses[] = $order; 
                                if($checkout == true){
                                    Cart::destroy($cart->rowId);
                                }
                                // return response()->json( [
                                    //     'status'  => 'success',
                                    //     'message' => 'Course Checkout Successfully.'
                                    // ], 200 );
                        }
                    }
                    catch (\Throwable $e) {
                        DB::rollback();
                        return redirect('/esewa/response')->with('errors', 'Error While Checkout');
                    }
                }
                DB::commit();
                Toastr::success('Success', 'Payment Course Competed');
                return redirect('/esewa/response')->with('success_message', 'Transaction Completed');
            }else{
                DB::rollback();
                return redirect('/esewa/response')->with('errors', 'Error While Checkout');
            }
        }
    }
    
    public function failure()
    {
        return redirect('/esewa/response')->with('failure_message', 'Failed.');
    }
    
    //extract value from response code of verification of payment
    public function get_response($node, $xml)
    {
        $objXmlDocument = simplexml_load_string($xml);
        if ($objXmlDocument === FALSE) {
            return false;
        }
         
        $objJsonDocument = json_encode($objXmlDocument);
        $arrOutput = json_decode($objJsonDocument, TRUE);
        if($arrOutput['response_code']){
            return trim($arrOutput['response_code']);
        }
        return false;

        // if($xml==false){
        //     return false;
        // }
        $found = preg_match('#<'.$node.'[?:\s+>]+)?>(.*?)'.'</'.$node.'>#s',$xml, $matches);
        // if($found!= false){
        //     return $matches[1];
        // }
        // return false;
    }
    
    public function response()
    {
        return view('userdashboard.order.response');
    }
    
}
