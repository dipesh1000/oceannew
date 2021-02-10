@extends('frontend.layouts.app')
@section('content')
<style>
     .wrapper-template {
     background-position: center;
     /* background-color: #eee; */
     background-repeat: no-repeat;
     background-size: cover;
     color: #505050;
     font-family: "Rubik", Helvetica, Arial, sans-serif;
     font-size: 14px;
     font-weight: normal;
     line-height: 1.5;
     text-transform: none
 }

 .forgot {
     background-color: #fff;
     padding: 12px;
     border: 1px solid #dfdfdf
 }

 .padding-bottom-3x {
     padding-bottom: 72px !important
 }

 .card-footer {
     background-color: #fff
 }

 .btn {
     font-size: 13px
 }

 .form-control:focus {
     color: #495057;
     background-color: #fff;
     border-color: #76b7e9;
     outline: 0;
     box-shadow: 0 0 0 0px #28a745
 }
</style>
<div style="margin-top: 142px; margin-bottom: 50px" class="wrapper-template">
    <div class="container padding-bottom-3x mb-2 mt-5">
	    <div class="row justify-content-center">
	        <div class="col-lg-8 col-md-10">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
	            <div class="forgot">
	                <h2>Forgot your password?</h2>
	                <p>Change your password in three easy steps. This will help you to secure your password!</p>
	                <ol class="list-unstyled">
	                    <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
	                    <li><span class="text-primary text-medium">2. </span>Our system will send you a temporary link</li>
	                    <li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
	                </ol>
	            </div>
                <form class="card mt-4" method="post" action="{{ url('/reset-password') }}">
                    {{ csrf_field() }}
	                <div class="card-body">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group"> 
                            <label for="email">Enter your email address</label> 
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" required>
                            <small class="form-text text-muted">Enter the email address you used during the registration. Then we'll email a link to this address.</small> 
                        </div>
                        <div class="form-group"> 
                            <label for="password">Enter your new password</label> 
                            <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password" required>
                        </div>
                        <div class="form-group"> 
                            <label for="password_confirmation">Enter confirm password</label> 
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="text" name="password_confirmation" id="cpassword" required>
                        </div>
                    </div>
                    <div class="card-footer"> 
                        <button class="btn btn-success" type="submit">Update New Password</button> 
                        <a href="{{ route('login') }}" class="btn" style="background: linear-gradient(
                            45deg
                            , #1d56a2, #008fd5);
                                color: #fff">Back to Login
                        </a> 
                    </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
@endsection
{{-- @push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pwstrength.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
        "use strict";
        var options = {
        minChar: 8,
        bootstrap3: false,
        errorMessages: {
            password_too_short: "<font color='red'>The Password is too short</font>",
            same_as_username: "Your password cannot be the same as your username"
        },
        scores: [17, 26, 40, 50],
        verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
        showVerdicts: true,
        showVerdictsInitially: false,
        raisePower: 1.4,
        usernameField: "#username",
        };
        $(':password').pwstrength(options);
        });
        </script>
@endpush --}}