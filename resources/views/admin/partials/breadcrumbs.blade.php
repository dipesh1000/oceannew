<div class="statbox widget box box-shadow">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>{{ ucfirst($type=="index"?'':$type) }} {{ ucfirst($type=='index'?$label.' List':$label) }}</h4>

            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area text-center">

        <div class="row">
            <div class="col-sm-6">
                <nav class="breadcrumb-two" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.'.$route) }}">{{ ucfirst($label) }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ ucfirst($type??'') }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-6">
                @if(isset($type) && $type=='index')
                    <a href="{{ route('admin.'.$route.'.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
                    @else
                    <a href="{{ route('admin.'.$route) }}" class="btn btn-sm btn-success float-right">Back To {{ $label }} List</a>
                @endif
            </div>
        </div>

    </div>
</div>