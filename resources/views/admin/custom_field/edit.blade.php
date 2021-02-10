@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/editors/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>EditCustom Field</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-lg-12 col-12 mx-auto">
                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.custom_field.update') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="custom_field_id" value="{{ $customField->id }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <label for="t-text" class="sr-only">Custom Field Title</label>
                                            <input id="custom_field_title" value="{{ $customField->title }}" type="text" name="title" placeholder="Custom Field Title..." class="form-control" required>
                                        </div>

                                        <hr>
                                        <h2>Add Feilds</h2>


                                        <div class="repeated_table">

                                            @if(isset($customField->childrens))

                                               @foreach($customField->childrens as $children)
                                                    @php
                                                        $field_count = $loop->iteration;
                                                        $field_type = $children->field_type;
                                                    @endphp
                                                    <div id="toggleAccordion" class="accordion-repeat">
                                                        <div class="card">
                                                            <div class="card-header" >
                                                                <section class="mb-0 mt-0">
                                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#repeatfield{{ $field_count }}">
                                                                        <span>{{ $field_count }}</span><span> - </span><span class="field-name">{{ $children->title }}</span>
                                                                        <a href="{{ route('admin.custom_field.field.delete', $children->id) }}" class="btn btn-sm btn-outline-danger deleteconfirmation float-right">Remove</a>
                                                                    </div>

                                                                </section>
                                                            </div>

                                                            <div id="repeatfield{{ $field_count }}" class="collapse" >
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <p>Field Label</p>
                                                                        <label for="t-text" class="sr-only">Field Label</label>
                                                                        <input type="text" value="{{ $children->title }}"  name="field[title][{{$children->id}}]"  class="form-control main-label" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <p>Field Name</p>
                                                                        <label for="t-text" class="sr-only">Field Label</label>
                                                                        <input type="text" value="{{ $children->child['field_name'] }}" name="field[name][{{$children->id}}]"  class="form-control main-field slugFieldName" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <p>Field Type</p>
                                                                        <label for="t-text" class="sr-only">Field Type</label>
                                                                        <input type="text"  name="field[type][{{$children->id}}]"  class="form-control" readonly value="{{ $field_type }}" required>
                                                                    </div>



                                                                    <div class="form-group">
                                                                        <p>Instructions</p>
                                                                        <label for="t-text" class="sr-only">Instructions</label>
                                                                        <input type="text" value="@if(isset($children->child['instruction'])) {{ $children->child['instruction'] }} @endif" name="field[instruction][{{$children->id}}]"  class="form-control">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <p> Required? </p>
                                                                        <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                                            <input name="field[required][{{$children->id}}]" type="checkbox" @isset($children->child['required']) @if($children->child['required'] == "on") checked @endif @endisset>
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                    </div>

                                                                    @if($field_type == "text" || $field_type == "text_area" || $field_type == "number")
                                                                        <div class="form-group">
                                                                            <p>Placeholder Text</p>
                                                                            <label for="t-text" class="sr-only">Placeholder Text</label>
                                                                            <input type="text" name="field[placeholder][{{$children->id}}]" value="{{ $children->child['placeholder']??'' }}"  class="form-control" >
                                                                        </div>
                                                                    @endif

                                                                    @if($field_type == "image" || $field_type == "file")
                                                                        <div class="form-group">
                                                                            <p>Max File Size (MB)</p>
                                                                            <label for="t-text" class="sr-only">Max File Size</label>
                                                                            <input type="number" name="field[file_size][{{$children->id}}]" value="{{ $children->child['file_size']??'' }}"  class="form-control" >
                                                                        </div>
                                                                    @endif

                                                                    @if($field_type == "select" || $field_type == "checkbox" || $field_type == "repeater")
                                                                        <div class='repeater'>
                                                                            <div data-repeater-list="field[{{$field_type}}][{{$children->id}}]">

                                                                                @if(isset($children->child['repeater']))

                                                                                    @foreach($children->child['repeater'] as $repeater)
                                                                                        <div data-repeater-item>
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <p>Label</p>
                                                                                                        <label for="t-text" class="sr-only">Label</label>
                                                                                                        <input type="text" class="form-control repaterLabelName" value="{{$repeater['label']}}" name="label" placeholder="Red"  required/>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <p>Name</p>
                                                                                                        <label for="t-text" class="sr-only">Name</label>
                                                                                                        <input type="text"  class="form-control slugFieldName" value="{{$repeater['name']}}" placeholder="red" name="name" required/>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <button data-repeater-delete type="button" class="btn-sm btn btn-danger mt-5">Delete</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                                    @endif

                                                                            </div>
                                                                            <input data-repeater-create type="button" value="Add" />
                                                                        </div>
                                                                    @endif

                                                                    @if($field_type == "post_type")
                                                                        <div class="form-group">
                                                                            <p>Select Post Types</p>
                                                                            <label for="t-text" class="sr-only">Select Post Types</label>
                                                                            <select class="form-control  basic" name="field[post_type][{{$children->id}}]">

                                                                                @if($postTypes)
                                                                                    @foreach($postTypes as $postType)
                                                                                        <option value="{{ $postType->id }}" @if($children->child['post_type'] == $postType->id) selected @endif>{{ $postType->title }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <p> Is Multiple Select? </p>
                                                                            <label class="switch s-icons s-outline  s-outline-danger  mb-4 mr-2">
                                                                                <input name="field[multiselect][{{$children->id}}]" type="checkbox" @isset($children->child['multiselect']) @if($children->child['multiselect'] == "on") checked @endif @endisset>
                                                                                <span class="slider"></span>
                                                                            </label>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                   @endforeach

                                                @endif


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
                                                <input type="hidden" id="field_count" name="field_count" value="{{ $customField->childrens?count($customField->childrens)+1:1 }}">
                                                <button type="button" class="mt-4 btn btn-primary mt-5" id="add_new_field">Add Field</button>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p> Status</p>
                                            <label for="t-text" class="sr-only">Status</label>
                                            <select class="form-control  basic" name="status">
                                                <option value="Active" @if($customField->status == "Active") selected @endif >Active</option>
                                                <option value="InActive" @if($customField->status == "InActive") selected @endif >InActive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <p> Select Post Type</p>
                                            <label for="t-text" class="sr-only">Select Post Type</label>
                                            <select class="form-control  basic" name="post_type">
                                                @foreach($postTypes as $postTypes)
                                                    <option value="{{$postTypes->id}}"  @if($customField->post_type == $postTypes->id) selected @endif >{{$postTypes->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <p> Field Position</p>
                                            <label for="t-text" class="sr-only">Field Position</label>
                                            <select class="form-control  basic" name="field_position">
                                                <option value="after_title" @if($customField->field_position == "after_title") selected @endif >After Title</option>
                                                <option value="after_content" @if($customField->field_position == "after_content") selected @endif >After Content</option>
                                                <option value="sidebar" @if($customField->field_position == "sidebar") selected @endif >Sidebar</option>
                                            </select>
                                        </div>

                                        <input type="submit" name="txt" class="mt-4 btn btn-success float-right" value="Update">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <p> Description</p>
                                    <textarea name="description">{{ $customField->post_content }}</textarea>
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
<script src="{{ asset('cork/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
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
            isFirstItemUndeletable: true
        });
    }


    repeaterReload();
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

<script>


    $('.deleteconfirmation').on('click', function (event ) {
        $this = $(this);
        event.preventDefault();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.location.href = $this.attr('href');
            }
        })
    })
</script>

@endpush
