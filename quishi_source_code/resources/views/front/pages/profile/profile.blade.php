@extends('front.layout.master')
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
                                <option value="1">0-15 years</option>
                                <option value="2">15-30 years</option>
                                <option value="3">30-45 years</option>
                                <option value="4">45-50 years</option>
                                <option value="5">50 above</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control" name="education" id="education">
                                <option value="0" disabled="disabled" selected="selected">Education</option>
                                <option value="high school">High School</option>
                                <option value="associate">Associate</option>
                                <option value="bachelor">Bachelor</option>
                                <option value="masters">Masters</option>
                                <option value="phd">PHD</option>
                                <option value="other">Other</option>
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
                            <div class="change-view"><i class="icon-list"></i></div>
                            
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

                              <h2>Search Results (<span class="search_number">{{$total_record_shown}}</span> Profiles)</h2>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="filter-dropdown">
                            <div class="sort-by">Sort By: </div>
                            <div class="sort-dropdown">
                                <select class="form-control" name="career_advisor_order" id="sort_order">
                                    <option value="desc">Recent</option>
                                    <option value="asc">Oldest</option>
                                    <option value='profile_desc'>Profile Likes Desc</option>
                                    <option value='profile_asc'>Profile Likes Asc</option>
                                    <option value="view_desc" selected="">Profile Views Desc</option>
                                    <option value="view_asc">Profile Views Asc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row show_more_career_advisior">
                    @if(count($users_lists) > 0)
                    @foreach($users_lists as $user_list)
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    @if(empty($user_list['user_image']))
                                        <img src="{{asset('/front')}}/images/blog1.jpg">
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
                                        @foreach($user_list['user_tag'] as $key=>$tag)
                                        <li><a href="#">{{ucwords($tag['tag_title'])}}</a></li>
                                        @endforeach
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
                                <div class="view-profile">
                                    <a href="{{URL::to('/career-advisior').'/'.$user_list['user_id']}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                      <p>Sorry no career advisior were found, please try with others parameters</p>
                @endif

                </div>
                <div class=" show-div" id="show-div">

                </div>
                @if($show_more)
                <div class="view-more text-center read_more">
                    <a href="javascript:void(0);" data_current_page="{{$current_page}}" class="btn btn-default load_more" id="load_more">load more</a>
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


    $(document).on("click",'.load_more', function(){

        //call the specific function to get the ajax result
        var type = true;
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

              $('span.search_number').html(data.total_record_shown);
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




});

</script>
@endsection