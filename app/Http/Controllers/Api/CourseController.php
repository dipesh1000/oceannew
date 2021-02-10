<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Book;
use App\Model\MasterOrder;
use App\Model\Order;
use App\Model\SavedCourse;
use App\Repositories\RepoCourse\CourseRepository;
use App\Traits\ResponseAPI;
use Illuminate\Support\Collection;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CourseController extends Controller
{
    use ResponseAPI;

    public $courseRepo;
    //

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    public function getAllCourses()
    {
        
        $courses = [];
        $user = Auth::user();
       
        $masterOrder = MasterOrder::where('user_id', $user->id)->get();
        foreach ($masterOrder as $orders){
            $purchaseCourse = Order::where('master_order_id', $orders->id)->get();
            foreach ($purchaseCourse as $courseItem){
                $ss = $courseItem->purchaseble_type;
                if($ss == 'App\Model\Package'){
                    $courses[] = $this->course->getPackageById($courseItem->purchaseble_id);
                }
                if($ss == 'App\Model\Book'){
                    $courses[] = $this->course->getBookById($courseItem->purchaseble_id);
                }
                if($ss == 'App\Model\Video'){
                    $courses[] = $this->course->getVideoById($courseItem->purchaseble_id);
                }
                
            }    
        }
        $collectionCourse = collect($courses);
        $coursesList = $this->paginate($collectionCourse);   
       
        if($coursesList)
        {
            return $this->success("Data Retrive Successfully",$coursesList,200); 
        }
        
        return $this->error("Something went wrong");
        
    }

    public function savedCourse(Request $request)
    { 
     
        if(Auth::check())
        {
            $user = Auth::user();
            $courseId = $request->courseId;
            $courseExist = SavedCourse::where('saveable_id', '=', $courseId)->where('user_id', $user->id)->first();
            if ($courseExist === null) 
            {
                
                try {
                    $savedCourse = new SavedCourse();
                    $savedCourse->user_id = $user->id;
                    $savedCourse->saveable_id = $request->courseId;
                    $savedCourse->saveable_type = getSavedCourseByType($request->all());
                    $savedCourse->save();
                    return $this->success("Course Saved Successfully",$savedCourse,200); 
                    }
                    catch (\Exception $e) {
                        // dd($e->getMessage());
                        return response()->json(['errors'=>'Error While Saving Course']);
                    }
            } 
            else 
            {
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

    public function delete(Request $request)
    {
        $delete = SavedCourse::findOrFail($request->id)->delete();
        if($delete)
        {
            return $this->success("Data Retrive Successfully",200); 
        }
        return $this->error("Something Went Wrong");
    }
    
    public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
