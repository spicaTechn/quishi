<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('front.inc.head')
</head>
<body>
    @include('front.inc.header')
    <!-- end header -->

    @yield('content')


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('front.inc.footer')
    @yield('page_specific_scripts')
</body>
</html>