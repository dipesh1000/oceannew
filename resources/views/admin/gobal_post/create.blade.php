@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/editors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="statbox widget box box-shadow mb-3">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add New {{ $postType->title }}</h4>

                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area text-center">

                        <div class="row">
                            <div class="col-sm-6">
                                <nav class="breadcrumb-two" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><a href="{{ route('admin.post', $postType->slug) }}">{{ $postType->title }}</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Create</a></li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('admin.post', $postType->slug) }}" class="btn btn-sm btn-success float-right">Back to {{ $postType->title }} List</a>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.post.store', $postType->slug) }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <label for="t-text" class="sr-only">{{ $postType->title }} Title</label>
                                            <input id="post_title" value="{{ old('title') }}" type="text" name="title" placeholder="{{ $postType->title }} Title..." class="form-control" required>
                                        </div>


                                     {{returnField($postType, 'after_title')}}

                                        @if($postType->editor == 1)
                                            <div class="form-group">
                                                <p> Description</p>
                                                <textarea name="description">{{ old('description') }}</textarea>
                                            </div>
                                        @endif
                                        {{returnField($postType, 'after_content')}}
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
                                        {{returnField($postType, 'sidebar')}}
                                        @if($postType->feature_image == 1)
                                        <div class="form-group mt-3">
                                            <p>Feature Image</p>
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Clear <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>


                                        @endif


                                        <input type="submit" name="txt" class="mt-4 btn btn-primary float-right">
                                    </div>
                                </div>

                                <hr>
                                @if($postType->feature_image == 1)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p>Image Alt Text</p>
                                            <label for="t-text" class="sr-only">Image Alt Text</label>
                                            <input id="alt_txt" value="{{ old('img_alt') }}" type="text" name="img_alt" placeholder="Image Alt Text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p>Image Title</p>
                                            <label for="t-text" class="sr-only">Image Title</label>
                                            <input id="img_title" value="{{ old('img_title') }}" type="text" name="img_title" placeholder="Image Title" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    @endif

                                <div class="form-group">
                                    <p>Meta Keywords Or Tags</p>
                                    <label for="t-text" class="sr-only">Meta Keywords Or Tags</label>
                                    <select class="form-control tagging" multiple="multiple" name="meta_keyword[]">
                                        @foreach($keywords as $keyword)
                                        <option value="{{ $keyword }}">{{ $keyword }}</option>
                                       @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <p>Meta Description</p>
                                    <textarea name="meta_description">{{ old('meta_description') }}</textarea>
                                </div>
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
<script src="{{ asset('cork/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
<script src="{{ asset('cork/plugins/editors/quill/quill.js') }}"></script>
<script src="{{ asset('cork/plugins/editors/quill/custom-quill.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src="https://cdn.jwplayer.com/libraries/IDzF9Zmk.js"></script>

<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage')
</script>

<script>
    $('.repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'label': 'Red',
            'name': 'red'
        },
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        ready: function (setIndexes) {
        },
    });
</script>

<script>
    $("input[type='file']").on("change", function () {

        fileSize = $(this).attr('file-size');
       if(fileSize){
           if(this.files[0].size > parseInt(fileSize) * 1000000) {
               alert("Please upload file size max  "+ fileSize +"MB. Thanks!!");
               $(this).val('');
           }
       }
    });
</script>
<script>
    $(document).ready(function() {
        $(".true_false").click(function() {
            var thisitem = $(this);
            if (thisitem.is(":checked")) {
                thisitem.val(1);
            } else {
                thisitem.val(0);
            }
        });
    });

    $(".tagging").select2({
        tags: true
    });
</script>

<script>
    $(document).on("keyup", "#post_title" , function() {
        var post_title = $(this).val();
        $('#alt_txt').val(post_title);
        $('#img_title').val(post_title);

    });
</script>

@endpush
