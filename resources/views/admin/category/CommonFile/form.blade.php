<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <p>Title</p>
            <label for="t-text" class="sr-only">Category Title</label>
            {{ Form::text('title',old('title')??$editCategory->title??'',['class' => 'form-control','placeholder'=> 'Category Title...', 'required']) }}
            {{-- <small class="text-danger alert-message">{{ $errors->first('title') ?? '' }}</small> --}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <p>Parent Category</p>
            <label for="t-text" class="sr-only">Parent Category</label>
            <select class="form-control  basic" name="parent_id">
                <option selected="" value="0">No Parent</option>
                @foreach($categories as $category)
                    <option @isset($editCategory) @if($editCategory->id == $category->id) selected @endif @endisset  value="{{ $category->id }}">{{ $category->title }}</option>
                    @include('admin.category.categorysub')
                @endforeach
            </select>
        </div>
    </div>
    {{-- <div class="col-md-6 mx-auto">
        <div class="form-group">
            <p>Category Image</p>
            <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>Clear <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
        </div>
    </div> --}}
</div>

<div class="row">
    <div class="col-md-6">
        {{-- <div class="form-group">
            <p>Icon</p>
            <label for="t-text" class="sr-only">Category Icon</label>
            {{ Form::text('icon',old('icon')??$editCategory->icon??'',['class' => 'form-control','placeholder'=> 'Category Icon...']) }}
        </div> --}}
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <p> Status</p>
            <label class="switch s-icons s-outline  s-outline-danger  mb-4 mr-2">
                {{ Form::checkbox('status',null, (!empty($editCategory) ? $editCategory->status=="Active"? true : false:true    )) }}
                <span class="slider"></span>
            </label>
        </div>
    </div>
</div>

{{-- <div class="form-group">
    <p> Description</p>
    {{ Form::textarea('description', old('description')??$editCategory->description??'') }}
</div> --}}