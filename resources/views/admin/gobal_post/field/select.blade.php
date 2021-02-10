<div class="form-group">
    <p>{{ $filed->title }}</p>
    @if(isset($filedContent['repeater']))
    <select class="form-control  basic" @if(isset($filedContent['required'])) required @endif name="custom_field[{{ $filed->field_type }}][{{ $filedContent['field_name'] ?? '' }}]">
        <option value="">Null</option>
        @foreach($filedContent['repeater'] as $repeater)
        <option value="{{$repeater['label']}}" @if(isset($post) && getPostFieldData($post, $filedContent['field_name'] ?? '')) @if(getPostFieldData($post, $filedContent['field_name'] ?? '')==$repeater['label']) selected @endif  @endif >{{$repeater['label']}}</option>
        @endforeach
    </select>

    @endif
</div>