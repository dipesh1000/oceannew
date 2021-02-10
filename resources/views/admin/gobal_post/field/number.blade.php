<div class="form-group">
    <p>{{ $filed->title }}</p>
    <label for="t-text" class="sr-only"> {{ $filed->title }}</label>
    <input id="post_type_title" value="@if(isset($post)){{ getPostFieldData($post, $filedContent['field_name'] ?? '') }}@endif" type="number" name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]" placeholder="{{ $filedContent['placeholder']?$filedContent['placeholder']:$filed->title }}..." class="form-control" @if(isset($filedContent['required'])) required @endif>
</div>