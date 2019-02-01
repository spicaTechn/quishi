@extends('front.career-advisor.layout.master')
@section('title','Followers List')
@section('page_specific_css')
@endsection
@section('content')

    <div class="follows-section profile-main-section">
        <h4>@if(Auth::user()->followers()->count() == 0)
             {{ 'You have no followers' }}
            @elseif(Auth::user()->followers->count() == 1)
             {{ '1 Career Advisor Follow you' }}
            @else
            {{ Auth::user()->followers()->count().' Career Advisors Follow you' }} 
            @endif
        </h4>
        <div class="follower-wrap">
            @if($followers->count() > 0)
            <div class="row">
                @foreach($followers as $follower)
                <div class="col-lg-3 col-md-4">
                    <div class="trending-profiles-section">
                        <div class="profile-image">
                            @if(empty($follower->user_profile->image_path))
                                <img src="{{asset('/front')}}/images/default-profile.jpg">
                                @else
                                  <img src="{{asset('/front')}}/images/profile/{{ $follower->user_profile->image_path }}">
                            @endif
                           
                        </div>
                        <div class="profile-desination">
                            <h3>{{$follower->user_profile->first_name }}</h3>
                            <span>{{ ucwords($follower->careers()->first()->title) }}</span>
                        </div>
                        <div class="full-list-view">
                            <div class="profile-slills">
                                <ul>
                                    @foreach($follower->tags->take(3) as $tag)
                                    <li><a href="javascript:void(0);">{{ucwords($tag->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="profile-info">
                                <p>{{ ucfirst(str_limit($follower->user_profile->description,70)) }}</p>
                            </div>
                        </div>
                        <div class="full-list-view">
                            <div class="like-view">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @csrf
                                        <div class="view-section">
                                            <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$follower->id }}" id="total_likes">
                                                <i class="icon-like"></i>
                                            </a>
                                            <span class="like{{$follower->id }}" id="like" value="{{$follower->id }}">{{ quishi_convert_number_to_human_readable($follower->user_profile->total_likes) }} Likes</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="view-section">
                                            <a href="#"><i class="icon-eye"></i></a>
                                            <span>{{ quishi_convert_number_to_human_readable($follower->user_profile->profile_views) }} Views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="view-profile row">
                                @if(Auth::user()->following()->where('leader_id',$follower->id)->count() > 0)
                                     <a href="javascript:void(0);" class="unfollow_career_advisor" data-following-id="{{$follower->id}}"> {{ __('Unfollow')}}</a>
                                @else
                                     <a href="javascript:void(0);" class="follow_career_advisor" data-following-id="{{$follower->id}}"> {{ __('Follow')}}</a>
                                @endif
                                <a href="{{URL::to('/career-advisor').'/'.$follower->id .'/' .str_slug($follower->user_profile->first_name)}}">view profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <!-- end col -->
            </div>
            <div class="follower_following_pagination">
                <div class="pagination">
                    {{ $followers->links() }}
                </div>
            </div>
            @else
                <div class="_no_result_founds">
                 <p>Looks like you have no followers yet! Please improve your activity by creating new <a href="{{ route('profile.blog.create') }}" class="new_forum_question_add">Blog</a> or post a question to <a href="{{ url('/forum') }}" class="new_forum_question_add">Forum</a> to get attention from like minded peoples</p>
                </div>
            @endif
            <!-- end row -->
        </div>
        <!-- end follower-wrap -->
    </div>
</div>
</div>


<!-- end follows-section -->
@endsection
@section('page_specific_js')

 <script>
    $(document).ready(function(){
         //follow career advisor
    $('body').on('click','.follow_career_advisor', function(e){
        //prevent the default action
        var current_link = $(this);
        e.preventDefault();
        if("{{Auth::check()}}"){
            var following_id = $(this).attr('data-following-id');
            var _token       = "{{csrf_token()}}";
            //make the post request
            $.post("{{URL::to('/profile/followCareerAdvisor')}}" + "/" + following_id, {_token}, function(data){
                //check the return data status
                if(data.status == "success"){
                    setTimeout(function()
                    {
                            swal({
                              title : "You are now followers of " + " " + data.name,
                              text  : data.message,
                              type  : 'success',
                             closeOnConfirm: true,
                            }, function() {
                                window.open("{{route('careerAdviser.followers')}}","_self");
                            });
                  }, 1000);

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
                    setTimeout(function()
                    {
                            swal({
                             title: "You unfollow " + " " + data.name,
                             text : data.message,
                             type : 'success',
                             closeOnConfirm: true,
                            }, function() {
                                window.open("{{route('careerAdviser.followers')}}","_self");
                            });
                  }, 1000);
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

    //increase the like counter
    $( ".total_likes" ).on( "click", function() {
      var user_profile_id = $(this).attr('data-profile-id');
      var _token          = $("input[name='_token']").val();
      //var total_likes     = (parseInt($(".like"+user_profile_id).html())+1);
      //alert(total_likes);
      $.ajax({
              url:"{{url('')}}" + "/career-advisior/" + user_profile_id,
              type:"POST",
              dataType:"json",
              data: {_token:_token,user_profile_id:user_profile_id},
              success:function(data){
                  //check for the success status only
                  if(data.status == "success"){
                      //insert the data in the modal
                      // alert('success');
                      //$(this).closest('.total_likes').find('.like'+user_profile_id).html(total_likes + " " + "Likes");
                      $('.like'+user_profile_id).html(data.total_likes+" "+"Likes");

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