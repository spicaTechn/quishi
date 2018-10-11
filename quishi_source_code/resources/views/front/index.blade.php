@extends('front.layout.master')
@section('content')
<div class="banner-bg" style="background: url({{asset('/front/images/banner.jpg')}}) no-repeat center; background-size: cover;">
    <div class="most-search-job">
        <ul>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
        </ul>
    </div>
    <div class="container">
        <div class="search-absolute-content text-center">
            <h1>search</h1>
            <form name="search_career_advisor" id="search_career_advisor" class="search_career_advisor" action="{{URL::to('/career-advisior')}}">
                <div class="search-wrapper">

                    <div class="form-group">
                        <i class="icon-magnifier"></i>
                        <input type="text" name="search_by_job_title" class="form-control" placeholder="Search keyword or title" id="search_by_job_title">
                    </div>
                    <div class="form-group">
                        <i class="icon-location-pin"></i>
                        <input type="text" name="search_by_location"  id="search_by_location" class="form-control search_by_location" placeholder="Location" style="background: #f4f4f4;">
                    </div>

                    <button class="btn btn-transpatent" ><i class="icon-magnifier"></i></button>

                </div>
            </form>
            <p>Your career guide with sincere and honest tales of experiences from professionals around the world.</p>
        </div>
    </div>
</div>
<div class="page-section trending-profiles">
    <div class="container">
        <div class="section-title">
            <h2>trending profiles</h2>
        </div>
        <div class="row">
            @foreach($users_profile as $user_profile)
            <div class="col-lg-4">
                <div class="trending-profiles-section">
                    <div class="profile-image">
                        @if($user_profile->image_path)
                            <img src="{{asset('/front')}}/images/profile/{{ $user_profile->image_path }}">
                        @else
                           <img src="{{asset('/front')}}/images/profile/1.jpg">
                        @endif
                    </div>
                    <div class="profile-desination">
                        <h3>{{ $user_profile->first_name }}</h3>
                        <span>UI/UX Designer</span>
                    </div>

                    <div class="profile-slills">
                        <ul>
                            @foreach($user_profile->user->tags as $user_tag)
                                <li><a href="#">{{$user_tag->title}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="profile-info">
                        <p>{{ str_limit($user_profile->description,70) }}</p>
                    </div>
                    <div class="like-view">
                        <div class="row">
                            <div class="col-sm-6">
                                @csrf
                                <div class="view-section">
                                    <a href="javascript:void(0);" class="total_likes" data-profile-id="{{ $user_profile->user->id }}" id="total_likes">
                                        <i class="icon-like"></i>
                                    </a>
                                    <span class="like{{ $user_profile->user->id }}" id="like" value="{{ $user_profile->user->id }}">
                                        {{ $user_profile->total_likes }} Likes</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-eye"></i></a>
                                    <span>{{ $user_profile->profile_views }} Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-profile">
                        <a href="{{URL::to('/career-advisior').'/'.$user_profile->user->id}}">view profile</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="view-more text-center"><a href="{{URL::to('/career-advisior')}}" class="btn btn-default">view more</a></div>
    </div>
</div>
<!-- trending-profiles -->
<!-- video section -->
<div class="video-section">
    <div class="container">
        <div class="section-title">
            <h2>Your gateway to find a right career</h2>
        </div>
        <div class="circle-animation">
            <div class="btn-play" id="play-video">
                <span class="icon ion-ios-play"></span>
            </div> See How it Works
        </div>
        <div class="modal modal-quishi" id="feature-video">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        @if($home_video)
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ $home_video->content }}" allowfullscreen></iframe>
                        </div>
                        @else
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/1jhkEtvH6s8" allowfullscreen></iframe>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- end video section -->
<div class="page-section the-media">
    <div class="container">
        <div class="section-title">
            <h2>In the Media</h2>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
               @foreach($blog->page_detail as $blog_detail)
               <?php
                $blog_unserialize = unserialize($blog_detail->meta_value);
               ?>
                <div class="col-md-6">
                    <div class="home-blog-section">
                        <div class="blog-image">
                            <img src="{{asset('/front')}}/images/blogs/{{ $blog_unserialize['image'] }}" alt="#">
                        </div>
                        <div class="blog-conten">
                            <h4>{{ $blog->title }}</h4>
                            <span class="time">Eva Marcel on {{ $blog_unserialize['date'] }}</span>
                            <p>{{ str_limit($blog->content,160) }}</p>
                            <a href="{{ url('/blog').'/'.$blog->id }}">Full Story <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
              @endforeach
            @endforeach

        </div>
        <div class="view-more text-center"><a href="{{URL::to('/blog')}}" class="btn btn-default">all blogs</a></div>
    </div>
</div>
<!-- trending-profiles -->
<div class="page-section about-section">
    <div class="container">
        <div class="row">
            @foreach($services as $service)
             @foreach($service->page_detail as $service_icon)
                <div class="col-md-4">
                    <div class="about-inner-section">
                        <div class="about-icon-section">
                            <img src="{{asset('/front')}}/images/pages/{{ $service_icon['meta_value'] }}" alt="expert">
                        </div>
                        <div class="about-content-section">
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->content }}</p>
                            <a href="#">More about our experts <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
             @endforeach
            @endforeach

        </div>
    </div>
</div>
<!-- end about section -->

@endsection

@section('page_specific_js')

<script type="text/javascript">
//feature video modal
    $("#play-video").click(function() {
        //alert("closed");
        $("#feature-video").fadeIn();
    });

    $("#feature-video .close").click(function() {
        $("#feature-video").fadeOut();
    });


$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    //alert("hello");
    $( ".total_likes" ).on( "click", function() {
      var user_profile_id = $(this).attr('data-profile-id');
      var _token          = $("input[name='_token']").val();
      var total_likes     = (parseInt($(".like"+user_profile_id).html())+1);
      //alert(total_likes);
      $.ajax({
              url:"{{url('')}}" + "/career-advisior/" + user_profile_id,
              type:"POST",
              dataType:"json",
              data: {_token:_token,user_profile_id:user_profile_id,total_likes:total_likes},
              success:function(data){
                  //check for the success status only
                  if(data.status == "success"){
                      //insert the data in the modal
                      // alert('success');
                      //$(this).closest('.total_likes').find('.like'+user_profile_id).html(total_likes + " " + "Likes");
                      $('.like'+user_profile_id).html(total_likes+" "+"Likes");

                  }

              },
              error:function(event){
                      console.log('Cannot get the particular team');
              }
          });
    });


});

</script>
@endsection