<div class="col-md-4 col-lg-3">
    <div class="dashboard_navbar">
        <div class="d_user">
            <div class="image_container">
            <img src="{{ $users->image ?? asset('assets/img/user.png')}}" alt="">
            </div>
            <div class="user_name">
                {{ getProfileDetails('email') ?? ''}}
            </div>
            <span>
                {{ getProfileDetails('address') ?? ''}}
            </span>
        </div>
        <div class="d_navigation">
            <ul>
                <li class="{{ (request()->is('userdashboard')) ? 'active' : '' }}">
                <a href="{{ route('userDashboard') }}">
                        <i class="far fa-user"></i> Dashboard
                    </a>
                </li>
                <li class="{{ (request()->is('profile')) ? 'active' : '' }}">
                <a href="{{ route('userProfile') }}">
                        <i class="far fa-user"></i> My Profile
                    </a>
                </li>
                <li class="{{ (request()->is('save-course-later')) ? 'active' : '' }}">
                    <a href="{{ route('saveCourseLater') }}">
                        <i class="far fa-user"></i> Saved Courses
                    </a>
                </li>
                <li class="{{ (request()->is('courses')) ? 'active' : '' }}">
                    <a href="{{ route('purchasedCourse') }}">
                        <i class="far fa-user"></i> All Courses
                    </a>
                </li>
                {{-- <li>
                    <a href="">
                        <i class="far fa-user"></i> My Order
                    </a>
                </li> --}}
                <li class="{{ (request()->is('paymentHistory')) ? 'active' : '' }}">
                    <a href="{{ route('paymentHistory') }}">
                        <i class="far fa-user"></i> History
                    </a>
                </li>
                {{-- <li>
                    <a href="">
                        <i class="far fa-user"></i> Reviews
                    </a>
                </li> --}}
                <li>
                    {{-- <a href="">
                        <i class="far fa-user"></i> Logout
                    </a> --}}
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="far fa-user"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>