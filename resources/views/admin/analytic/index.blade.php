@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('cork/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('cork/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
<style>
    .icon-refresh-animate {
    animation-name: rotateThis;
    animation-duration: .5s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    }
    @keyframes rotateThis {
        from { transform:scale(1)rotate(0deg);}
        to {transform: scale(1) rotate(360deg);}
    }
</style>
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div id="breadcrumbArrowed" class="col-xl-12 col-lg-12 layout-top-spacing mb-3">
                <div id="breadcrumbArrowed" class="col-xl-12 col-lg-12 layout-top-spacing mb-3">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Analytics</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area text-center">

                            <div class="row">
                                <div class="col-sm-12">
                                    <nav class="breadcrumb-two" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><a href="{{ route('admin.analytic') }}">Analytic</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="widget-content widget-content-area br-6">
                    <div class="row layout-top-spacing">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value" id="realtimevisitor"></h6>
                                            <p class="">Real Time Visitor</p>
                                        </div>
                                        <div class="">
                                            <button id="realtimevisitorbtn" class="w-icon btn btn-light-default">
                                                <i class="fa fa-refresh" style="font-size: 25px"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-secondary realtime-progress" role="progressbar" style="width: 5%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-one">
                                <div class="widget-heading">
                                    <h6 class="">Statistics</h6>
                                </div>
                                <div class="w-chart">
                                    <div class="w-chart-section">
                                        <div class="w-detail">
                                            <p class="w-title">Total Page Views</p>
                                            <p class="w-stats">{{ $totalPageviews }}</p>
                                        </div>
                                        <div class="w-chart-render-one">
                                            <div id="total-users"></div>
                                        </div>
                                    </div>

                                    <div class="w-chart-section">
                                        <div class="w-detail">
                                            <p class="w-title">Total Visitor</p>
                                            <p class="w-stats">{{ $totalVisitor }}</p>
                                        </div>
                                        <div class="w-chart-render-one">
                                            <div id="paid-visits"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-account-invoice-two">
                                <div class="widget-content">
                                    <div class="account-box">

                                        @if(isset($visitorTypes))
                                            @foreach($visitorTypes as $type)
                                        <div class="info" @if($loop->iteration > 1) style="margin-bottom: 0px" @endif>
                                            <h5 class="">{{ $type['type'] }}</h5>
                                            <p class="inv-balance">{{ $type['sessions'] }}</p>
                                        </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget-four">
                                <div class="widget-heading">
                                    <h5 class="">Visitors by Browser</h5>
                                </div>
                                <div class="widget-content">
                                    <div class="vistorsBrowser">
                                        @if(isset($browsers[0]['browser']))
                                        <div class="browser-list">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                            </div>
                                            <div class="w-browser-details">

                                                <div class="w-browser-info">
                                                    <h6>{{$browsers[0]['browser']}}</h6>
                                                    <p class="browser-count">{{round(( $browsers[0]['sessions']/$totalBrowsersSession )*100)}}%</p>
                                                </div>

                                                <div class="w-browser-stats">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: {{round(( $browsers[0]['sessions']/$totalBrowsersSession )*100)}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        @endif
                                        @if(isset($browsers[1]['browser']))
                                        <div class="browser-list">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                            </div>

                                            <div class="w-browser-details">
                                                <div class="w-browser-info">
                                                    <h6>{{$browsers[1]['browser']}}</h6>
                                                    <p class="browser-count">{{round(( $browsers[1]['sessions']/$totalBrowsersSession )*100)}}%</p>
                                                </div>
                                                <div class="w-browser-stats">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{round(( $browsers[1]['sessions']/$totalBrowsersSession )*100)}}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif



                                        @if(isset($otherBrowsersSession))
                                            <div class="browser-list">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                                </div>
                                                <div class="w-browser-details">

                                                    <div class="w-browser-info">
                                                        <h6>Others</h6>
                                                        <p class="browser-count">{{round(( $otherBrowsersSession/$totalBrowsersSession )*100)}}%</p>
                                                    </div>

                                                    <div class="w-browser-stats">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{round(( $otherBrowsersSession/$totalBrowsersSession )*100)}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endisset

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-two">

                                <div class="widget-heading p-2">
                                    <h5 class="">Most Visited Pages</h5>
                                </div>

                                <div class="widget-content widget-content-area br-6">
                                    <div class="table-responsive mb-4 mt-4">
                                        <table id="zero-config" class="table table-hover" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Page Title</th>
                                                <th>Views</th>
                                                <th>URL</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($getMostVisitedPages))
                                                @foreach($getMostVisitedPages as $mostVisitedPage)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $mostVisitedPage['pageTitle'] }}</td>
                                                        <td>{{ $mostVisitedPage['pageViews'] }}</td>
                                                        <td>{{substr($mostVisitedPage['url'], 0, 20)}}</td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Page Title</th>
                                                <th>Views</th>
                                                <th>URL</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-three">

                                <div class="widget-heading p-2">
                                    <h5 class="">Top Referrers Sources</h5>
                                </div>

                                <div class="widget-content widget-content-area br-6">
                                    <div class="table-responsive mb-4 mt-4">
                                        <table id="zero-config1" class="table table-hover" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Source</th>
                                                <th>Views</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($getTopReferrers))
                                                @foreach($getTopReferrers as $getTopReferrer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{substr($getTopReferrer['url'], 0, 40)}}</td>
                                                        <td>{{ $getTopReferrer['pageViews'] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Source</th>
                                                <th>Views</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script src="{{ asset('cork/plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('cork/plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('cork/assets/js/dashboard/dash_2.js') }}"></script>
<script>
    $('#zero-config').DataTable();
    $('#zero-config1').DataTable();
</script>
<script>

    $(document).on("click", "#realtimevisitorbtn", function (e) {
        e.preventDefault();
        realtimevisitor();
    });
    $(document).ready(function(){
        realtimevisitor();
        progressfunction(0);
    });


    function progressfunction(width) {
        var interval = setInterval(function() {
            width += 10;
            $('.realtime-progress').css('width', width + '%');
            if (width >= 100) {
                realtimevisitor()
            }
        }, 10000)
    }

    function realtimevisitor() {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.analytic.realtime') }}",
            beforeSend: function (data) {
               $('#realtimevisitorbtn').addClass( 'icon-refresh-animate' );
            },
            success: function (data) {
                $('#realtimevisitor').text(data);
            },
            error: function (err) {
                $('#realtimevisitorbtn').removeClass( 'icon-refresh-animate' );
            },
            complete: function () {
                $('#realtimevisitorbtn').removeClass( 'icon-refresh-animate' );
                progressfunction(0);
            }
        });
    }


</script>
@endpush
