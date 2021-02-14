<?php 

namespace App\Repositories\DashboardRepo;

use App\Http\Resources\BookResource;
use App\Model\Book;
use App\Model\Category;
use App\Model\Package;
use App\Model\Video;

class  DashboardRepository implements DashboardInterface {

    public function getLatestBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->take(3)->get();
        return $books;
    }

    public function getLatestVideos()
    {
        $Videos = Video::orderBy('created_at', 'desc')->take(3)->get();
        return $Videos;
    }

    public function getLatestPackages()
    {
        $packages = Package::orderBy('created_at', 'desc')->take(3)->get();
        return $packages;
    }
}