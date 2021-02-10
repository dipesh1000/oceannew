<footer>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="footer_box footer_address">
                <div class = footer_logo>
                <a href="{{ URL::to('/') }}"><img src="{{ asset(getSiteSetting('logo') ?? '') }}" alt="{{ getSiteSetting('site_Description') ?? '' }}"></a>
                </div>
                <div>
                    {{ getSiteSetting('address') ?? '' }}
                </div>
                <div>
                    {{ getSiteSetting('secondary_phone') ?? '' }}
                </div>
                <div>
                    {{ getSiteSetting('secondary_email') ?? '' }}
                </div>
            </div>
            
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="footer_box">
                <div class="footer_header">
                    Navigation
                </div>
                <div>
                    <ul class="footer_list">
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="">FAQs Page</a></li>
                        <li><a href="">Checkout</a></li>
                        <li><a href="{{ route('getContact') }}">Contact</a></li>
                        <li><a href="">Blog</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="col-md-3 col-lg-2">
            <div class="footer_box">
                <div class="footer_header">
                    Categories
                </div>
                <div>
                    <ul class="footer_list">
                        <li><a href="">School</a></li>
                        <li><a href="">College</a></li>
                        <li><a href="">University</a></li>
                        <li><a href="">References</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-2" >
            <div class = "footer_box">
                <div class="footer_header">
                    Help & Support
                </div>
                <div>
                    <ul class="footer_list" >
                        <li> <a href="">Documentation</a></li>
                        <li><a href="">Live Chart</a></li>
                        <li><a href="">Mail Us</a><li>
                        <li><a href="">Privacy</a> </li>
                        <li><a href="">Faqs</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ccol-md-12 col-lg-3">
            <div class = "footer_box">
                <div class="footer_header">
                    Download Apps
                </div>
                <div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="footer_copyright">

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <strong>&copy; 2020 Ocean Publication</strong>  Developed by <a href="http://an4soft.com">An4soft</a> 
            </div>
            <div class="col-md-6">
                <div class="mobile_links">
                    <ul >
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-pinterest"></i></i></a></li>
                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="" class="backtop">
    <i class="fas fa-arrow-up"></i>
</a>
</footer>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script src="{{ asset('assets/dflip/js/dflip.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/toastr/toastr.min.js') }}" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.min.js"></script>
    {!! Toastr::message() !!}    

    <script>
         $(".slider-wrapper").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            cssEase: "ease-out",
        });
</script>

@include('frontend.cart.removeCartScript')

  