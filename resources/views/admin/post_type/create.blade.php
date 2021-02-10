@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/editors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Post Type</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.post_type.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <label for="t-text" class="sr-only">Post Type Title</label>
                                            <input id="post_type_title" value="{{ old('title') }}" type="text" name="title" placeholder="Post Type Title..." class="form-control" required>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p>Post Type Icon</p>
                                                    <label for="t-text" class="sr-only">Post Type Icon</label>
                                                    <input  value="{{ old('icon') }}" id="t-text" type="text" name="icon" placeholder="Post Type Icon..." class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p>Position</p>
                                                    <label for="t-text" class="sr-only">Post Type Position</label>
                                                    <input  value="{{ old('position') }}" id="t-text" type="number" name="position" placeholder="Post Type Position..." class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p> Status</p>
                                            <label for="t-text" class="sr-only">Status</label>
                                            <select class="form-control  basic" name="status">
                                                <option value="Active">Active</option>
                                                <option value="InActive">InActive</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <p> Has Archive?</p>
                                                    <label class="switch s-icons s-outline  s-outline-danger  mb-4 mr-2">
                                                        <input name="archive" type="checkbox" checked>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <p> Has Feature Image? </p>
                                                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                        <input name="feature_image" type="checkbox" checked>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <p> Has Editor? </p>
                                                    <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                                        <input name="editor" type="checkbox" checked>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <p> Description</p>
                                   <textarea name="description">{{ old('description') }}</textarea>
                                </div>


                                <input type="submit" name="txt" class="mt-4 btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




@endsection

@push('scripts')
<script src="{{ asset('cork/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('cork/plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('cork/plugins/editors/quill/quill.js') }}"></script>
<script src="{{ asset('cork/plugins/editors/quill/custom-quill.js') }}"></script>
<script src="https://cdn.jwplayer.com/libraries/IDzF9Zmk.js"></script>






@endpush
