<?php

namespace App\Jobs;

use App\Notifications\ChangedCourse;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMailCourse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$data)
    {
        //
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->user->notify(new ChangedCourse($this->data));
    }
}
