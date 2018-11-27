
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
                    <li class="nav-item"><a href="{{URL::to('/blog')}}" class="nav-link {{Request::is('blog*') ? 'active ' : '' }}">{{ __('Blog')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link {{Request::is('about*') ? 'active ' : '' }}">{{ __('About')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link {{Request::is('contact*') ? 'active ' : '' }}">{{ __('Contact')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/career-advisor')}}" class="nav-link {{Request::is('career-advisior*') ? 'active ' : '' }}">{{ __('Profiles')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/forums')}}" class="nav-link {{Request::is('forums*') ? 'active ' : '' }}">{{ __('Forum')}}</a></li>
                </ul>
            </div>
            <div class="login-menu login-menu-sm">
                <ul>
                    @guest
                        <li class="nav-item"><a href="{{asset('/login')}}" class="nav-link"> {{ __('Log In')}} <i class="icon-power"></i></a></li>
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
