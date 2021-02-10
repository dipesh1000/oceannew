<?php

namespace App\Http\Controllers\userdashboard;

use App\Http\Controllers\Controller;
use App\Model\Book;
use App\Model\SavedCourse;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Repositories\RepoCourse\CourseRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;

class SavedCourseController extends Controller
{
    public $course;
    public function __Construct(CourseRepository $course)
    {
        $this->course = $course;
    }
    public function savedCourse(Request $request)
    { 
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            $courseId = $request->courseId;
            $courseExist = SavedCourse::where('saveable_id', '=', $courseId)->where('user_id', $user->id)->first();
            if ($courseExist === null) {
                try {
                    $savedCourse = new SavedCourse();
                    $savedCourse->user_id = $user->id;
                    $savedCourse->saveable_id = $request->courseId;
                    $savedCourse->saveable_type = get_class(getSavedCourseByType($request));
                    $savedCourse->save();
                    return response()->json( [
                        'status'  => 'success',
                        'message' => 'Course Saved Successfully.'
                    ], 200 );
                    }
                    catch (\Exception $e) {
                        return redirect()->back()->with('errors', 'Error While Saving Course');
                    }
            } else {
                return response()->json( [
                    'status'  => 'exists',
                    'message' => 'Course Already Exists!!!'
                ], 200 );
            }
        }
        else {
            return response()->json( [
                'status'  => 'login',
                'message' => 'Please Login'
            ], 200 );
        }
    }
    public function getSavedCourse()
    {
        $users = Sentinel::getUser();
        $savedCourse = SavedCourse::where('user_id', $users->id)->get();
        $courses = [];
        if (count($savedCourse) > 0) {
            foreach ($savedCourse as $courseItem){
                $ss = $courseItem->saveable_type;
                if($ss == 'App\Model\Book'){
                    $courses[] = $this->course->getBookById($courseItem->saveable_id);
                }
                if($ss == 'App\Model\Video'){
                    // dd($courseItem->saveable_id);
                    $courses[] = $this->course->getVideoById($courseItem->saveable_id);
                }
                if($ss == 'App\Model\Package'){
                    $courses[] = $this->course->getPackageById($courseItem->saveable_id);
                }
            }
        }
        // dd($courses);
        return view('userdashboard.savedcourse.index', compact('courses', 'users'));

    }
    public function destroy($id)
    {
        $user = Sentinel::getUser();
        $savedCourse = SavedCourse::where('saveable_id', '=', $id)->where('user_id', $user->id)->first();
        if($savedCourse) {
            $savedCourse->delete();
            Toastr::success('Success', 'Deleted Course Successfully');
            return redirect()->back()->with('success', 'Saved Course Removed Successfully');
        }
        else {
            return redirect()->back()->with('error', 'Some users purchase this Book!! you are unable to delete this.');
        }
    }
}
