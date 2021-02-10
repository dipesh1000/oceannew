
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <p>Title<span class="text-danger">*</span></p>
            <label for="title" class="sr-only">Book Title</label>
            {{ Form::text('title',old('title')??$book->title??'',['class' => 'form-control','placeholder'=> 'Book Title...', 'required']) }}
            <small class="text-danger alert-message">{{ $errors->first('title') }}</small>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p> Book Type<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Book Type</label>
                    {{ Form::select('book_type',['DigitalCopy' => 'DigitalCopy', 'HardCopy' => 'HardCopy', 'Both'=>'Both'],$book->digital_or_hardcopy??'',['id'=>'book_type', 'class' => 'form-control basic','required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('book_type') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Upload Book File<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Upload Book File</label>
                    {{ Form::file('book_file',['id'=>'bookfile', 'class' => 'form-control',(!empty($book) ? $book->book? '' : 'required':'') ]) }}
                    <small class="text-danger alert-message">{{ $errors->first('book_file') }}</small>

                    @if(isset($book->book))
                        <a class="btn btn-sm btn-outline-danger mt-2" href="{{ asset($book->book) }}" target="_blank">View File</a>

                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Book Price</p>
                    <label for="t-text" class="sr-only">Book Price</label>
                    {{ Form::number('price',old('price')??$book->price??'',['class' => 'form-control','placeholder'=> 'Book Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('price') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Offer Price</p>
                    <label for="t-text" class="sr-only">Offer Price</label>
                    {{ Form::number('offer_price',old('offer_price')??$book->offer_price??'',['class' => 'form-control','placeholder'=> 'Offer Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('offer_price') }}</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Stock Quantity<span class="text-danger"></span></p>
                    <label for="t-text" class="sr-only">Stock Quantity</label>
                    {{ Form::number('quantity',old('quantity')??$book->quantity??'',['class' => 'form-control','placeholder'=> 'Enter Stock Quantity....', 'id'=>'stock_quantity']) }}
                    <small class="text-danger alert-message">{{ $errors->first('quantity') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Book Author</p>
                    <label for="t-text" class="sr-only">Video Author</label>
                    {{ Form::text('author',old('author')??$book->author??'',['class' => 'form-control','placeholder'=> 'Video Author...', 'required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('author') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>ISBN No.</p>
                    <label for="t-text" class="sr-only">ISBN No.</label>
                    {{ Form::text('isbn_no',old('isbn_no')??$book->isbn_no??'',['class' => 'form-control','placeholder'=> 'ISBN No....']) }}
                    <small class="text-danger alert-message">{{ $errors->first('isbn_no') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>SKU</p>
                    <label for="t-text" class="sr-only">SKU</label>
                    {{ Form::text('sku',old('sku')??$book->sku??'',['class' => 'form-control','placeholder'=> 'SKU...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('sku') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Edition</p>
                    <label for="t-text" class="sr-only">Edition</label>
                    {{ Form::text('edition',old('isbn_no')??$book->edition??'',['class' => 'form-control','placeholder'=> 'Edition....']) }}
                    <small class="text-danger alert-message">{{ $errors->first('edition') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Book Language</p>
                    <label for="t-text" class="sr-only">Book Language</label>
                    {{ Form::text('language',old('language')??$book->language??'',['class' => 'form-control','placeholder'=> 'Book Language....']) }}
                    <small class="text-danger alert-message">{{ $errors->first('language') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <p> Category</p>
            <label for="t-text" class="sr-only">Category</label>
            <select class="form-control  basic" name="category_id">
                <option selected="" value=""></option>
                @foreach($categories as $category)
                    <option @isset($book->category_id ) @if($book->category_id == $category->id) selected @endif @endisset  value="{{ $category->id }}">{{ $category->title }}</option>
                    @include('admin.book.categorysub')
                @endforeach
            </select>
            <small class="text-danger alert-message">{{ $errors->first('category_id') }}</small>
        </div>

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
                        {{ Form::checkbox('status',null, (!empty($book) ? $book->status=="Active"? true : false:true)) }}
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-section">
    <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="description-tab-button" data-toggle="tab" href="#description-tab" role="tab" aria-controls="description-tab" aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="table-content-button" data-toggle="tab" href="#table-content" role="tab" aria-controls="table-content" aria-selected="false">Table of Content</a>
        </li>
    </ul>

    <div class="tab-content" id="justifyTabContent">
        <div class="tab-pane fade show active" id="description-tab" role="tabpanel" aria-labelledby="description-tab-button">
            <div class="form-group">
                <p> Description</p>
                {{ Form::textarea('description', old('description')??$book->description??'') }}
                <small class="text-danger alert-message">{{ $errors->first('description') }}</small>
            </div>
        </div>
        <div class="tab-pane fade" id="table-content" role="tabpanel" aria-labelledby="table-content-button">
            <div class="form-group">
                <p> Table of Content</p>
                {{ Form::textarea('table_of_content', old('table_of_content')??$book->table_of_content??'') }}
                <small class="text-danger alert-message">{{ $errors->first('table_of_content') }}</small>
            </div>
        </div>
    </div>
</div>
