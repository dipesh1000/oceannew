<?php

namespace App\Repositories\VideoRepo;


interface VideoInterface
{
    public function getAllVideos();

    public function getAllVideosCategory();

    public function getVideoBySlug($slug);

    public function getRelatedCategories($slug);

    public function getSimilarVideos($slug);


}