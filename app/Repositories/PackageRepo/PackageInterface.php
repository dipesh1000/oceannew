<?php 

namespace App\Repositories\PackageRepo;

interface PackageInterface 
{
    public function getAllPackages();

    public function getPackageBySlug($slug);

    public function packageAssignCourse($slug);

    public function getSimilarPackages($slug);

}