<?php
/**
 * Created by PhpStorm.
 * User: Bijay
 * Date: 11/1/2020
 * Time: 1:27 PM
 */

namespace App\Repositories\FrontCms;


use App\Model\GobalPost;
use App\Model\GobalPostMeta;
use App\Model\PostType;

class CmsRepository implements CmsInterface
{
    public function getGlobalPostTypeBySlug($slug){
        return PostType::where('slug', $slug)->first();
    }

    public function getGlobalPostByPostType($postType){
        $globalPosts = GobalPost::where('post_type', $postType->id)
            ->where('status','Active')
            ->orderBy('position','ASC')
            ->get();
        return $globalPosts;
    }

    public function getGlobalPostByID($id,  $limit=null){
        $globalPosts = GobalPost::where('post_type', $id)
            ->where('status','Active')
            ->orderBy('position','ASC')
            ->get();
            
            if($limit){
                 return $globalPosts->take($limit);
            }
        return $globalPosts;
    }

    public function getGlobalPostSingleById($id){
        $globalPosts = GobalPost::where('id', $id)->first();
        return $globalPosts;
    }

    public function getGlobalPostMetaByKey($post, $key){
        $meta =  GobalPostMeta::where('gobal_post_id', $post->id)->where('key', $key)->first();
        if($meta){
            return $meta->value;
        }
        return null;
    }




    public function getGlobalPostMultipleByIds($ids = []){
        return GobalPost::whereIn('id',$ids)->where('status','Active')->get();
    }


    public function getgobalPostBySlug($slug){

        return GobalPost::where('slug', $slug)->first();
    }


}