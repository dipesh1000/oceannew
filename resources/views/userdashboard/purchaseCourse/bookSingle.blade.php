@extends('frontend.layouts.app')
@section('content')
<style>
    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width:240px;
        height:360px;
        opacity: 0;
        transition: .3s ease;
        background-color: grey;
    }

    .image_container:hover .overlay {
        opacity: 0.7;
    }

    .icon {
        color: white;
        font-size: 100px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .fa-user:hover {
    color: #eee;
    }
    ._df_thumb{
        width:240px;
        height:360px;
    }

</style>
<div id="single_page">
    <div class="detail_header_container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="image_container">
                        <a href="{{ route('pdf_viewer',$book->id) }}">
                            <div class="_df_thumb" id="flipbok_div" thumb={{$book->image}}></div>
                        </a>
                            {{-- <img class="img-fluid" src="{{ $book->image }}" alt="{{ $book->title }}"> --}}
                        {{-- <div class="overlay">
                            <a href="{{ route('pdf_viewer',$book->id) }}" class="icon" title="Read Book">
                              <i class="fa fa-eye viewBook" data-id="{{$book->id}}"></i>
                            </a>
                        </div> --}}
                    </div>
                    {{-- <div class="p-5 text-right">
                        <div class="_df_button" source="{{ $book->book }}"> Read Book</div>
                    </div> --}}
                </div>
                <div id="player"></div>
                <div class="col-md-8">
                    <div class="course_detail_container">
                        <div class="header">
                            {{ $book->title }}
                        </div>
                        <div class="description">
                            {!! $book->description !!}
                        </div>
                        <div class="review">
                            <i class="text-primary {{ $avgRating >= 1 ? 'fa fa-star' : 'far fa-star' }}"></i> <span>{{ $avgRating }} Reviews</span> 
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="course_container">

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="course_content_container">
                    <div class="course_content_header">
                        Table Of Content
                    </div>
                    <div class="course_module_container">

                        <div class="module_header">
                            {!! $book->table_of_content !!}
                        </div>
                    </div>
                </div>
    
                <div class="course_content_container">
                    <div class="course_content_header">
                        Course Description
                    </div>
                    <div class="course_module_container">
                        <div class="course_description_container">
                        <div>{!! $book->description !!}</div>
                        </div>                      
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="course_content_container">
                    <div class="course_content_header">
                        Feed Back
                    </div>
                        <div class="course_module_side_container">
                        @if($review == null)
                        <p class="text-center font-weight-bold pt-2">Please give us your feedback</p>
                        <form action="{{ route('feedback.store') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="courseId" value="{{ $book->id }}">
                            <input type="hidden" name="name" value="{{ $book->type }}">
                            <div class="rating"> 
                                <input type="radio" name="rating" value="5" id="5">
                                <label for="5">☆</label> 
                                <input type="radio" name="rating" value="4" id="4">
                                <label for="4">☆</label>
                                <input type="radio" name="rating" value="3" id="3">
                                <label for="3">☆</label> 
                                <input type="radio" name="rating" value="2" id="2">
                                <label for="2">☆</label> 
                                <input type="radio" name="rating" value="1" id="1">
                                <label for="1">☆</label>
                            </div>
                            <div class="p-2">
                                <textarea name="review" id="review" class="form-control" required></textarea>
                            </div>
                            <div class="p-2 text-right">
                                <button type="submit" value="submit" class="btn-sm btn-outline-primary">Submit</button>
                            </div>
                        </form>
                        @else 
                        <div class="row">
                            <div class="col-md-9">
                                <p class="text-center font-weight-semi-bold pt-2">
                                    {{ $review->star }}☆ {{ $review->review }}
                                </p>
                            </div>
                            <div class="col-md-3 align-self-center">
                                <button type="button" class="btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                                    Edit
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('feedback.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="feedback_id" value="{{$review->id}}">
                                        <input type="hidden" name="courseId" value="{{ $book->id }}">
                                        <input type="hidden" name="name" value="{{ $book->type }}">
                                        <div class="rating"> 
                                            @for($i=5; $i>0; $i--) 
                                                <input type="radio" name="rating" value="{{$i}}" id="{{$i}}"
                                                    @if($review->star == $i) checked @endif>
                                                <label for="{{$i}}">☆</label>     
                                            @endfor
                                        </div>
                                        <div class="p-2">
                                            <textarea name="review" id="review" value="{{ $review->review }}" class="form-control" required>{{ $review->review }}</textarea>
                                        </div>
                                        <div class="p-2 text-right">
                                            <button type="submit" value="submit" class="btn-sm btn-outline-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endif
                        </div>

                    <div class="course_content_header">
                        Provided By
                    </div>

                    <a href="">
                        <div class="course_module_side_container">
                            <div class="side_container_logo">
                                <img src="{{ getSiteSetting('logo') ?? '' }}" alt="…"> Ocean Publication
                            </div>
                            
                        </div>
                    </a>
                    
                </div>

            </div>

        </div>
    </div>


    </div>


</div>


@endsection
@push('scripts')    
    
    <script type="text/javascript">
    $('#flipbok_div').on('click',function(e){
        e.preventDefault();
        window.location.href = $(this).closest('a').attr('href');
    })
        // window.onload = function(){
        //     document.getElementById('flipbok_div').removeAttribute("source");
        // }
        // $('#flipbok_example').removeAttr('source');
    </script>

@endpush
