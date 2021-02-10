@extends('frontend.layouts.app')
@section('content')
<!--<link-->
<!--      rel="stylesheet"-->
<!--      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"-->
<!--    />-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<style>
    .out-of-stock{
        border: 1px solid;
    padding: 10px 30px;
    margin: 5px;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(45deg, #1d56a2, #008fd5);
    }
    .aside_drop {
        border-bottom: 1px solid #0487ce;
    }
    .aside_drop:hover {
        background: linear-gradient(45deg, #c3cbd6, #ffffff)!important;
        color: #fff;
        display: block;
    }
    .aside_drop li {
        padding-left: 25px;
    }
    .aside_drop li:hover {
        color: #fff;
    }
    
    #product_page {
        margin-top:0px;
    }
    .book_price{
        margin: 5px;
    }   
    .book_price del{
        color: red;
    }
    .review-box {
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        border-radius: 5px;
        margin: 10px 0;
    }
    .review-user {
        background-size: cover;
        height: 80px;
        width: 80px;
        border-radius: 5px;
        margin: 0 auto;
    }
    .review-name {
        padding-top: 10px;
        text-align: center;
        color: #136ab4;
        font-size: 12px;
        font-weight: 700;
        margin: 0;
    }
    .review-date {
        font-weight: 900;
    }
    .checked {
  color: orange;
}
    </style>
    
<div id="single_page">
    <div class="detail_header_container" style="padding: 0px 0px;">
        <div class="">
            <div class="row">
                <div class="col-md-3 asider">
                    <aside>
                        <div class="aside_header" style="padding-left: 25px">
                            {{ $child_cat->title }}
                        </div>
                             @foreach ($child_cat->childs as $catItem)
                             <div class="aside_drop" data-toggle="collapse" data-target="#drop{{ $catItem->id }}">
                                 <li id="cat{{$catItem->id}}" class="selectCategory" value="{{$catItem->id}}">{{ $catItem->title }}</li> 
                                 @if($catItem->childs && $catItem->childs->count() > 0)
                                    <span>&blacktriangledown;</span>
                                 @endif
                             </div>
                             @if($catItem->childs && $catItem->childs->count() > 0)
                                 @foreach ($catItem->childs as $child_cats)
                                     <div class="collapse" id="drop{{ $catItem->id }}"> 
                                         <div class="aside_list" data-toggle="collapse" data-target="#drop{{ $child_cats->id }}">
                                             <li id="cat{{$child_cats->id}}" class="selectCategory" value="{{$child_cats->id}}">
                                                 {{ $child_cats->title }}
                                             </li> 
                                         </div>
                                     </div>
                                 @endforeach
                             @endif
                             @endforeach
                    </aside>
                </div>
                <div class="col-md-9">
                    <main id="product_page">
                        <div id="booksData">
                            {{-- @include('frontend.book.books') --}}
                        </div>
                    </main>
                    <div class="row singleBook" style="padding: 32px 0px">
                        <div class="col-md-5">
                            <div class="image_container">
                                <img class="img-fluid" src="{{ $book->image }}" alt="{{ $book->title }}">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="course_detail_container">
                                <div class="header">
                                    {{ $book->title }}
                                </div>
                                <div class="description">
                                    <table>
                                        <tr>
                                            <th>SKU</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->sku }}</td>
                                        </tr>
                                        <tr>
                                            <th>ISBN No</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->isbn_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Author</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->author }}</td>
                                        </tr>
                                        <tr>
                                            <th>Edition</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->edition }}</td>
                                        </tr>
                                        <tr>
                                            <th>Book Type</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->digital_or_hardcopy }}</td>
                                        </tr>
                                        <tr>
                                            <th>Language</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $book->language }}</td>
                                        </tr>
                                        <tr>
                                            <th>MRP</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>
                                                @if(hasOfferPrice($book))
                                                    <del>Rs. {{ $book->price }}</del>
                                                @else
                                                    Rs. {{$book->price}}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @if(hasOfferPrice($book))
                                    <div class="price_container">
                                        <span>
                                        Offer Price
                                        </span>
                                        <div>
                                            Rs. {{ $book->offer_price }}
                                        </div>
                                    </div>
                                 @endif
                                <div class="review">
                                    <i class="fa fa-star" style="color: orange"></i> <span>{{ $book->rating }} Reviews</span> 
                                </div>
                                
                                <div>
                                    <label for="out-of-stock" class="out-of-stock">
                                    @if($book->quantity == 0)
                                        Out Of Stock
                                    @else
                                        In Stock
                                    @endif
                                    </label>
                                </div>
                                <div class="enroll_btn">
                                    <a href="javascript:void(0)" class="addtocart btn btn-outline-primary" data-course="{{ $book->id }}">
                                        Add To Cart <i class="fas fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="cart-remove-from-cart-button save-course-later btn btn-outline-primary" course-id="{{ $book->id }}">
                                        Save For Later<i class="fas fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="course_container singleBook">

        <div class="container">
            <div class="row">
                <div class="container">
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#course">Course Description</a>
                      </li>
                      <li><a data-toggle="tab" href="#table">Table of Content</a></li>
                      <li><a data-toggle="tab" href="#review">Reviews</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="course" class="tab-pane fade show in active">
                          {!! $book->description !!}
                      </div>
                      <div id="table" class="tab-pane fade">
                        {!! $book->table_of_content !!}
                      </div>
                      <div id="review" class="tab-pane fade">
                        <h3>Reviews</h3>
                        
                      </div>
                    </div>
                </div>

            </div>
            @if(count($similarBooks) > 0)
                <div class="similar_content_header">
                    Similar Content
                </div>
                <div class="row">
                    @foreach ($similarBooks as $book)
                        <div class="col-md-2 col-6">
                            <div class="book_list p-1" style="background-color: #fff;">
                                <div class="book_img">
                                    <a href="{{ route('book.single', $book->slug) }}"><img class="img-fluid" src="{{ $book->image }}" alt=""></a>
                                </div>
                                <div class="book_description" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; margin: 5px; color: black;"
                                    title="{{ $book->title }}">
                                    {{ $book->title }}
                                </div>
                                
                                {{-- <div class="row">
                                    <div class="col-md-6" style="align-self: center">
                                        reviews 4.5 <label for="5" style="margin-bottom: .1rem; font-size: 1.5vw;">☆</label>
                                    </div>
                                    <div class="col-md-6">
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
                                </div> --}}
                
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
                                    <div class="book_price d-flex justify-content-between">
                                        @if(hasOfferPrice($book))
                                            <del>Rs {{ $book->price }}</del>
                                            <div class="new-price">Rs {{ $book->offer_price }}</div>
                                        @else
                                            <div class="new-price">Rs {{$book->price}}</div>
                                        @endif
                                    </div>
                                    <div class="book_button out-of-stock">    
                                        <a class="btn_addcart text-light" href="{{ route('book.single', $book->slug) }}"> <i class="fas fa-eye"></i> View</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>                   
                    @endforeach
                </div>  
            @endif
        </div>
        @if(count($book->courseItem) > 0)
        <div class="container">
            <h3>FeedBack</h3>
            @foreach ($book->courseItem as $feedback)
            {{-- {{ dd($feedback) }} --}}
                <div class="review-box p-2">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="review-user" style="background-image: url('{{ $feedback->user->image ?? asset('assets/img/user.png') }}')"></div>
                            <p class="review-name">{{ $feedback->user->first_name }} {{ $feedback->user->last_name }}</p>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="review-container col-md-10">
                                    {{ $feedback->review }}
                                    <div>
                                        <span><i class="fa fa-calendar"></i></span>
                                        {{ \Carbon\Carbon::parse($feedback->user->created_at)->isoFormat('MMM Do YYYY')}}
                                    </div>
                                </div>
                                <div class="review-date col-md-2 pt-2">
                                    <div class="text-center" style="font-weight: 400; color:#1d56a2; font-size: 18px;">{{ $feedback->star }} / 5</div>
                                    @for($i=1; $i<=5; $i++) 
                                        <span class="fa fa-star  @if($feedback->star >= $i) checked @endif"></span>    
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>


</div>
@endsection
@push('scripts')
<script type="text/javascript">
        function UpdateMiniCart() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.mini')  }}",
                beforeSend: function (data) {
                    //
                },
                success: function (data) {
                    $('#mini-cart').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //
                },
                complete: function () {
                    location.reload();
                }
            });
            }
        function sweetAlert(type, title, message) {
            swal({
                title: title,
                html: message,
                type: type,
                confirmButtonColor: '#ee3d43',
                timer: 20000
            }).catch(swal.noop);
        }
        $(document).on("click", ".addtocart", function (e) {
            // alert('here');
            e.preventDefault();
            var $this = $(this);
            var course = $this.attr('data-course');
            var type = 'book';
            quantity = 1;
             
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                postType: 'html',
                url: "{{ route('addToCart') }}",
                data: {
                    course: course,
                    type: type,
                    quantity: quantity
                },
                beforeSend: function (data) {
                    $this.button('loading')
                },
                success: function(data){
                    if (data.status) {
                    $('.alert-message.alert-danger').fadeOut();

                    var message = '<div><span><strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Success!</strong> ';
                    message += data.message;
                    message += '</span><a href="{{ route('cart') }}" class="btn btn-xs btn-primary pull-right">View cart</a></div>';

                    $('.alert-message.alert-success').html(message).fadeIn().delay(3000).fadeOut('slow');

                    sweetAlert('success', 'Success', data.message + '<a href="{{ route('cart') }}"> View Cart</a>');
                }

                UpdateMiniCart();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    sweetAlert('error', 'Oops...', 'Something went wrong!');
                },
                complete: function () {
                    $this.button('reset');
                    //$("html, body").animate({scrollTop: 0}, "slow");
                }
            });
        });
     //Save Course For Later
     $(document).on("click", ".save-course-later", function (e) {
            e.preventDefault();
            var $this = $(this);
            var courseId = $this.attr('course-id');
            var name = 'book';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('saveCourseLater.store')  }}",
                data: {
                  courseId: courseId,
                  name: name
                },
                beforeSend: function () {
                    $this.prop('disabled', true);
                },
                success: function (data) {
                  if (data.status == 'login') {
                    window.location.replace('{{ route('login') }}');
                  }
                  if (data.status == 'exists'){
                    swal(data.status, data.message, "error");
                  }
                  else{
                    swal(data.status, data.message, "success");
                  }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                    // location.reload();
                }
            });

        });   
        $(function( $ ){
        $(".selectCategory").click(function(){
            var cat = $(this).val();
            console.log(cat)
            $.ajax({
                type: 'GET',
                dataType: 'html',
                url: "{{ url('/bookByCat') }}",
                data: 'cat_id='+cat,
                success: function(response){
                    console.log(response)
                    $("#booksData").html(response);
                }
            });
        }); 

        $(".selectCategory").click(function(){
            $(".singleBook").empty();
        });
        
    }); 
</script>
@endpush

