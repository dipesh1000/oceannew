<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('categories'));
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
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        try{
            $category = new Category();
            $category->title = $request->title;
            $category->parent_id = $request->parent_id;
            $category->icon = $request->icon;
            $category->description = $request->description;
            $category->status = $request->status=="on"?"Active":"Inactive";
            $category->image = imageupload('/upload/category/', $request->file('image'));
            $response = $category->save();
            if($response){
                return redirect('/backend/category')->with('success', 'Category Successfully Created.');
            }else{
                return redirect()->back()->with('error', 'Error while creating Category');
            }
        }
    catch (\Exception $e) {
        return redirect()->back()->with('errors', 'Error while creating Category');
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
        $editCategory = Category::find($id);
        if($editCategory){
            $categories = Category::where('parent_id', 0)->get();
            $categories = $this->addRelation( $categories );
            return view('admin.category.edit', compact('categories','editCategory'));
        }else{
            return redirect()->back()->with('errors', 'Category Not Found!!! Refresh your page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
        ]);

        try{
            $category = Category::where('id', $request->category_id)->first();
            $category->title = $request->title;
            $category->parent_id = $request->parent_id;
            $category->icon = $request->icon;
            $category->description = $request->description;
            $category->status = $request->status=="on"?"Active":"Inactive";

            if ($request->hasFile('image')){
                imageDelete($category);
                $category->image = imageupload('/upload/category/', $request->file('image'));
            }

            $response = $category->update();
            if($response){
                return redirect('/backend/category')->with('success', 'Category Successfully Updated.');
            }else{
                return redirect()->back()->with('errors', 'Error while updating Category');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Error while updating Category');
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
        $category = Category::find($id);
        if($category){
            imageDelete($category);
            $category->delete();
            return redirect()->back()->with('success', 'Category Successfully Deleted.');
        }else{
            return redirect()->back()->with('errors', 'Category Not Found!!! Refresh your page.');
        }
    }
}
