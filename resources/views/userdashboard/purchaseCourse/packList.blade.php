<div class="row">
    @foreach ($coursesList as $course)
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="course-element">
            <div class="course-element-image">
            <img src="{{ $course->image }}" />
            </div>
            <div class="course-element-details">
                <div class="course-name-divider"></div>
                <div class="course-element-title">
                    {{ $course->title }}
                </div>
                {{-- <div class="course-element-subtitle">
                    {!! substr(strip_tags($course->description), 0 , 40) !!}
                </div> --}}
                <div class="d-flex justify-content-between align-items-baseline">
                {{-- <div class="course-element-price">{{ $course->offer_price }}</div> --}}
                @if($course->type == 'book')
                <a href="{{ route('purchasedCourseBook', $course->id) }}" class="btn-sm btn-primary">View</a>
                @elseif($course->type == 'video')
                <a href="{{ route('purchasedCourseVideo', $course->id) }}" class="btn-sm btn-primary">View</a>
                @else
                <button type="button" class="btn-sm btn-primary packageList" data-id="{{ $course->id }}">View</button>
                @endif
                </div>
            </div>
        </div>
    </div> 
    @endforeach
</div>