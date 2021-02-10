@if (\Illuminate\Support\Facades\Session::has('success'))

    <div class="row alert-message">
        <div class="col-md-8 offset-md-2">
            <div class="alert alert-icon-left alert-light-primary m-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="text-black"  data-dismiss="alert"> ×</span></button>
                <i data-feather="check"></i>
                 {!! \Illuminate\Support\Facades\Session::get('success') !!}
            </div>
        </div>
    </div>

@endif

