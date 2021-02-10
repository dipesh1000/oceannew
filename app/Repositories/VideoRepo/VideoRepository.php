<?php 

namespace App\Repositories\VideoRepo;

use App\Model\Category;
use App\Model\Video;

class  VideoRepository implements VideoInterface {

    public function getAllVideos()
    {
        $videos = Video::orderBy('ID','DESC')
        ->where('status','Active')
        ->where('offer_price','>',0)
        ->paginate(12);

        return $videos;
    
    }
    public function getAllVideosCategory()
    {
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
        return $cats;
    }

    public function getVideoBySlug($slug)
    {
        $video = Video::where('slug', $slug)->first();
        $video->type = 'video';
        
        return $video;
    }

    public function getRelatedCategories($slug)
    {
        $video = Video::where('slug', $slug)->first();
        $current_cat = $video->category()->first();
        $parent_cat = $current_cat->parent()->first();
        $child_cat = Category::with('childs.childs')
            ->where('id', $parent_cat->id)
            ->first();
        
        return $child_cat;
    }

    public function getSimilarVideos($slug)
    {
        $video = Video::where('slug', $slug)->first();

        $similarVideos = Video::orderBy('ID','DESC')
        ->where('category_id', $video->category_id)
        ->where('id', '!=' , $video->id)
        ->where('status','Active')
        ->take(3)
        ->get();

        return $similarVideos;
    }


}