<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\RepoCourse\CourseInterface;
use Dotenv\Result\Success;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;

class CartController extends Controller
{
    protected $course;
    public function __construct(CourseInterface $course)
    {
        $this->course = $course;
    }
    public function index()
    {
        $cart = Cart::content();
        $courses = [];
        $rowID = [];
        if($cart->where('name', 'video')){
            foreach($cart->where('name', 'video') as $course) {
                $videoId = $course->id;
                $video = $this->course->getVideoById($videoId);
                $video->cartId = $course->rowId;
                $courses[] = $video;
            }
        }

        if($cart->where('name', 'book')){
            foreach($cart->where('name', 'book') as $course) {
                $bookId = $course->id;
                $book = $this->course->getBookById($bookId);
                $book->cartId = $course->rowId;
                $courses[] = $book;

            }
        }
        
        if($cart->where('name', 'package')){
            foreach($cart->where('name', 'package') as $course) {
                $packageId = $course->id;
                $package = $this->course->getPackageById($packageId);
                $package->cartId = $course->rowId;
                $courses[] = $package;
            }
        }

        return view('frontend.cart.index', compact('courses'));
    }
    
    public function addToCart(Request $request)
    {     
        Cart::add([
            'id' => $request->course, 
            'name' => $request->type, 
            'qty' => $request->quantity, 
            'price' => 0.00,
            'weight' => 0,
          ]);

        if(!$request->ajax()){
			return redirect()->back()->with( 'success', 'Course added to cart!!' );
		}

		return response()->json( [
			'status'  => 'success',
			'message' => 'Course successfully added to cart.'
        ], 200 );
        
        // return redirect()->back()->with('success', 'Added to cart Successfully');
    }
    public function getMiniCart()
    {
        $cart = Cart::content();
        $courses = [];
        $rowID = [];
        if($cart->where('name', 'video')){
            foreach($cart->where('name', 'video') as $course) {
                $videoId = $course->id;
                $video = $this->course->getVideoById($videoId);
                $video->cartId = $course->rowId;
                $courses[] = $video;
            }
        }

        if($cart->where('name', 'book')){
            foreach($cart->where('name', 'book') as $course) {
                $bookId = $course->id;
                $book = $this->course->getBookById($bookId);
                $book->cartId = $course->rowId;
                $courses[] = $book;

            }
        }
        
        if($cart->where('name', 'package')){
            foreach($cart->where('name', 'package') as $course) {
                $packageId = $course->id;
                $package = $this->course->getPackageById($packageId);
                $package->cartId = $course->rowId;
                $courses[] = $package;
            }
        }
        // return $courses;
        $cartTotal = Cart::total();
		return view( 'frontend.cart.mini-cart', compact( 'courses', 'cartTotal' ) );
    }
    public function remove(Request $request) {
		Cart::remove($request->id);
		return response()->json( [
			'status'  => 'success',
			'message' => 'Cart successfully cleared.'
		], 200 );
    }
    
    public function removeNonAjax($id){
        Cart::remove($id);
        SweetAlert::success('Cart Item Removed Successfully');
        return redirect()->back();
    }
}
