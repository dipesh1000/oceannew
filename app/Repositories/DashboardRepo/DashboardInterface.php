<?php

namespace App\Repositories\DashboardRepo;


interface DashboardInterface
{
    public function getLatestBooks();

    public function getLatestVideos();
    
    public function getLatestPackages();

}