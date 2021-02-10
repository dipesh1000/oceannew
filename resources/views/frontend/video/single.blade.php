@extends('frontend.layouts.app')
@section('content')
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
</style>
<div id="single_page">

    <!-- <div class="banner_container">
        <div class="text_container">
            <div>
                Introduction to Math 
            </div>
            <div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda mollitia praesentium necessitatibus quo asperiores.
            </div>
            <div>
                <a href="">
                    Start Course
                </a>
            </div>
            
        </div>
        <div class="background_gradient"></div>
        <div class="background_image_container"></div>

    </div> -->

    <div class="detail_header_container" style="padding: 32px 0">
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
                    <div id="videosData">
                        {{-- @include('frontend.book.books') --}}
                    </div>
                    <div class="row singleBook">
                        <div class="col-md-7">
                            <div class="image_container">
                                <img class="img-fluid" src="{{ $video->image }}" alt="{{ $video->title }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="course_detail_container">
                                <div class="header">
                                    {{ $video->title }}
                                </div>
                                <div class="description">
                                    <table>
                                        <tr>
                                            <th>SKU</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->sku }}</td>
                                        </tr>
                                        <tr>
                                            <th>ISBN No</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->isbn_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Author</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->author }}</td>
                                        </tr>
                                        <tr>
                                            <th>Edition</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->edition }}</td>
                                        </tr>
                                        <tr>
                                            <th>video Type</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->digital_or_hardcopy }}</td>
                                        </tr>
                                        <tr>
                                            <th>Language</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>{{ $video->language }}</td>
                                        </tr>
                                        <tr>
                                            <th>MRP</th>
                                            <td> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td>
                                            <td>
                                                @if(hasOfferPrice($video))
                                                <del>Rs. {{ $video->price }}</del>
                                                @else
                                                    Rs. {{$video->price}}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @if(hasOfferPrice($video))
                                <div class="price_container">
                                    <span>
                                     Offer Price
                                    </span>
                                    <div>
                                         Rs. {{ $video->offer_price }}
                                    </div>
                                 </div>
                                 @endif
                                <div class="review">
                                    <i class="far fa-star"></i> <span>4.7 Reviews</span> 
                                </div>
                                
                                <div>
                                    <label for="out-of-stock" class="out-of-stock">
                                    @if($video->quantity == 0)
                                        Out Of Stock
                                    @else
                                        In Stock
                                    @endif
                                    </label>
                                </div>
                                <div class="enroll_btn">
                                    <a href="javascript:void(0)" class="addtocart btn btn-outline-primary" data-course="{{ $video->id }}">
                                        Add To Cart <i class="fas fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="cart-remove-from-cart-button save-course-later btn btn-outline-primary" course-id="{{ $video->id }}">
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

    <div class="course_container">

    <div class="container">
        <div class="row singleBook">

            <div class="col-md-8">
                
                <div class="course_content_container">
                    <div class="course_content_header">
                        Course Description
                    </div>
                    <div class="course_module_container">
                        <div class="course_description_container">
                        <div>{!! $video->description !!}</div>
                        </div>                      
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="course_content_container">

                    <div class="course_content_header">
                        Table Of Content
                    </div>
                        <div class="course_module_side_container p-4">
                            {!! $video->description !!}
                        </div>
                    
                </div>

            </div>

        </div>
        @if(count($similarVideos) > 0)
        <div class="similar_content_header">
            Similar Content
        </div>
        <div class="row">
            @foreach ($similarVideos as $item)
                <div class="col-md-4">
                    <div class="similar_content_container">
                    <a href="{{ route('video.single', $item->slug) }}">
                            <div class="image_container">
                            <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->title }}">
                            </div>
                            <div class="text_container">
                                <div class="text_container_header">
                                    {{ $item->title }}
                                </div>
                                <div class="text_container_para">
                                    {!! substr(strip_tags($item->description), 0 , 150) !!}
                                </div>
                            </div>
                        </a>
                    
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>


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
            var type = 'video';
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
                    console.log(data);
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


        //save for later
        $(document).on("click", ".save-course-later", function (e) {
            e.preventDefault();
            var $this = $(this);
            var courseId = $this.attr('course-id');
            var name = 'video';
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
                    location.reload();
                }
            });
        });  

</script>
<script> 
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
                        $("#videosData").html(response);
                    }
                });
            }); 
            $(".selectCategory").click(function(){
            $(".singleBook").empty();
            });
        });

         
    
</script>
@endpush
