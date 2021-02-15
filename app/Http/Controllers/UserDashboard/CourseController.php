<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Model\Feedback;
use App\Model\MasterOrder;
use App\Model\Order;
use App\Repositories\RepoCourse\CourseRepository;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\ErrorHandler\Collecting;

class CourseController extends Controller
{
    public $course;
    
    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
    }
    
    public function getAllCourses()
    {
        $courses = [];
        $users = Sentinel::getUser();
        $masterOrder = MasterOrder::where('user_id', $users->id)->get();
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
        return view('userdashboard.purchaseCourse.index', compact('coursesList', 'users'));
    }

    public function getSingleVideo($id)
    {
        $video = $this->course->getVideoById($id);
        return view('userdashboard.purchaseCourse.videoSingle', compact('video'));
    }
    public function getSingleBook($id)
    {
        $book = $this->course->getBookById($id);
        $user = Sentinel::getUser();
        $book->user_id = $user->id; 
        $review = $book->courseItem()->first();

        $avgRating = $book->courseItem->avg('star');

        return view('userdashboard.purchaseCourse.bookSingle', compact('book', 'review', 'avgRating'));
    }
    public function getSinglePackage($id)
    {
        $package = $this->course->getPackageById($id);
        $courses = [];
        foreach ($package->packageItem as $ppp){
            if ($ppp->itemable_type == 'App\Model\Book') {
                $bookId = $ppp->itemable_id;
                $courses[] = $this->course->getBookById($bookId);
            }
            if ($ppp->itemable_type == 'App\Model\Video') {
                $videoId = $ppp->itemable_id;
                $courses[] = $this->course->getVideoById($videoId);
            }
        }

        $coursesList = $courses;
        return view('userdashboard.purchaseCourse.packList', compact('coursesList'));
    }   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getSingleBookPdf($id){
        try{    
            $book = $this->course->getBookById($id);
            $user = Sentinel::getUser();
            $isPurchased = $this->course->isCoursePurchased($book, $user);
            if($isPurchased){
                $fileName = 'abc.pdf';
                $path = storage_path('app/'.$book->book);
                $data = file_get_contents($path);
                file_put_contents(public_path('/pdf/'.$fileName),$data);
                $view = view('userdashboard.purchaseCourse.pdfviewer', compact('book','fileName'))->render();
                return $view;
            }else{
                Toastr::error('Unauthorized Access','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            Toastr::error($e->getMessage(),'Operation Failed');
            return redirect()->back();      }
    }
}

