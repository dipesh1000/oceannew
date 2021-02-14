<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\Category\CategoryResource;
use App\Repositories\BookRepo\BookRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    use ResponseAPI;
    
    public $book;
    public function __construct(BookRepository $book) {
        $this->book = $book;
    }
    public function index()
    {
        // try {
            $books = $this->book->getAllBooks();

            $cats = $this->book->getAllBooksCategory();
            $context_cat = [];
            foreach($cats as $cat){
                $data = CategoryResource::collection($cat);
                $context_cat = array_merge($context_cat,  $data->toArray(0) );
            }
            $context = [
                'books' => BookResource::collection($books),
                'categories' => $context_cat 
            ];
            return $this->success("All Books", $context); 
            
    }

    public function getBookBySlug($slug)
    {
       
        try {
            $book = $this->book->getBookBySlug($slug);

            $similarBooks = $this->book->getSimilarBooks($slug);

            $child_cat = $this->book->getRelatedCategories($slug);
            
            $review = $book->courseItem;
            
            return [
                $this->success("Book", $book),
                $this->success("similarBooks", $similarBooks),
                $this->success("childCategories", $child_cat),
                $this->success("Review", $review)
            ];
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->error($ex->getMessage());
        }
        catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
