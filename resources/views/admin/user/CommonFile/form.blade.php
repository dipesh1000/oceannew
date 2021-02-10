
<div class="row">
    <div class="col-md-8">
        <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   <p>First Name<span class="text-danger">*</span></p>
                   <label for="title" class="sr-only">First Name</label>
                   {{ Form::text('first_name',old('first_name')??$user->first_name??'',['class' => 'form-control','placeholder'=> 'First Name...', 'required']) }}
                   <small class="text-danger alert-message">{{ $errors->first('first_name') }}</small>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <p>Last Name<span class="text-danger">*</span></p>
                   <label for="title" class="sr-only">Last Name</label>
                   {{ Form::text('last_name',old('last_name')??$user->last_name??'',['class' => 'form-control','placeholder'=> 'Last Name...', 'required']) }}
                   <small class="text-danger alert-message">{{ $errors->first('last_name') }}</small>
               </div>
           </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Email<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Email</label>
                    {{ Form::email('email',old('email')??$user->email??'',['class' => 'form-control','placeholder'=> 'Email...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('email') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p> Role<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Role</label>
                    <select class="form-control basic" name="role[]">
                             @foreach($roles as $role)
                                 <option @if(isset($user->roles)) @foreach($user->roles as $userrole) {{ $role->id==$userrole->id?'selected':'' }} @endforeach @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                 @endforeach
                    </select>
                    <small class="text-danger alert-message">{{ $errors->first('role') }}</small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p>Phone</p>
            <label for="t-text" class="sr-only">Phone</label>
            {{ Form::number('phone',old('phone')??$user->phone??'',['class' => 'form-control','placeholder'=> 'Phone...']) }}
            <small class="text-danger alert-message">{{ $errors->first('phone') }}</small>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Password<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Password</label>
                    {{ Form::password('password',['class' => 'form-control','placeholder'=> 'Password...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('password') }}</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <p>Confirm Password<span class="text-danger">*</span></p>
                    <label for="t-text" class="sr-only">Confirm Password</label>
                    {{ Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Confirm Password...']) }}
                    <small class="text-danger alert-message">{{ $errors->first('password_confirmation') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">

        <div class="form-group">
            <p>User Image</p>
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
                    <p> Activate User.</p>
                    <label class="switch s-icons s-outline  s-outline-danger">
                        {{ Form::checkbox('activate',null, (!empty($book) ? $book->status=="Active"? true : false:true)) }}
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

