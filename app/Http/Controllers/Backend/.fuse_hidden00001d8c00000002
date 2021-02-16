<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Model\Book;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Video;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $book = Book::find(39);
        // dd($book);
        // $filename = $book->book;
        
        $books = Book::orderBy('id', 'desc')->get();
        return view('admin.book.index', compact('books'));
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
        return view('admin.book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try{
            DB::beginTransaction();
            $book = new Book();
            $book->title = $request->title;
            $book->category_id = $request->category_id;
            $book->book = bookupload('/upload/book/file', $request->file('book_file'));
            $book->price = $request->price;
            $book->offer_price = $request->offer_price;
            $book->author = $request->author;
            $book->isbn_no = $request->isbn_no;
            $book->image = imageupload('/upload/book/image/', $request->file('image'));
            $book->sku = $request->sku;
            $book->edition = $request->edition;
            $book->language = $request->language;
            $book->digital_or_hardcopy = $request->book_type;
            $book->quantity = $request->quantity;
            $book->description = $request->description;
            $book->table_of_content = $request->table_of_content;
            $book->status = $request->status=="on"?"Active":"Inactive";
            $response = $book->save();
            if($response){
                DB::commit();
                return redirect()->route('admin.book')->with('success', 'Book Successfully Created.');
            }else{
                DB::rollback();
                return redirect()->back()->with('error', 'Error while creating Book!!');
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error while creating Book!!');
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
        $book = Book::find($id);
        if($book){
            $categories = Category::where('parent_id', 0)->get();
            $categories = $this->addRelation( $categories );
            return view('admin.book.edit', compact('categories','book'));
        }else{
            return redirect()->back()->with('errors', 'Book Not Found!!! Refresh your page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request)
    {

        // try{
            $book = Book::where('id', $request->book_id)->first();
            $book->title = $request->title;
            $book->category_id = $request->category_id;
            if ($request->hasFile('book_file')){
                bookdelete($book);
                $book->book = bookupload('/upload/book/file/', $request->file('book_file'));
            }
            $book->price = $request->price;
            $book->offer_price = $request->offer_price;
            $book->author = $request->author;
            $book->isbn_no = $request->isbn_no;
            if ($request->hasFile('image')){
                imageDelete($book);
                $book->image = imageupload('/upload/book/image/', $request->file('image'));
            }
            $book->sku = $request->sku;
            $book->edition = $request->edition;
            $book->language = $request->language;
            $book->digital_or_hardcopy = $request->book_type;
            $book->quantity = $request->quantity;
            $book->description = $request->description;
            $book->table_of_content = $request->table_of_content;
            $book->status = $request->status=="on"?"Active":"Inactive";
            $response = $book->update();
            if($response){
                return redirect()->route('admin.book')->with('success', 'Book Successfully Updated.');
            }else{
                return redirect()->back()->with('error', 'Error while Updating Book!!');
            }
        // }
        // catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Error while Updating Book!!');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if($book->orderItem->isEmpty()) {
            if($book){
                imageDelete($book);
                $book->delete();
                return redirect()->back()->with('success', 'Book Successfully Deleted.');
            }else{
                return redirect()->back()->with('error', 'Book Not Found!!! Refresh your page.');
            } 
        }
        else {
            return redirect()->back()->with('error', 'Some users purchase this Book!! you are unable to delete this.');
        }
        
    }

}
