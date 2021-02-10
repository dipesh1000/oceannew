<style>
    .rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center
}

.rating>input {
  display: none
}

.rating>label {
  position: relative;
  width: 1em;
  font-size: 2vw;
  color: #FFD600;
  cursor: pointer
}

.rating>label::before {
  content: "\2605";
  position: absolute;
  opacity: 0
}

.rating>label:hover:before{
    opacity: 1 !important
}
.rating>label:hover~label:before {
  opacity: 1 !important
}

.rating>input:checked~label:before {
  opacity: 1
}

.rating:hover>input:checked~label:before {
  opacity: 0.4
}
.checked {
  color: orange;
}
</style>
<div class="bread_container">
    <ul class="bread">
        <li><a href="/"> <i class="fa fa-home"></i> Home &gt; </a></li>
        <li><a href="/books">Books &gt;</a></li>
        @if(isset($currentCategory))
            @if(isset($currentCategory->parent->parent))
                <li><a href="">{{$currentCategory->parent->parent->title}} &gt; </a></li>
            @endif
            @if(isset($currentCategory->parent))
                <li><a href="">{{$currentCategory->parent->title}} &gt; </a></li>
            @endif
            <li><a href="">{{$currentCategory->title}} </a></li>
        @endif
    </ul>
</div>

<div class="row">
    @if($books->count() > 0)
    @foreach ($books as $book)
        <div class="col-md-3 col-6">
            <div class="book_list">
                <div class="book_img">
                    {{-- <span class="badge badge-primary">Book</span> --}}
                    <a href="{{ route('book.single', $book->slug) }}"><img class="img-fluid" src="{{ $book->image }}" alt=""></a>
                </div>
                <div class="book_description">
                    {{ $book->title }}
                </div>
                
                <div class="row no-gutters">
                    <div class="col-md-7" style="align-self: center">
                        {{ $book->rating }} <i class="fa fa-star" style="color: orange"></i> Reviews
                    </div>
                    <div class="col-md-5">
                        @for($i=1; $i<=5; $i++) 
                            <span class="fa fa-star  @if($book->rating >= $i) checked @endif"></span>    
                        @endfor
                        <div class="rating"> 
                            {{-- @for($i=5; $i>0; $i--) 
                                <input type="radio" name="rating" value="{{$i}}" id="{{$i}}"
                                    @if($book->rating == $i) checked @endif>
                                <label for="{{$i}}">☆</label>     
                            @endfor --}}
                            
                            
                        </div>
                    </div>
                </div>

                {{-- <div class="row" style="height: 80px">
                    <div class="col-md-6">
                        <ul class="card-details">
                            <li>
                                <i class="fa fa-user"></i> <span>{{ $book->author }}</span>
                            </li>
                            <li>
                                <i class="fa fa-book"></i> <span>{{ $book->edition }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="card-details">
                            <li>
                                <i class="fa fa-file"></i> <span>{{ $book->digital_or_hardcopy }}</span>
                            </li>
                            <li>
                                <i class="fa fa-american-sign-language-interpreting"></i> <span>{{ $book->language }}</span>
                            </li>
                        </ul>
                    </div>
                </div> --}}

                <div class="book-nav">
                    <div class="book_price">
                        @if(hasOfferPrice($book))
                            <div class="old-price">Rs {{ $book->price }}</div>
                            <div class="new-price">Rs {{ $book->offer_price }}</div>
                        @else
                            <div class="new-price">Rs {{ $book->price }}</div>
                        @endif
                    </div>
                    
                </div>
                <div class="book-nav-below">
                    <div class="book_button_view">    
                            <a class="btn_addcart" href="{{ route('book.single', $book->slug) }}"> <i class="fas fa-eye"></i> View</a>
                    </div>
                    <div class="book-add-cart">
                        <a class="btn_addcart" href="#" onclick="addToCart(this)" data-course="{{ $book->id }}"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        </div>                  
    @endforeach

    @else
        <div class="col-12">
            <div class="no-books-container">
                <div class="no-book-details">
                    <h3 class="text-center">No books available...</h3>
                </div>
            </div>
        </div>
    @endif
</div>