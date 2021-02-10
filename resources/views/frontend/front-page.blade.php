@extends('frontend.layouts.app')
@section('content')
<div id="index_page">
        <div class="banner">
				<div class="navbar-wrapper">
					<div class="primary-navbar container ">
						<div class="logo-container">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ getSiteSetting('logo') ?? '' }}" class="img-fluid" alt="" />
                            </a>
						</div>
						<div class="primary-content">
							<ul class="first-navbar-wrapper">
                                <!-- <li>
                                    <input type="search" class="search-bar" placeholder="Search">
									<a>
                                        <i id="search-icon" class="fas fa-search"></i>
                                    </a>
								</li> -->
								<li>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:{{ getSiteSetting('primary_phone') ?? '' }}">{{ getSiteSetting('primary_phone') ?? '' }}</a>
								
                                </li>
                                
								<li>
                                    <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ getSiteSetting('primary_email') ?? '' }}">{{ getSiteSetting('primary_email') ?? '' }}</a>
                                </li>
                                <li>
                                    @include('frontend.cart.mini-cart')
                                </li>
                                @if ($user = Sentinel::check())
                                <li class="p-1 ml-4">
                                    <a href="{{ route('userDashboard') }}"><i class="fa fa-user-circle"></i>{{ $user->first_name }}</a>
                                </li>
                                @endif
							</ul>
							<ul class="second-navbar-wrapper">
								<li>
									<a href="{{ URL::to('/') }}">
										Home
									</a>
								</li>

								<li>
									<a href="/about-us">About us</a>
								</li>
								<li>
                                <a href="{{ route('package') }}">
										Packages
									</a>
								</li>
                                    <li class="fixed-visible">
                                        <a href="">
                                            Publication
                                        </a>
                                    </li>
                                    <li class="fixed-visible">
                                    <a href="{{ route('postType', 'authors') }}">
                                            Author
                                        </a>
                                    </li>
                                    <li class="fixed-visible">
                                    <a href="{{ route('postType',  'distributors') }}">
                                            Distributor
                                        </a>
                                    </li>
                                	<li>
                                    <a href="{{ route('getContact') }}">
										Contact
									</a>
                                </li>
                                <li>
                                    @if ($user = Sentinel::check())
                                        <a href="/logout">Logout</a>
                                    @else
                                        <a href="/login">
                                            Login
                                        </a>
                                    @endif
                                </li>
                                @include('frontend.partials.search_form')
                            </ul>
						</div>
						<div class="bars d-block d-lg-none">
							<span id="ham-bar"  onclick="openNav()"><i class="fa fa-bars"></i></span>
						</div>
					</div>
				</div>
				<div class="slider-wrapper">
                    @foreach ($mainSliders as $item)
                        <div class="slider">
                            <div class="img-container">
                            <img src="{{ $item->image }}" class="img-fluid" alt="{{ $item->title }}" />
                            </div>
                            <div class="overlay-container">
                                <div class="container">
                                    @php
                                        $sliderMeta = $item->postMetas->first();
                                    @endphp
                                    @if($sliderMeta != null) 
                                        @if(getGlobalPostMetaByKeys($sliderMeta->gobal_post_id, $sliderMeta->key))
                                        <div class="title">{{ $item->title }}</div>
                                        @else
                                            <div class="title"></div>
                                        @endif
                                    @endif
                                    <div class="subtitle">
                                        {!! $item->post_content !!} 
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
					
				</div>
		</div>

        {{-- <div class="banner_box_container">
            <div class="container">
                <div class="trips_container">
                    <div class="row no-gutters">
                        <div class="col-lg-4">
                            <div class="trips">
                                <div class="trips_icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="trips_details">
                                    <div class="trips_details_header">
                                        100,000 online courses
                                    </div>
                                    <div class="trips_details_para"> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="trips">
                                <div class="trips_icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="trips_details">
                                    <div class="trips_details_header">
                                        100,000 online courses
                                    </div>
                                    <div class="trips_details_para"> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="trips">
                                <div class="trips_icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="trips_details">
                                    <div class="trips_details_header">
                                        100,000 online courses
                                    </div>
                                    <div class="trips_details_para"> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>  --}}
        <div class="our_publication_container">
            <div class="our_publication_header">
                 Our Programs
             </div>
             <div class="row">
                 <div class="col-md-6 col-xl-2">
                     
                 </div>
                 <div class="col-md-6 col-xl-4">
                     <div class="program-body program-border">
                         <div class="program-icon">
                             <i class="fas fa-book" style="color: #104c8d"></i>
                         </div>
                         <a href="{{ route('getAllBooks') }}">
                             <h1 class="text-heading" style="color: #104c8d">Books</h1>
                         </a>
                         <p>
                             You Will get all the book that need for any upcoming examination, or preparing any other entrance.
                         </p>
                         <a class="btn btn-outline-primary" href="{{ route('getAllBooks') }}">Browse Now</a>
                     </div>
                 </div> 
                 <div class="col-md-6 col-xl-4">
                     <div class="program-body">
                         <div class="program-icon">
                            <i class="fas fa-video" style="color: #104c8d"></i>
                         </div>
                         <a href="{{ route('getAllVideos') }}">
                             <h1 class="text-heading" style="color: #104c8d">Videos</h1>
                         </a>
                         <p>
                            Creating video tutorials relieves almost all of the stress that can come from introducing programs.
                         </p>
                         <a class="btn btn-outline-primary" href="{{ route('getAllVideos') }}">Browse Now</a>
                     </div>
                 </div> 
             </div>
     </div>
        {{-- <div class="our_publication_container">
            <div class="our_publication_header">
                 Our Publications
             </div>
             <div class="row">
                 @foreach ($categories as $category)
                     <div class="col-md-6 col-xl-3">
                         <a href="{{ route('category.single', $category->slug) }}">
                             <div class="publication_container">
                             <div class="book_icon">
                             <i class="{{ $category->icon ?? 'fas fa-book-open' }}"></i>
                                 </div>
                                 <div class="book_container_title">
                                 <i class="fas fa-film"></i>  {{ $category->title }}
                                 </div>
                                 <div class="book_container_text"> 
                                 </div>
                                 <div class="book_container_btn">
                                     <span>
                                         Browse Now
                                     </span>
                                 
                                 </div>
                             </div>
                         </a> 
                     </div>
                 @endforeach
             </div>
     </div> --}}
        {{-- <div class="our_publication_container">
               <div class="our_publication_header">
                    Our Publications
                </div>
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-6 col-xl-3">
                            <a href="{{ route('category.single', $category->slug) }}">
                                <div class="publication_container">
                                <div class="book_icon">
                                <i class="{{ $category->icon ?? 'fas fa-book-open' }}"></i>
                                    </div>
                                    <div class="book_container_title">
                                    <i class="fas fa-film"></i>  {{ $category->title }}
                                    </div>
                                    <div class="book_container_text"> 
                                    </div>
                                    <div class="book_container_btn">
                                        <span>
                                            Browse Now
                                        </span>
                                    
                                    </div>
                                </div>
                            </a> 
                        </div>
                    @endforeach
                </div>
        </div> --}}
        @if($freeLibrary)
        <div class="our-video-library">
            <div class="video-library-title">
                Our Library
            </div>
            <div class="video-slider container">
               <div class="row">
                @foreach ($freeLibrary as $library)
                    <div class="video-item col-md-2">
                        <div class="img-container">
                            
                            <div style="background-color: #ddd!important" class="_df_thumb" source="{{ $library->book }}"
                                tags="" thumb="{{ $library->image }}">{{ $library->title }}</div>
                        </div>
                    </div>
                @endforeach
               </div>
            </div>
        </div>
        @endif
        <div class="our_package_container">
            <div class="container">
                <div class="our_package_header">
                    Our Packages
                </div>
                
                <div class="row">
                    @foreach($packages as $package)
                    {{-- {{ dd($package) }} --}}
                    <div class="col-md-3">
                        <div class="course_container">
                            <div class="image_container">
                            <a href="{{ route('package.single', $package->slug) }}">
                                    <img class="img-fluid" src="{{ $package->image }}" alt="{{ $package->title }}">
                                </a>  
                                <div class="course_price">
                                    <div>Rs. {{ $package->offer_price }}</div>
                                    <del>Rs. {{ $package->price }}</del>
                                </div>
                            </div>
                            <div class="course_title">
                                {{ $package->title }}
                            </div>
                            <div class="course_info">
                                <ul>
                                    <li><i class="far fa-eye"></i>9662 Views</li>
                                    <li><i class="far fa-clock"></i> 6h 40min </li>
                                    <li><i class="far fa-star"></i> 4.7 Reviews</li>
                                </ul>
                            </div>
                            <div class="package-add-to-cart">
                                <a href="#" class="addtocart" data-course="{{$package->id}}"><i class="fa fa-shopping-cart">&nbsp;Add to cart</i></a>
                            </div>
                           
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="view-more">
                    <a href="{{ route('package') }}">View More</a>
                </div>
            </div>
        </div>

        <div class="news_container">
            <div class="container">
                <div class="news_header">
                    News and Events
                </div>
                <div class="row">
                    @foreach ($newsAndEvents as $item)
                        <div class="col-md-4">
                            <div class="article_container">
                                <div class="image_container">
                                <a href="{{ route('newsAndEventSlug.single', $item->slug) }}">
                                        <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->title }}">
                                    </a>  
                                </div>
                                <div class="article_title">
                                    {{ $item->title }}
                                </div>
                                <!-- <div class="article_author">
                                    <div class="image_container">
                                        <img class="img-fluid" src="img/avatar1.jpg" alt="">
                                    </div>
                                    <div>
                                        Adam Willsone
                                    </div>
                                </div> -->
                            </div>
                        </div>   
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="subscribe_us_container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-8 col-lg-7">
                    <div class="subscribe_container">
                        <div class="subscribe_header">
                            <div>
                                Join Thousand of Happy Students!
                            </div>
                            <div>
                                Subscribe our newsletter & get latest news and updation!
                            </div>
                        </div>
                        <form  class="sup_form">
                            <input class="form-control" type="email" placeholder="Your Email Address" >
                            <div class="get_started_btn">
                                <a href="">Get Started</a>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="gradient"></div>
    </div> -->
   
    <div class="app-container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="title">
                        Get all your needs in one app
                    </div>
                    <div class="subtitle">
                        Available On
                    </div>
                    <div class="button-container">
                        <a href="" class="google-btn">
                            <img src="{{ asset('assets/img/android.png') }}" class="img-fluid" alt=""> Play Store
                        </a>
                        <a href="" class="apple-btn">
                            <img src="{{ asset('assets/img/apple.png') }}" class="img-fluid" alt=""> App Store
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="img-container">
                        <img src="{{ asset('assets/img/app.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var option_button_pdf = {
            source:'http://www.yoursite.com/someplace/pdf-to-be-loaded.pdf',
            webgl:true,
            height:500
            //we recommend using default auto height
        };
    </script>
    
    
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
            var type = 'package';
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
    </script>
    
@endpush

