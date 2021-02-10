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
                @include('admin.partials.breadcrumbs', ['type'=>'edit', 'label'=>'Package', 'route'=>'package'])
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            {!! Form::open(['url'=>route('admin.package.update'), 'enctype'=>'multipart/form-data']) !!}
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            @include('admin.package.CommonFile.form')
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
            @if(isset($package->image) )
    var importedBaseImage = "{{ asset($package->image) }}"
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
    function generateRandomInteger() {
        return Math.floor(Math.random() * 90000) + 10000;
    }
    $(document).on("change", "#package_type", function (e) {
        e.preventDefault();
        var package_type = $(this).val();
        var category_id = $("#category_id :selected").val();
        getPackgeItem(category_id, package_type)
    });

    $(document).on("change", "#category_id", function (e) {
        e.preventDefault();
        var category_id = $(this).val();
        var package_type = $("#package_type :selected").val();
        getPackgeItem(category_id, package_type)
    });

    function getPackgeItem(category_id, package_type) {
        var category_id = category_id;
        var package_type = package_type;
        var bookids = $(".bookids").map(function(){return $(this).val();}).get();
        var videoids = $(".videoids").map(function(){return $(this).val();}).get();


        if(category_id && package_type){
            $.ajax({
                type: "GET",
                url: "{{ route('admin.package.item')  }}",
                data: {
                    category_id: category_id,
                    package_type: package_type,
                    videoids: videoids,
                    bookids: bookids,
                },
                beforeSend: function (data) {

                },
                success: function (data) {
                    $('#package-item table tbody').append(data);


                },
                error: function (xhr, ajaxOptions, thrownError) {

                },
            });
        }
    }


</script>

<script>
    jQuery(document).on('click', '.delete-item', function (e) {
        e.preventDefault();

        var $this = $(this);

        var itemid = $this.attr('data-id');

        if (!itemid) {
            $this.closest("tr").remove();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.package.item.delete')  }}",
            data: {
                itemid: itemid
            },
            beforeSend: function () {
                $this.prop('disabled', true);
            },
            success: function (data) {
                if(data['status'] == "success"){
                    $this.closest("tr").remove();
                }else {
                    alert("Error!!!.Refresh Your Page.")
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                $this.prop('disabled', false);
            },
            complete: function () {
                $this.prop('disabled', false);
            }
        });
    });

    jQuery(document).on('click', '.btn-add-videocontent', function (e) {
        e.preventDefault();
        console.log('tgd');
        var lastRow = $('table.table-videocontent > tbody > tr').last().attr('data-row');
        var counter = lastRow ? parseInt(lastRow) + 1 : 1;
        var randomInteger = generateRandomInteger();
        var newRow = jQuery('<tr data-row="' + counter + '">' +
            '<td>' + counter + '</td>' +
            '<td><input type="text" name="videocontent[key][' + randomInteger + ']" class="form-control" required/></td>' +
            '<td><input type="text" name="videocontent[value][' + randomInteger + ']" class="form-control" required/></td>' +
            '<td><button type="button" class="btn badge badge-dark btn-sm btn-delete-videocontent" data-specification="">Remove</button></td>' +
            '</tr>');
        jQuery('table.table-videocontent').append(newRow);

    });
</script>


@endpush
