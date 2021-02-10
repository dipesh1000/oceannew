@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('cork/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ $video->title }} Video Preview </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                <div id="player"></div>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script src="https://cdn.jwplayer.com/libraries/IDzF9Zmk.js"></script>


<script>

     mediaid = '{{ $video->video }}';
    jwplayer('player').setup({
        playlist: 'https://cdn.jwplayer.com/v2/media/'+ mediaid,
        autostart: true,
        floating: true,
        width: '100%',
    });
</script>

@endpush
