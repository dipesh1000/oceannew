<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>route('admin.user.role.update'), 'enctype'=>'multipart/form-data', 'id'=>'saverole']) !!}
            <input type="hidden" value="{{ $role->id }}" name="role_id">
            <div class="form-group">
                <p>Role Name<span class="text-danger">*</span></p>
                <label for="title" class="sr-only">Role Name</label>
                {{ Form::text('name',old('name')??$role->name??'',['class' => 'form-control','placeholder'=> 'Role Name...', 'required']) }}
                <small class="text-danger alert-message">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group">
                <p>Role Slug<span class="text-danger">*</span></p>
                <label for="title" class="sr-only">Role Slug</label>
                {{ Form::text('slug',old('slug')??$role->slug??'',['class' => 'form-control','placeholder'=> 'Role Slug...', 'required']) }}
                <small class="text-danger alert-message">{{ $errors->first('slug') }}</small>
            </div>
            {{Form::submit('Update',['class'=>'mt-4 btn btn-primary'])}}
            <button class="btn btn-sm btn-danger float-right" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>