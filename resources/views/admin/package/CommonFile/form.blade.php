
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <p>Title<span class="text-danger">*</span></p>
            <label for="title" class="sr-only">Package Title</label>
            {{ Form::text('title',old('title')??$package->title??'',['class' => 'form-control','placeholder'=> 'Package Title...', 'required']) }}
            <small class="text-danger alert-message">{{ $errors->first('title') }}</small>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Package Price</p>
                    <label for="t-text" class="sr-only">Package Price</label>
                    {{ Form::number('price',old('price')??$package->price??'',['class' => 'form-control','placeholder'=> 'Package Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('price') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Offer Price</p>
                    <label for="t-text" class="sr-only">Offer Price</label>
                    {{ Form::number('offer_price',old('offer_price')??$package->offer_price??'',['class' => 'form-control','placeholder'=> 'Offer Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('offer_price') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p> Package Type<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Package Type</label>
                    {{ Form::select('package_type',['Book' => 'Book', 'Video' => 'Video', 'Book & Video'=>'Book & Video'],$package->package_type??'',['id'=>'package_type', 'class' => 'form-control basic','required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('book_type') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p> Category</p>
                    <label for="t-text" class="sr-only">Category</label>
                    <select class="form-control  basic" name="category_id" id="category_id">
                        <option selected="" value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @include('admin.package.categorysub')
                        @endforeach
                    </select>
                    <small class="text-danger alert-message">{{ $errors->first('category_id') }}</small>
                </div>
            </div>
        </div>

        <div id="package-item">
            <div class="table-responsive mb-4 mt-4">
                <table id="zero-config" class="table table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($packagesItems))
                        @foreach($packagesItems as $item)
                            @if(isset($item->itemable))
                                <tr>
                                    <td><input type="checkbox" name="packageitem[{{ $item->itemable->type }}][]" value="{{ $item->itemable->id }}" checked></td>
                                    <input type="hidden" name="itemids[{{ $item->itemable->type }}][]" value="{{ $item->itemable->id }}" class="{{ $item->itemable->type }}ids">
                                    <td>{{ $item->itemable->title }}</td>
                                    <td>{{ $item->itemable->type }}</td>
                                    <td><img src="{{ asset('thumbnail/'.$item->itemable->image) }}" width="50"></td>
                                    <td>{{ $item->itemable->category->title }}</td>
                                    <td><button  data-id = "{{ $item->id }}" title="Delete" class=" btn btn-sm badge badge-dark delete-item">Delete</button></td>
                                </tr>
                                @endif
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">

        <div class="form-group">
            <p>Feature Image</p>
            <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>Clear <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image" value="{{ $video->image??'' }}">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            <small class="text-danger alert-message">{{ $errors->first('image') }}</small>
        </div>

        <div class="row">
            <div class="col-sm-12   mb-4 ml-5">
                <div class="form-group">
                    <p> Status</p>
                    <label class="switch s-icons s-outline  s-outline-danger">
                        {{ Form::checkbox('status',null, (!empty($package) ? $package->status=="Active"? true : false:true)) }}
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <p> Description</p>
    {{ Form::textarea('description', old('description')??$package->description??'') }}
    <small class="text-danger alert-message">{{ $errors->first('description') }}</small>
</div>
