<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\VideoRepo\VideoRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use ResponseAPI;
    
    public $video;
    public function __construct(VideoRepository $video) {
        $this->video = $video;
    }
    public function index()
    {
        try {
            $videos = $this->video->getAllVideos();
    
            $cats = $this->video->getAllVideosCategory();
            // return $this->success("All Books", [$books, $cats]);
            return [
                $this->success("Videos", $videos), 
                $this->success('Categories', $cats)
            ];
        } 
        catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage());
        }
        catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
        
    }
    public function getVideoBySlug($slug)
    {
        try {
            $video = $this->video->getVideoBySlug($slug);

            $child_cat = $this->video->getRelatedCategories($slug);

            $similarVideos = $this->video->getSimilarVideos($slug);

            $review = $video->courseItem;

        return [
            $this->success("Video", $video), 
            $this->success('ChildCategories', $child_cat), 
            $this->success('Similar Videos', $similarVideos),
            $this->success("Review", $review)
            ];

        } 
        catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
        catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage(), $ex->getCode());
        }
    }
}
