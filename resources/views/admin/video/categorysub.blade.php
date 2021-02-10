@if($category->subCategory->isNotEmpty())
    @foreach($category->subCategory as $child)
        <option @isset($video) @if($video->category_id == $child->id) selected @endif @endisset value="{{ $child->id }}" >
            &nbsp;&nbsp;{{seperator($loop->depth)}}&nbsp;&nbsp;{{ $child->title }}</option>
        @include('admin.video.categorysub', ['category' => $child])
    @endforeach
@endif