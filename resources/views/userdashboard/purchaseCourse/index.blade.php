@extends('frontend.layouts.app')
@section('content')
<div id="allcourses_page">
    <div class="row no-gutters">
        @include('userdashboard.partials.side-nav')
        <div class="col-md-8 col-lg-9">
            <div class="allcourses_content_bar">
                <div class="d_breadcrumb">
                  <ul>
                    <li>
                      <a href=""> Home </a>
                    </li>
                    <li>/</li>
                    <li class="active">
                      <a href="all-courses.html">
                        <span>All Courses</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            <div class="course_container">  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="allcourses-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="courseData">
                                        @if (count($coursesList) > 0)
                                            @include('userdashboard.purchaseCourse.packList')
                                        @endif  
                                    </div>
                                    {{ $coursesList->links() }}
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
<script>
     $(document).on("click", ".packageList", function (e) {
            e.preventDefault();
            var $this = $(this);
            var courseId = $this.attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                dataType: "html",
                type: "GET",
                url: "/courses/package/" + courseId,
                data: {
                    courseId: courseId
                },
                // beforeSend: function () {
                //     $this.prop('disabled', true);
                // },
                success: function (data) {
                    console.log(data);
                    $("#courseData").html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                    // location.reload();
                }
            });

        });
</script>
@endpush