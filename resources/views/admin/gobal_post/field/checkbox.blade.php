<div class="form-group">
    <p>{{ $filed->title }}</p>
    <label for="t-text" class="sr-only"> {{ $filed->title }}</label>
    <div class="row">
        @if(isset($filedContent['repeater']))
            <input type="hidden" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name']?? '' }}][]" value="0">

            @foreach($filedContent['repeater'] as $repeater)
        <div class="col-sm-4">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name']?? '' }}][]" class="custom-control-input" id="customCheck{{ $loop->iteration }}" @if(isset($filedContent['required'])) required @endif value="{{$repeater['label']}}"
                @if(isset($post))
                    @if(getPostFieldData($post, $filedContent['field_name'] ?? ''))
                        @foreach(getPostFieldData($post, $filedContent['field_name'] ?? '') as $fieldDatum)

                            @if($repeater['label'] == $fieldDatum)
                                checked
                                @endif
                            @endforeach
                        @endif
                @endif
                >
                <label class="custom-control-label" for="customCheck{{ $loop->iteration }}">{{$repeater['label']}}</label>
            </div>
        </div>
            @endforeach
        @endif
    </div>
</div>