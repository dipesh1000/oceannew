@extends('frontend.layouts.app')
@section('content')
<style>
    
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
    .side-drop-list-item {
        border-bottom: 1px solid #0487ce;
        width: 89%;
        margin-left: 22px;
        padding: .8em;
        background: #f4f5f7;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .side-drop-list-item:hover {
        background: linear-gradient(45deg, #c3cbd6, #ffffff)!important;
        color: #fff;
        display: block;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .side-drop-list-item span{
        color: #008fd5;
    }
    .side-drop-list-item:hover span{
        color: #008fd5;
    }
    #product_page aside .aside_list {
        padding: 0 4px;
    }
    /*.aside_list li{*/
    /*    display: flex;*/
    /*    flex-direction: row;*/
    /*    justify-content: space-between;*/
    /*}*/
    .active {
        cursor: pointer!important;
    }

    .no-books-container{
        margin-top: 20px; 
        min-height: 80vh;
    }
    .no-books-container .no-book-details{
        margin: 0 auto;
    }

    .grand-child-cat{
        padding-left: 25px;
        cursor: pointer;
    }

    
    @media screen and (max-width: 768px){
        .no-books-container{
            margin-top:20px;
            min-height: 40vh;
        }
    }
    
</style>
<div id="product_page">
    <div class="container-fluid book_filter">
       <div class="filter_title" data-toggle="collapse" data-target="#filter_list">
           <a><i class="fas fa-filter"></i>Book Filter</a>
       </div>
 
   <div class="collapse" id="filter_list"> 
     <aside>
               <div class="aside_header">
                   Categories
               </div>
               
               @foreach ($cats as $cat)
                    @foreach ($cat as $catItem)
                    <div class="aside_drop" data-toggle="collapse" data-target="#drop{{ $catItem->id }}">
                        <li id="cat{{$catItem->id}}" class="selectCategory" value="{{$catItem->id}}">{{ $catItem->title }}</li> 
                        @if($catItem->childs && $catItem->childs->count() > 0)
                            <span>&blacktriangledown;</span>
                        @endif
                    </div>
                    @if($catItem->childs)
                        @foreach ($catItem->childs as $child_cats)
                            <div class="collapse" id="drop{{ $catItem->id }}"> 
                                <div class="aside_list" data-toggle="collapse" data-target="#drop{{ $child_cats->id }}">
                                    <li id="cat{{$child_cats->id}}" class="selectCategory side-drop-list-item {{ ($child_cats->childs) ? 'active' : '' }}" value="{{$child_cats->id}}">
                                        {{ $child_cats->title }}
                                        @if($child_cats->childs && $child_cats->childs->count() > 0)
                                            <span>&blacktriangledown;</span>
                                        @endif
                                    </li> 
                                    
                                </div>
                            </div>
                            @if($child_cats->childs)
                                @foreach ($child_cats->childs as $child_cat)
                                <div class="collapse" id="drop{{ $child_cats->id }}"> 
                                    <div class="aside_list">
                                        <li id="cat{{$catItem->id}}" class="selectCategory grand-child-cat side-drop-list-item" value="{{$child_cat->id}}">
                                            {{ $child_cat->title }}
                                        </li> 
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    @endforeach
                @endforeach
           </aside>
   </div>
</div>


<div class="container-fluid">
   <div class="row">

       <div class="col-3 asider">
           <aside>
               <div class="aside_header">
                   Categories
               </div>
                @foreach ($cats as $cat)
                    @foreach ($cat as $catItem)
                    <div class="aside_drop" data-toggle="collapse" data-target="#drop{{ $catItem->id }}">
                        <li id="cat{{$catItem->id}}" class="selectCategory" value="{{$catItem->id}}">{{ $catItem->title }}</li> 
                        @if($catItem->childs && $catItem->childs->count() > 0)
                            <span>&blacktriangledown;</span>
                        @endif
                    </div>
                    @if($catItem->childs)
                        @foreach ($catItem->childs as $child_cats)
                            <div class="collapse" id="drop{{ $catItem->id }}"> 
                                <div class="aside_list" data-toggle="collapse" data-target="#drop{{ $child_cats->id }}">
                                    <li id="cat{{$child_cats->id}}" class="selectCategory side-drop-list-item {{ ($child_cats->childs) ? 'active' : '' }}" value="{{$child_cats->id}}">
                                        {{ $child_cats->title }}
                                        @if($child_cats->childs && $child_cats->childs->count() > 0)
                                            <span>&blacktriangledown;</span>
                                        @endif
                                    </li> 
                                    
                                </div>
                            </div>
                            @if($child_cats->childs)
                                @foreach ($child_cats->childs as $child_cat)
                                <div class="collapse" id="drop{{ $child_cats->id }}"> 
                                    <div class="aside_list">
                                        <li id="cat{{$catItem->id}}" class="selectCategory grand-child-cat side-drop-list-item" value="{{$child_cat->id}}">
                                            {{ $child_cat->title }}
                                        </li> 
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    @endforeach
                @endforeach
           </aside>
       </div>

       <div class="col-12  col-md-9">
           <main>

                <div id="booksData">
                    @include('frontend.book.books')
                </div>

                
           </main>
       </div>

   </div>
</div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous"></script>
<script>
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
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
                    $("#booksData").html(response);
                }
            });
        }); 
    });
</script>
<script>
    function addToCart (el) {
        // alert('here');
        // e.preventDefault();
        var $this = $(el);
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
    };
</script>
@endpush
