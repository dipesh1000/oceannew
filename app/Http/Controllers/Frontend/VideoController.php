<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('ID','DESC')
            ->where('status','Active')
            ->where('offer_price','>',0)
            ->paginate(12);

        $categories = Category::orderBy('ID', 'DESC')
        ->where('status', 'Active')
        ->where('parent_id', 0)
        ->get();

        $cats = [];
        foreach ( $categories as $category ) {
            $cats[] = Category::with('childs.childs')
            ->where('id', $category->id)
            ->get();
        }
        return view('frontend.video.index',compact('cats', 'videos'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }
    public function getVideoBySlug($slug)
    {
        $video = Video::where('slug', $slug)->first();
        $video->type = 'video';
        $similarVideos = Video::orderBy('ID','DESC')
            ->where('category_id', $video->category_id)
            ->where('id', '!=' , $video->id)
            ->where('status','Active')
            ->take(3)
            ->get();
        $current_cat = $video->category()->first();
        $parent_cat = $current_cat->parent()->first();
        $child_cat = Category::with('childs.childs')
            ->where('id', $parent_cat->id)
            ->first();
        return view('frontend.video.single', compact('video', 'similarVideos', 'child_cat'));
    }
}
