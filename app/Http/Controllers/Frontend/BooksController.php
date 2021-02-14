<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Book;
use App\Model\Category;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('ID','DESC')
            ->where('status','Active')
            ->where('offer_price','>',0)
            ->get();

        $categories = Category::orderBy('ID', 'DESC')
        ->where('status', 'Active')
        ->where('parent_id', 0)
        ->get();

        $cats = [];
        foreach ( $categories as $category ) {
            $cats[] = Category::with('childs.childs')
            ->where('id', $category->id)
            ->get();
        }

        $avgRatingBooks = [];
        foreach($books as $book) {
            if($book->courseItem) {
                $avgRatingBooks = $book->courseItem;
                if($avgRatingBooks->avg('star') == null) {
                    $book->rating = 2;
                }else {
                    $book->rating = $avgRatingBooks->avg('star');
                }
            }
        }
        return view('frontend.book.index',compact('cats', 'books'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
    }
    public function getBooksBySlug($slug)
    {
        
        $book = Book::where('slug', $slug)->first();
        $book->type = 'book';
        $similarBooks = Book::orderBy('ID','DESC')
            ->where('category_id', $book->category_id)
            ->where('id', '!=' , $book->id)
            ->where('status','Active')
            ->where('price','>',0)
            ->take(6)
            ->get();
        $current_cat = $book->category()->first();
        $parent_cat = $current_cat->parent()->first();
        $child_cat = Category::with('childs.childs')
            ->where('id', $parent_cat->id)
            ->first();

        if ($book->courseItem->avg('star')) {
            $avgRating = $book->courseItem->avg('star');
            $book->rating = $avgRating;
        }else {
            $avgRating = 2;
            $book->rating = $avgRating;
        }
        
        return view('frontend.book.single', compact('book', 'similarBooks', 'child_cat'));
    }
}
