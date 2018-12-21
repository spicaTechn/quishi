@extends('front.layout.master')
@section('content')
<div class="cover-photo">
    <img src="{{ asset('/front') }}/images/profile/banner.jpg" alt="cover photo">
</div>
<div class="front-profile-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="profile-left">
                            <div class="front-profile">
                                <img src="{{asset('/front')}}/images/profile/{{ $user->user_profile->image_path }}" alt="profile- pic">
                            </div>
                            <!-- end front-profile -->
                            <div class="profile-name-detail profile-name-detail-xs">
                                <h2>{{ ucwords($user->user_profile->first_name) }}</h2>
                                @foreach($user->careers as $career)
                                 <span class="small">{{ ucwords($career->title) }}</span>
                                @endforeach
                                <span class="small">{{ $user->email }}</span>
                            </div>
                            <!-- end profile-name-detail -->
                            <div class="about-profile-detail">
                                <p>{{ str_limit($user->user_profile->description,100) }}</p>
                            </div>
                            <!-- end about-profile-detail -->
                            <div class="personal-contacts">
                                <ul>
                               @foreach($user->user_links as $user_link)
                                   @if($user_link->type == '1' && $user_link->status == '1')
                                     <li><a href="{{$user_link->link}}">{{$user_link->link}}</a></li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            <!-- end personal-contacts -->
                            <div class="profile-social-media">
                                <ul>
                                    @foreach($user->user_links as $user_link)
                                       @if($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "facebook_link")
                                          <li><a href="{{$user_link->link}}"><i class="icon-social-facebook"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "twitter_link")
                                          <li><a href="{{$user_link->link}}"><i class="icon-social-twitter"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "linkedin_link")
                                           <li><a href="{{$user_link->link}}"><i class="icon-social-linkedin"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "google_plus_link")
                                            <li><a href="{{$user_link->link}}"><i class="icon-social-google"></i></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end profile-social-media -->
                            <div class="like-viewers">
                                <ul>

                                    @csrf
                                    <li>
                                        <a href="javascript:void(0);" data-profile-id="{{$user->id}}" id="total_likes">
                                            <i class="icon-like"></i>Likes
                                        </a>
                                        <span class="like" id="like" value="{{ $user->user_profile->total_likes }}">{{ $user->user_profile->total_likes }}
                                        </span>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="icon-eye"></i> Views</a><span>{{ $profile_view }}</span></li>
                                    <li><a href="javascript:void(0);"><i class="icon-bubble"></i> Comments</a><span>{{quishi_convert_number_to_human_readable($total_comments) }}</span></li>
                                    <li><a href="#"><i class="icon-user"></i> Followers</a><span>{{quishi_convert_number_to_human_readable($user->followers()->count())}}</span></li>
                                    <li><a href="{{URL::to('/blog/careerAdvisor/'.$user->id)}}"><i class="icon-feed"></i> Blog</a><span>{{$user->posts()->count()}}</span></li>

                                </ul>
                            </div>
                            <!-- end like-viewers -->
                        </div>
                        <!-- end profile-left -->
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="profile-detail-right">
                            <div class="profile-name-detail profile-name-detail-md">
                                <h2>{{ $user->user_profile->first_name }}</h2>
                                @foreach($user->careers as $career)
                                 <span class="small">{{ ucwords($career->title) }}</span>
                                @endforeach
                                <span class="small">{{ $user->email }}</span>
                                
                            </div>
                            <!-- end profile-name-detail -->
                            <div class="profile-follow-following">
                                <a href="#" class="btn btn-default"><i class="icon-like"></i> Like</a>
                                <!-- <a href="#" class="btn btn-default"><i class="icon-like"></i> Liked</a> -->
                                <a href="#" class="btn btn-default"><i class="icon-feed"></i> Follow</a>
                                <!-- <a href="#" class="btn btn-default"><i class="icon-check"></i> Following</a> -->
                            </div>
                                <!-- end profile-follow-following -->
                            <div class="about-my-profile">
                                <h3>About Me</h3>
                                <p>{{ $user->user_profile->description }}</p>
                            </div>
                            <!-- end about-my-profile -->
                            <div class="personal-detail">
                                <h4>More Info:</h4>
                                <ul>
                                    <li><span>Address: </span>{{ ucwords($user->user_profile->location) }}</li>
                                    <li><span>Age Group:</span> {{ show_career_advisior_age_group($user->user_profile->age_group) }}</li>
                                    <li><span>Education Level:</span> {{ ucwords($user->user_profile->educational_level) }}</li>
                                    <li><span>Faculty:</span> {{ucwords($user->user_profile->education->name)}}</li>
                                     @foreach($user->careers as $career)
                                    <li><span>Job Title:</span> {{ ucwords($career->title) }}</li>
                                    @endforeach
                                    <li><span>Salary Range:</span> {{ show_career_advisior_salary_range($user->user_profile->salary_range) }}</li>
                                    <li><span>Experience:</span> {{ show_career_advisior_job_experience($user->user_profile->job_experience) }}</li>
                                </ul>
                            </div>
                            <!-- end personal-detail -->

                            <div class="profile-slills">
                                <ul>
                                    @foreach($user->tags as $tag)
                                        <li><a href="#">{{ucwords($tag->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end profile-slills -->
                        </div>
                        <!-- end profile-detail-right -->
                    </div>

                </div>
                @if($blogs->count() > 0)
                <div class="profile-blog-section the-media container">                        
                        <div class="section-title">
                            <h2>{{ __('Recent blog') }}</h2>
                        </div>
                        <div class="row row-news">
                            @foreach($blogs as $blog)
                            <div class="col-lg-4">
                                <div class="news-blog-section">
                                    <div class="blog-image">

                                        @if($blog->image_path != "")
                                             <img src="{{asset('/front')}}/images/blogs/{{$blog->image_path}}" alt="#">
                                        @else
                                            <img src="{{asset('/front')}}/images/blogs/1537937998.jpg" alt="#">
                                        @endif
                                       
                                    </div>
                                    <div class="blog-conten">
                                        <h4>{{ $blog->title }}</h4>
                                        <span class="time">Published on {{ Carbon\Carbon::parse($blog->published_date)->format('M-Y')}}</span>
                                        <p>{!! ($blog->abstract != "" ) ? $blog->abstract : substr($blog->content,0,50) . '..' !!}</p>
                                        <a href="{{URL::to('/blog/'.$blog->id) }}">{{ __('Full Story') }} <i class="icon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <div class="view-more"><a href="{{URL::to('/blog/careerAdvisor/'.$user->id)}}" class="btn btn-default">{{ __('view blogs') }}</a></div>

                </div>
                @endif
            </div>
        </div>
        <!-- end front-profile-details -->
        <div class="profileq-profilea">
            <div class="container">
                <h4>Q&A’s with {{ $user->user_profile->first_name }}</h4>
                @foreach ($questions as $question)
                <div class="profile-question-answer-section" id="profile-answer{{$question['question_id']}}">
                    <h4><i class="icon-check"></i> {{ $question['question_title'] }}</h4>
                    <p>{{ $question['answer'] }}</p>
                    <div class="like-comment-view">
                        <ul>
                            <li><a href="#" data-user-id="{{$user->id}}" data-question-id="{{$question['question_id']}}" class="_total_answer_likes"><span class="like-numbers">{{$question['total_likes']}}</span> <i class="icon-like"></i> {{ ($question['total_likes'] > 1) ? 'Likes' : 'Like' }}</a></li>
                            <li><a href="#profile-reply-form{{$question['question_id']}}" class="go-to-comment"><span class="like-numbers">{{$question['total_comments']}}</span> <i class="icon-bubble"></i> Comments</a></li>
                        </ul>
                    </div>
                    <!-- end like comment view -->

                    <div class="profile-leave-comment">
                        <h4 class="small">{{ __('Leave a Comment') }}</h4>
                        <form action="javascript:void(0);" method="post" name="_answer_comment_{{$question['question_id']}}" id="_answer_comment_{{ $question['question_id']}}">
                            <input type="hidden" name="answer_id" value="{{ $question['answer_id']}}"/>
                            <input type="hidden" name="question_id" value="{{ $question['question_id']}}"/>
                            <input type="hidden" name="question_id" value="{{ $question['question_id']}}"/>
                            <input type="hidden" name="_career_profile_id" value="{{$user->id}}"/>
                            <input type="hidden" name="_parent_comment_id" value="0"/>
                            {{csrf_field()}}
                            <div class="profile-reply-form" id="profile-reply-form{{$question['question_id']}}">
                                <div class="reply-user-image">
                                    @if(Auth::check())
                                      @if(Auth::user()->user_profile->image_path != "")
                                        <img src="{{ asset('/front')}} /images/profile/{{Auth::user()->user_profile->image_path}}">
                                      @else
                                        <img src="{{ asset('/front')}} /images/profile/1.jpg">
                                      @endif
                                    @endif
                                </div>
                                <div class="reply-coment-box">
                                    <div class="comment-method">
                                        <ul>
                                            @if(! Auth::check())
                                            <li>Please <a href="{{URL::to('/login')}}">Signin</a> or <a href="{{ URL::to('/register')}}">Create an account </a> to post a comment</li>
                                            @else
                                            <li>
                                                <a>
                                                    <input type="checkbox" id="check-for-login{{$question['question_id']}}" name="_hide_name{{$question['question_id']}}">
                                                    <label for="check-for-login">Post Anonymously</label>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if(Auth::check())
                                    <div class="form-group">
                                        <textarea class="form-control" rows="1" placeholder="Your Message Here !" name="_comment_message" required></textarea>
                                        <!-- <input type="text " name="" class="form-control message-box" placeholder="Your Message Here !"> -->
                                        <button class="btn btn-default btn_comment"  data-question-id="{{$question['question_id']}}"><i class="icon-cursor"></i></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>

                        @if(count($question['answer_comments']) > 0)
                        @foreach($question['answer_comments'] as $answer_comment)
                        <div class="profile-comment-wrapper" id="profile-comment-wrapper-{{$answer_comment->id}}">
                            <div class="profile-comment-section">
                                <div class="profile-coment-user">
                                    @if($answer_comment->comment_poster->user_profile->image_path != "" && $answer_comment->type != '1')
                                        <img src="{{ asset('/front/images/profile/'.$answer_comment->comment_poster->user_profile->image_path)}}">
                                    @else
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    @endif
                                </div>

                                <div class="profile-coment-comment">
                                    <h5>{{ ($answer_comment->type == '0') ? $answer_comment->comment_poster->user_profile->first_name : 'Ananymous' }}</h5>
                                    <p>{{ ucfirst($answer_comment->content) }}</p>
                                    <div class="profile-author-comment">
                                        <ul>
                                            <li><a href="javascript:void(0);" class="_comment_like" data-comment-id="{{ $answer_comment->id}}"><i class="icon-like"></i> {{ $answer_comment->total_likes }} {{ ($answer_comment->total_likes > 1) ? 'Likes' : 'Like' }}</a></li>
                                            @if(Auth::check())
                                                <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                            @endif
                                        </ul>
                                        <form action="javascript:void(0);" name="_comment_reply_form" id="_comment_reply_form_{{ $answer_comment->id }}">
                                             <input type="hidden" name="_parent_comment_id"  value="{{$answer_comment->id}}"/>
                                             <input type="hidden" name="_quishi_comment_posted_by" value="{{$answer_comment->posted_by}}"/>
                                            {{csrf_field()}}
                                        <div class="form-group">
                                            <div class="reply-user-image reply-subinner-image">
                                                @if(Auth::check())
                                                  @if(Auth::user()->user_profile->image_path != "")
                                                    <img src="{{ asset('/front')}} /images/profile/{{Auth::user()->user_profile->image_path}}">
                                                  @else
                                                    <img src="{{ asset('/front')}} /images/profile/1.jpg">
                                                  @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="comment-method">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <input type="checkbox" id="check-for-login" name="_hide_name_{{$answer_comment->id}}">
                                                        <label for="check-for-login">Post Anonymously</label>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="form-group" id="comment-1">
                                                <input type="hidden" name="_career_advisor_id" value="{{$answer_comment->user_id}}"/>
                                                <input type="hidden" name="answer_id" value="{{$question['answer_id']}}"/>
                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn" data-answer-id="{{$answer_comment->id}}"><i class="icon-cursor"></i></button>
                                            
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            @if($answer_comment->childern()->count() > 0)
                            <div class="reply-inner">
                                @foreach($answer_comment->childern()->orderBy('created_at','desc')->get() as $comment_reply)
                                <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        @if($comment_reply->comment_poster->user_profile->image_path != "" && $comment_reply->type != '1')
                                        <img src="{{ asset('/front/images/profile/'.$comment_reply->comment_poster->user_profile->image_path)}}">
                                        @else
                                            <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                        @endif
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>{{ ($comment_reply->type == '0') ? $comment_reply->comment_poster->user_profile->first_name : 'Ananymous' }}</h5>
                                        <p>{{ $comment_reply->content }}</p>
                                        
                                    </div>
                                </div>
                                @endforeach
                                <!-- end inner profile-comment-section 1 -->
                                
                                <div class="view-all-comment"  style="{{ ($answer_comment->childern()->count() > 2) ? 'display:block;' : 'display:none;' }} " >
                                    <span>View all {{ ($answer_comment->childern()->count() - 2)}} Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
                                </div>
                            </div> 
                            @endif                                                                   
                        </div>
                        @endforeach  
                        <div class="view-all-profile-comment" style=" {{ (count($question['answer_comments']) < 4) ? 'display: none;'  : 'display:block;' }} ">
                            <span>View all {{ (count($question['answer_comments']) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
                        </div>  
                        @else
                            <div class="view-all-profile-comment" style=" {{ (count($question['answer_comments']) < 4) ? 'display: none;'  : 'display:block;' }} ">
                                <span>View all {{ (count($question['answer_comments']) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
                            </div> 
                            <div class="_no_comment_posted" id="_no_comment_posted">
                                <div class="profile-comment-section">
                                    <div class="_no_comment_posted_yet">
                                        <p>There are no comment posted yet</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- end profile-leave-comment -->

                </div>
                @endforeach
                <!-- end profile-question-answer-section -->


            </div>
        </div>
        <!-- end profileq-profilea -->
        
@endsection

@section('page_specific_js')
<script type="text/javascript">
$(document).ready(function () {

    //career profile like counter
    $( "#total_likes" ).on( "click", function() {
      var user_profile_id = $(this).attr('data-profile-id');
      var _token          = $("input[name='_token']").val();
      var total_likes     = (parseInt($("#like").html(),10)+1);
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
                      $(".like").html(total_likes);

                  }
              },
              error:function(event){
                      console.log('Cannot get the particular team');
              }
          });
    });


    //add new comment on profile answer 
    $('body').on('click','.btn_comment',function(e){
        e.preventDefault();
        var current_clicked_btn = $(this);
        var _reply_message = $(this).parent().closest('div.form-group').find('textarea').val();
        if(_reply_message.length > 10){
           var _current_commented_id  = $(this).data('question-id');
           var comment_details        = $("#_answer_comment_" + _current_commented_id).serialize();
            $.ajax({
                url         : "{{URL::to('/answers/postComment')}}",
                type        : "POST",
                dataType    : 'JSON',
                data        : comment_details,
                success     : function(data){
                    //append new comment
                   $(current_clicked_btn).parent().closest('div.profile-leave-comment').find('form#_answer_comment_' + _current_commented_id ).after(data.result).show('slow');
                   $(current_clicked_btn).parent().closest('div.profile-question-answer-section').find('a.go-to-comment > span').html(data.total_comment);
                   //reset the text area size
                   //$(this).parent().closest('div.form-group').find('textarea').css('height','37px');
                   //reset the form
                   if(data.total_comment >= 4){
                     $('.view-all-profile-comment span').html('View all ' + (data.total_comment - 3) + ' Comments <i class="fa fa-reply" aria-hidden="true"></i>');
                     $('.view-all-profile-comment').show();
                 }else{
                    $('.view-all-profile-comment').hide();
                 }

                  //hide the no comment section
                  $("._no_comment_posted").hide();
                  $("#_answer_comment_" + _current_commented_id).find('textarea').css('height','37px');
                  //$("#_answer_comment_" + _current_commented_id).slideToggle(500);
                  $("#_answer_comment_" + _current_commented_id)[0].reset();

                }

           });
        }else{
            alert('Your comment should be minimum 10 characters long');
        }
        //alert('i need to post new comment on the answer');
    });

    //profile answer like
    $('body').on('click','._total_answer_likes',function(e){
        e.preventDefault();
        var current_click           = $(this);
        var _liked_question_id      = $(this).data('question-id');
        var _affected_user          = $(this).data('user-id');
        var _token                  = "{{csrf_token()}}";
        $.post("{{URL::to('/answers/plusLike')}}",{
            _token             : _token,
            _liked_question_id : _liked_question_id,
            _affected_user_id  : _affected_user
        },function(response){
            //check for the success response
            if(response.status == "success"){
                if(response.result == 1){
                    $(current_click).html('<span class="like-numbers">'+ response.result + '</span> <i class="icon-like"></i> Like');
                }else{
                    $(current_click).html('<span class="like-numbers">'+ response.result + '</span> <i class="icon-like"></i> Likes');
                }
                
            }
        });
    });


    //comment like

    $('body').on('click','._comment_like',function(e){
        e.preventDefault();
        var current_click = $(this);
        var _token      = "{{csrf_token()}}";
        var _comment_id = $(this).data('comment-id');
        $.post("{{url::to('/answers/comments/plusLike')}}",{ _token : _token , _comment_id : _comment_id }, function(response){
            if(response.status == "success"){
                if(response.total_likes == 1){
                    $(current_click).html(' <i class="icon-like"></i> ' + response.total_likes + ' Like');
                }else{
                    $(current_click).html('<i class="icon-like"></i> ' + response.total_likes + ' Likes');
                }
            }
        });
    });


    

    //comment new reply

    $('body').on('click','._comment_reply_btn',function(e){
        e.preventDefault();
        var current_clicked_btn    = $(this);
        var _comment_reply_message = $(this).parent().closest('div.form-group').find('textarea').val();
        if(_comment_reply_message.length > 10){
               var _current_answer_id  = $(this).data('answer-id');
               var comment_details        = $("#_comment_reply_form_" + _current_answer_id).serialize();
               $.ajax({
                url         : "{{URL::to('/answers/comments/postComment')}}",
                type        : "POST",
                dataType    : 'JSON',
                data        : comment_details,
                success     : function(data){
                    //append new comment
                   $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('div.reply-inner').prepend(data.result).show('slow');
                   //reset the text area size
                   //$(this).parent().closest('div.form-group').find('textarea').css('height','37px');
                   //reset the form
                   if(data.total_reply >= 3){
                     $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-comment span').html('View all ' + (data.total_reply - 2) + ' Replies <i class="fa fa-reply" aria-hidden="true"></i>');
                     $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-comment').show();
                 }else if(data.total_reply == 1){
                    //add new reply box
                    $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('div.profile-comment-section').after(data.result);
                    $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-comment').hide();
                 }else{
                      $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-comment').hide();
                 }

                  //hide the no comment section
                  //$("._no_comment_posted").hide();
                   $("#_comment_reply_form_" + _current_answer_id).find('textarea').css('height','37px');
                   //$("#_comment_reply_form_" + _current_answer_id).slideToggle(500);
                   $("#_comment_reply_form_" + _current_answer_id)[0].reset();

                }

           });

        }else{
            alert('Your reply should be minimum 10 characters long'); 
        }
    });




    autosize(document.querySelectorAll('.profile-question-answer-section textarea'));

});
</script>
@endsection