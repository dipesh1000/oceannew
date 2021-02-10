@extends('frontend.layouts.app')
@section('content')
<div id="register_page">
    <div class="signin_up_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                   <div class="register_container">
                       <div class="register-header">
                           Don't have an account , Create one!
                       </div>
                       <div class="register-btn">
                       <a href="{{ route('register') }}">Register Now !</a>
                       </div>
                   </div>
                </div>
                <div class="col-lg-6">
                     <div class="signin_container">
                        <div class="sign_header">
                            Log in
                        </div>
                        <form action="{{ route('post.login') }}" method="POST">
                            {{ csrf_field() }}
                            @include('auth.flash')
                            <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" value="{{ old('email') }}" name="email" class="form-control" placeholder="Username">
                            <small class="text-danger alert-message">{{ $errors->first('email') }}</small>
                            <div class="form-group">
                               <label for="">Password</label>
                               <input type="password" name="password" class="form-control" placeholder="*********">
                            </div>
                            <input type="hidden" name="prev_route" value="{{ session('prev-route') ?? ''}}">
                            <div class="form-group ">
                                <button type="submit" class="btn signin">Signin</button>
                            </div>
                            
        
                        </form>
                        <div class="social-login">
                            <ul>
                                <li>
                                    <input type="checkbox">
                                    <label for="">Save Password</label>
                                </li>
                                <li class="forget_password">
                                   <a href="{{ URL::to('forgot-password') }}">Forget Password?</a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection