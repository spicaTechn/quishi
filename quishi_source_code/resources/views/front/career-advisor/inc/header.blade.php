
<header class="inner-header">
    <div class="login-menu login-menu-xs">
        <ul>
            <li class="nav-item"><a href="{{route('login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
            <li class="nav-item"><a href="{{route('register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
        </ul>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('/front/images/logo.png')}}" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="" class="nav-link">{{ __('Blog')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link">{{ __('About')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link">{{ __('Contact')}}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">{{ __('Profiles')}}</a></li>
                </ul>
            </div>
            <div class="login-menu login-menu-sm">
                <ul>
                    @guest
                        <li class="nav-item"><a href="{{asset('/login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a></li>
                        <li class="nav-item"><a href="{{asset('/register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a></li>
                        
                    @else
                        @if( Auth::user()->user_profile()->count() > 0 && Auth::user()->user_profile->image_path != '')
                            <li class="nav-item logdin"><a href="{{(Auth::user()->logged_in_type == 1) ? route('admin.dashboard') : route('profile')}}" class="nav-link"><img src="{{  asset('/front/images/profile/').'/'.Auth::user()->user_profile->image_path }}"> Hi {{ucwords(auth()->user()->name) }} </a></li>
                        @else
                            <li class="nav-item logdin"><a href="{{(Auth::user()->logged_in_type == 1) ? route('admin.dashboard') : route('profile')}}" class="nav-link"><img src="{{ asset('/front//images/blog1.jpg')}}"> Hi {{ ucwords(auth()->user()->name) }} </a></li>
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
        <div class="profile-sidemenu">
            <ul>
                <li class="{{ Request::is('profile') ? 'active' : ''}}"><a href="{{route('profile')}}"> <i class="ti-dashboard"></i> Dashboard</a></li>
                <li class="{{ Request::is('profile/answers*') ? 'active' : '' }}"><a href="{{url('/profile/answers')}}"><i class="ti-write"></i> My answers</a></li>
                <li class="{{ Request::is('profile/reviews*') ? 'active' : '' }}"><a href=" {{url('/profile/reviews')}} "><i class="ti-comment-alt"></i> Admin reviews<span class="badge badge-pill badge-danger">{{ Auth::user()->reviews()->count() }}</span></a></li>
                <li><a href="#"><i class="ti-user"></i> My account</a></li>
                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-user"></i> Logout</a><form id="logout-form" method="post" action="{{route('logout')}}" style="display:none;">{{csrf_field()}}</form></li>
            </ul>
        </div>