
<header class="inner-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('/front/images/logo.png')}}" class="img-fluid"></a>
            <button class="navbar-toggler">
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
            </button>

            <div class="login-menu login-menu-mobile static-login-menu">
                <ul>
                    @if(!Auth::check())
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
                    <li class="nav-item"><a href="{{route('register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
                    @endif

                <!-- if user is logdin -->
                        @if(Auth::check())
                        <li class="nav-item dropdown logdin">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               @if( Auth::user()->user_profile()->count() > 0 && Auth::user()->user_profile->image_path != '')
                                 <img src="{{  asset('/front/images/profile/').'/'.Auth::user()->user_profile->image_path }}"> Hi {{ucwords(auth()->user()->name) }}
                                @else
                                      <img src="{{  asset('/front/images/profile/blog1.jpg')}}"> Hi {{ucwords(auth()->user()->name) }}
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                               <li><a class="dropdown-item" href="{{route('profile.my-account.change-password')}}"> {{ __('Change Password') }}</a></li>
                               <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a><form id="logout-form" method="post" action="{{route('logout')}}" style="display:none;">{{csrf_field()}}</form></li>
                            </ul>
                        </li>
                    @endif
                                  
                </ul>

                  <h4>My Menu</h4>      


            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{URL::to('/career-advisor')}}" class="nav-link">{{ __('Profiles')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/blog')}}" class="nav-link">{{ __('Blog')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/forums')}}" class="nav-link {{Request::is('forums*') ? 'active ' : '' }}">{{ __('Forum')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link">{{ __('About')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link">{{ __('Contact')}}</a></li>
                    @if(Auth::user()->notifications()->count() > 0)
                    <li class="nav-item notification-box"><a href="#" class="nav-link"><i class="fa fa-globe"></i>@if(Auth::user()->notifications()->where('seen_flag','0')->count() > 0) <span class="badge">{{Auth::user()->unreadNotifications()->where('seen_flag','0')->count()}}@endif</span></a>
                        <div class="notification-list">
                            <div class="notification-title">
                                <span>{{ __('Notification') }} </span><a href="#" class="_quishi_mark_as_read @if(Auth::user()->unreadNotifications()->count() <= 0) {{ 'no_unread_notification' }} @endif">{{ __('Mark as read') }}</a>
                            </div>
                            <div class="notification-inner-list">
                            <ul>
                                @foreach(Auth::user()->notifications as $notifications)
                                <li class="notification-list-item">
                                    <a href="{{ $notifications->data['url'] }}" class="_quishi_mark_as_read_notification @if($notifications->read_at != '') ? {{ 'mark-as-read' }} : {{ ''}} @endif" data-notification-id="{{$notifications->id }}">

                                        <div class="notification-image">
                                             <img src="{{ $notifications->data['user_image'] }}" alt="#">
                                        </div>
                                        <div class="notification-content">
                                            {!! ucfirst($notifications->data['message']) !!}
                                        </div>
                                    </a>
                                </li>
                                <!-- end notification item -->
                                @endforeach
                            </ul>
                            </div>       
                        </div>
                    </li>
                    @endif
                </ul>

            </div>
            <div class="login-menu login-menu-sm">
                <ul>
                    @guest
                        <li class="nav-item"><a href="{{asset('/login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
                        <li class="nav-item"><a href="{{asset('/register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
                        
                    @else
                        @if( Auth::user()->user_profile()->count() > 0 && Auth::user()->user_profile->image_path != '')
                          
                            <li class="dropdown nav-item logdin">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{  asset('/front/images/profile/').'/'.Auth::user()->user_profile->image_path }}"> Hi {{ucwords(auth()->user()->name) }}</a>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{(Auth::user()->logged_in_type == 1) ? route('admin.dashboard') : route('profile')}}">{{ __('Profile') }}</a></li>
                                    @if(Auth::user()->sign_in_type == '0')
                                    <li><a class="dropdown-item" href="{{route('profile.my-account.change-password')}}"> {{ __('Change Password') }}</a></li>
                                    @endif
                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a><form id="logout-form" method="post" action="{{route('logout')}}" style="display:none;">{{csrf_field()}}</form></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown nav-item logdin">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('/front//images/blog1.jpg')}}"> Hi {{ucwords(auth()->user()->name) }}</a>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{(Auth::user()->logged_in_type == 1) ? route('admin.dashboard') : route('profile')}}">{{ __('Profile') }}</a></li>
                                    @if(Auth::user()->sign_in_type == '0')
                                    <li><a class="dropdown-item" href="{{route('profile.my-account.change-password')}}"> {{ __('Change Password') }}</a></li>
                                    @endif
                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a><form id="logout-form" method="post" action="{{route('logout')}}" style="display:none;">{{csrf_field()}}</form></li>
                                </ul>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- end header -->
<div class="my-profile">
    <div class="container">
        <div class="dashboard-toggle">
            <i class="dashboard-line"></i>
            <i class="dashboard-line"></i>
            <i class="dashboard-line"></i>
        </div>
        <div class="profile-sidemenu">

             <div class=" profile-sidemenu--hiden">
            <div class="dashboard-toggle-hide">
                &times;
            </div>
        </div>
            <ul>
                <li class="{{ Request::is('profile') ? 'active' : ''}}"><a href="{{route('profile')}}"> <i class="ti-dashboard"></i> Dashboard</a></li>
                <li class="{{ Request::is('profile/answers*') ? 'active' : '' }}"><a href="{{url('/profile/answers')}}"><i class="ti-write"></i> My answers</a></li>
                <li class="{{ Request::is('profile/reviews*') ? 'active' : '' }}"><a href=" {{url('/profile/reviews')}} "><i class="ti-comment-alt"></i> Admin reviews<span class="badge badge-pill badge-danger">{{ Auth::user()->reviews()->where('status','0')->count() }}</span></a></li>
                <li class="{{Request::is('profile/my-account*') ? 'active' : ''}}"><a  href="{{route('careerAdvisior.my-account.index')}}"><i class="ti-user"></i> My account</a></li>
                <li class="blog-dropdown {{ Request::is('profile/blogs*') ? 'active open' : '' }}" ><a href="#"><i class="ti-pencil-alt"></i>Blogs<i class="ti-angle-right"></i></a>
                    <ul class="blog-dropdown-menu" {{ Request::is('profile/blogs*') ? 'style=display:block;' : '' }} >
                        <li class="{{ Request::is('profile/blogs/index') ? 'active' : '' }}"><a href="{{route('profile.blog.index')}}"><i class="ti-angle-right"></i> All Blogs</a></li>
                        <li class="{{ Request::is('profile/blogs/create') ? 'active' : '' }}"><a href="{{route('profile.blog.create')}}"><i class="ti-angle-right"></i> Add Blog</a></li>
                    </ul>
                </li>
                
                <li  class="{{Request::is('profile/forum*') ? 'active' : ''}}"><a href="{{route('profile.forum.index')}}"><i class="ti-comments"></i>Forum</a></li>
                <li  class="{{Request::is('profile/followers*') ? 'active' : ''}}"><a href="{{route('careerAdviser.followers')}}"><i class="ti-user"></i>Followers</a></li>
                <li  class="{{Request::is('profile/following*') ? 'active' : ''}}"><a href="{{route('careerAdviser.following')}}"><i class="ti-heart"></i>Following</a></li>
            </ul>

            <h4 class="main-menu-xs">Main Menu</h4>
        </div>