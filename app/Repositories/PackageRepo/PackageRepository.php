<?php 

namespace App\Repositories\PackageRepo;

use App\Model\Package;
use App\Repositories\RepoCourse\CourseRepository;

class  PackageRepository implements PackageInterface {

    public $course;
    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
    }

    public function getAllPackages()
    {
        $packages = Package::orderBy('ID','DESC')
        ->where('status','Active')
        ->where('offer_price','>',0)
        ->paginate(12);

        return $packages;
    }
    
    public function getPackageBySlug($slug)
    {
        $package = Package::where('slug', $slug)->first();
        $package->type = 'package';
        
        return $package;
    }

    public function packageAssignCourse($slug)
    {
        $package = Package::where('slug', $slug)->first();
        $packageAssignCourse = [];
            $packageIdentifier = $package->packageItem;
            foreach ($packageIdentifier as $type){
                if($type->itemable_type == "App\\Model\\Book") {
                    $packageAssignCourse[] = $this->course->getBookById($type->itemable_id);
                }
                else{
                    $packageAssignCourse[] = $this->course->getVideoById($type->itemable_id);
                }
            }
        return $packageAssignCourse;
    }

    public function getSimilarPackages($slug)
    {
        $package = Package::where('slug', $slug)->first();
        $similarPackages = Package::orderBy('ID','DESC')
            ->where('id', '!=' , $package->id)
            ->where('status','Active')
            ->take(3)
            ->get();

        return $similarPackages;
    }

}