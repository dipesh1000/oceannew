<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepo\DashboardRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    
    use ResponseAPI;

    public $dash;
    public function __construct(DashboardRepository $dash)
    {
        $this->dash = $dash;
    }
    public function dashboardDetails()
    {
        try {
            $user = Sentinel::findById(Auth::id());
            $books = $this->dash->getLatestBooks();
            $videos = $this->dash->getLatestVideos();
            $packages = $this->dash->getLatestPackages();

            return [
                $this->success("User", $user), 
                $this->success("Books", $books), 
                $this->success('Videos', $videos),
                $this->success('Package', $packages)
            ];

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage());
        }
        catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    
    }
}
