@extends('frontend.layouts.app')
@section('content')
<div id="dashboard_page">
    <div class="row no-gutters">
        @include('userdashboard.partials.side-nav')
        <div class="col-md-8 col-lg-9">
            @include('userdashboard.partials.breadcum')
            <div class="d_widget_container_box course_container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="d_widget_container widget_1"> 
                        <h1>{{ counter('\App\Model\SavedCourse') }}</h1>
                        Total Saved Course
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d_widget_container widget_2"> 
                        <h1>{{ counter('\App\Model\MasterOrder') }}</h1>
                        Total Buy Course
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="notification_container">
                        <div class="n_header">
                            Notification
                        </div>
                        <div class="n_list">
                            <div class="n_list_icon">
                                <a href="">
                                    <li>
                                        <i class="far fa-calendar"></i>
                                    </li>
                                </a>
                            </div>
                            <div class="n_list_text">
                                <div class="n_list_name">
                                    Maryam Amiri
                                </div>
                                <div>
                                    Check New Admin Dashboard..
                                </div>
                                <div>
                                    Just Now
                                </div>
                            </div>
                        </div>
                        <div class="n_list">
                            <div class="n_list_icon">
                                <a href="">
                                    <li>
                                        <i class="far fa-calendar"></i>
                                    </li>
                                </a>
                            </div>
                            <div class="n_list_text">
                                <div class="n_list_name">
                                    Maryam Amiri
                                </div>
                                <div>
                                    Check New Admin Dashboard..
                                </div>
                                <div>
                                    Just Now
                                </div>
                            </div>
                        </div>
                        <div class="n_list">
                            <div class="n_list_icon">
                                <a href="">
                                    <li>
                                        <i class="far fa-calendar"></i>
                                    </li>
                                </a>
                            </div>
                            <div class="n_list_text">
                                <div class="n_list_name">
                                    Maryam Amiri
                                </div>
                                <div>
                                    Check New Admin Dashboard..
                                </div>
                                <div>
                                    Just Now
                                </div>
                            </div>
                        </div>
                        <div class="n_list">
                            <div class="n_list_icon">
                                <a href="">
                                    <li>
                                        <i class="far fa-calendar"></i>
                                    </li>
                                </a>
                            </div>
                            <div class="n_list_text">
                                <div class="n_list_name">
                                    Maryam Amiri
                                </div>
                                <div>
                                    Check New Admin Dashboard..
                                </div>
                                <div>
                                    Just Now
                                </div>
                            </div>
                        </div>
                        <div class="n_list">
                            <div class="n_list_icon">
                                <a href="">
                                    <li>
                                        <i class="far fa-calendar"></i>
                                    </li>
                                </a>
                            </div>
                            <div class="n_list_text">
                                <div class="n_list_name">
                                    Maryam Amiri
                                </div>
                                <div>
                                    Check New Admin Dashboard..
                                </div>
                                <div>
                                    Just Now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            {{-- <div class="course_container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image_container">
                                    <a href="">
                                        <img class="img-fluid" src="img/pic2.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="image_container">
                                    <img class="img-fluid" src="img/pic2.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="image_container">
                                    <img class="img-fluid" src="img/pic2.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="image_container">
                                    <img class="img-fluid" src="img/pic2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="notification_container">
                            <div class="n_header">
                                Notification
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a href="">
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a href="">
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a href="">
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a href="">
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                            <div class="n_list">
                                <div class="n_list_icon">
                                    <a href="">
                                        <li>
                                            <i class="far fa-calendar"></i>
                                        </li>
                                    </a>
                                </div>
                                <div class="n_list_text">
                                    <div class="n_list_name">
                                        Maryam Amiri
                                    </div>
                                    <div>
                                        Check New Admin Dashboard..
                                    </div>
                                    <div>
                                        Just Now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
@endsection