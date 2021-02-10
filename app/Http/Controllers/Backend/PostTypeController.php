<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\PostType;
use App\PostType\PostTypeIcon;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postTypes = PostType::all();
        return view('admin.post_type.index', compact('postTypes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postTypeIcon = new PostTypeIcon();
        $iconLists =  $postTypeIcon->iconList();
        return view('admin.post_type.create', compact('iconLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:191',
        ]);

        try{
            $postType = new PostType();
            $postType->title = $request->title;
            $postType->description = $request->description;
            $postType->has_archive = $request->archive=="on"?1:0;
            $postType->position = $request->position;
            $postType->status = $request->status;
            $postType->icon =  $request->icon;
            $postType->feature_image =$request->feature_image=="on"?1:0;
            $postType->editor = $request->editor=="on"?1:0;
            $response = $postType->save();
            if($response){
                return redirect()->back()->with('success', 'Post Type Successfully Created.');
            }else{
                return redirect()->back()->with('error', 'Error while creating Post Type');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while creating Post Type');
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
    public function edit($slug)
    {
        $postType = PostType::where('slug', $slug)->first();
        if($postType){
            return view('admin.post_type.edit', compact('postType'));
        }else{
            return redirect()->back()->with('errors', 'Video Not Found!!! Refresh your page.');
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
            $postType = PostType::where('id', $request->post_type_id)->first();
            $postType->title = $request->title;
            $postType->description = $request->description;
            $postType->has_archive = $request->archive=="on"?1:0;
            $postType->position = $request->position;
            $postType->status = $request->status;
            $postType->icon =  $request->icon;
            $postType->feature_image =$request->feature_image=="on"?1:0;
            $postType->editor = $request->editor=="on"?1:0;
            $response = $postType->update();
            if($response){
                return redirect()->back()->with('success', 'Post Type Successfully Updated.');
            }else{
                return redirect()->back()->with('error', 'Error while Updating Post Type');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Post Type');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $postType = PostType::where('slug', $slug)->first();
        if($postType){
            $postType->delete();
            return redirect()->back()->with('success', 'Post Type Successfully Deleted.');
        }else{
            return redirect()->back()->with('errors', 'Post Type Not Found!!! Refresh your page.');
        }
    }


    public function ordering(){
        $postTypes = PostType::where('status', 'Active')->orderBy('position', 'ASC')->get();

        return view('admin.post_type.order', compact('postTypes'));
    }

    public function orderStore(Request $request){
        foreach ($request->position as $key => $item){
            $postType=PostType::where('id', $item)->first();
            $postType->position = $key;
            $postType->update();
        }

        return response()->json([
            'status' => 'success',
        ], 201);
    }
}
