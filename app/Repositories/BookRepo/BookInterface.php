<?php

namespace App\Repositories\BookRepo;


interface BookInterface
{
    public function getAllBooks();

    public function getAllBooksCategory();

    public function getBookBySlug($slug);

    public function getRelatedCategories($slug);

    public function getSimilarBooks($slug);


}