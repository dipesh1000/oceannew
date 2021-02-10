@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/editors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div id="breadcrumbArrowed" class="col-xl-12 col-lg-12 layout-top-spacing mb-3">
                @include('admin.partials.breadcrumbs', ['type'=>'create', 'label'=>'Book', 'route'=>'book'])
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            {!! Form::open(['url'=>route('admin.book.store'), 'enctype'=>'multipart/form-data']) !!}
                            @include('admin.book.CommonFile.form')
                            {{Form::submit('Submit',['class'=>'mt-4 btn btn-primary'])}}
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
<script src="{{ asset('cork/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="https://cdn.jwplayer.com/libraries/IDzF9Zmk.js"></script>

<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage')
</script>

<script>
    jQuery(document).on('change', '#book_type', function (e) {
        var getValue = $(this).val();
        if(getValue == "HardCopy"){
            $('#bookfile').attr('required', false);
            $('#bookfile').siblings('p').children('span').text('');
            $('#stock_quantity').attr('required', true);
            $('#stock_quantity').siblings('p').children('span').text('*');
        }else if(getValue == "Both"){
            $('#bookfile').attr('required', true);
            $('#bookfile').siblings('p').children('span').text('*');
            $('#stock_quantity').attr('required', true);
            $('#stock_quantity').siblings('p').children('span').text('*');
        } else {
            $('#bookfile').attr('required', true);
            $('#stock_quantity').attr('required', false);
        }
    });
</script>



@endpush
