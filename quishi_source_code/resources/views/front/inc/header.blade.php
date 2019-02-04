
<header class="inner-header">
    <div class="login-menu login-menu-xs">
        <ul>
            @if(!Auth::check())
            <li class="nav-item @if(Request::is('login*')) {{ 'active'}}@endif"><a href="{{route('login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
            <li class="nav-item @if(Request::is('register*')) {{ 'active'}}@endif"><a href="{{route('register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
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
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('/front/images/logo.png')}}" class="img-fluid"></a>
            <!-- <a class="navbar-brand navbar-for-xs" href="{{URL::to('/')}}"><img src="{{asset('/front/images/mobile-logo.png')}}" class="img-fluid"></a> -->
            <button class="navbar-toggler">
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
            </button>

            <!-- <div class="mobile-login-btn ">
                <i class="icon-user"></i>
                <span></span>
            </div> -->

            <div class="login-menu login-menu-mobile static-login-menu">
                <ul>
                    @if(!Auth::check())
                    <li class="nav-item @if(Request::is('login*')) {{ 'active'}}@endif"><a href="{{route('login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
                    <li class="nav-item @if(Request::is('register*')) {{ 'active'}}@endif"><a href="{{route('register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
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

                  <h4>Main Menu</h4>      


            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{URL::to('/career-advisor')}}" class="nav-link {{Request::is('career-advisior*') ? 'active ' : '' }}">{{ __('Profiles')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/blog')}}" class="nav-link {{Request::is('blog*') ? 'active ' : '' }}">{{ __('Blog')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/forums')}}" class="nav-link {{Request::is('forums*') ? 'active ' : '' }}">{{ __('Forum')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link {{Request::is('about*') ? 'active ' : '' }}">{{ __('About')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link {{Request::is('contact*') ? 'active ' : '' }}">{{ __('Contact')}}</a></li>
                    @if(Auth::user())
                    @if(Auth::user()->notifications()->count() > 0)
                    <li class="nav-item notification-box  @if(Auth::user()->notifications()->where('seen_flag','0')->count() > 0) {{ '_all_not_seen'}} @endif"><a href="#" class="nav-link"><i class="fa fa-globe"></i> @if(Auth::user()->notifications()->where('seen_flag','0')->count() > 0)  <span class="badge">{{Auth::user()->notifications()->where('seen_flag','0')->count()}} @endif</span></a>
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
                                @endforeach
                                <!-- end notification item -->
                            </ul>
                            </div>       
                        </div>
                    </li>
                      @endif
                @endif
                   
                </ul>
            </div>
            <div class="login-menu login-menu-sm">
                <ul>
                    @guest
                        <li class="nav-item @if(Request::is('login*')) {{ 'active'}} @endif"><a href="{{asset('/login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
                        <li class="nav-item @if(Request::is('register*')) {{ 'active'}} @endif"><a href="{{asset('/register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
                        
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
                                    @if(Auth::user()->sign_in_type == "0")
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
<script>
    var SITE_URL  = "{{URL::to('/')}}";
</script>
<!-- end header -->
