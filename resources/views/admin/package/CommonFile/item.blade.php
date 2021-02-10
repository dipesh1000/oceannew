@foreach($packagesItems as $item)
    <tr>
        <td><input type="checkbox" name="packageitem[{{ $item->type }}][]" value="{{ $item->id }}"></td>
        <input type="hidden" name="itemids[{{ $item->type }}][]" value="{{ $item->id }}" class="{{ $item->type }}ids">
        <td>{{ $item->title??'' }}</td>
        <td>{{ $item->type }}</td>
        <td><img src="{{ asset('thumbnail/'.$item->image) }}" width="50"></td>
        <td>{{ $item->category->title??'' }}</td>
        <td><button  data-id = "" title="Delete" class=" btn btn-sm badge badge-dark delete-item">Delete</button></td>
    </tr>
@endforeach