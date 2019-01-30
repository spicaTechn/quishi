@extends('front.layout.master') 
@section('title')
 {{$question->slug . ' | Quishi'}}
@endsection
@section('page_specific_css')
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}"> 
@endsection
@section('content')
<div class="forum-comment-section">
    <div class="container">
        <div class="forum-title-section forum-comment-title-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-forum-user">
                        <div class="forum-user">
                            @if(($question->type == 1) || ($question->user->user_profile->image_path == ""))
                                <img src="{{asset('/front')}}/images/default-profile.jpg"> 
                            @else
                                 <img src="{{asset('/front/images/profile/'.$question->user->user_profile->image_path)}}">
                            @endif
                        </div>

                        <div class="forum-title-bar">
                            
                             <div class="user-detail">

                                <!-- <h5>Ram<span> Web Developer</span></h5> -->
                            
                            

                                <h5>@if($question->type == 1) {{ 'Ananymous' }} @else  <?php echo $question->user->user_profile->first_name .'<span>'.ucwords($question->user->careers()->first()->title).' - '.$question->user->user_profile->location .'</span>';?> @endif </h5>
                            </div>
                            

                        </div>
                    </div>
                    <h4>{{ $question->title }}</h4>
                </div>
                
                <div class="col-md-12">
                    <div class="forum-share-bar">
                        <div class="product-share">
                            <div class="sh-title"> <i class="icon-share"></i> Share</div>
                            <div class="show-on-share social-share">
                                <ul>
                                    <li>
                                        <a href="http://www.facebook.com/share.php?u={{ url()->current() }}" target="_blank">
                                            <i class="icon-social-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/home?status={{ url()->current() }}" target="_blank">
                                            <i class="icon-social-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $question->title }}&source={{ url()->current() }}" target="_blank">
                                            <i class="icon-social-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url={{ url()->current() }}" onclick="javascript:window.open(this.href, '_blank','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank">
                                            <i class="icon-social-google" aria-hidden="true"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
         <div class="profile-leave-comments blog-leave-comment">
            <h4 class="small">Leave a Answer</h4>
            <form action="javascript:void(0);" method="post" name="_quishi_new_blog_comment" id="_quishi_new_blog_comment">
                {{csrf_field()}}
                <input type="hidden" name="_parent_post_id" value="{{$question->id}}"/>
                <input type="hidden" name="_parent_comment_id" value="0"/>
                <input type="hidden" name="_blog_career_advisor_id" value="{{$question->user->id}}"/>
                <div class="profile-reply-form" id="profile-reply-form">
                    <div class="reply-user-image">
                         @if(Auth::check() && Auth::user()->user_profile()->count() > 0)
                          @if(Auth::user()->user_profile->image_path != "")
                            <img src="{{ asset('/front')}}/images/profile/{{Auth::user()->user_profile->image_path}}">
                          @else
                             <img src="{{asset('/front')}}/images/default-profile.jpg"> 
                          @endif
                        @endif
                    </div>
                    <div class="reply-coment-box">
                        <div class="comment-method">
                            <ul>
                                @if(! Auth::check())
                                <li>Please <a href="{{URL::to('/login')}}">Signin</a> or <a href="{{ URL::to('/register')}}">Create an account </a> to post a answer</li>
                               @elseif(Auth::user()->user_profile()->count() <= 0)
                                        <li>Please <a href="{{URL::to('/profile')}}">Verify your account </a> to post a comment</li>
                                    
                                @else
                                 @if(Auth::user()->user_profile->status == 1)
                                    <li>
                                        <a>
                                            <input type="checkbox" id="check-for-login" name="_hide_name">
                                            <label for="check-for-login">Post Anonymously</label>
                                        </a>
                                    </li>
                                 @else
                                     <li>Please <a href="{{URL::to('/profile')}}">Verify your account </a> to post a comment</li>
                                 @endif
                                @endif
                            </ul>
                        </div>
                        @if(Auth::check() && Auth::user()->user_profile()->count() > 0)
                         @if(Auth::user()->user_profile->status == 1)
                            <div class="form-group">
                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" name="_comment_message" required></textarea>
                                <!-- <input type="text " name="" class="form-control message-box" placeholder="Your Message Here !"> -->
                                <button class="btn btn-default btn_comment"  data-blog-id="{{$question->id}}"><i class="icon-cursor"></i></button>
                            </div>
                         @endif
                        @endif
                        
                    </div>
                </div>
            </form>
            @if($question->forum_question_answers->count() > 0)
            @foreach($question->forum_question_answers()->where('parent',0)->orderBy('created_at','desc')->get() as $forum_answer)
            <div class="profile-comment-wrapper" id="profile-comment-wrapper-{{$forum_answer->id}}">
                <div class="profile-comment-section">
                    <div class="profile-coment-user">
                       @if($forum_answer->answer_poster->user_profile->image_path != "" && $forum_answer->type != '1')
                            <img src="{{ asset('/front/images/profile/'.$forum_answer->answer_poster->user_profile->image_path)}}">
                        @else
                            <img src="{{asset('/front')}}/images/default-profile.jpg"> 
                        @endif
                    </div>

                    <div class="profile-coment-comment">
                        <h5>{{ ($forum_answer->type == '0') ? $forum_answer->answer_poster->user_profile->first_name : 'Ananymous' }}</h5>
                        <p>{{ ucfirst($forum_answer->content) }}</p>
                        <div class="profile-author-comment">
                            <ul>
                                <li><a href="javascript:void(0);" class="_comment_like" data-comment-id="{{ $forum_answer->id}}"><i class="icon-like"></i>{{ ' '. $forum_answer->total_like_counts }} {{ ($forum_answer->total_like_counts > 1) ? ' Likes' : ' Like' }}</a></li>
                                @if(Auth::check() && Auth::user()->user_profile()->count() > 0 )
                                    @if(Auth::user()->user_profile->status == 1)
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    @endif
                                @endif
                            </ul>
                            @if(Auth::check() && Auth::user()->user_profile()->count() > 0)
                                @if(Auth::user()->user_profile->status == 1)
                                <form action="javascript:void(0);" name="_comment_reply_form" id="_comment_reply_form_{{ $forum_answer->id }}">
                                     <input type="hidden" name="_parent_comment_id"  value="{{$forum_answer->id}}"/>
                                     <input type="hidden" name="_quishi_comment_posted_by" value="{{$forum_answer->posted_by}}"/>
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <div class="reply-user-image reply-subinner-image">
                                        @if(Auth::check())
                                          @if(Auth::user()->user_profile->image_path != "")
                                            <img src="{{ asset('/front')}} /images/profile/{{Auth::user()->user_profile->image_path}}">
                                          @else
                                            <img src="{{ asset('/front')}} /images/profile/default-profile.jpg">
                                          @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="comment-method">
                                    <ul>
                                        <li>
                                            <a>
                                                <input type="checkbox" id="check-for-login" name="_hide_name_{{$forum_answer->id}}">
                                                <label for="check-for-login">Post Anonymously</label>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="form-group" id="comment-1">
                                        <input type="hidden" name="_career_advisor_id" value="{{$forum_answer->user_id}}"/>
                                        <input type="hidden" name="answer_id" value="{{$forum_answer->forum_question_id}}"/>
                                        <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                        <button class="btn btn-default _comment_reply_btn" data-answer-id="{{$forum_answer->id}}"><i class="icon-cursor"></i></button>
                                    
                                </div>
                            </form>
                            @endif
                        @endif
                        </div>


                        </div>
                        
                    </div>
                @if($forum_answer->childern()->count() > 0)
                <div class="reply-inner">
                    @foreach($forum_answer->childern()->orderBy('created_at','desc')->get() as $comment_reply)
                    <div class="profile-comment-section" id="blog-comment-reply{{$comment_reply->id}}">
                        <div class="profile-coment-user">
                            @if($comment_reply->answer_poster->user_profile->image_path != "" && $comment_reply->type != '1')
                            <img src="{{ asset('/front/images/profile/'.$comment_reply->answer_poster->user_profile->image_path)}}">
                            @else
                                <img src="http://localhost/quishi/front/images/default-profile.jpg">
                            @endif
                        </div>
                        
                        <div class="profile-coment-comment">
                            <h5>{{ ($comment_reply->type == '0') ? $comment_reply->answer_poster->user_profile->first_name : 'Ananymous' }}</h5>
                            <p>{{ $comment_reply->content }}</p>

                            <div class="profile-author-comment">
                            <ul>
                                <li><a href="javascript:void(0);" class="_comment_like" data-comment-id="{{ $comment_reply->id}}"><i class="icon-like"></i>{{ ' '. $comment_reply->total_like_counts }} {{ ($comment_reply->total_like_counts > 1) ? ' Likes' : ' Like' }}</a></li>
                            </ul>
                          </div>
                            
                        </div>
                    </div>
                    @endforeach
                    <!-- end inner profile-comment-section -->
                     <div class="view-all-comment"  style="{{ ($forum_answer->childern()->count() > 2) ? 'display:block;' : 'display:none;' }} " >
                        <span>View all {{ ($forum_answer->childern()->count() - 2)}} Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
                    </div>
                </div> 
                @else
                @endif                                                                       
            </div>
            <!-- end profile comment-wrapper 1-->

            @endforeach
             <div class="view-all-blog-comments" style=" {{ (($question->forum_question_answers()->where('parent',0)->count()) < 4) ? 'display: none;'  : 'display:block;' }} ">
                <span>View all {{ (($question->forum_question_answers()->where('parent',0)->count()) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
            </div>  
            @else
            <div class="view-all-blog-comments" style=" {{ (($question->forum_question_answers()->where('parent',0)->count()) < 4) ? 'display: none;'  : 'display:block;' }} " >
                <span>View all {{ (($question->forum_question_answers()->where('parent',0)->count()) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
            </div>
             <div class="_no_comment_posted" id="_no_comment_posted">
                <div class="profile-comment-section">
                    <div class="_no_comment_posted_yet">
                        <p>There are no answer posted yet</p>
                    </div>
                </div>
            </div>
          @endif
        </div>
    </div>
</div>
@endsection @section('page_specific_js')
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        autosize(document.querySelectorAll('.blog-leave-comment textarea.form-control'));
             //add new comment on profile answer 
        $('body').on('click','.btn_comment',function(e){
            e.preventDefault();
            var current_clicked_btn = $(this);
            var _reply_message = $(this).parent().closest('div.form-group').find('textarea').val();
            if(_reply_message.length > 10){
               var comment_details           = $("#_quishi_new_blog_comment").serialize();
                $.ajax({
                    url         : "{{URL::to('/forums/postAnswer')}}",
                    type        : "POST",
                    dataType    : 'JSON',
                    data        : comment_details,
                    success     : function(data){
                        //append new comment
                       $(current_clicked_btn).parent().closest('div.profile-leave-comments').find('form#_quishi_new_blog_comment').after(data.result).show('slow');
                       //$(current_clicked_btn).parent().closest('div.profile-question-answer-section').find('a.go-to-comment > span').html(data.total_comment);
                       //reset the text area size
                       //$(this).parent().closest('div.form-group').find('textarea').css('height','37px');
                       //reset the form
                       if(data.total_comment >= 4){
                         $('.view-all-blog-comments span').html('View all ' + (data.total_comment - 3) + ' Comments <i class="fa fa-reply" aria-hidden="true"></i>');
                         $('.view-all-blog-comments').show();
                     }else{
                        $('.view-all-blog-comments').hide();
                     }

                      //hide the no comment section
                      $("._no_comment_posted").hide();
                      $("#_quishi_new_blog_comment").find('textarea').css('height','37px');
                      //$("#_answer_comment_" + _current_commented_id).slideToggle(500);
                      $("#_quishi_new_blog_comment")[0].reset();

                    }

               });
            }else{
                alert('Your comment should be minimum 10 characters long');
            }
            //alert('i need to post new comment on the answer');
        });

        //like comment
        $('body').on('click','._comment_like',function(e){
            e.preventDefault();
            var current_click = $(this);
            var _token      = "{{csrf_token()}}";
            var _comment_id = $(this).data('comment-id');
            $.post("{{url::to('/forums/answers/plusLike')}}",{ _token : _token , _comment_id : _comment_id }, function(response){
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
            var  current_clicked_btn    = $(this);
            var _comment_reply_message = $(this).parent().closest('div.form-group').find('textarea').val();
            if(_comment_reply_message.length > 10){
                   var _current_answer_id  = $(this).data('answer-id');
                   var comment_details        = $("#_comment_reply_form_" + _current_answer_id).serialize();
                   $.ajax({
                    url         : "{{URL::to('/forums/answers/postReply')}}",
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



    });
</script>
@endsection