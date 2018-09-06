<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('inc.head')
</head>
<body>
    @include('inc.header')
    <!-- end header -->

    @yield('content')


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('inc.footer')
</body>
</html>