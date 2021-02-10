@if($category->subCategory->isNotEmpty())
    @foreach($category->subCategory as $child)
        <option value="{{ $child->id }}" >
            &nbsp;&nbsp;{{seperator($loop->depth)}}&nbsp;&nbsp;{{ $child->title }}</option>
        @include('admin.package.categorysub', ['category' => $child])
    @endforeach
@endif