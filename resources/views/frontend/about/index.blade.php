@extends('frontend.layouts.app')
@section('content')
<div id="about_page">
    <div class="about_content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="about-title">
                        About Us
                    </div>
                    <div class="about-content">
                        {!! getSiteSetting('about') ?? '' !!}
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
  </div>
@endsection