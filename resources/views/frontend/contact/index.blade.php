@extends('frontend.layouts.app')
@section('content')
<div id="contact_page">
    <div class="contactus_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif
                    @if(session('success'))
                        <h1>{{session('success')}}</h1>
                    @endif
                    <div class="contact_title">
                        Contact Form
                    </div>
                    <div class="contact_container contact-margin">
                        <form method="post" action="{{ route('storeContact') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                               <label for="Name">Name</label>
                               <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                               <label for="email">Email</label>
                               <input type="email"  name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                             </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                             </div>
                             <div class="form-group">
                                <label for="message">Message</label>
                                <!-- <textarea  class="form-control" >Messag</textarea> -->
                                <textarea name="message" class="form-control textarea"></textarea>
                             </div>
                            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Captcha</label>
                                <div class="col-md-6 pull-center">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn submit">Submit Request</button>
                            </div>
                            
                        </form>
                    </div>
                    {!! NoCaptcha::renderJs() !!}
                </div>
                <div class="col-lg-4">
                   <div class="contact_container">
                    <div class="contact_header">
                        Reach Us
                    </div>
                    <div class="reachus_container">
                        <div class="reachus_title">
                            Get In Touch
                        </div>
                        <div class="address">
                            {{ getSiteSetting('site_Description') ?? '' }}
                        </div>
                        <div class="reachus_title">
                            Reach Us
                        </div>
                        <div class="address">
                            {{ getSiteSetting('address') ?? '' }}
                        </div>
                        <div class="reachus_title">
                            Drop a Mail
                        </div>
                        <div class="address">
                            <div>
                                {{ getSiteSetting('primary_email') ?? '' }}
                            </div>
                            <div>
                                {{ getSiteSetting('secondary_email') ?? '' }}
                            </div>
                        </div>
                        <div class="reachus_title">
                            Call Us
                        </div>
                        <div class="address">
                            <div>
                                {{ getSiteSetting('primary_phone') ?? '' }}
                            </div>
                            <div>
                                {{ getSiteSetting('secondary_phone') ?? '' }}
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