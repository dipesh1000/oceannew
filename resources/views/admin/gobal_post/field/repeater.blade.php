<div class="form-group">
    <p>{{ $filed->title }}</p>
    <label for="t-text" class="sr-only"> {{ $filed->title }}</label>
    <div class='repeater'>
        <input type="hidden" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}][]" value="0">

        <table class="table table-bordered table-specifications" data-repeater-list="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]">
            <thead>
            <tr>
                @if(isset($filedContent['repeater']))

                    @foreach($filedContent['repeater'] as $repeater)
                <th>{{$repeater['label']}}</th>
                    @endforeach
                @endif
                <th>Action</th>
            </tr>
            </thead>
            <tbody >

            @if(isset($post) && getPostFieldData($post, $filedContent['field_name'] ?? ''))

                    @foreach(getPostFieldData($post, $filedContent['field_name'] ?? '') as $fieldDatum)
                        <tr data-repeater-item>
                            @if(isset($filedContent['repeater']))

                                @foreach($filedContent['repeater'] as $repeater)
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="{{$repeater['name']}}" value="{{ $fieldDatum[$repeater['name']] }}" class="form-control" required>
                                        </div>
                                    </td>
                                @endforeach
                            @endif
                            <td>
                                <button data-repeater-delete type="button" class="btn-sm btn btn-danger ">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr data-repeater-item>
                    @if(isset($filedContent['repeater']))

                        @foreach($filedContent['repeater'] as $repeater)
                            <td>
                                <div class="form-group">
                                    <input type="text" name="{{$repeater['name']}}" value="" class="form-control" required>
                                </div>
                            </td>
                        @endforeach
                    @endif
                    <td>
                        <button data-repeater-delete type="button" class="btn-sm btn btn-danger ">Delete</button>
                    </td>
                </tr>
            @endif

            </tbody>
            <tfoot>
            <tr>
                @if(isset($filedContent['repeater']))

                    @foreach($filedContent['repeater'] as $repeater)
                <th></th>
                    @endforeach
                @endif
                <th>
                    <input data-repeater-create class="btn btn-sm btn-success" type="button" value="Add" />
                </th>
            </tr>
            </tfoot>
        </table>

    </div>
</div>