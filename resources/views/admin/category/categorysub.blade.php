@if($category->subCategory->isNotEmpty())
    @foreach($category->subCategory as $child)
        <option @isset($editCategory) @if($editCategory->parent_id == $child->id) selected @endif @endisset value="{{ $child->id }}" @if(seperator($loop->depth) == "--") disabled="disabled" @endif>
            &nbsp;&nbsp;{{seperator($loop->depth)}}&nbsp;&nbsp;{{ $child->title }}</option>
        @include('admin.category.categorysub', ['category' => $child])
    @endforeach
@endif