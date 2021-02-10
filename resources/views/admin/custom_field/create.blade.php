@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/editors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Custom Field</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.custom_field.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <label for="t-text" class="sr-only">Custom Field Title</label>
                                            <input id="custom_field_title" value="{{ old('title') }}" type="text" name="title" placeholder="Custom Field Title..." class="form-control" required>
                                        </div>

                                        <hr>
                                        <h2>Add Feilds</h2>


                                        <div class="repeated_table">


                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <p>Field Type</p>
                                                    <label for="t-text" class="sr-only">Field Label</label>
                                                    <select class="form-control" id="field_type">
                                                        <option value="text">Text</option>
                                                        <option value="text_area">Text Area</option>
                                                        <option value="number">Number</option>
                                                        <option value="image">Image</option>
                                                        <option value="file">File</option>
                                                        <option value="select">Select</option>
                                                        <option value="checkbox">Checkbox</option>
                                                        <option value="true_false">True/False</option>
                                                        <option value="date">Date</option>
                                                        <option value="repeater">Repeater</option>
                                                        <option value="post_type">Post Type</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="hidden" id="field_count" name="field_count" value="1">
                                                <button type="button" class="mt-4 btn btn-primary mt-5" id="add_new_field">Add Field</button>
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
                                        <div class="form-group">
                                            <p> Select Post Type</p>
                                            <label for="t-text" class="sr-only">Select Post Type</label>
                                            <select class="form-control  basic" name="post_type">
                                                @foreach($postTypes as $postTypes)
                                                <option value="{{$postTypes->id}}">{{$postTypes->title}}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <p> Field Position</p>
                                            <label for="t-text" class="sr-only">Field Position</label>
                                            <select class="form-control  basic" name="field_position">
                                                <option value="after_title">After Title</option>
                                                <option value="after_content">After Content</option>
                                                <option value="sidebar">Sidebar</option>
                                            </select>
                                        </div>

                                        <input type="submit" name="txt" class="mt-4 btn btn-success float-right">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <p> Description</p>
                                   <textarea name="description">{{ old('description') }}</textarea>
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
<script src="{{ asset('cork/plugins/editors/quill/quill.js') }}"></script>
<script src="{{ asset('cork/plugins/editors/quill/custom-quill.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>


<script>
    function generateRandomInteger() {
        return Math.floor(Math.random() * 90000) + 10000;
    }
    $(document).on("click", "#add_new_field", function (e) {
        e.preventDefault();
        var $this = $(this);
        var field_count = $('#field_count').val();
        var selectedOption = $('#field_type').children("option:selected").val();

        $.ajax({
            type: "GET",
            url: "{{ route('admin.custom_field.field')  }}",
            data: {
                field_type: selectedOption,
                field_count: field_count,
                random_integer:generateRandomInteger(),
            },
            beforeSend: function (data) {

            },
            success: function (data) {
                var add_field_count = parseInt(field_count) + 1;
                $('#field_count').val(add_field_count);
                $('.repeated_table').append(data);
                repeaterReload();


            },
            error: function (xhr, ajaxOptions, thrownError) {

            },
        });

    });


</script>
<script>

    function repeaterReload() {
        $('.repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'label': '',
                'name': ''
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
            isFirstItemUndeletable: true
        });
    }

</script>

<script>
    $(document).on("keyup", ".main-label" , function() {
        var thisitem  = $(this);
        var labelText = thisitem.val();
        Text = labelText.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

        thisitem.parent().siblings().children('.main-field').val(Text);
        thisitem.parents('.accordion-repeat').find('.field-name').text(labelText);
    });
</script>

<script>
    $(document).on("keyup", ".repaterLabelName" , function() {
        var thisitem  = $(this);
        var labelText = thisitem.val();
        Text = labelText.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

        thisitem.parent().parent().siblings().children().children('.slugFieldName').val(Text);
    });
</script>

<script>
    $(document).on("click", ".remove-field" , function() {
        $(this).closest('.accordion-repeat').remove();
    });
</script>

<script>
    $(document).on("keyup", ".slugFieldName" , function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $(this).val(Text);
    });
</script>


@endpush
