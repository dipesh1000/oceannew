<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\PackageItem;
use App\Model\Category;
use App\Model\GobalPost;
use App\Model\Book;
use App\Model\Video;

class FrontpageController extends Controller
{
    public function index()
    {
        $packages = Package::take(4)
            ->orderBy('ID','DESC')
            ->where('status','Active')
            ->get();
            
        $categories = Category::take(4)
            ->orderBy('ID','DESC')
            ->where('status','Active')
            ->where('parent_id', 0)
            ->get();

        $freeLibrary = Book::take(4)
        ->orderBy('ID','DESC')
        ->where('offer_price', 0)
        ->where('status','Active')
        ->get();    
        
        $newsAndEvents = GobalPost::where('post_type', 5)
            ->orderBy('ID','DESC')
            ->where('status','Active')
            ->take(3)
            ->get();


        $mainSliders = GobalPost::where('post_type', 7)
            ->orderBy('ID','DESC')
            ->where('status','Active')
            ->take(3)
            ->get();

        // $ddd = $mainSliders->postMetas;
        // dd($ddd);

        return view('frontend.front-page', compact('packages', 'categories', 'newsAndEvents', 'mainSliders', 'freeLibrary'));
    }
    public function getSearch(Request $request)
    {
        $q = $_GET['q'];
        $books = Book::where('title','LIKE','%'.$q.'%')->get();
        $videos = Video::where('title','LIKE','%'.$q.'%')->get();
        return view('frontend.search.index', compact('books', 'videos'));
    }
}
