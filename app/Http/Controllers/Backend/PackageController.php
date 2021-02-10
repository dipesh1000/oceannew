<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Model\Book;
use App\Model\Category;
use App\Model\Package;
use App\Model\PackageItem;
use App\Model\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Resources;
use PHPUnit\Exception;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }

    public function addRelation( $categories ) {

        $categories->map( function ( $item, $key ) {

            $sub = $this->selectChild( $item->id );

            return $item = array_add( $item, 'subCategory', $sub );

        } );

        return $categories;
    }

    public function selectChild( $id ) {
        $categories = Category::where( 'parent_id', $id )->get(); //rooney

        $categories = $this->addRelation( $categories );

        return $categories;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        $categories = $this->addRelation( $categories );
        return view('admin.package.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        try{
            $package = new Package();
            $package->title = $request->title;
            $package->price = $request->price;
            $package->offer_price = $request->offer_price;
            $package->image = imageupload('/upload/package/', $request->file('image'));
            $package->package_type = $request->package_type;
            $package->description = $request->description;
            $package->status = $request->status=="on"?"Active":"Inactive";
            $response = $package->save();
            if($response){
                if (isset($request->packageitem['video'])){

                    foreach ($request->packageitem['video'] as $key => $item){
                        $package->packageItem()->updateOrCreate(['itemable_id'=> $item, 'itemable_type' => Video::class],[
                            'itemable_id'=>$item,
                            'itemable_type' => Video::class,
                        ]);
                    }

                }
                if (isset($request->packageitem['book'])){

                    foreach ($request->packageitem['book'] as $key => $item){
                        $package->packageItem()->updateOrCreate(['itemable_id'=> $item, 'itemable_type' => Book::class],[
                            'itemable_id'=>$item,
                            'itemable_type' => Book::class,
                        ]);
                    }

                }
                return redirect()->back()->with('success', 'Package Successfully Updated.');
            }else{
                return redirect()->back()->with('error', 'Error while Updating Package!!');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Package!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        if($package){
            $categories = Category::where('parent_id', 0)->get();
            $categories = $this->addRelation( $categories );
            $packagesItems = $package->packageItem;
            foreach ($packagesItems as $item){
                if ($item->itemable_type == Video::class){
                    $item->itemable->type = 'video';
                }if ($item->itemable_type == Book::class){
                    $item->itemable->type = 'book';
                }
            }
            return view('admin.package.edit', compact('categories','package', 'packagesItems'));
        }else{
            return redirect()->back()->with('errors', 'Package Not Found!!! Refresh your page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request)
    {
        try{
            $package = Package::where('id', $request->package_id)->first();
            $package->title = $request->title;
            $package->price = $request->price;
            $package->offer_price = $request->offer_price;
            if ($request->hasFile('image')){
                imageDelete($package);
                $package->image = imageupload('/upload/package/', $request->file('image'));
            }
            $package->package_type = $request->package_type;
            $package->description = $request->description;
            $package->status = $request->status=="on"?"Active":"Inactive";
            $response = $package->update();
            if($response){
                if (isset($request->packageitem['video'])){

                    foreach ($request->packageitem['video'] as $key => $item){
                        $package->packageItem()->updateOrCreate(['itemable_id'=> $item, 'itemable_type' => Video::class],[
                            'itemable_id'=>$item,
                            'itemable_type' => Video::class,
                        ]);
                    }

                }
                if (isset($request->packageitem['book'])){

                    foreach ($request->packageitem['book'] as $key => $item){
                        $package->packageItem()->updateOrCreate(['itemable_id'=> $item, 'itemable_type' => Book::class],[
                            'itemable_id'=>$item,
                            'itemable_type' => Book::class,
                        ]);
                    }

                }
                return redirect()->back()->with('success', 'Package Successfully Created.');
            }else{
                return redirect()->back()->with('error', 'Error while creating Package!!');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while creating Package!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);

        if($package->orderItem->isEmpty()) {
            if($package){
                imageDelete($package);
                $package->delete();
                return redirect()->back()->with('success', 'Package Successfully Deleted.');
            }else{
                return redirect()->back()->with('error', 'Package Not Found!!! Refresh your page.');
            }
        }
        else {
            return redirect()->back()->with('error', 'Some users purchase this Book!! you are unable to delete this.');
        }

       
    }


    public function packageItem(Request $request){

//        dd($request);
        try {
            $category_id = $request->category_id;
            $package_type = $request->package_type;
            $bookids = $request->bookids;
            $videoids = $request->videoids;


            $packagesItems = null;
            $books = Book::select('id', 'title', 'image', 'category_id')->where('status', 'Active')->where('category_id', $category_id)->get();
            $videos = Video::select('id', 'title', 'image', 'category_id')->where('status', 'Active')->where('category_id', $category_id)->get();

            if ($videoids){
                $videos =  $videos->whereNotIn('id', $videoids);
            }
            if ($bookids){
                $books = $books->whereNotIn('id', $bookids);
            }
            if ($books){
                foreach ($books as $item){
                    $item->type = "book";
                }
            }
            if ($videos){
                foreach ($videos as $item){
                    $item->type = "video";
                }
            }
            if ($package_type == "Book")  {
                $packagesItems = $books;


            }elseif ($package_type == "Video"){
                $packagesItems = $videos;
            }else{

                $packagesItems = $books->merge($videos);
            }


            return view('admin.package.CommonFile.item', compact('packagesItems'));

        }
        catch (\Exception $e) {
            return null;
        }

    }


    public function packageItemDelete(Request $request){

        $packageItem = PackageItem::where('id', $request->itemid)->first();

        if($packageItem){
            $packageItem->delete();
            return response()->json([
                'status' => 'success',
            ], 201);
        }else{
            return response()->json([
                'status' => 'error',
            ], 201);
        }
    }
}
