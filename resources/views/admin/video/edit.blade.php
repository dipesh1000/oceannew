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
                @include('admin.partials.breadcrumbs', ['type'=>'edit', 'label'=>'Video', 'route'=>'video'])
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            {!! Form::open(['url'=>route('admin.video.update'), 'enctype'=>'multipart/form-data']) !!}
                            <input type="hidden" name="video_id" value="{{ $video->id }}">
                            @include('admin.video.CommonFile.form')
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
            @if(isset($video->image) )
    var importedBaseImage = "{{ asset($video->image) }}"
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
    $(document).ready(function(){
        // File upload via Ajax
        $("#videoUploadButton").on('click', function(e){
            e.preventDefault();
            $videotitle = $('#videotitle').val();

            if($videotitle == ""){
                alert("Enter Video Title First!!!");
                return false;
            }
            var formData = new FormData();
            formData.append("file", jQuery("#videofile")[0].files[0]);
            formData.append("title", $videotitle);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(Math.round(percentComplete)+'%');
                            if(Math.round(percentComplete == 100)){
                                $(".progress-bar").html('Completed');
                                $(".progress-bar").addClass('bg-primary');
                            }
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: '{{ route('admin.video.upload') }}',
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $("#videoUploadButton").hide();
                    $('#media-id').attr("placeholder", 'Loading...');
                    $(".progress-bar").width('0%');
                },
                error:function(){
                    $("#videoUploadButton").show();
                    $('#media-id').attr("placeholder", 'Video ID...');
                    $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                },
                success: function(resp){
                    $("#videoUploadButton").show();
                    if(resp['status'] == 'success'){
                        $('#media-id').val(resp['videokey']);
                        jwplayerKey(resp['videokey']);
                        $(".progress-bar").html('Video Successfully Upload.');
                        $('#uploadForm')[0].reset();
                    }else if(resp['status'] == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                    }
                }
            });
        });


        $("#fileInput").change(function(){
            var allowedTypes = ['video/mp4', 'video/WebM'];
            var file = this.files[0];
            var fileType = file.type;
            if(!allowedTypes.includes(fileType)){
                alert('Please select a valid file (mp4/WebM).');
                $("#fileInput").val('');
                return false;
            }
        });
    });
</script>


<script>
    function generateRandomInteger() {
        return Math.floor(Math.random() * 90000) + 10000;
    }
    jQuery(document).on('click', '.btn-delete-videocontent', function (e) {
        e.preventDefault();

        var $this = $(this);

        var additional = $this.attr('data-videocontent');

        if (!additional) {
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
            url: "{{ route('admin.video.videocontent.delete')  }}",
            data: {
                additional: additional
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
                //
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
