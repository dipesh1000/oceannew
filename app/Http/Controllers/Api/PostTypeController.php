<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\PostType;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    //
    public function getAuthor()
    {
        $author = PostType::where('slug','authors')->get();
        if($author->isNotEmpty())
        {
            return response()->json(['data'=>$author]);
        }
        return response()->json(['data'=>"No data found!!"]);
    }   

    public function getDistributors()
    {
        $distribution = PostType::where('slug','distributors')->get();
  
        if($distribution->isNotEmpty())
        {
            return response()->json(['data'=>$distribution]);
        }
        response()->json(['data'=>"No data found!!"]);
    }

    public function aboutUs()
    {
        $about = PostType::where('slug','about-us')->get();
        if($about->isNotEmpty())
        {
            return response()->json(['data'=>$about]);
        }
        return response()->json(['data'=>"No data found!!"]);
       
    }
}
