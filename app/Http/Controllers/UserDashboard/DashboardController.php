<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Model\MasterOrder;
use App\Model\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\File;


class DashboardController extends Controller
{
    public function index()
    {
        $users = Sentinel::getUser();
        return view('userdashboard.index', compact('users'));
    }

    public function myOrders()
    {
    
        $user = Sentinel::getUser();
        $users_order = Sentinel::getUserRepository()->setModel('App\User')->with('myOrder')->whereHas('myOrder')->findOrFail($user->id);

        return view('userdashboard.my-order.my-order',compact('users_order'));
    }

    public function paymentHistory()
    {
        $user = Sentinel::getUser();
        $users_order = $user->myOrder;
        foreach($users_order as $order) {
            $courses = $order->orderDetails;
            foreach($courses as $course) {
                $courseDetails = getCoursesByModel($course);
                $course->courseTitle = $courseDetails->title;
                $course->orderdate = $course->order_date;
            }
        }
        return view('userdashboard.order.history', compact('users_order'));
    }

    public function viewSinglePaymentHistory($id)
    {
        $masterOrder = MasterOrder::findOrFail($id);
        $user = User::find($masterOrder->user_id);
        $courses = $masterOrder->orderDetails;
        foreach($courses as $course) {
            $courseDetails = getCoursesByModel($course);
            $course->courseList = $courseDetails;
        }
        return view('userdashboard.order.viewInvoice', compact('masterOrder', 'user', 'courses'));
    }  

    public function printSinglePaymentHistory($id)
    {
        $masterOrder = MasterOrder::findOrFail($id);
        $user = User::find($masterOrder->user_id);
        $courses = $masterOrder->orderDetails;
        foreach($courses as $course) {
            $courseDetails = getCoursesByModel($course);
            $course->courseList = $courseDetails;
        }
        return view('userdashboard.order.printInvoice', compact('masterOrder', 'user', 'courses'));
    }
   
}
