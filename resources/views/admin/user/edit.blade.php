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
            <div id="breadcrumbArrowed" class="col-xl-12 col-lg-12 layout-top-spacing mb-3">
                @include('admin.partials.breadcrumbs', ['type'=>'edit', 'label'=>'User', 'route'=>'user'])
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            {!! Form::open(['url'=>route('admin.user.update'), 'enctype'=>'multipart/form-data']) !!}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            @include('admin.user.CommonFile.form')
                            {{Form::submit('Update',['class'=>'mt-4 btn btn-primary'])}}
                            {!! Form::close() !!}
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


<script>
    //First upload .
            @if(isset($user->image) )
    var importedBaseImage = "{{ asset($user->image) }}"
    var firstUpload = new FileUploadWithPreview('myFirstImage', {
        images: {
            baseImage: importedBaseImage,
        },
    })
            @else
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    @endif
</script>

<script>
    $(document).ready(function() {
        var getValue =  $("#book_type :selected").val();
        checkBookType(getValue);
    });
    jQuery(document).on('change', '#book_type', function (e) {
        var getValue = $(this).val();
        checkBookType(getValue);
    });

    function checkBookType(getValue) {
        if(getValue == "HardCopy"){
            $('#bookfile').siblings('p').children('span').text('');
            $('#stock_quantity').attr('required', true);
            $('#stock_quantity').siblings('p').children('span').text('*');
        }else if(getValue == "Both"){
            $('#bookfile').siblings('p').children('span').text('*');
            $('#stock_quantity').attr('required', true);
            $('#stock_quantity').siblings('p').children('span').text('*');
        } else {
            $('#stock_quantity').attr('required', false);
        }
    }
</script>



@endpush
