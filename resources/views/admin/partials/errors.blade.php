@if (\Illuminate\Support\Facades\Session::has('error'))
    <div class="row alert-message">
        <div class="col-md-8 offset-md-2">
            <div class="alert alert-icon-left alert-light-danger m-2 " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="text-black"  data-dismiss="alert"> ×</span></button>
                <i data-feather="alert-triangle"></i>
                {!! \Illuminate\Support\Facades\Session::get('error') !!}
            </div>
        </div>
    </div>


@endif