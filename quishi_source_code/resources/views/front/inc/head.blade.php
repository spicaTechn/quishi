<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$site_title}} | {{$page_title}}</title>

    <!-- sharing data setup -->
    <?php if(isset($blog)): ?>
    <?php if(Request::path()=='blog'.'/'.$blog->id): ?>
        <!-- checking image of food exit or not -->
        <?php $ogimage = asset('/front/images/blogs').'/'.$blog_details['image'];?>
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

    <?php endif; ?>
    <?php endif; ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <!-- <link rel="stylesheet" href="{{ asset('/front/css/nice-select.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/front/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/nice-select.css') }}">
    <link rel="icon" href="{{ asset('/front/images/fav-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/css/fonts.css') }}">
     <!-- Load the sweetalert css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
    <!--Select 2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">
