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
                    <a href="#" class="link open-team-deatil" data-teamid="{{ $our_team['id'] }}" data-teamname="{{ $our_team['title'] }}" data-teamimage="{{asset('/front')}}/images/pages/{{ $our_team['image'] }}" data-teamdesc="{{ $our_team['description'] }}"><i class="icon-link"></i></a>
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

<!--Team decription -->
<div class="modal fade" id="teamDescription" role="dialog" aria-labelledby="teamDescriptionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title text-center" id="myModalLabel">More About Samip Subedi</h4>
            </div>
            <div class="modal-body">
                <center>
                    <img src="" name="aboutme" width="140" height="140" border="0" class="img-circle teamImageHolder"></a>
                    <h3 class="media-heading"></h3>
                </center>
                <hr>
                <center>
                <p class="text-left team-bio"><br>
                </center>
            </div>
            <div class="modal-footer text-center d-flex flex-column">
                <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about Samip</button>
            </div>
        </div>
    </div>
</div>
<!--Team description end-->
@endsection

@section('page_specific_js')
<script>
    $('.open-team-deatil').on('click', function(e) {
        e.preventDefault();
        var teamid = $(this).data("teamid"); // returns id
        var teamname = $(this).data("teamname"); // returns name
        var teamimg = $(this).data("teamimage"); // returns image
        var teamdesc = $(this).data("teamdesc"); // returns description
        
        // Set values to modal content
        $('#teamDescription .teamImageHolder').attr("src",teamimg);
        $('#teamDescription .media-heading').text(teamname);
        $('#teamDescription .team-bio').html('<strong>Bio: </strong><br>' +teamdesc);

        // Open modal with related information
        $('#teamDescription').modal('show');
    });
</script>
@endsection
