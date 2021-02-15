<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Feedback;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FeedbackController extends Controller
{
    public function create(Request $request)
    {
        $user = Sentinel::findById(Auth::id());
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
}
