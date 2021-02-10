@extends('frontend.layouts.app')
@section('content')
<style>
    .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 2vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}
</style>

<div id="single_page">

    <!-- <div class="banner_container">
        <div class="text_container">
            <div>
                Introduction to Math 
            </div>
            <div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda mollitia praesentium necessitatibus quo asperiores.
            </div>
            <div>
                <a href="">
                    Start Course
                </a>
            </div>
            
        </div>
        <div class="background_gradient"></div>
        <div class="background_image_container"></div>

    </div> -->

    <div class="detail_header_container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="image_container">
                        <img class="img-fluid" src="{{ $video->image }}" alt="{{ $video->title }}">
                    </div>
                    <div class="p-5 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-play-circle" aria-hidden="true"></i> Play Video
                          </button>
                    </div>
                </div>
                <div id="player"></div>
                <div class="col-md-8">
                    <div class="course_detail_container">
                        <div class="header">
                            {{ $video->title }}
                        </div>
                        <div class="description">
                            {!! $video->description !!}
                        </div>
                        <div class="review">
                            <i class="far fa-star"></i> <span>4.7 Reviews</span> 
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
                            {!! $video->table_of_content !!}
                        </div>
                        {{-- <div class="module_list">
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Introduction
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="">
                                    <div>
                                        <i class="fas fa-video"></i>Intro to chapter 1
                                    </div>
                                    <div>
                                        4m    
                                    </div>
                                </a>
                            </div>
                        </div> --}}

                    </div>
                </div>
    
                <div class="course_content_container">
                    <div class="course_content_header">
                        Course Description
                    </div>
                    <div class="course_module_container">
                        <div class="course_description_container">
                        <div>{!! $video->description !!}</div>
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
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <p class="text-center font-weight-bold pt-2">Please give us your feedback</p>
                            <form action="{{ route('feedback.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="courseId" value="{{ $video->id }}">
                                <input type="hidden" name="name" value="{{ $video->type }}">
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

  
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <div style="position:relative; overflow:hidden; padding-bottom:56.25%"> <iframe src="https://cdn.jwplayer.com/players/{{$video->video}}-Fy9ggf0s.html" width="100%" height="100%" frameborder="0" scrolling="auto" title="Test Video" style="position:absolute;" allowfullscreen></iframe> </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('scripts')
<script type="text/javascript">
        function UpdateMiniCart() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.mini')  }}",
                beforeSend: function (data) {
                    //
                },
                success: function (data) {
                    $('#mini-cart').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //
                },
                complete: function () {
                    //
                }
            });
            }
        function sweetAlert(type, title, message) {
            swal({
                title: title,
                html: message,
                type: type,
                confirmButtonColor: '#ee3d43',
                timer: 20000
            }).catch(swal.noop);
        }
       
    
</script>
@endpush
