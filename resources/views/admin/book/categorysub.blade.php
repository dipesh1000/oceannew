@if($category->subCategory->isNotEmpty())
    @foreach($category->subCategory as $child)
        <option @isset($book) @if($book->category_id == $child->id) selected @endif @endisset value="{{ $child->id }}" >
            &nbsp;&nbsp;{{seperator($loop->depth)}}&nbsp;&nbsp;{{ $child->title }}</option>
        @include('admin.book.categorysub', ['category' => $child])
    @endforeach
@endif