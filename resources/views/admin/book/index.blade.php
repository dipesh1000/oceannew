@extends('admin.partials.master')

@push('styles')
<link href="{{ asset('cork/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('cork/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/dflip/css/dflip.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dflip/css/themify-icons.css') }}">

@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div id="breadcrumbArrowed" class="col-xl-12 col-lg-12 layout-top-spacing mb-3">
                @include('admin.partials.breadcrumbs', ['type'=>'index', 'label'=>'Book', 'route'=>'book'])
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sn</th>
                                <th width="20%">Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="10%">Book Type</th>
                                <th width="20%" class="no-content">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->category?$book->category->title:"" }}
                                    @if($book->price == 0) <span class="badge badge-info">Library</span> @endif
                                </td>
                                <td class="text-left">
                                    <span><img src="{{ asset($book->image) }}" width="50" ></span>
                                </td>
                                <td> @if($book->status == "Active" ) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
                                <td> @if($book->digital_or_hardcopy == "Both" ) <span class="badge badge-success">Digital & Hardcopy</span> @else <span class="badge badge-primary">{{ $book->digital_or_hardcopy }}</span> @endif</td>
                                <td>
                                    <a href="#" class="_df_button badge badge-primary" source="{{ $book->book }}"> <i data-feather="eye"></i></a>
                                    {{-- <a target="_blank" href="{{ route('admin.book.show', $book->id) }}" title="Edit" class="badge badge-primary"> <i data-feather="eye"></i></a> --}}
                                    <a href="{{ route('admin.book.edit', $book->id) }}" title="Edit" class="badge badge-success"> <i data-feather="edit"></i></a>
                                    <a href="{{ route('admin.book.delete', $book->id) }}" title="Delete" class="badge badge-dark warning confirm"><i data-feather="archive"></i></a>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Book Type</th>
                                <th class="no-content">Action</th>
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
<script src="{{ asset('assets/dflip/js/dflip.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}" defer></script>
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
