<!doctype html>
<html lang="en">
<head>
	<title>{{config('app.name')}} | @yield('title')</title>
    <!-- Required meta tags -->
    @include('front.career-advisor.inc.head')
    @yield('page_specific_css')
</head>
<body>
    @include('front.career-advisor.inc.header')
    <!-- end header -->
    @yield('content')


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('front.career-advisor.inc.footer')


</body>
</html>