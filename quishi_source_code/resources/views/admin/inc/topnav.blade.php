
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="#" class="dashboard-logo">
                            <img class="img-fluid" src="{{ asset('/admin_assets/assets/images/logo.png') }}" alt="{{$site_title}}"/>
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            
                            
                            <li class="user-profile header-notification">
                                <a href="#!">
                                        <img src="{{asset('/admin_assets/assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                        <i class="ti-angle-down"></i>
                                    </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="{{url('/admin/userProfile')}}">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                    </li>
                                    
                                   
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
            
        