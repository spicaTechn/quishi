@extends('front.layout.master')

@section('content')
<div class="banner-bg" style="background: url({{asset('/front/images/banner.jpg')}}) no-repeat center; background-size: cover;">
    <div class="container">
        <div class="search-absolute-content text-center">
            <!-- <h1>{{ __('search') }}</h1> -->
            <form name="search_career_advisor" id="search_career_advisor" class="search_career_advisor" action="{{URL::to('/career-advisor')}}" autocomplete="off">
                <div class="search-wrapper">

                    <div class="form-group">
                        <i class="icon-magnifier"></i>
                        <input type="text" name="search_by_job_title" class="form-control search_by_job_title" placeholder="Job title" id="search_by_job_title">
                        <div class="search-list" style="display: none;" id="_job_title_search_list">
                            <ul>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="icon-location-pin"></i>
                        <input type="text" name="search_by_location"  id="search_by_location" class="form-control search_by_location" placeholder="Location" style="background: #f4f4f4;">
                        <div class="search-list" style="display: none;" id="_location_search_list">
                            <ul>
                                
                            </ul>
                        </div>
                    </div>

                    <button class="btn btn-transpatent" ><i class="icon-magnifier"></i></button>

                </div>
            </form>
            <p>{{ __('Your career guide with sincere and honest tales of experiences from professionals around the world.') }}</p>
        </div>
    </div>
</div>
<div class="page-section trending-profiles">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('trending profiles') }}</h2>
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
                        @foreach($user_profile->user->careers as $user_career)
                            <span>{{ucwords($user_career->title)}}</span>
                        @endforeach
                    </div>

                    <div class="profile-slills">
                        <ul>
                            @foreach($user_profile->user->tags as $user_tag)
                                <li><a href="#">{{ucwords($user_tag->title)}}</a></li>
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
                    <div class="view-profile row">
                        <!-- follows / unfollow -->
                        @if(auth::check())
                            @if($user_profile->user->followers()->where('follower_id',auth::user()->id)->get()->count() >= 1)
                                <a href="javascript:void(0);" class="unfollow_career_advisor" data-following-id="{{$user_profile->user_id}}"> {{ __('Unfollow')}}</a>
                            @else
                                <a href="javascript:void(0);" class="follow_career_advisor" data-following-id="{{$user_profile->user_id}}">{{ __('Follow') }}</a>
                            @endif
                        @else
                            <a href="javascript:void(0);" class="unfollow_career_advisor" data-following-id="{{$user_profile->user_id}}"> {{ __('Follow')}}</a>
                        @endif
                        <a href="{{URL::to('/career-advisor').'/'.$user_profile->user->id}}">{{ __('view profile') }}</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="view-more text-center"><a href="{{URL::to('/career-advisor')}}" class="btn btn-default">{{ __('view more') }}</a></div>
    </div>
</div>
<!-- trending-profiles -->
<!-- video section -->
<div class="video-section">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('Your gateway to find a right career') }}</h2>
        </div>
        <div class="circle-animation">
            <div class="btn-play" id="play-video">
                <span class="icon ion-ios-play"></span>
            </div> {{ __('See How it Works') }}
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
        <div class="page-section quishi-works">
            <div class="container">
                <div class="section-title">
                    <h2>{{ __('How Quishi works for you') }}</h2>
                </div>

                <div class="row">

                    @foreach($services as $service)
                         @foreach($service->page_detail as $service_icon)
                            <div class="col-md-4 how-col">
                                <div class="how-col-image">
                                        <img src="{{asset('/front')}}/images/career-review2.png">
                                </div>
                                    <h4>{{ $service->title }}</h4>
                                    <p>{{ $service->content }}</p>
                            </div>
                         @endforeach
                    @endforeach
                    
                </div>
            </div>
        </div>
<div class="page-section the-media">
    <div class="container">
        @if($blogs->count() > 0) 
        <div class="section-title">
            <h2>{{ __('In the Media') }}</h2>
        </div>
        <div class="row row-news isotopeContainer2">
            @foreach($blogs as $blog)
            <div class="col-lg-3 col-sm-6 isotopeSelector">
                <div class="news-blog-section">
                    <div class="blog-image">
                        @if($blog->image_path != "")
                            <img src="{{asset('/front')}}/images/blogs/{{ $blog->image_path }}" alt="#">
                        @else
                            <img src="{{ asset('/front/images/blogs/1539154047.jpg') }}" alt="" style="">
                        @endif
                    </div>
                    <div class="blog-conten">
                        <h4>{{ $blog->title}}</h4>
                        <span class="time">Published on {{ Carbon\Carbon::parse($blog->published_date)->format('d M Y')}}</span>
                        <p>{{ ($blog->abstract != "") ? substr($blog->abstract,0,150) .'..' : substr($blog->content,0,150) . '...' }}</p>
                        <a href="{{ url('/blog').'/'.$blog->id }}">{{ __('Full Story') }} <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="view-more"><a href="{{URL::to('/media')}}" class="btn btn-default">{{ __('All Media') }}</a></div>
        @endif
    </div>
</div>
<div class="popular-blogs page-section">
    <div class="container">
        @if($popular_blogs->count() > 0) 
        <div class="section-title">
            <h2>{{ __('Popular Blogs') }}</h2>
        </div>
        <div class="row row-news isotopeContainer2">
            @foreach($popular_blogs as $popular_blog)
            <div class="col-lg-3 col-sm-6 isotopeSelector">
                 <div class="news-blog-section">
                    <div class="blog-image">
                        @if($popular_blog->image_path != "")
                            <img src="{{asset('/front')}}/images/blogs/{{ $popular_blog->image_path }}" alt="#">
                        @else
                            <img src="{{ asset('/front/images/blogs/1539154047.jpg') }}" alt="" style="">
                        @endif
                    </div>
                    <div class="blog-conten">
                        <h4>{{ $popular_blog->title }}</h4>
                        <span class="time">Published on {{ Carbon\Carbon::parse($popular_blog->published_date)->format('d M Y')}}</span>
                        <p>{{ ($popular_blog->abstract != "") ? substr($popular_blog->abstract,0,150) .'..' : substr($popular_blog->content,0,150) . '...' }}</p>
                        <a href="{{ url('/blog').'/'.$popular_blog->id }}">{{ __('Full Story') }} <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

         <div class="view-more"><a href="{{URL::to('/blog')}}" class="btn btn-default">{{ __('view Blogs') }}</a></div>

        @endif
    </div>
</div>   


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


    //follow career advisor
    $('body').on('click','.follow_career_advisor', function(e){
        //prevent the default action
        var current_link = $(this);
        e.preventDefault();
        if("{{Auth::check()}}"){
            var following_id = $(this).attr('data-following-id');
            var _token       = "{{csrf_token()}}";
            //make the post request
            $.post("{{url::to('/profile/followCareerAdvisor')}}" + "/" + following_id, {_token}, function(data){
                //check the return data status
                if(data.status == "success"){
                    $(current_link).html('Unfollow');
                    //change the class name 
                    $(current_link).removeClass('follow_career_advisor');
                    $(current_link).addClass('unfollow_career_advisor');
                    //show the swal success message to the career advisor
                    swal({
                        title : "You are now followers of " + " " + data.name,
                        text  : data.message,
                        type  : 'success'
                    })

                }else if(data.status == "failed"){
                    //show the error swal message to career advisor
                    //console.log(data.message);
                    swal({
                        title : "Following Career Advisor Failed!",
                        text  : data.message,
                        type  : 'error'
                    });
                }
                
            });
        }else{
             window.open("{{URL::to('/login')}}","_self");
        }

    });

    //unfollow career advisor
    $('body').on('click','.unfollow_career_advisor',function(e){
        //prevent the default action
        e.preventDefault();
        var current_link   = $(this);
        if("{{Auth::check()}}"){
            var unfollowing_id  = $(this).attr('data-following-id');
            var _token          = "{{csrf_token()}}";
            $.post("{{URL::to('/profile/unfollowCareerAdvisor')}}" + "/" + unfollowing_id , {_token},function(data){

                if(data.status == "success"){
                    //success response
                    $(current_link).html('Follow');
                    //change the class name 
                    $(current_link).removeClass('unfollow_career_advisor');
                    $(current_link).addClass('follow_career_advisor');
                    //show the swal message to the career advisor
                    swal({
                        title: "You unfollow " + " " + data.name,
                        text : data.message,
                        type : 'success'
                    });
                }else if(data.status == "failed"){
                    //handle the failed response
                    //show the swal error message to the career advisor
                    swal({
                        title : 'Unfollowing failed!!',
                        text  : data.message,
                        type  : error
                    })
                }   
            });
        }else{
            window.open("{{URL::to('/login')}}","_self");
        }
        
    });


    //show the autocomplete option when the 
    $('body').on('keyup','.search_by_location',function(e){
        e.preventDefault();
        var search_query   =  $(this).val();
        var _token         = "{{csrf_token()}}";

        //make the post request
        $.post("{{URL::to('/searchByLocation')}}",{q:search_query, _token : _token},function(data){
            if(data.status == "success"){
                var return_lists = "";
                $.each(data.result, function(index,value){
                    return_lists += "<li data-location='" + value.full_address + "'><i class='icon-location-pin'></i>" + value.full_address + "</li>";
                });
                //now append to ul 
                $("#_location_search_list ul").html(return_lists);
                $('#_location_search_list').show();
            }else{
                $('#_location_search_list').hide();
            }
        });
    });
    //trigger the click event

    $('body').on('click','#_location_search_list > ul li', function(e){
       var selected_address   = $(this).data('location');
        $(this).closest('div.form-group').find('input').val(selected_address);
        $('#_location_search_list').hide();
    });


    $('body').click(function(event){
        var $trigger = $("#_location_search_list > ul li");
        if ($trigger !== event.target) {
            $("#_location_search_list").hide();
        }
    });


    //show the autocomplete for the job title

    $('body').on('keyup','.search_by_job_title',function(e){
        var search_job_title  = $(this).val();
        var _token            = "{{csrf_token()}}";

        //make the request 
        $.post("{{URL::to('/searchByJobTitle')}}",{ q:search_job_title, _token:_token},function(data){
            if(data.status == "success"){
               var return_job_lists = "";
               $.each(data.result,function(index,value){
                return_job_lists += "<li data-job-title='" + value.title + "'><i class='ti-light-bulb'></i>" + value.title + "</li>";
               });

               $("#_job_title_search_list ul").html(return_job_lists);
               $("#_job_title_search_list").show();
            }else{
                $("#_job_title_search_list").hide();
            }
        });
    });

    //trigger the click event

    $('body').on('click','#_job_title_search_list > ul li', function(e){
       var selected_address   = $(this).data('job-title');
        $(this).closest('div.form-group').find('input').val(selected_address);
        $('#_job_title_search_list').hide();
    });

    $('body').click(function(event){
        var $trigger = $("#_location_search_list > ul li");
        if ($trigger !== event.target) {
            $("#_job_title_search_list").hide();
        }
    });



});

</script>
@endsection