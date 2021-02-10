@extends('frontend.layouts.app')
@section('content')
<div id="register_page">
    <div class="signin_up_container">
        @if(Sentinel::check())
        <form method="POST" action="{{ route('logout')  }}" id="form-submit">
            {{ csrf_field() }}
            <a onclick="document.getElementById('form-submit').submit()">Logout</a>
        </form>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="register_container">
                       <div class="register-header">
                          Have an account , Login!
                       </div>
                       <div class="register-btn">
                       <a href="{{ route('login') }}">Login Now !</a>
                       </div>
                   </div>
                </div>
                <div class="col-lg-6">
                    <div class="signin_container">
                        <div class="sign_header">
                            Register
                        </div>
                        <form action="{{ route('post.register') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name">
                                <small class="text-danger alert-message">{{ $errors->first('first_name') }}</small>
                            </div>
                             <div class="form-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                                <small class="text-danger alert-message">{{ $errors->first('last_name') }}</small>
                             </div>
                             <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <small class="text-danger alert-message">{{ $errors->first('email') }}</small>
                             </div>
                             <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                                <small class="text-danger alert-message">{{ $errors->first('phone') }}</small>
                             </div>
                            {{-- <div class="form-group">
                               <input type="text" class="form-control" placeholder="Username">
                            </div> --}}
                            <div class="form-group">
                               <input type="password" name="password" class="form-control" placeholder="*********">
                               <small class="text-danger alert-message">{{ $errors->first('password') }}</small>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="*********">
                             </div>
                            <div class="form-group ">
                                <button type="submit" class="btn signin">Register</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  </div>
    
@endsection
