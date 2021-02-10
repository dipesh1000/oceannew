@extends('frontend.layouts.app')
@section('content')
<div class="container" style="margin: 100px auto 30px;">
    <div class="row">
        <div class="col mt-5">
            <div class="card">
                <div class="card-group">
                    <div class="card-body">
                    @if(session('success_message'))
                    <div class="alert alert-success">
                        {{session('success_message')}}
                    </div>
                    @endif
                    @if(session('failure_message'))
                    <div class="alert alert-danger">
                        {{session('failure_message')}}
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection