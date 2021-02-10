@extends('frontend.layouts.app')
@section('content')
<div id="packages_page">
    <div class="our_package_container">
        <div class="container">
            <div class="our_package_header">
                Our Packages
            </div>
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-md-3">
                        <div class="course_container">
                            <div class="image_container">
                                <a href="{{ route('package.single', $package->slug) }}">
                                <img class="img-fluid" src="{{ $package->image }}" alt="{{ $package->title }}">
                                </a>  
                                <div class="course_price">
                                    <div>Rs.{{ $package->offer_price }}</div>
                                    <del>Rs.{{ $package->price }}</del>
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
                        
                        </div>

                    </div>
                @endforeach
            </div>
           
        </div>
    </div>
  </div>
@endsection