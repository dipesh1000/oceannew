@extends('admin.partials.master')

@push('styles')

<style>
    td{
        cursor: all-scroll;
    }
</style>
@endpush

@section('contents')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Post Type Ordering </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Position</th>
                                <th>Icon</th>
                            </tr>
                            </thead>
                            <tbody class="row_position">
                            @foreach($postTypes as $postType)
                                <tr id="{{ $postType->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $postType->title }}</td>
                                    <td>{{ $postType->slug }}</td>
                                    <td>{{ $postType->position }}</td>
                                    <td>{!! $postType->icon !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <tr>
                                <th>Sn</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Position</th>
                                <th>Icon</th>
                            </tr>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <a href="{{ route('admin.post_type.order') }}" class="btn btn-sm btn-danger" id="order-btn">Reload..</a>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">


    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        console.log(data);
        var myUrl = "{{ route('admin.post_type.order.store') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: myUrl,
            data: {position:data},
            beforeSend: function (result) {
                $('#order-btn').hide();
            },
            success: function (result) {
                $('#order-btn').show();
            },
            error: function (result) {
                $('#order-btn').show();
            }
        });
    }





</script>
@endpush
