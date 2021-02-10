<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\GobalPost;
use App\Repositories\FrontCms\CmsInterface;
use App\Model\PostType;
use Illuminate\Http\Request;

class PosttypeController extends Controller
{
    protected $cms;
    public function __construct(CmsInterface $cms)
    {
        $this->cms = $cms;
    }
    public function newsAndEventGetBySlug($slug)
    {   
        $newsAndEvent = GobalPost::where('slug', $slug)->first();
        return view('frontend.newsandevent.single', compact('newsAndEvent'));
    }
    
    // public function getDistributer() {
    //     $dristibuters = GobalPost::with('postMetas')->where('post_type', 3)->get();
    //     return view('frontend.dristibuter.index', compact('dristibuters'));
    // }
    public function getPostType($post_type)
    {
        $postType = $this->cms->getGlobalPostTypeBySlug($post_type);
        $posts = $this->cms->getGlobalPostByPostType($postType);
        foreach($posts as $post) {
            $meta = $this->cms->getGlobalPostMetaByKey($post, 'subjects');
            $metaDetails = unserialize($meta);
            $post->subjects = $metaDetails;
        }
        return view('frontend.postypes.index', compact('postType', 'posts'));
    }
    public function getPostTypeDetails($postType, $slug)
    {
        $postTypess = $this->cms->getGlobalPostTypeBySlug($slug);
        dd($postTypess);  
    }
}
