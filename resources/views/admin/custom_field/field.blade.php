<div id="toggleAccordion" class="accordion-repeat">
    <div class="card">
        <div class="card-header" >
            <section class="mb-0 mt-0">
                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#repeatfield{{ $field_count }}">
                    <span>{{ $field_count }}</span><span> - </span><span class="field-name">No Label</span>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-field float-right">Remove</button>
                </div>

            </section>
        </div>

        <div id="repeatfield{{ $field_count }}" class="collapse" >
            <div class="card-body">
                <div class="form-group">
                    <p>Field Label</p>
                    <label for="t-text" class="sr-only">Field Label</label>
                    <input type="text" name="field[title][{{$random_integer}}]"  class="form-control main-label" required>
                </div>
                <div class="form-group">
                    <p>Field Name</p>
                    <label for="t-text" class="sr-only">Field Label</label>
                    <input type="text" name="field[name][{{$random_integer}}]"  class="form-control slugFieldName main-field" required>
                </div>
                <div class="form-group">
                    <p>Field Type</p>
                    <label for="t-text" class="sr-only">Field Type</label>
                    <input type="text" name="field[type][{{$random_integer}}]"  class="form-control" readonly value="{{ $field_type }}" required>
                </div>



                <div class="form-group">
                    <p>Instructions</p>
                    <label for="t-text" class="sr-only">Instructions</label>
                    <input type="text" name="field[instruction][{{$random_integer}}]"  class="form-control">
                </div>

                <div class="form-group">
                    <p> Required? </p>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="field[required][{{$random_integer}}]" type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                @if($field_type == "text" || $field_type == "text_area" || $field_type == "number")
                <div class="form-group">
                    <p>Placeholder Text</p>
                    <label for="t-text" class="sr-only">Placeholder Text</label>
                    <input type="text" name="field[placeholder][{{$random_integer}}]"  class="form-control" >
                </div>
                @endif

                @if($field_type == "image" || $field_type == "file")
                <div class="form-group">
                    <p>Max File Size (MB)</p>
                    <label for="t-text" class="sr-only">Max File Size</label>
                    <input type="number" name="field[file_size][{{$random_integer}}]"  class="form-control" >
                </div>
                @endif

                @if($field_type == "select" || $field_type == "checkbox" || $field_type == "repeater")
                <div class='repeater'>
                    <div data-repeater-list="field[{{$field_type}}][{{$random_integer}}]">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <p>Label</p>
                                        <label for="t-text" class="sr-only">Label</label>
                                        <input type="text" class="form-control repaterLabelName" name="label" placeholder="Red"  required/>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <p>Name</p>
                                        <label for="t-text" class="sr-only">Name</label>
                                        <input type="text"  class="form-control slugFieldName" placeholder="red" name="name" required/>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button data-repeater-delete type="button" class="btn-sm btn btn-danger mt-5">Delete</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input data-repeater-create type="button" value="Add" />
                </div>
                    @endif

                @if($field_type == "post_type")
                    <div class="form-group">
                        <p>Select Post Types</p>
                        <label for="t-text" class="sr-only">Select Post Types</label>
                        <select class="form-control  basic" name="field[post_type][{{$random_integer}}]">

                            @if($postTypes)
                                @foreach($postTypes as $postType)
                                    <option value="{{ $postType->id }}">{{ $postType->title }}</option>
                                @endforeach
                                @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <p> Is Multiple Select? </p>
                        <label class="switch s-icons s-outline  s-outline-danger  mb-4 mr-2">
                            <input name="field[multiselect][{{$random_integer}}]" type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    @endif

            </div>
        </div>
    </div>

</div>





