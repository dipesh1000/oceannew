@extends('frontend.layouts.app')
@section('content')
<style>
    .our_package_container{
        padding : 40px 0 !important;
    }
    #cart_page{
        padding: 5px !important;
    }
    .custom-package-title{
        line-height: 1.5em;
        height: 3em;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-body-custom{
        padding:2px;
    }
    .esewa-container{
        border: 1px solid green;
    }
    .esewa-container .esewa-pay-button{
        margin: 5px;
        pointer:cursor;
        height:32px; 
        width:auto;
    }
</style>
<div id="packages_page">
    <div class="our_package_container">
        <div class="container">
            @php
                $totalPrice = 0;
                $invoice_no = date("Ymd").time();
            @endphp
            <div id="cart_page">
            <div class="bread_container">
              <ul class="bread">
                <li>
                  <a href="/"><i class="fa fa-home"></i> Home &gt;</a>
                </li>
                <li><a href="/cart">Cart</a>&gt;</li>
                <li><a href="#">Checkout</a></li>
              </ul>
            </div>
            </div>
            
            <div class="row">
                <div class="col-md-8 mt-5">
                    <div class="row">
                        @foreach ($courses as $course)
                        @php
                            $totalPrice += $course->offer_price
                        @endphp
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ $course->image }}" alt="product1">
                                <div class="card-group">
                                    <div class="card-body-custom">
                                        <div class="custom-package-title" title="{{ $course->title }}">
                                            {{ $course->title }}
                                        </div>
                                            <!--<p class="card-text text-muted">{!! substr(strip_tags($course->description), 0 , 100) !!}</p>-->
                                        <h4 class="card-text text-center">
                                            <span class="badge badge-success"><sup>Rs.</sup>{{ $course->offer_price }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <h3 class="p-2 text-center">Order Summary:</h3>
                        <div class="card-body">
                            <span>Grand Total :</span>
                            <span class="float-right">{{$totalPrice}}</span>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="p-2 text-center"> Pay With :</h3>
                        <div class="card-group">
                            <div class="card-body">
                                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                    <input value="{{ $totalPrice }}" name="tAmt" type="hidden">
                                    <input value="{{ $totalPrice }}" name="amt" type="hidden">
                                    <input value="0" name="txAmt" type="hidden">
                                    <input value="0" name="psc" type="hidden">
                                    <input value="0" name="pdc" type="hidden">
                                    <input value="epay_payment" name="scd" type="hidden">
                                    <input value="{{ $invoice_no }}" name="pid" type="hidden">
                                    <input value="{{ URL::to('/esewa/success') }}" type="hidden" name="su">
                                    <input value="{{ URL::to('/esewa/failure') }}" type="hidden" name="fu">
                                    <div class="text-center esewa-container">
                                        <input class="esewa-pay-button" src="{{ asset('assets/esewa.png') }}" 
                                            type="image" alt="Pay with Esewa" >
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    
@endpush