<?php

namespace App\Observers;

use App\Jobs\ProcessMailCourse;
use App\Model\Video;
use App\User;

class VideoObserver
{
    /**
     * Handle the video "created" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function created(Video $video)
    {
        //
    }

    /**
     * Handle the video "updated" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function updated(Video $video)
    {
        //
           
        $order = $video->orderItem()->get();
        $users = [];
        foreach($order as $data)
        {
            
            if($master = $data->master_order)
            {
                
                if($master->status == 1)    
                {
                    array_push($users,$master->user_id);
                }
            
            }
         
        }

        if($users)
        {
            $users_data = User::whereIn('id',$users)->get();
            foreach($users_data as $user)
            {
                ProcessMailCourse::dispatch($user,$video);

            }
        }
    }

    /**
     * Handle the video "deleted" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function deleted(Video $video)
    {
        //
    }

    /**
     * Handle the video "restored" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the video "force deleted" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }
}
