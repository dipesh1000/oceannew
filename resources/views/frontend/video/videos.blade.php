<div class="bread_container">
    <ul class="bread">
        <li><a href="/"> <i class="fa fa-home"></i> Home &gt; </a></li>
        <li><a href="/videos">Videos &gt;</a></li>
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
    @if($videos->count() > 0)
    @foreach ($videos as $video)
        <div class="col-md-3 col-6">
            <div class="book_list">
                <div class="book_img">
                    {{-- <span class="badge badge-primary">Video</span> --}}
                    <a href="{{ route('video.single', $video->slug) }}"><img class="img-fluid" src="{{ $video->image }}" alt=""></a>
                </div>
                <div class="book_description">
                    {{ $video->title }}
                </div>
                
                <div class="row">
                    <div class="col-md-7" style="align-self: center">
                        4.5 <i class="fa fa-star" style="color: orange"></i> Reviews
                    </div>
                    <div class="col-md-5">
                        <div class="rating"> 
                            <input type="radio" name="rating" value="5" id="5">
                            <label for="5" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label> 
                            <input type="radio" name="rating" value="4" id="4">
                            <label for="4" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label>
                            <input type="radio" name="rating" value="3" id="3">
                            <label for="3" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label> 
                            <input type="radio" name="rating" value="2" id="2">
                            <label for="2" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label> 
                            <input type="radio" name="rating" value="1" id="1">
                            <label for="1" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label>
                        </div>
                    </div>
                </div>

                <div class="book-nav">
                    <div class="book_price">
                        @if(hasOfferPrice($video))
                            <div class="old-price">Rs {{ $video->price }}</div>
                            <div class="new-price">Rs {{ $video->offer_price }}</div>
                        @else
                            <div class="new-price">Rs {{$video->price}}</div>
                        @endif
                    </div>
                    
                </div>
                <div class="book-nav-below">
                    <div class="book_button_view">    
                            <a class="btn_addcart" href="{{ route('video.single', $video->slug) }}"> <i class="fas fa-eye"></i> View</a>
                    </div>
                    <div class="book-add-cart">
                        <a class="btn_addcart" href="#" onclick="addToCart(this)" data-course="{{ $video->id }}"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
                
            </div>
        </div>                   
    @endforeach

    
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
     </nav> --}}

     @else
        
        <div class="col-12">
            <div class="no-video-container">
                <div class="no-video-details">
                    <h3 class="text-center">No Videos available...</h3>
                </div>
            </div>
        </div>
     @endif
</div>