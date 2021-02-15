<?php

namespace App\Observers;

use App\Jobs\ProcessMailCourse;
use App\Model\Package;
use App\User;

class PackageObserver
{
    /**
     * Handle the package "created" event.
     *
     * @param  \App\Package  $package
     * @return void
     */
    public function created(Package $package)
    {
        //
    }

    /**
     * Handle the package "updated" event.
     *
     * @param  \App\Package  $package
     * @return void
     */
    public function updated(Package $package)
    {
        //
          
        $order = $package->orderItem()->get();
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
                ProcessMailCourse::dispatch($user,$package);
                //$user->notify(new ChangedCourse($book));
            }
        }
    }

    /**
     * Handle the package "deleted" event.
     *
     * @param  \App\Package  $package
     * @return void
     */
    public function deleted(Package $package)
    {
        //
    }

    /**
     * Handle the package "restored" event.
     *
     * @param  \App\Package  $package
     * @return void
     */
    public function restored(Package $package)
    {
        //
    }

    /**
     * Handle the package "force deleted" event.
     *
     * @param  \App\Package  $package
     * @return void
     */
    public function forceDeleted(Package $package)
    {
        //
    }
}
