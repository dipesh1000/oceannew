@extends('frontend.layouts.app')
@section('content')
<div id="cart_page">
    <div class="bread_container">
      <ul class="bread">
        <li>
          <a href=""><i class="fa fa-home"></i> Home &gt;</a>
        </li>
        <li><a href="">Cart</a></li>
      </ul>
    </div>
    <div class="cart-section">
      <div class="cart-savedcourses-content">
        @php
            $total = 0;
            $totalWithDiscount = 0;
        @endphp
        @if (Cart::instance('default')->count())
        <div class="row">
          <div class="col-lg-9 order-lg-1 order-md-12 order-sm-12 order-2">
            @foreach ($courses as $cartContent)
                    @php
                        $total += $cartContent->offer_price;
                        $totalWithDiscount += $cartContent->price;
                    @endphp
            <div class="cart-saved-courses-list">
              <div class="row">
                <div class="col-lg-2">
                  <div class="cart-course-image">
                    <img src="{{ $cartContent->image }}" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="cart-course-details">
                    <div class="cart-course-title">
                      <a href="{{ route('book.single', $cartContent->slug) }}">
                        <strong>{{ $cartContent->title }}</strong>
                      </a>
                    </div>
                    <div class="cart-course-subtitle">
                      {!! substr(strip_tags($cartContent->description), 0 , 200) !!}
                    </div>
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="cart-course-add-remove">
                    <button class="cart-add-to-cart-button remove-from-cart" data-id="{{ $cartContent->cartId }}">
                      Remove
                    </button>
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="cart-course-price">
                    <strong>Rs. {{ $cartContent->offer_price }}</strong>
                    <div><s>Rs. {{ $cartContent->price }}</s></div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-lg-3 order-lg-12 order-md-1 order-sm-1 order-1">
            <div class="cart-total-checkout-price-section">
              <strong>Total Amount</strong>
              <p class="cart-total-price">Rs. {{ $total }} /-</p>
              <p><del>Rs.{{ $totalWithDiscount }}</del></p>
              {{-- <form action="{{ route('checkout.page')  }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ttlPrice" value="{{ $total }}">
                <button class="cart-checkout-button checkout" data-total="{{ $total }}">Checkout</button>
              </form> --}}
              <a href="{{ route('checkout.page')  }}" class="btn cart-checkout-button checkout">Checkout</a>
            </div>
          </div>
        </div>
        @else 
          <h1>No Product Found in Your Cart!</h1>
          <p>Select  <a href="{{ route('categoryType') }}" class="btn btn-outline-primary"> Visit Interested Courses </a>  Form here!!!</p>
        @endif
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  
@endpush