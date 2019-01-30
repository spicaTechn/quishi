@extends('front.layout.master')
@section('title','Quishi | Career Advisors')
@section('page_specific_css')
<!--select2 css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">
@endsection
@section('content')
<div id="main" class="main">
  <div class="top-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-filter-dropdown">
                            <select class="form-control" name="age_group" id="age_group">
                                <option value="0" disabled="disabled" selected="">{{ __('Age Group')}} </option>
                                <option value="1">{{ __('0-15 years') }}</option>
                                <option value="2">{{ __('15-30 years') }}</option>
                                <option value="3">{{ __('30-45 years') }}</option>
                                <option value="4">{{ __('45-50 years') }}</option>
                                <option value="5">{{ __('50 above') }}</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control" name="education" id="education">
                                <option value="0" disabled="disabled" selected="selected">{{ __('Education') }}</option>
                                <option value="high school">{{ __('High School') }}</option>
                                <option value="associate">{{ __('Associate') }}</option>
                                <option value="bachelor">{{ __('Bachelor') }}</option>
                                <option value="masters">{{ __('Masters') }}</option>
                                <option value="phd">{{ __('PHD') }}</option>
                                <option value="other">{{ __('Other') }}</option>
                            </select>
                        </div>
                      
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control industry " name="industry" id="industry">
                                <option value="0" disabled="disabled" selected="selected">Job Title</option>
                                @foreach($industries as $industry)
                                    <option value="{{$industry->id}}" 
                                        @if(isset($_GET['search_by_job_title']))
                                            @if($_GET['search_by_job_title'] == $industry->title)
                                                {{'selected'}}
                                            @endif
                                        @endif
                                    >{{ucwords($industry->title)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                    </div>
                    <div class="col-md-4">
                        <div class="filter-right">
                            <div class="change-view"><i class="icon-grid"></i>
                            <i class="icon-list"></i></div>
                            
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
                             <h2>Showing <span class="pagination_profile"> {{ $total_record_shown }} </span> of <span class="total_profile">{{ $total_record}}</span><span class="profile_text">@if($total_record > 1) {{ 'Profiles'}} @else {{ 'Profile' }} @endif</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="filter-dropdown">
                            <div class="sort-by">Sort By: </div>
                            <div class="sort-dropdown">
                                <select class="form-control" name="career_advisor_order" id="sort_order">
                                    <option value="desc">{{ __('Recent') }}</option>
                                    <option value="asc">{{ __('Oldest') }}</option>
                                    <option value='profile_desc'>{{ __('Most Liked') }}</option>
                                    <option value='profile_asc'>{{ __('Least Liked') }}</option>
                                    <option value="view_desc" selected="">{{ __('Most Views') }}</option>
                                    <option value="view_asc">{{ __('Least Views') }}</option>
                                </select>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="top-filter-section search_by_name">
                  <div class="search-form">
                      <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                      <input type="text" name="search_by_name" id="search_by_name" class="form-control" placeholder="search by name">
                  </div>
                </div>        
                <div class="row show_more_career_advisior isotopeContainer2">
                    @if(count($users_lists) > 0)
                    @foreach($users_lists as $user_list)
                    <div class="col-lg-4 isotopeSelector">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    @if(empty($user_list['user_image']))
                                        <img src="{{asset('/front')}}/images/default-profile.jpg">
                                    @else
                                        <img src="{{asset('/front')}}/images/profile/{{ $user_list['user_image'] }}">
                                    @endif
                                </div>
                                <div class="profile-desination">
                                    <h3>{{ $user_list['first_name'] }}</h3>
                                   
                                    <span>{{ ucwords($user_list['career'])  }}</span>
                               
                                </div>
                            </div>

                            <div class="full-list-view">
                                <div class="profile-slills">
                                    <ul>
                                      @if(count($user_list['user_tag']) > 0)
                                        @foreach($user_list['user_tag'] as $key=>$tag)
                                        <li><a href="#">{{ucwords($tag['tag_title'])}}</a></li>
                                        @endforeach
                                      @endif
                                    </ul>
                                </div>
                                <div class="profile-info">
                                    <p>{{ str_limit($user_list['descripiton'],70) }}</p>
                                </div>
                            </div>

                            <div class="full-list-view">
                                <div class="like-view">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @csrf
                                            <div class="view-section">
                                                <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$user_list['user_id']}}" id="total_likes">
                                                    <i class="icon-like"></i>
                                                </a>
                                                <span class="like{{ $user_list['user_id'] }}" id="like" value="{{ $user_list['user_id'] }}">{{ $user_list['total_likes'] }} Likes</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="view-section">
                                                <a href="#"><i class="icon-eye"></i></a>
                                                <span>{{ $user_list['total_views'] }} Views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-profile row">
                                    @if(auth::check())
                                        @if($user_list['follow'])
                                          <a href="javascript:void(0);" class="unfollow_career_advisor" data-following-id="{{$user_list['following_id']}}"> {{ __('Unfollow')}}</a>
                                        @else
                                           <a href="javascript:void(0);" class="follow_career_advisor" data-following-id="{{$user_list['following_id']}}"> {{ __('Follow')}}</a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0);" class="follow_career_advisor" data-following-id="{{$user_list['following_id']}}"> {{ __('Follow')}}</a>
                                    @endif
                                    <a href="{{URL::to('/career-advisor').'/'.$user_list['user_id'].'/'.str_slug($user_list['first_name'])}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="col-md-12">
                      <p> {{ __('Sorry no career advisior were found, please try with others parameters') }}</p>
                    </div>
                @endif

                </div>
                <div class=" show-div" id="show-div">

                </div>
                @if($show_more)
                <div class="view-more text-center read_more">
                    <a href="javascript:void(0);" data_current_page="{{$current_page}}" class="btn btn-default load_more" id="load_more">{{ __('load more') }}</a>
                </div>
                @endif
            </div>
        </div>
</div>
@endsection

@section('page_specific_js')
<!-- Select 2 -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    //alert("hello");
    $('body').on('click', ".total_likes", function() {
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


    $(document).on("click",'.load_more', function(){

        //call the specific function to get the ajax result
        var type = true;
        renderSearchDataAndAjaxCall(type);
        
    });


    $(document).on('keyup', '#search_by_name',function(){
        var type = false;
        $("#load_more").attr('data_current_page',0);
        renderSearchDataAndAjaxCall(type);
    });

    $(document).on('change','.industry,#education,#age_group,#likes_order,#views_order,#sort_order',function(){
        var type = false;
        $("#load_more").attr('data_current_page',0);
        renderSearchDataAndAjaxCall(type);
    });



    function renderSearchDataAndAjaxCall(type){


        var search_by_location      = "{{(isset($_GET['search_by_location'])) ? $_GET['search_by_location'] : '' }}";

        //get the other field on-page search parameters
        var age_group               = $('#age_group').val();
        var career_name             = $('#search_by_name').val();
        var education               = $('#education').val();
        var address                 = $('#location').val();
        var industry                = $('#industry').val();
        var sort_order              = $('#sort_order').val();

        // get page parameters
        var current_page           = $("#load_more").attr('data_current_page');
        var next_page              = parseInt(current_page,10) + 1;
      
        //make request to the server
        $.ajax({
              //make the ajax request to either add or update the
          url:"{{url('')}}" + "/loadMoreCareer",
          type:"GET",
          data:{
                current_page            : current_page,
                search_by_location      : search_by_location,
                career_name             : career_name,
                age_group               : age_group,
                education               : education,
                industry                : industry,
                sort_order              : sort_order,
          },
          cache: false,
          dataType:'json',
          beforeSend:function(){
            $("#load_more").html('Loading....');
          },
          success:function(data)
          {

            if(data.success == true) {
              if(type == true){
                    if(data.read_more){
                        $('.read_more').show();
                        $("#load_more").attr('data_current_page',next_page);
                    }else{
                           $('.read_more').hide();
                    }
                    $('.show_more_career_advisior').append(data.html);
              }else{

                    if(data.read_more){
                        $('.read_more').show();
                        $("#load_more").attr('data_current_page',next_page);
                    }else{
                           $('.read_more').hide();
                    }
                    
                    $('.show_more_career_advisior').html(data.html);
              }

              $('span.pagination_profile').html(data.total_record_shown);
              $("span.total_profile").html(data.total_record);
              if(data.total_record > 1){
                $("span.profile_text").html(' Profiles');
              }else{
                $("span.profile_text").html(' Profile');
              }
            }
          },
          complete:function(data){
             $("#load_more").html('Load More');
          },
          error:function(event)
          {
              console.log('cannot get profile data from quishi. Please try again later on..');
          }
        });
    }


    //initialize the select2 here 
    $('.industry').select2({});
    $('.address').select2();


     //follow career advisor
    $('body').on('click','.follow_career_advisor', function(e){
        //prevent the default action
        var current_link = $(this);
        e.preventDefault();
        if("{{Auth::check() && Auth::user()->user_profile()->count() > 0 }}"){
            var following_id = $(this).attr('data-following-id');
            var _token       = "{{csrf_token()}}";
            //make the post request
            $.post("{{URL::to('/profile/followCareerAdvisor')}}" + "/" + following_id, {_token}, function(data){
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
        if("{{Auth::check() && Auth::user()->user_profile()->count() > 0 }}"){
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




});

</script>
@endsection