<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Model\MasterOrder;
use App\Model\Order;
use App\Repositories\RepoCourse\CourseRepository;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ResponseAPI;
    
    public $courseRepo;
    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }
    public function myOrder()
    {
        $user = Sentinel::findById(Auth::id());
        $my_order = $user->myOrder()->get();
        
        return (new OrderResource($my_order));
    }

    public function orderStore(Request $request)
    {
       
        $user = Sentinel::findById(Auth::id());
        
        $carts = $request->cart;
        $count = count($carts);
        $totalPrice = $request->ttlPrice;
        $courses = [];
        try {
            $masterOrder = new MasterOrder();
            $masterOrder->user_id = $user->id;
            $masterOrder->invoice_no = $user->id.time();
            $masterOrder->status = MasterOrder::STATUS_ACTIVE;
            $masterOrder->grandTotal = $totalPrice;
            $masterOrder->payment_method = 'Offline';
            $masterOrder->save();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage());
            return response()->json(['errors'=>'Error While Checkout']);
        }
        if($count > 0) {
            try {
              
                foreach ($carts as $cart) { 
                    $order = new Order;
                    $order->purchaseble_id = $cart['id'];
                    $order->master_order_id = $masterOrder->id;
                    $order->purchaseble_type = $this->courseRepo->getClass($cart['name']);
                    $order->order_date = Carbon::now()->toDateTimeString();
                    $order->price = $this->courseRepo->getClass($cart['name'])::first()->offer_price;
                    $checkout = $order->save();
                    $courses[] = $order; 
                       
                        return response()->json( [
                                'status'  => 'success',
                                'message' => 'Course Checkout Successfully.'
                            ], 200 );
                    }  
                    DB::commit();
                    dd($e->getMessage());
                    return response()->json(['success'=>'Checkout Successfull','order'=>$order]);
                    }catch (\Throwable $e) {
                        DB::rollback();
                        dd($e->getMessage());
                        return response()->json(['errors'=>'Error While Checkout']);
                    }
                   
        }
    }
}   
