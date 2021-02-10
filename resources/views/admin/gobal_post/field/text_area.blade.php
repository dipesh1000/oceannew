<div class="form-group">
    <p>{{ $filed->title }}</p>
    <label for="t-text" class="sr-only"> {{ $filed->title }}</label>
    <textarea name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]" @if(isset($filedContent['required'])) required @endif>
        @if(isset($post))
            {{ getPostFieldData($post, $filedContent['field_name'] ?? '') }}
        @else
            {{ $filedContent['placeholder'] ?? $filed->title }}...
        @endif
    </textarea>
</div>