<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Permission for {{ $role->name }}</h5>
        </div>
        <div class="modal-body">
            {!! Form::open(['url'=>route('admin.user.role.permission.store'), 'enctype'=>'multipart/form-data', 'id'=>'saverole']) !!}
            <input type="hidden" value="{{ $role->id }}" name="role_id">
            <div class="form-group">
                <p> Permission</p>
                <label for="t-text" class="sr-only">Permission</label>
                <div class="form-check d-inline mr-2">
                    <input value="full.permission" name="permissions[]" type="checkbox" class="form-check-input fullpermission-checkbok" id="exampleCheck0" @isset($role->permissions) @foreach($role->permissions as $key => $rolePermission) {{ $key=="full.permission"?'checked':'' }} @endforeach @endisset>
                    <label class="form-check-label" for="exampleCheck0">full.permission</label>
                </div>
                <div class="form-check d-inline mr-2">
                    <input value="no.permission" name="permissions[]" type="checkbox" class="form-check-input nopermission-checkbok" id="exampleCheck01" @isset($role->permissions) @foreach($role->permissions as $key => $rolePermission) {{ $key=="no.permission"?'checked':'' }} @endforeach @endisset>
                    <label class="form-check-label" for="exampleCheck01">no.permission</label>
                </div>
                <hr>
                @foreach($permissions as $permission)
                <div class="form-check d-inline mr-2">
                    <input value="{{ $permission->name }}" name="permissions[]" type="checkbox" class="form-check-input permission-checkbok" id="exampleCheck{{ $loop->iteration }}" @isset($role->permissions) @foreach($role->permissions as $key => $rolePermission) {{ $key==$permission->name?'checked':'' }} @endforeach @endisset>
                    <label class="form-check-label" for="exampleCheck{{ $loop->iteration }}">{{ $permission->name }}</label>
                </div>
                @endforeach
            </div>
            {{Form::submit('Update',['class'=>'mt-4 btn btn-primary'])}}
            <button class="btn btn-sm btn-danger float-right" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
