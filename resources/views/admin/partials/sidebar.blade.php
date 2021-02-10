<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled show" id="dashboard" data-parent="#accordionExample">
                    <li class="active">
                        <a href="#"> Sales </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.analytic') }}"> Analytics </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-layer-group"></i>
                        <span>Category</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="category" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.category') }}"> All Category </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.create') }}"> Add New  </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#video" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-video"></i>
                        <span>Video</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="video" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.video') }}"> All Videos </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.video.create') }}"> Add New  </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="user" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.user') }}"> All Users </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.create') }}"> Add New  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.role') }}"> Role  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.permission') }}"> Permission  </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#book" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-book"></i>
                        <span>Books</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="book" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.book') }}"> All Books </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.book.create') }}"> Add New  </a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="#videopackage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-box"></i>
                        <span>Package</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="videopackage" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.package') }}"> All Packages </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.package.create') }}"> Add New  </a>
                    </li>
                </ul>
            </li>



            @foreach(getPostTypes() as $sidePostType)
                <li class="menu">
                    <a href="#{{ $sidePostType->slug }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            {!! $sidePostType->icon !!}
                            <span>{{ $sidePostType->title }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="{{ $sidePostType->slug }}" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('admin.post',  $sidePostType->slug) }}"> All {{ $sidePostType->title }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.create',  $sidePostType->slug) }}"> Add New  </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.trash',  $sidePostType->slug) }}"> Trash  </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.log',  $sidePostType->slug) }}"> Log  </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.order',  $sidePostType->slug) }}"> Order  </a>
                        </li>
                    </ul>
                </li>

            @endforeach


            <li class="menu">
                <a href="#postType" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-blog"></i>
                        <span>Post Type</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="postType" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.post_type') }}"> All Post Types </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post_type.create') }}"> Add New  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post_type.order') }}"> Post Type Position  </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#customField" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fab fa-intercom"></i>
                        <span>Custom Field</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="customField" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.custom_field') }}"> All Custom Field </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.custom_field.create') }}"> Add New  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post_type.order') }}"> Post Type Position  </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="user" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('admin.user') }}"> All Users </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.create') }}"> Add New  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.role') }}"> Role  </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.permission') }}"> Permission  </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="{{ route('admin.site') }}" class="dropdown-toggle">
                    <div class="">
                        <i class="fab fa-internet-explorer"></i>
                        <span>Site Setting</span>
                    </div>
                </a>
            </li>




        </ul>
        <!-- <div class="shadow-bottom"></div> -->

    </nav>

</div>
<!--  END SIDEBAR  -->
