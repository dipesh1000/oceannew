<?php
/**
 * Created by PhpStorm.
 * User: Bijay
 * Date: 11/1/2020
 * Time: 1:27 PM
 */

namespace App\Repositories\FrontCms;


interface CmsInterface
{
    public function getGlobalPostTypeBySlug($slug);

    public function getGlobalPostByID($id, $limit=null);

    public function getGlobalPostByPostType($postType);

    public function getGlobalPostSingleById($id);

    public function getGlobalPostMetaByKey($post, $key);

    public function getGlobalPostMultipleByIds($ids = []);

    public function getgobalPostBySlug($slug);

}