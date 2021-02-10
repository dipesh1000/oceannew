@extends('frontend.layouts.app')
@section('content')
<div id="dashboard_page">
    <div class="row no-gutters">
        @include('userdashboard.partials.side-nav')
        <div class="col-md-8 col-lg-9">
            @include('userdashboard.partials.breadcum')
            
            <div class="course_container">
                <div class="row">
                    <div class="col-lg-8">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            </div>
                        @endif
                        <div class="profile-edit">
                        <form action="{{ route('updateProfile', $users->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" value="{{ $users->first_name ?? '' }}" name="first_name" id="firstname" placeholder="Enter First Name">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" value="{{ $users->last_name ?? ''}}" name="last_name" id="lastname" placeholder="Enter Last Name">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ $users->email ?? ''}}" name="email" id="email" placeholder="Enter Email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" value="{{ $users->phone ?? ''}}" name="phone" id="phone" placeholder="Enter phone">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" value="{{ $users->address ?? ''}}" name="address" id="address" placeholder="Enter Address">
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="file">Image</label>
                                    <img src="{{ $users->image ?? ''}}" class="rounded mx-auto d-block" width="100px" alt="...">
                                    <input type="file" class="form-control" name="image" id="file" placeholder="Enter phone">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-4 control-label">New Password</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="new_password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                                    </div>  
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-outline-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="notification_container">
                            <div class="n_header">
                                Information
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a>
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Full Name
                                    </div>
                                    <div>
                                        {{ $users->first_name }} {{ $users->last_name }}
                                    </div>
    
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a>
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Email
                                    </div>
                                    <div>
                                        {{ $users->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a>
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Phone
                                    </div>
                                    <div>
                                        {{ $users->phone }}
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a>
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a>
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
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