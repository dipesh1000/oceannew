<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Model\Category;
use App\Model\Video;
use App\Model\VideoContent;
use Illuminate\Http\Request;
use Jwplayer\JwplatformAPI;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
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
        return view('admin.video.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        try{
            $video = new Video();
            $video->title = $request->title;
            $video->category_id = $request->category_id;
            $video->video = $request->video;
            $video->price = $request->price;
            $video->offer_price = $request->offer_price;
            $video->feature = $request->feature=="on"?1:0;
            $video->preview = $request->preview=="on"?1:0;
            $video->image = imageupload('/upload/video/', $request->file('image'));
            $video->author = $request->author;
            $video->time = $request->time;
            $video->description = $request->description;
            $video->table_of_content = $request->table_of_content;
            $video->status = $request->status=="on"?"Active":"Inactive";
            $response = $video->save();
            if($response){
                // create specification
                if (isset($request['videocontent'])) {

                    $keys = $request['videocontent']['key'];
                    $values = $request['videocontent']['value'];

                    $videocontentsKeys = array_keys($keys);

                    // Create specification
                    foreach ($videocontentsKeys as $videocontentKey) {
                        $video->videoContent()->create([
                                'video_id' => $video->id,
                                'key' => $keys[$videocontentKey],
                                'value' => $values[$videocontentKey],
                            ]);
                    }
                }
                return redirect()->back()->with('success', 'Video Successfully Created.');
            }else{
                return redirect()->back()->with('error', 'Error while creating Video');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while creating Video');
        }


    }


    public function uploadVideo(Request $request){

        $jwplatform_api = new JwplatformAPI('qxgIaS6m', 'w6rtD7CGjMUmTPryB5AXGjVO');

        $target_file = $request->file;
        $params = array();
        $params['title'] = $request->title;
        $params['description'] = 'Video description here';

        $create_response = json_encode($jwplatform_api->call('/videos/create', $params));
        $decoded = json_decode(trim($create_response), TRUE);
        $upload_link = $decoded['link'];

        $upload_response = $jwplatform_api->upload($target_file, $upload_link);

        if($upload_response['status'] == "ok" ){

            return response()->json([
                'status' => 'success',
                'videokey' => $upload_response['media']['key'],
            ], 201);
        }else{
            return response()->json([
                'status' => 'error',
                'videokey' => "",
            ], 201);
        }
        return response()->json([
            'status' => 'error',
            'videokey' => "",
        ], 201);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        if($video){
            return view('admin.video.preview', compact('video'));
        }else{
            return redirect()->back()->with('errors', 'Video Not Found!!! Refresh your page.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        if($video){
            $categories = Category::where('parent_id', 0)->get();
            $categories = $this->addRelation( $categories );
            return view('admin.video.edit', compact('categories','video'));
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
    public function update(UpdateVideoRequest $request)
    {


        try{
            $video = Video::where('id', $request->video_id)->first();
            $video->title = $request->title;
            $video->category_id = $request->category_id;
            $video->video = $request->video;
            $video->price = $request->price;
            $video->offer_price = $request->offer_price;
            $video->feature = $request->feature=="on"?1:0;
            $video->preview = $request->preview=="on"?1:0;
            if ($request->hasFile('image')){
                imageDelete($video);
                $video->image = imageupload('/upload/video/', $request->file('image'));
            }
            $video->author = $request->author;
            $video->time = $request->time;
            $video->description = $request->description;
            $video->status = $request->status=="on"?"Active":"Inactive";
            $response = $video->update();
            if($response){
                // create specification
                if (isset($request['videocontent'])) {

                    $keys = $request['videocontent']['key'];
                    $values = $request['videocontent']['value'];

                    $videocontentsKeys = array_keys($keys);

                    // Create specification
                    foreach ($videocontentsKeys as $videocontentKey) {
                        $video->videoContent()->updateOrCreate(['id'=>$videocontentKey],[
                            'video_id' => $video->id,
                            'key' => $keys[$videocontentKey],
                            'value' => $values[$videocontentKey],
                        ]);
                    }
                }
                return redirect()->back()->with('success', 'Video Successfully Updated.');
            }else{
                return redirect()->back()->with('error', 'Error while Updating Video');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error while Updating Video');
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

        $video = Video::find($id);

        if($video->orderItem->isEmpty()){
            if($video){
                imageDelete($video);
                $video->delete();
                return redirect()->back()->with('success', 'Video Successfully Deleted.');
            }else{
                return redirect()->back()->with('error', 'Video Not Found!!! Refresh your page.');
            }
        }else{
            return redirect()->back()->with('error', 'Some users purchase this Video!! you are unable to delete this.');
        }


        
    }


    public function uploadContentDelete(Request $request){

        $video = VideoContent::where('id', $request->additional)->first();

        if($video){
            $video->delete();
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
