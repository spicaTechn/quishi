
<header class="inner-header">
    <div class="login-menu login-menu-xs">
        <ul>
            <li class="nav-item"><a href="#" class="nav-link"> Sign In <i class="icon-power"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"> Sign Up <i class="icon-user"></i></a></li>
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
                    <li class="nav-item"><a href="" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Profiles</a></li>
                    <!--  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">construction</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="login-menu login-menu-sm">
                <ul>
                    @guest
                        <li class="nav-item"><a href="{{asset('/login')}}" class="nav-link"> Sign In <i class="icon-power"></i></a></li>
                        <li class="nav-item"><a href="{{asset('/register')}}" class="nav-link"> Sign Up <i class="icon-user"></i></a></li>
                        
                    @else
                        <li class="nav-item logdin"><a href="#" class="nav-link"><img src="{{asset('/front')}}/images/blog1.jpg"> Hi {{auth()->user()->name}} </a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- end header -->