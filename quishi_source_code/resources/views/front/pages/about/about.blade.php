@extends('front.layout.master')
@section('content')
<div class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="about-content-top">
                    <p>{{ $about->title }}</p>
                </div>
                <div class="about-content">
                    <p>{{ $about->content }}</p>
                </div>

                <!-- <div class="about-slogan" style="background: url(images/blog2.jpg) no-repeat;">
                    Motivation is the first step of success
                </div> -->
            </div>

            <div class="col-md-6">
                <div class="about-image">
                    <img src="{{asset('/front')}}/images/pages/{{$about_image->meta_value}}" alt="career">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about section -->
<div class="our-team">
    <div class="container">
        <h2>Our Team</h2>
        <div class="row">
            @foreach($our_teams as $our_team)

            <div class="col-lg-3 col-md-6">
                <div class="team-section">
                    <img src="{{asset('/front')}}/images/pages/{{ $our_team['image'] }}" style="height: 358px;" alt="">
                    <a href="#" class="link"><i class="icon-link"></i></a>
                    <div class="team-caption">
                        <h4>{{ $our_team['title'] }}</h4>
                        <span>{{ $our_team['position'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
