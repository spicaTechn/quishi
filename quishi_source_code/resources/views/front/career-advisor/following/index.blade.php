@extends('front.career-advisor.layout.master')
@section('title','Following List')
@section('page_specific_css')
@endsection
@section('content')
    <div class="follows-section profile-main-section">
        <h4>Following {{ Auth::user()->following()->count() . ' Career Advisors' }} </h4>
        <div class="follower-wrap">
            @if($_following_advisers->count() > 0)
            <div class="row">
                @foreach($_following_advisers as $following_adviser)
                <div class="col-lg-3 col-md-4">
                    <div class="trending-profiles-section">
                        <div class="profile-image">
                            @if(empty($following_adviser->user_profile->image_path))
                                <img src="{{asset('/front')}}/images/default-profile.jpg">
                                @else
                                  <img src="{{asset('/front')}}/images/profile/{{ $following_adviser->user_profile->image_path }}">
                            @endif
                           
                        </div>
                        <div class="profile-desination">
                            <h3>{{$following_adviser->user_profile->first_name }}</h3>
                            <span>{{ ucwords($following_adviser->careers()->first()->title) }}</span>
                        </div>
                        <div class="full-list-view">
                            <div class="profile-slills">
                                <ul>
                                    @foreach($following_adviser->tags as $tag)
                                    <li><a href="#">{{ucwords($tag->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="profile-info">
                                <p>{{ ucfirst(str_limit($following_adviser->user_profile->description,70)) }}</p>
                            </div>
                        </div>
                        <div class="full-list-view">
                            <div class="like-view">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @csrf
                                        <div class="view-section">
                                            <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$following_adviser->id }}" id="total_likes">
                                                <i class="icon-like"></i>
                                            </a>
                                            <span class="like{{$following_adviser->id }}" id="like" value="{{$following_adviser->id }}">{{ quishi_convert_number_to_human_readable($following_adviser->user_profile->total_likes) }} Likes</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="view-section">
                                            <a href="#"><i class="icon-eye"></i></a>
                                            <span>{{ quishi_convert_number_to_human_readable($following_adviser->user_profile->profile_views) }} Views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="view-profile row">
                                <a href="javascript:void(0);" class="unfollow_career_advisor" data-following-id="{{$following_adviser->id}}"> {{ __('Unfollow')}}</a>
                                <a href="{{URL::to('/career-advisor').'/'.$following_adviser->id .'/'.str_slug($following_adviser->user_profile->first_name)}}">view profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <!-- end col -->
            </div>
            <div class="follower_following_pagination">
                <div class="pagination">
                    {{ $_following_advisers->links() }}
                </div>
            </div>
            @else
                <div class="_no_result_founds">
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
                                window.open("{{route('careerAdviser.following')}}","_self");
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
 });
</script>
@endsection