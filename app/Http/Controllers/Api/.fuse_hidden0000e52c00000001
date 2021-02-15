<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\RepoCourse\CourseRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleCourseController extends Controller
{
    //
    protected $user;

    public function __construct(User $user,CourseRepository $course)
    {
        $this->user = Auth::user();
        $this->course = $course;
        
    }
    
    public function getBook(Request $request)
    {
        // try{    
            $book = $this->course->getBookById($request->book_id);
      
            $user = $this->user;
            $isPurchased = $this->course->isCoursePurchased($book, $user);
            if($isPurchased){
                return response()->json(['book'=>asset($book)]);
            }else{
                return response()->json(['message'=>"Book hasn't been purchased"]);
            }
        // }catch(\Exception $e){
        //      return response()->json(['message'=>"Something went wrong"]);  }
    }

    public function getPackage(Request $request)
    {
        $data = $this->course->getPackageById($request->package_id);
        $items = array();
        foreach($data->packageItem as $value){
            $single_item = $value->itemable;
            array_push($items,$single_item);
        }
        $user = $this->user;
        $isPurchased = $this->course->isCoursePurchased($data, $user);
        if($isPurchased){
            return response()->json(['items'=>$items]);
        }else{
            return response()->json(['message'=>"Package hasn't been purchased"]);
        }
    }

    public function getVideo(Request $request)
    {
        $data = $this->course->getVideoById($request->video_id);
      
        $user = $this->user;
        $isPurchased = $this->course->isCoursePurchased($data, $user);
        if($isPurchased){
            return response()->json(['video'=>$data]);
        }else{
            return response()->json(['message'=>"Video hasn't been purchased"]);
        }
    }
}
