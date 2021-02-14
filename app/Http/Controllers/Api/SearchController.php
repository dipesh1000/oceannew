<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Book;
use App\Model\Package;
use App\Model\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        
        $book = Book::where('title','like','%'.$request->data.'%')->get();
        $video = Video::where('title','like','%'.$request->data.'%')->get();
        $package = Package::where('title','like','%'.$request->data.'%')->get();
        $alldatas = $book->merge($video)->merge($package);
        return response()->json(['data'=>$alldatas]);        
        
    }
}
