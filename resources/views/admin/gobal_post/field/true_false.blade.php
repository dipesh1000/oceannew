<div class="form-group">
    <p>{{ $filed->title }}</p>
    <div class="custom-control custom-checkbox">
        <input type="hidden" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]"  value="0">
        <input type="checkbox" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]" class="custom-control-input {{ $filed->field_type }}" id="customCheck{{ $filedContent['field_name'] ?? '' }}" @if(isset($filedContent['required'])) required @endif value="@if(isset($post) && getPostFieldData($post, $filedContent['field_name'] ?? '')) {{ getPostFieldData($post, $filedContent['field_name'] ?? '') }} @else 0 @endif" @if(isset($post))  {{ getPostFieldData($post, $filedContent['field_name'] ?? '')==1?'checked':'' }}  @endif>
        <label class="custom-control-label" for="customCheck{{ $filedContent['field_name'] ?? '' }}"></label>
    </div>
</div>