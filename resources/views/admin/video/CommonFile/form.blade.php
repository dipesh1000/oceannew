
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <p>Title *</p>
            <label for="title" class="sr-only">Video Title*</label>
            {{ Form::text('title',old('title')??$video->title??'',['class' => 'form-control','placeholder'=> 'Video Title...', 'required']) }}
            <small class="text-danger alert-message">{{ $errors->first('title') }}</small>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <p>Upload Video</p>
                   {{ Form::file('file', ['id'=>'videofile']) }}
                    {{ Form::submit('Upload', ['class'=>'btn btn-primary', 'id'=>'videoUploadButton']) }}

                    <div class="progress mt-2">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                    </div>
                    <!-- Display upload status -->
                    <div id="uploadStatus"></div>


                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <p>Video ID</p>
                    <label for="t-text" class="sr-only">Video ID</label>
                    {{ Form::text('video',old('video')??$video->video??'',['class' => 'form-control','placeholder'=> 'Enter Video ID....', 'id'=>'media-id', 'required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('video') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Video Price</p>
                    <label for="t-text" class="sr-only">Video Price</label>
                    {{ Form::number('price',old('price')??$video->price??'',['class' => 'form-control','placeholder'=> 'Video Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('price') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Offer Price</p>
                    <label for="t-text" class="sr-only">Offer Price</label>
                    {{ Form::number('offer_price',old('offer_price')??$video->offer_price??'',['class' => 'form-control','placeholder'=> 'Offer Price...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('offer_price') }}</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Video Total Time</p>
                    <label for="t-text" class="sr-only">Video Total Time</label>
                    {{ Form::text('time',old('time')??$video->time??'',['class' => 'form-control','placeholder'=> 'Video Total Time...', 'required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('time') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Video Author</p>
                    <label for="t-text" class="sr-only">Video Author</label>
                    {{ Form::text('author',old('author')??$video->author??'',['class' => 'form-control','placeholder'=> 'Video Author...', 'required']) }}
                    <small class="text-danger alert-message">{{ $errors->first('author') }}</small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p>Video Meta</p>
            <label for="t-text" class="sr-only">Video Meta</label>
            <table class="table table-bordered table-videocontent">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($video->videoContent))
                    @foreach($video->videoContent as $item)
                        <tr data-row="{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="text"
                                           name="videocontent[key][{{ $item->id }}]"
                                           value="{{ $item->key }}"
                                           class="form-control" required>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text"
                                           name="videocontent[value][{{ $item->id }}]"
                                           value="{{ $item->value }}"
                                           class="form-control" required>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)"
                                   class="btn badge badge-dark btn-sm btn-delete-videocontent"
                                   data-videocontent="{{ $item->id }}">Remove</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <button class="btn btn-primary btn-sm btn-add-videocontent">
                            Add New
                        </button>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <p> Category</p>
            <label for="t-text" class="sr-only">Category</label>
            <select class="form-control  basic" name="category_id">
                <option selected="" value=""></option>
                @foreach($categories as $category)
                    <option @isset($video->category_id ) @if($video->category_id == $category->id) selected @endif @endisset  value="{{ $category->id }}">{{ $category->title }}</option>
                    @include('admin.video.categorysub')
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
            <div class="col-sm-4">
                <div class="form-group">
                    <p> Status</p>
                    <label class="switch s-icons s-outline  s-outline-danger  mb-4 mr-2">
                        {{ Form::checkbox('status',null, (!empty($video) ? $video->status=="Active"? true : false:true)) }}
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <p> Is Preview? </p>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        {{ Form::checkbox('preview',null,  (!empty($video) ? $video->preview==1? true : false:false))}}
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <p> Is Feature? </p>
                    <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                        {{ Form::checkbox('feature',null, (!empty($video) ? $video->feature==1? true : false:false)) }}
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
                <p> Description *</p>
                {{ Form::textarea('description', old('description')??$video->description??'') }}
                <small class="text-danger alert-message">{{ $errors->first('description') }}</small>
            </div>
        </div>
        <div class="tab-pane fade" id="table-content" role="tabpanel" aria-labelledby="table-content-button">
            <div class="form-group">
                <p> Table of Content</p>
                {{ Form::textarea('table_of_content', old('table_of_content')??$video->table_of_content??'') }}
                <small class="text-danger alert-message">{{ $errors->first('table_of_content') }}</small>
            </div>
        </div>
    </div>
</div>
<input type="submit" name="txt" class="mt-4 btn btn-primary">