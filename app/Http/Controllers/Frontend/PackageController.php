<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\Book;
use App\Model\PackageItem;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('ID','DESC')
            ->where('status','Active')
            ->paginate(12);
        return view('frontend.packages.index',compact('packages'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }
    public function singlePackage($slug)
    {
        $package = Package::where('slug', $slug)->first();
        $similarPackages = Book::orderBy('ID','DESC')
            ->where('category_id', $package->category_id)
            ->where('id', '!=' , $package->id)
            ->where('status','Active')
            ->take(3)
            ->get();
        return view('frontend.packages.single', compact('package', 'similarPackages'));
    }
}
