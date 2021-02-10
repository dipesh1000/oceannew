@extends('frontend.layouts.app')
@section('content')
<div id="dashboard_page">
    <div class="row no-gutters">
        @include('userdashboard.partials.side-nav')
        <div class="col-md-8 col-lg-9">
            @include('userdashboard.partials.breadcum')
            <div class="course_container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="profile-content">
                      <div class="profile-image">
                        <img src="{{ $users->image ?? '' }}" />
                      </div>
                      <div class="profile-name">{{ $users->first_name }} {{ $users->last_name }}</div>
                      <div class="profile-address">{{ $users->address ?? '' }}</div>
                      <div class="edit-profile"><a href="{{ route('userProfileEdit', $users->id) }}">Edit Profile</a></div>
                      <div class="person-profile-detail">
                        <div class="profile-element">
                          <div class="profile-element-first">   
                            <strong>Name:&nbsp;</strong>
                          </div>
                          <div class="profile-element-value">
                            {{ $users->first_name }} {{ $users->last_name }}
                          </div>
                        </div>
                        <div class="profile-element">
                          <div class="profile-element-first">
                            <strong>Email ID:&nbsp;</strong>
                          </div>
                          <div class="profile-element-value">{{ $users->email}}</div>
                        </div>
                        <div class="profile-element">
                          <div class="profile-element-first">
                            <strong>Mobile number:&nbsp;</strong>
                          </div>
                          <div class="profile-element-value">{{ $users->phone ?? ''}}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection