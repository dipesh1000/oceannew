<div class="form-group">
    <p>{{ $filed->title }}</p>
    <label for="t-text" class="sr-only"> {{ $filed->title }}</label>
    <input id="post_type_title" value="@if(isset($post)){{ getPostFieldData($post, $filedContent['field_name'] ?? '') }}@endif" type="date" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]"  class="form-control" @if(isset($filedContent['required'])) required @endif>
</div>