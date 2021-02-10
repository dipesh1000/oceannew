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
                <div class="statbox widget box box-shadow mb-3">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add New {{ $postType->title }}</h4>

                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area text-center">

                        <div class="row">
                            <div class="col-sm-6">
                                <nav class="breadcrumb-two" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><a href="{{ route('admin.post', $postType->slug) }}">{{ $postType->title }}</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Index</a></li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('admin.post.create', $postType->slug) }}" class="btn btn-sm btn-success float-right">Add New {{ $postType->title }} </a>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Modify Date</th>
                                <th class="no-content">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td> @if($post->status == "Active" ) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
                                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                <td>{{ $post->updated_at->format('Y-m-d') }}</td>

                                <td>
                                    <a href="{{ route('admin.post.edit',[$postType->slug, $post->slug]) }}" title="Edit" class="badge badge-success"> <i data-feather="edit"></i></a>
                                    <a href="{{ route('admin.post.delete', [$postType->slug, $post->slug]) }}" title="Delete" class="badge badge-dark warning confirm"><i data-feather="archive"></i></a>

                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <tr>
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Modify Date</th>
                                <th class="no-content">Action</th>
                            </tr>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script src="{{ asset('cork/plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('cork/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cork/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<script>
    $('#zero-config').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });
</script>

<script>


        $('.widget-content .warning.confirm').on('click', function (event ) {
            $this = $(this);
            event.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.location.href = $this.attr('href');
                }
            })
        })
</script>

@endpush
