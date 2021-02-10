<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>route('admin.user.permission.update'), 'enctype'=>'multipart/form-data', 'id'=>'saverole']) !!}
            <input type="hidden" value="{{ $permission->id }}" name="permission_id">
            <div class="form-group">
                <p>Permission Name<span class="text-danger">*</span></p>
                <label for="title" class="sr-only">Permission Name</label>
                {{ Form::text('name',old('name')??$permission->name??'',['class' => 'form-control','placeholder'=> 'Permission Name...', 'required', 'id'=>'permession_name']) }}
                <small class="text-danger alert-message">{{ $errors->first('name') }}</small>
            </div>
            {{Form::submit('Update',['class'=>'mt-4 btn btn-primary'])}}
            <button class="btn btn-sm btn-danger float-right" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>


