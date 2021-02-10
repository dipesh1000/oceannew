@extends('frontend.layouts.app')
@section('content')
<div id="single_page">
    <div class="detail_header_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="image_container">
                        <img class="img-fluid" src="{{ $newsAndEvent->image }}" alt="{{ $newsAndEvent->title }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="course_detail_container">
                        <div class="review">
                            <i class="far fa-clock"></i> <span>{{ date('d-m-Y', strtotime($newsAndEvent->created_at)) }}</span> 
                        </div>
                        <div class="header header-line">
                            {{ $newsAndEvent->title }}
                        </div>
                        <div class="description">
                            {!! $newsAndEvent->post_content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection