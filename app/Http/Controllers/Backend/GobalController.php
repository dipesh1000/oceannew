<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\GobalPost;
use App\Model\GobalPostMeta;
use App\Model\PostType;
use App\Model\SeoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;

class GobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_type)
    {
        $postType = getPostTypeBySlug($post_type);
        $posts = getGobalPostByPostType($post_type);
        return view('admin.gobal_post.index', compact('posts', 'postType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_type)
    {
        $seoContents = SeoContent::all();
        $keywords = [];
        foreach ($seoContents as $content){
            if($content->meta_keyword){
                $keywords=array_merge($keywords, unserialize($content->meta_keyword));
            }

        }
        $keywords = array_unique($keywords);
        $postType = getPostTypeBySlug($post_type);
        return view('admin.gobal_post.create', compact('postType', 'keywords'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_type)
    {


        try{
            $postType = PostType::where('slug', $post_type)->first();
            $post = new GobalPost();
            $post->title = $request->title;
            $post->post_content = $request->description;
            $post->status = $request->status;
            $post->post_type = $postType->id;
            if ($request->hasFile('image')){
                $post->image = imageupload('/upload/'. $post_type .'/', $request->file('image'));
            }

            $response = $post->save();
            if ($response){
                $post->seoable()->create([
                    'img_alt'=>$request->img_alt??$request->title,
                    'img_title'=>$request->img_title??$request->title,
                    'meta_keyword'=>$request->meta_keyword?serialize($request->meta_keyword):null,
                    'meta_description'=>$request->meta_description,
                ]);
                if ($request->custom_field){
                    $this->updatecreatefield($request, $post);
                }
            }
            return redirect()->back()->with('success', 'Post Successfully Created.');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while Creating Post.');
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
    public function edit($post_type, $slug)
    {
        $seoContents = SeoContent::all();
        $keywords = [];
        foreach ($seoContents as $content){
            if($content->meta_keyword){
                $keywords=array_merge($keywords, unserialize($content->meta_keyword));
            }

        }
        $keywords = array_unique($keywords);
        $postType = getPostTypeBySlug($post_type);
        $post = getGobalPostBySlug($slug);
        return view('admin.gobal_post.edit', compact('postType', 'post', 'keywords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_type)
    {
        try{

            $postType = PostType::where('slug', $post_type)->first();
            $post = GobalPost::where('id', $request->post_id)->first();
            $post->title = $request->title;
            $post->post_content = $request->description;
            $post->status = $request->status;
            $post->post_type = $postType->id;
            if ($request->hasFile('image')){
                imageDelete($post);
                $post->image = imageupload('/upload/'. $post_type .'/', $request->file('image'));
            }

            $response = $post->update();
            if ($response){
                $post->seoable()->updateOrCreate(['seoable_id'=>$post->id, 'seoable_type'=>GobalPost::class],[
                    'img_alt'=>$request->img_alt??$request->title,
                    'img_title'=>$request->img_title??$request->title,
                    'meta_keyword'=>$request->meta_keyword?serialize($request->meta_keyword):null,
                    'meta_description'=>$request->meta_description,
                ]);
                if ($request->custom_field){
                    $this->updatecreatefield($request, $post);
                }
            }
            return redirect()->back()->with('success', 'Post Successfully Updated.');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while Updating Post.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($post_type, $slug)
    {
        $postType = getPostTypeBySlug($post_type);
        $post = getGobalPostBySlug($slug);
        if($post){
            $post->delete();
            return redirect()->back()->with('success', 'Post Successfully Deleted.');
        }else{
            return redirect()->back()->with('errors', 'Post Not Found!!! Refresh your page.');
        }
    }

    public function updatecreatefield($request, $post){

        if (isset($request->custom_field['post_type'])) {
            $postfielddata = $request->custom_field['post_type'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    if (count($postfielddata[$postfieldkey]) > 1){
                        $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                            'key' => $postfieldkey,
                            'value' => serialize(array_diff($postfielddata[$postfieldkey],[0])),
                            'post_type' => 'post_type',
                        ]);
                    }else{
                        $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                            'key' => $postfieldkey,
                            'value' => null,
                            'post_type' => 'post_type',
                        ]);
                    }

                }
            }
        }

        if (isset($request->custom_field['repeater'])){
            $postfielddata = $request->custom_field['repeater'];
            $postfieldkeys = array_keys($postfielddata);

            if ($postfieldkeys){
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => serialize($postfielddata[$postfieldkey]),
                        'post_type' => 'repeater',
                    ]);
                }
            }

        }


        if (isset($request->custom_field['text'])){
            $postfielddata = $request->custom_field['text'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys){
                foreach ($postfieldkeys as $postfieldkey){
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'text',
                    ]);
                }
            }

        }


        if (isset($request->custom_field['checkbox'])){
            $postfielddata = $request->custom_field['checkbox'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys){
                foreach ($postfieldkeys as $postfieldkey) {
                    if (count($postfielddata[$postfieldkey]) > 1){
                        $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                            'key' => $postfieldkey,
                            'value' => serialize(array_diff($postfielddata[$postfieldkey],[0])),
                            'post_type' => 'post_type',
                        ]);
                    }else{
                        $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                            'key' => $postfieldkey,
                            'value' => null,
                            'post_type' => 'post_type',
                        ]);
                    }
                }
            }

        }

        if (isset($request->custom_field['text_area'])){
            $postfielddata = $request->custom_field['text_area'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'text_area',
                    ]);
                }
            }

        }

        if (isset($request->custom_field['number'])){
            $postfielddata = $request->custom_field['number'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'number',
                    ]);
                }
            }

        }

        if (isset($request->custom_field['select'])){
            $postfielddata = $request->custom_field['select'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'select',
                    ]);
                }
            }

        }

        if (isset($request->custom_field['true_false'])){
            $postfielddata = $request->custom_field['true_false'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'true_false',
                    ]);
                }
            }

        }

        if (isset($request->custom_field['date'])){
            $postfielddata = $request->custom_field['date'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => $postfielddata[$postfieldkey],
                        'post_type' => 'date',
                    ]);
                }
            }

        }

        if (isset($request->custom_field['image'])){
            $postfielddata = $request->custom_field['image'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    filedFileDelete($post->id, $postfieldkey);
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => imageupload('/upload/custom_field/', $postfielddata[$postfieldkey]),
                        'post_type' => 'image',
                    ]);
                }
            }
        }

        if (isset($request->custom_field['file'])){
            $postfielddata = $request->custom_field['file'];
            $postfieldkeys = array_keys($postfielddata);
            if ($postfieldkeys) {
                foreach ($postfieldkeys as $postfieldkey) {
                    filedFileDelete($post->id, $postfieldkey);
                    $post->postMetas()->updateOrCreate(['gobal_post_id'=>$post->id,'key'=>$postfieldkey],[
                        'key' => $postfieldkey,
                        'value' => fileupload('/upload/custom_field/', $postfielddata[$postfieldkey]),
                        'post_type' => 'file',
                    ]);
                }
            }
        }
    }


    public function deleteFieldFile($id){
        $postMeta = GobalPostMeta::find($id);
        try{
            if ($postMeta->post_type == "image" || $postMeta->post_type == "file"){
                if ($postMeta->value){
                    if ($postMeta->post_type == 'image'){
                        $orginalpath = public_path().'/'.$postMeta->value;
                        $thumbnailpath = public_path().'/thumbnail/'.$postMeta->value;
                        if(file_exists($orginalpath)){
                            unlink($orginalpath);
                        }
                        if(file_exists($thumbnailpath)){
                            unlink($thumbnailpath);
                        }
                    }else{
                        File::delete(public_path($postMeta->value));
                    }
                }
                $postMeta->delete();
                return redirect()->back()->with('success', 'File Successfully Deleted.');
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while Deleting File.');
        }

    }


    public function getTrash($post_type){
        $postType = getPostTypeBySlug($post_type);
        $posts = GobalPost::onlyTrashed()->where('post_type', $postType->id)->get();
        return view('admin.gobal_post.trash', compact('posts', 'postType'));
    }
    public function getRestore($post_type, $slug){

        try{
            $postType = getPostTypeBySlug($post_type);
            $posts = GobalPost::withTrashed()->where('slug', $slug)->restore();
            $posts->getDescriptionForEvent('restored');
            return redirect()->back()->with('success', 'Successfully Restore.');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while Restoring.');
        }


    }


    public function forceDelete($post_type, $slug)
    {

        try{
            $postType = getPostTypeBySlug($post_type);
            $post = GobalPost::withTrashed()->where('slug', $slug)->first();
            if($post){
                imageDelete($post);
                $post->forceDelete();
                return redirect()->back()->with('success', 'Post Successfully Deleted.');
            }else{
                return redirect()->back()->with('errors', 'Post Not Found!!! Refresh your page.');
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while Deleting.');
        }

    }

    public function log($post_type)
    {
        $postType = getPostTypeBySlug($post_type);
        $posts = getGobalPostByPostType($post_type);
        $activityLogs = Activity::where('subject_type', GobalPost::class)->where('properties->attributes->post_type', $postType->id)->get();

        foreach ($activityLogs as $activityLog){

            $postTypeId = $activityLog->getExtraProperty('attributes')['post_type'];
            $activityLog->post_type_name = PostType::where('id', $postTypeId)->first()->title;
//
        }

        return view('admin.gobal_post.log', compact('posts', 'postType', 'activityLogs'));
    }

    public function ordering($post_type){
        $postType = getPostTypeBySlug($post_type);
        $posts = GobalPost::where('post_type', $postType->id)->orderBy('position', 'ASC')->get();

        return view('admin.gobal_post.order', compact('posts', 'postType'));
    }

    public function orderStore(Request $request){
        foreach ($request->position as $key => $item){
            $post=GobalPost::where('id', $item)->first();
            $post->position = $key;
            $post->update();
        }

        return response()->json([
            'status' => 'success',
        ], 201);
    }

}
