<?php

namespace App\Repositories\RepoCourse;
Interface CourseInterface {

    public function getBookById($id);

    public function getClass($type);

    public function getVideoById($id);

    public function getPackageById($id);

    // public function getBookModelById($id);

    // public function getVideoModelById($id);

    // public function getPackageModelById($id);

}