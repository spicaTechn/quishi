@extends('front.layout.master')
@section('content')
<div id="main" class="main">
  <div class="top-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Age Group</option>
                                <option>Age Group</option>
                                <option>Age Group</option>
                                <option>Age Group</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Education</option>
                                <option>Education</option>
                                <option>Education</option>
                                <option>Education</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Location</option>
                                <option>Location</option>
                                <option>Location</option>
                                <option>Location</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Industry</option>
                                <option>Industry</option>
                                <option>Industry</option>
                                <option>Industry</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                    </div>
                    <div class="col-md-4">
                        <div class="filter-right">
                            <div class="change-view"><i class="icon-list"></i></div>
                            <div class="search-form">
                                <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                                <input type="text" name="search-form" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-section search-results-found">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title">

                              <h2>Search Results ({{$users->count()}} Profiles)</h2>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="filter-dropdown">
                            <div class="sort-by">Sort By: </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Recent</option>
                                    <option>Recent</option>
                                    <option>Recent</option>
                                    <option>Recent</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Likes</option>
                                    <option>Likes</option>
                                    <option>Likes</option>
                                    <option>Likes</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Views</option>
                                    <option>Views</option>
                                    <option>Views</option>
                                    <option>Views</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($users as $user)
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="{{asset('/front')}}/images/profile/{{ $user->user_profile->image_path }}">
                                </div>
                                <div class="profile-desination">
                                    <h3>{{ $user->user_profile->first_name }}</h3>
                                    @foreach($user->careers as $career)
                                    <span>{{ $career->title }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="full-list-view">
                                <div class="profile-slills">
                                    <ul>
                                        @foreach($user->tags as $tag)
                                        <li><a href="#">{{$tag->title}}</a></li>
                                       <!--  <li><a href="#">jQuery</a></li>
                                        <li><a href="#">HTML5</a></li> -->
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="profile-info">
                                    <p>{{ str_limit($user->user_profile->description,70) }}</p>
                                </div>
                            </div>

                            <div class="full-list-view">
                                <div class="like-view">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @csrf
                                            <div class="view-section">
                                                <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$user->id}}" id="total_likes">
                                                    <i class="icon-like"></i>
                                                </a>
                                                <span class="like{{ $user->id }}" id="like" value="{{ $user->id }}">{{ $user->user_profile->total_likes }} Likes</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="view-section">
                                                <a href="#"><i class="icon-eye"></i></a>
                                                <span>{{ $user->user_profile->profile_views }} Views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-profile">
                                    <a href="{{URL::to('/career-advisior').'/'.$user->id}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @if($show_more)
                <div class="view-more text-center">
                    <a href="javascript:void(0);" data-count-record="0" class="btn btn-default load_more" id="load_more">load more</a>
                </div>
                @endif
            </div>
        </div>
</div>
<div class="loadmoredata" id="loamoredata"></div>
@endsection

@section('page_specific_js')
<script type="text/javascript">
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


    $('.load_more').on("click", function(){

        //var _token          = $("input[name='_token']").val();
        var count_record = $(this).attr('data-count-record');
        var added_record = parseInt(count_record+1);
        //alert(added_record);
        $.ajax({
              //make the ajax request to either add or update the
          url:"{{url('')}}" + "/loadMoreCareer",
          type:"GET",
          data:{record:added_record},
          cache: false,
          dataType:'json',

          success:function(data)
          {

            if(data.success == true) {
                //alert("success");
              $(".main").css("display", "none");
              $('.loadmoredata').append(data.html);
            }
          },
          error:function(event)
          {
              console.log('cannot get profile data from quishi. Please try again later on..');
          }
        });
    });






});

</script>
@endsection