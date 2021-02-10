<?php

namespace App\Console;

use App\Model\Book;
use App\Model\Category;
use App\Model\CustomField;
use App\Model\GobalPost;
use App\Model\Package;
use App\Model\PostType;
use App\Model\Video;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pdf_file:clear')->everyMinute();
        $schedule->call(function () {
            GobalPost::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            Video::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            Book::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            PostType::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            Package::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            CustomField::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
            Category::where('deleted_at', '<=', Carbon::now()->subDays(30))->forceDelete()();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
