<?php

namespace App\Observers;

use App\Jobs\ProcessMailCourse;
use App\Model\Book;
use App\Model\MasterOrder;
use App\Model\Order;
use App\Notifications\ChangedCourse;
use App\User;

class BookObserver
{
    /**
     * Handle the book "created" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        //
    }

    /**
     * Handle the book "updated" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function updated(Book $book)
    {
        //
       
        $order = $book->orderItem()->get();
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
                ProcessMailCourse::dispatch($user,$book);
                //$user->notify(new ChangedCourse($book));
            }
        }
     
    }

    /**
     * Handle the book "deleted" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function deleted(Book $book)
    {
        //
    }

    /**
     * Handle the book "restored" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function restored(Book $book)
    {
        //
    }

    /**
     * Handle the book "force deleted" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function forceDeleted(Book $book)
    {
        //
    }
}
