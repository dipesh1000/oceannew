<?php

namespace App\Repositories\RepoCourse;

use App\Model\Book;
use App\Model\Package;
use App\Model\Video;

class CourseRepository implements CourseInterface 
{
    public function getBookById($id)
    {
        $book = Book::where('id', $id)->first();
        $book->type = 'book';
        return $book;
    }

    public function getClass($type)
    {
        if($type == "book")
        {
            return (new Book())->getMorphClass();
        }
        else if($type == "video")
        {
            return (new Video())->getMorphClass();
        }
        else if($type == "package")
        {
            return (new Package())->getMorphClass();
        }

    }

    public function getVideoById($id)
    {
        $video = Video::where('id', $id)->first();
        $video->type = 'video';
        return $video;
    }
    public function getPackageById($id)
    {
        $package = Package::where('id', $id)->first();
        $package->type = 'package';
        return $package;
    }

    public function isCoursePurchased($data,$user)
    {
        $order = $data->orderItem()->get();
        foreach($order as $value)
        {
            
            if($master = $value->master_order)
            {
                
                if($master->status == 1 && $master->user_id == $user->id)    
                {
                    return true;
                }
            
            }
         
        }
        return false;
    }
    // public function getBookModelById($id)
    // {
    //     $book = Book::where('id', $id)->first();
    //     return $book;
    // }
    // public function getVideoModelById($id)
    // {
    //     $video = Video::where('id', $id)->first();
    //     dd($video);
    //     return $video;
    // }
    // public function getPackageModelById($id)
    // {
    //     $package = Package::where('id', $id)->first();
    //     return $package;
    // }
}
