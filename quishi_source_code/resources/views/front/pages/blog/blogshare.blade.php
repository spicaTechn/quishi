<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- sharing data setup -->
    <?php
    //checking image of food exit or not
        $ogimage = asset('/front/images/blogs').'/'.$blog_details['image'];


    ?>
	<!-- <meta property="fb:app_id" content="588023938211526" /> -->
    <meta property="og:title"        content="{{ $blog->title }}" />
    <meta property="og:abstract"     content="{{ $blog_details['abstract'] }}" />
    <meta property="og:date"         content="{{ $blog_details['date'] }}" />
    <meta property="og:type"         content="website" />
    <meta property="og:url"          content="{{ URL::to('/blog-share'.'/'.$blog->user_id.'/'.$blog->id) }}" />
    <meta property="og:image"        content="{{ $ogimage }}" />
    <meta property="og:image:width"  content="100%" />
    <!-- <meta property="og:image:height" content="315px" /> -->
    <meta property="og:description"  content="{{ $blog->content }}" />

    <title>{{$site_title}} | {{$page_title}}</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <!-- <link rel="stylesheet" href="{{ asset('/front/css/nice-select.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/front/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/nice-select.css') }}">
    <link rel="icon" href="{{ asset('/front/images/fav-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/fonts.css') }}">
</head>
<body>

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
                    <li class="nav-item"><a href="{{URL::to('/blog')}}" class="nav-link">{{ __('Blog')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/about')}}" class="nav-link">{{ __('About')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/contact')}}" class="nav-link">{{ __('Contact')}}</a></li>
                    <li class="nav-item"><a href="{{URL::to('/career-advisior')}}" class="nav-link">{{ __('Profiles')}}</a></li>
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

<div class="blog-single-pg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="blog-single-det">
                    <div class="blog-single-top">

                        <h1>{{ $blog->title }}</h1>
                        <p>{{ $blog_details['abstract'] }}</p>
                    </div>
                    <div class="blog-single-post clearfix">
                        <div class="post-img">
                            <img src="assets_front/images/user-img.png" alt="">
                        </div>
                        <div class="post-date">
                            <ul>
                                <li>Published <b><?php echo abs(date('m')-(Carbon\Carbon::parse($blog_details['date'])->format('m'))); ?> months ago</b> on
                                    <time><b>{{ $blog_details['date'] }}</b></time>
                                </li>
                                <li>By: <a href="#" target="_blank">Source Nepal</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-single-img">
                        <img src="{{ asset('/front') }}/images/blogs/{{ $blog_details['image'] }} " alt="" style="width: 100%;">
                    </div>
                    <div class="single-bl-info">
                        <p>{{ $blog->content }}</p>
                    </div>

                    <!-- share this post -->
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
            <div class="main-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Address</h4>
                                <p>{{ $contact_social['address'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Contact</h4>
                                <p>Phone: <a href="callto:{{ $contact_social['phone_number'] }}">{{ $contact_social['phone_number'] }}</a><br>Email: <a href="mailto:quishi@quishi.com">{{ $contact_social['email'] }}</a> <br>
                                <a href="mailto:{{ $contact_social['email'] }}">{{ $contact_social['email'] }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Donate</h4>
                                <div class="donate-image">
                                    <img src="{{asset('/front')}}/images/paypal.png" alt="paypals">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-social-media">
                        <ul>
                            <li><a href="{{ $contact_social['facebook'] }}"><i class="icon-social-facebook"></i></a></li>
                            <li><a href="{{ $contact_social['twitter'] }}"><i class="icon-social-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <div class="copyright text-center">
                        &copy; 2018 Quishi. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('/front/js/jquery-nice-select.min.js') }}"></script>
<script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<!-- <script src="{{ asset('/front/js/jquery.nice-select.min.js') }}"></script> -->
<script src="{{ asset('/front/js/custom.js') }}"></script>
<script src="{{ asset('/front/js/app.js') }}"></script>


</body>
</html>