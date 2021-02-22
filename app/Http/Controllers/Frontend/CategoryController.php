<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Book;
use App\Model\Video;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;



class CategoryController extends Controller
{
    public function index()
    {
        // dd(Sentinel::check());
        return view('frontend.category.products');
    }
    public function getBooksBySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $child_cat_ids = $category->getAllChildren()->pluck('id')->toArray();
        array_push($child_cat_ids, $category->id);
        $books = Book::whereIn('category_id',$child_cat_ids)->get();
        $videos = Video::whereIn('category_id', $child_cat_ids)->get();
        // dd($videos);
        $child_cat = Category::with('childs.childs')
            ->where('id', $category->id)
            ->get();
        
        return view('frontend.category.index', compact('child_cat', 'books', 'videos'));
    }
    public function bookByCat(Request $request)
    {
        $cat_id = $request->cat_id; 
        $category= Category::where('id', $cat_id)->first();
        $child_cat_ids = $category->getAllChildren()->pluck('id')->toArray();
        array_push($child_cat_ids, $cat_id);
        $books = Book::whereIn('category_id',$child_cat_ids)->where('price', '>', 0)->get();

        $currentCategory = $category;
        return view('frontend.book.books', compact('books','currentCategory'));
    }
    public function videoByCat(Request $request)
    {
        $cat_id = $request->cat_id; 
        $category= Category::where('id', $cat_id)->first();
        $child_cat_ids = $category->getAllChildren()->pluck('id')->toArray();
        array_push($child_cat_ids, $cat_id);
        $videos = Video::whereIn('category_id', $child_cat_ids)->get();
        $currentCategory = $category;
        return view('frontend.video.videos', compact('videos','currentCategory'));
    }
    
}
