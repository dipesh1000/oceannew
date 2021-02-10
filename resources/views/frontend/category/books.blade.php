<div class="row">
@foreach ($books as $result)
    {{-- @foreach ($data->books as $result) --}}
    <div class="col-md-3 col-6">
        <div class="book_list">
            <div class="book_img">
            <a href="{{ route('book.single', $result->slug) }}"><img class="img-fluid" src="{{ $result->image }}" alt="{{ $result->title }}"></a>
                    
            </div>
            <div class="book_description">
                {{ $result->title }} 
            </div>
            <div class="book-nav">
                <div class="book_price">
                    <div class="old-price">Rs. {{ $result->price }} </div>
                    <div class="new-price">Rs. {{ $result->offer_price }} </div>
                </div>
                <div class="book_button">    
                {{-- <a class="btn_addcart" href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Add To Cart</a> --}}
                </div>
            </div>
        </div>
    </div> 
    {{-- @endforeach --}}
@endforeach
@foreach ($videos as $result)
<div class="col-md-3 col-6">
    <div class="book_list">
        <div class="book_img">
        <a href="{{ route('video.single', $result->slug) }}"><img class="img-fluid" src="{{ $result->image }}" alt="{{ $result->title }}"></a>
                
        </div>
        <div class="book_description">
            {{ $result->title }} 
        </div>
        <div class="book-nav">
            <div class="book_price">
                <div class="old-price">Rs. {{ $result->price }} </div>
                <div class="new-price">Rs. {{ $result->offer_price }} </div>
            </div>
            <div class="book_button">    
            <a class="btn_addcart" href="{{ route('video.single', $result->slug) }}"><i class="fas fa-eye"></i> View</a>
                <!-- <a class="btn_like" href=""> <i class="far fa-heart"></i> </a> -->
            </div>
        </div>
    </div>
</div> 
@endforeach
</div>