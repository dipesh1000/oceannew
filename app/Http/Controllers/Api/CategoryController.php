<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource as ResourcesCategory;
use App\Http\Resources\Category\CategoryResource;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
       
        return new ResourcesCategory(Category::all());
    }

    public function getCategory($slug)
    {
        return new CategoryResource(Category::where('slug',$slug)->first());
    }
}
