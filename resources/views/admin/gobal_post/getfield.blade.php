
@foreach($customFields as $customField)
    @if($customField->field_position == $position)
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ $customField->title }}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @foreach($customField->childrens as $filed)
                    @if($filed->field_type)
                        @php
                            $filedContent = unserializeCustomFeild($filed->post_content);
                        @endphp
                        @include('admin.gobal_post.field.'.$filed->field_type)

                    @endif

                @endforeach
            </div>
        </div>
        @endif



    @endforeach
