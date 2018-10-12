<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    @include('front.inc.head')
    @yield('page_specific_css')
</head>
<body>
    @include('front.inc.header')
    <!-- end header -->

    @yield('content')


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('front.inc.footer')

  

</body>
</html>