<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepo\BookRepository;
use App\Repositories\PackageRepo\PackageRepository;
use App\Repositories\RepoCourse\CourseRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use ResponseAPI;

    public $package;
    public function __construct(PackageRepository $package)
    {
        $this->package = $package;
    }
    public function index()
    {
        try {
            $packages = $this->package->getAllPackages();

            return $this->success("Packages", $packages);

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage());
        }
        catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    
    }
    public function getPackageBySlug($slug)
    {
        try {
            $package = $this->package->getPackageBySlug($slug);
            
            $packageAssignCourse = $this->package->packageAssignCourse($slug);

            $similarPackages = $this->package->getSimilarPackages($slug);

            $review = $package->courseItem;

            return [
                    $this->success("Packages", $package), 
                    $this->success("Similar Packages", $similarPackages),
                    $this->success("Course Assign", $packageAssignCourse),
                    $this->success("Review", $review)
        ];

        } 
        catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage());
        }
        catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
        
    }
}
