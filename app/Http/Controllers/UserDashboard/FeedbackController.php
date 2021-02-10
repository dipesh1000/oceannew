<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Model\Feedback;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        try {
            $review = new Feedback();
            $review->user_id = $user->id;
            $review->coursable_id = $request->courseId;
            $review->coursable_type = get_class(getSavedCourseByType($request));
            $review->star = $request->rating;
            $review->review = $request->review;
            $save = $review->save(); 
            if($save) {
                Toastr::success('Success', 'Thank you for you feedback');
            }
            return redirect()->back();
        } catch (\Throwable $e) {
            Toastr::error($e->getMessage(), "Operation Failed");
            return redirect()->back();
        }   
    }

    public function update(Request $request){
        // dd($request);
        $user = Sentinel::getUser();
        try {
            $review = Feedback::find($request->feedback_id);
            $review->star = $request->rating;
            $review->review = $request->review;
            $save = $review->update(); 
            if($save) {
                Toastr::success('Success', 'Thank you for you feedback');
            }
            return redirect()->back();
        } catch (\Throwable $e) {
            Toastr::error($e->getMessage(), "Operation Failed");
            return redirect()->back();
        }
    }
}
