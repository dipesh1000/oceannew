<div class="form-group">
    <p>{{ $filed->title }}</p>
    <input type="file" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]" file-size="{{ $filedContent['file_size'] ?? '' }}" @if(isset($filedContent['required'])) @if(isset($post) && getPostFieldData($post, $filedContent['field_name'] ?? '')) @else required  @endif   @endif>
    @if(isset($post))
        @if(getPostFieldData($post, $filedContent['field_name'] ?? ''))
            <br>
            <a class="btn btn-sm btn-outline-danger mt-2" href="{{ asset(getPostFieldData($post, $filedContent['field_name'] ?? '')) }}" target="_blank">View {{ $filed->title }}</a>
            <a href="{{ route('admin.post.delete.field_file', getPostFieldId($post, $filedContent['field_name'] ?? '')) }}">
                Delete
            </a>
        @endif
    @endif

</div>