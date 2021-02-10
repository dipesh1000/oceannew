@extends('frontend.layouts.app')
@section('content')
<div id="packages_page">
    <div class="our_package_container">
        <div class="container">
            <div class="our_package_header">
                Please Select
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="course_container">
                        <div class="image_container">
                            <a href="{{ route('getAllBooks') }}">
                                <img class="img-fluid" src="{{ asset('assets/img/books.png') }}" alt="" style="height: 232px">
                            </a>  
                            <!-- <div class="course_price">
                                Rs 600
                            </div> -->
                        </div>
                        <a href="{{ route('getAllBooks') }}">
                            <div class="course_title">
                                Books
                            </div>
                        </a>
                        <!-- <div class="course_info">
                            <ul>
                                <li><i class="far fa-eye"></i>9662 Views</li>
                                <li><i class="far fa-clock"></i> 6h 40min </li>
                                <li><i class="far fa-star"></i> 4.7 Reviews</li>
                            </ul>
                        </div>
                        -->
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="course_container">
                        <div class="image_container">
                        <a href="{{ route('getAllVideos') }}">
                                <img class="img-fluid" src="{{ asset('assets/img/videos.png') }}" alt="" style="height: 232px">
                            </a>  
                            <!-- <div class="course_price">
                                Rs 600
                            </div> -->
                        </div>
                    <a href="{{ route('getAllVideos') }}">
                            <div class="course_title">
                                Videos
                            </div>
                        </a>
                        <!-- <div class="course_info">
                            <ul>
                                <li><i class="far fa-eye"></i>9662 Views</li>
                                <li><i class="far fa-clock"></i> 6h 40min </li>
                                <li><i class="far fa-star"></i> 4.7 Reviews</li>
                            </ul>
                        </div> -->
                       
                    </div>
                </div>   
            </div>
           
        </div>
    </div>
  </div>
@endsection