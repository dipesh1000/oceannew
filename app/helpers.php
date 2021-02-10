<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use App\Model\PostType;
use App\Model\GobalPost;
use App\Model\GobalPostMeta;
use App\Model\Category;
use App\Model\PackageItem;
use App\Model\SiteSetting;
use App\Repositories\RepoCourse\CourseInterface;
use App\Repositories\RepoCourse\CourseRepository;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Sentinel as SentinelSentinel;
use Illuminate\Support\Facades\Storage;

function getSiteSetting( $key ) {
    $config = SiteSetting::where( 'key', '=', $key )->first();
    if ( $config != null ) {
        return $config->value;
    }
    return null;
}

function fileupload($path, $file){
    if ($file) {

        $uploadedfile =  time() . '.' . $file->getClientOriginalName();

        $destinationPath = public_path($path);
        $file->move($destinationPath, $uploadedfile);

        return $path.$uploadedfile;

    }
    return null;

}
function bookupload($path, $file){
    if ($file) {

        $uploadedfile =  time() . '.' . $file->getClientOriginalName();

        // $destinationPath = public_path($path);
        $db_path = Storage::put($path, $file);
        // $file->move($destinationPath, $uploadedfile);
        return $db_path;

    }
    return null;

}


function imageDelete($data){
    if ($data->image){
        $orginalpath = public_path().'/'.$data->image;
        $thumbnailpath = public_path().'/thumbnail/'.$data->image;
        if(file_exists($orginalpath)){
            unlink($orginalpath);
        }
        if(file_exists($thumbnailpath)){
            unlink($thumbnailpath);
        }
    }
}


function bookdelete($data){
    if ($data->book){
        File::delete(public_path($data->book));
    }
}

function array_add($array, $key, $value)
{
    return Arr::add($array, $key, $value);
}

function seperator($depth)
{
    $space = '';
    for ($i = 1; $i < $depth; $i++) {
        $space .= '-';
    }
    return $space;
}

function returnExpression(){

    $videosArray = ['teststring', 'teststring2'];

    foreach ( $videosArray as $item){

        $returnValue = Jwplayer\JwplatformAPI::class;
        $returnValue->key = "";
        $returnValue->video_url = "";

    }


}


function getPostTypes(){

    $postTypes = PostType::where('status', 'Active')->orderBy('position', 'ASC')->get();
    return $postTypes;

}


function getPostTypeBySlug($post_type){
    $post_type =  $postTypes = PostType::where('slug', $post_type)->first();

    if ($post_type){
        return $post_type;
    }
    return redirect()->route('admin.dashboard');
}


function getGobalPostByPostType($post_type){
    $post_type =  $postTypes = PostType::where('slug', $post_type)->first();
    if ($post_type){
        $gobalPosts = GobalPost::where('post_type', $post_type->id)->get();
        return $gobalPosts;
    }
    return redirect()->route('admin.dashboard');
}

function getGobalPostBySlug($slug){
    $gobalPost = GobalPost::where('slug', $slug)->first();
    if ($gobalPost){
        return $gobalPost;
    }
    return redirect()->route('admin.dashboard');
}


function unserializeCustomFeild($data){

    if ($data){
        return unserialize($data);
    }

    return null;

}


function returnField($postType, $position){
    $customFields = $postType->customFields;
    return view('admin.gobal_post.getfield', compact('customFields', 'position'));

}

function returnFieldwithValue($postType, $position, $post){
    $customFields = $postType->customFields;
    return view('admin.gobal_post.getfield', compact('customFields', 'position', 'post'));
}

function getPostFieldData($post, $field_name){
    $getField = $post->postMetas->where('key', $field_name)->first();

    if ($getField){
        $serializePostType = array('post_type', 'repeater', 'checkbox');
        if (in_array($getField->post_type, $serializePostType)){

            return unserializeCustomFeild($getField->value);
        }else{
            return $getField->value;
        }
    }

    return null;
}


function filedFileDelete($post_id, $key){

    $postMeta = GobalPostMeta::where('gobal_post_id', $post_id)->where('key', $key)->first();
    if (isset($postMeta->value)){
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
}


function getPostFieldId($post, $field_name){
    $getField = $post->postMetas->where('key', $field_name)->first();
    if ($getField){
        return $getField->id;
    }

    return null;
}


function returnGobalPost($post_type){
    $gobalPosts= GobalPost::where('post_type', $post_type)->where('status', 'Active')->get();
    return $gobalPosts;
}


function getCategoryParents($category_id){
    $category = Category::select('id', 'title', 'parent_id')->where('id', $category_id)->first();

}

function gobalPostImage($id, $type=null, $imgclass=null, $imgid=null){

    $post = GobalPost::find($id);
    if ($post->image){

        $imageAlt = $post->seoable?$post->seoable->img_alt:$post->title;
        $imageTitle = $post->seoable?$post->seoable->img_alt:$post->title;
        if($type=="thumbnail"){
            return '<img src="'. asset("thumbnail/".$post->image) .'" class="'.$imgclass.'" id="'.$imgid.'" alt="'. $imageAlt .'" title="'.$imageTitle .'" />';
        }else{
            return '<img src="'. asset($post->image) .'" class="'.$imgclass.'" id="'.$imgid.'" alt="'. $imageAlt .'" title="'.$imageTitle .'" />';
        }
        return null;
    }
    return null;
};

function getCoursesByType($cart) 
{
    $interface = new CourseRepository();
    if($cart->name == "book"){
        $book = $interface->getBookById($cart->id);
        return $book;
    }

    if($cart->name == "video"){
        $video = $interface->getVideoById($cart->id);
        return $video;

    }

    if($cart->name == "package"){
        $package = $interface->getPackageById($cart->id);
        return $package;

    }
        
}
function getSavedCourseByType($request) 
{
    $interface = new CourseRepository();
    if($request['name'] == "book"){
        $book = $interface->getBookById($request['courseId']);
        return $book;
    }

    if($request['name'] == "video"){
        $video = $interface->getVideoById($request['courseId']);
        return $video;
    }

    if($request['name'] == "package"){
        $package = $interface->getPackageById($request['courseId']);
        return $package;

    }
        
}
function getCoursesByModel($course) 
{
    $interface = new CourseRepository();
    if($course->purchaseble_type == "App\Model\Book"){
        $book = $interface->getBookById($course->purchaseble_id);
        return $book;
    }

    if($course->purchaseble_type == "App\Model\Video"){
        $video = $interface->getVideoById($course->purchaseble_id);
        return $video;
    }

    if($course->purchaseble_type == "App\Model\Package"){
        $package = $interface->getPackageById($course->purchaseble_id);
        return $package;
    }
        
}


function getProfileDetails($key)
{
    $users = Sentinel::getUser();
    return $users->$key;
}

function hasOfferPrice($course){
    if($course){
        if($course->offer_price != '' && $course->offer_price != 0 && $course->offer_price < $course->price){
            return true;
        }
        return false;
    }
    return false;
}

function counter( $model )
{
    $user = Sentinel::getUser();
    $items = $model::where('user_id', $user->id)->get();
    $counter = count($items);
    return $counter;
}

function getGlobalPostMetaByKeys($post, $key){
    $meta =  GobalPostMeta::where('gobal_post_id', $post)->where('key', $key)->first();
    if($meta){
        return $meta->value;
        // $dat = unserialize($meta->value);
        // return $dat;
    }
    return null;
}


?>