<div class="form-group">
    <p>{{ $filed->title }}</p>
    @if(isset($filedContent['post_type']))
        <input type="hidden" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}][]" value="0">
        <select class="form-control   basic" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}][]" @if(isset($filedContent['multiselect'])) multiple @endif @if(isset($filedContent['required'])) required @endif>
            @foreach(returnGobalPost($filedContent['post_type']) as $getPostType)
                <option value="{{ $getPostType->id }}"
                        @if(isset($post))
                        @if(getPostFieldData($post, $filedContent['field_name'] ?? ''))
                        @foreach(getPostFieldData($post, $filedContent['field_name'] ?? '') as $fieldDatum)

                        @if($getPostType->id == $fieldDatum)
                        selected
                        @endif
                        @endforeach
                        @endif
                        @endif
                 >{{ $getPostType->title }}</option>
            @endforeach
        </select>

    @endif
</div>