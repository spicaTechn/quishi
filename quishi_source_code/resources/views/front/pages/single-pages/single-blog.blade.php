@extends('front.layout.master')
@section('content')
<div class="blog-single-pg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-single-det">
                    <div class="fixed-top-section" id="blogHeader">
                        
                        <div class="blog-single-post clearfix">
                              @if($blog_details->user->user_profile()->select('image_path')->first())
                                <div class="post-img">
                                    <img src="{{ asset('/front/images/profile/'.$blog_details->user->user_profile->image_path)}}" alt="">
                                </div>
                              @else
                                <div class="post-img">
                                   <img src="{{ asset('/front/images/profile/users.png') }}" >
                                </div>
                              @endif
                            <div class="post-date">
                                <ul>
                                    <li>Published on
                                        <time><b>{{ Carbon\Carbon::parse($blog_details->published_date)->format('d M Y') }}</b></time>
                                    </li>
                                    <li>By: <a href="{{URL::to('/career-advisior/'.$blog_details->user->id)}}" target="_blank">{{ucwords($blog_details->user->name)}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end blog-single-post -->

                        <div class="blog-single-top">
                            <h1>{{ $blog_details->title }}</h1>
                            
                        </div>
                        <!-- end blog single title -->
                    </div>

                    <div class="blog-single-content">
                        <p>{{  $blog_details->abstract }}</p>
                    </div>

                    <div class="blog-single-img">
                        @if($blog_details->image_path != "")
                            <img src="{{ asset('/front/images/blogs/'.$blog_details->image_path) }}" alt="" style="">
                        @else
                            <img src="{{ asset('/front/images/blogs/1539154047.jpg') }}" alt="" style="">
                        @endif
                    </div>
                    <div class="single-bl-info">
                        <p>{!! $blog_details->content !!}</p>

                       <!--  <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante adipiscing elit. Integer posuere erat a ante.</p>
                        </blockquote> -->
                    </div>
                    <div class="share-blog" style="display: block;">
                        <ul>
                            <li>Share this post</li>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" target="_blank"><i class="icon-social-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ url()->full() }}" target="_blank"#"><i class="icon-social-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->full() }}" target="_blank""><i class="icon-social-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{ url()->full() }}" target="_blank""><i class="icon-social-google" aria-hidden="true"></i></a></li>
                        </ul>

                        <ul>
                            <li class="blog-page-like"><i class="icon-like"></i> <span class="current_like">{{$blog_details->total_like_counts}}</span> {{($blog_details->total_like_counts > 1) ? 'Likes' : 'Like' }}</li>
                        </ul>
                    </div>

                    <!-- posts -->
                    <div class="profile-leave-comments blog-leave-comment">
                        <h4 class="small">Leave a Comment</h4>
                        <form action="javascript:void(0);" method="post" name="_quishi_new_blog_comment" id="_quishi_new_blog_comment">
                            {{csrf_field()}}
                            <input type="hidden" name="_parent_post_id" value="{{$blog_details->id}}"/>
                            <input type="hidden" name="_parent_comment_id" value="0"/>
                            <input type="hidden" name="_blog_career_advisor_id" value="{{$blog_details->user->id}}"/>
                            <div class="profile-reply-form" id="profile-reply-form">
                                <div class="reply-user-image">
                                     @if(Auth::check())
                                      @if(Auth::user()->user_profile->image_path != "")
                                        <img src="{{ asset('/front')}}/images/profile/{{Auth::user()->user_profile->image_path}}">
                                      @else
                                        <img src="{{ asset('/front')}}/images/profile/1.jpg">
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
                                                    <input type="checkbox" id="check-for-login" name="_hide_name">
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
                                        <button class="btn btn-default btn_comment"  data-blog-id="{{$blog_details->id}}"><i class="icon-cursor"></i></button>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </form>
                        @if($blog_details->comments->count() > 0)
                        @foreach($blog_details->comments()->where('parent',0)->orderBy('created_at','desc')->get() as $blog_comment)
                        <div class="profile-comment-wrapper" id="profile-comment-wrapper-{{$blog_comment->id}}">
                            <div class="profile-comment-section">
                                <div class="profile-coment-user">
                                   @if($blog_comment->comment_poster->user_profile->image_path != "" && $blog_comment->type != '1')
                                        <img src="{{ asset('/front/images/profile/'.$blog_comment->comment_poster->user_profile->image_path)}}">
                                    @else
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    @endif
                                </div>

                                <div class="profile-coment-comment">
                                    <h5>{{ ($blog_comment->type == '0') ? $blog_comment->comment_poster->user_profile->first_name : 'Ananymous' }}</h5>
                                    <p>{{ ucfirst($blog_comment->comment) }}</p>
                                    <div class="profile-author-comment">
                                        <ul>
                                            <li><a href="javascript:void(0);" class="_comment_like" data-comment-id="{{ $blog_comment->id}}"><i class="icon-like"></i>{{ ' '. $blog_comment->total_like_counts }} {{ ($blog_comment->total_like_counts > 1) ? ' Likes' : ' Like' }}</a></li>
                                            @if(Auth::check())
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                            @endif
                                        </ul>
                                        @if(Auth::check())
                                        <form action="javascript:void(0);" name="_comment_reply_form" id="_comment_reply_form_{{ $blog_comment->id }}">
                                             <input type="hidden" name="_parent_comment_id"  value="{{$blog_comment->id}}"/>
                                             <input type="hidden" name="_quishi_comment_posted_by" value="{{$blog_comment->posted_by}}"/>
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
                                                        <input type="checkbox" id="check-for-login" name="_hide_name_{{$blog_comment->id}}">
                                                        <label for="check-for-login">Post Anonymously</label>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="form-group" id="comment-1">
                                                <input type="hidden" name="_career_advisor_id" value="{{$blog_comment->user_id}}"/>
                                                <input type="hidden" name="answer_id" value="{{$blog_comment->post_id}}"/>
                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn" data-answer-id="{{$blog_comment->id}}"><i class="icon-cursor"></i></button>
                                            
                                        </div>
                                    </form>
                                    @endif
                                    </div>
  

                                    </div>
                                    
                                </div>
                            @if($blog_comment->childern()->count()>0)
                            <div class="reply-inner">
                                @foreach($blog_comment->childern()->orderBy('created_at','desc')->get() as $comment_reply)
                                <div class="profile-comment-section" id="blog-comment-reply{{$comment_reply->id}}">
                                    <div class="profile-coment-user">
                                        @if($comment_reply->comment_poster->user_profile->image_path != "" && $comment_reply->type != '1')
                                        <img src="{{ asset('/front/images/profile/'.$comment_reply->comment_poster->user_profile->image_path)}}">
                                        @else
                                            <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                        @endif
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>{{ ($comment_reply->type == '0') ? $comment_reply->comment_poster->user_profile->first_name : 'Ananymous' }}</h5>
                                        <p>{{ $comment_reply->comment }}</p>
                                        
                                    </div>
                                </div>
                                @endforeach
                                <!-- end inner profile-comment-section -->
                                 <div class="view-all-comment"  style="{{ ($blog_comment->childern()->count() > 2) ? 'display:block;' : 'display:none;' }} " >
                                    <span>View all {{ ($blog_comment->childern()->count() - 2)}} Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
                                </div>
                            </div> 
                            @else
                            @endif                                                                       
                        </div>
                        <!-- end profile comment-wrapper 1-->

                        @endforeach
                         <div class="view-all-blog-comments" style=" {{ (($blog_details->comments()->where('parent',0)->count()) < 4) ? 'display: none;'  : 'display:block;' }} ">
                            <span>View all {{ (($blog_details->comments()->where('parent',0)->count()) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
                        </div>  
                        @else
                        <div class="view-all-blog-comments" style=" {{ (($blog_details->comments()->where('parent',0)->count()) < 4) ? 'display: none;'  : 'display:block;' }} " >
                            <span>View all {{ (($blog_details->comments()->where('parent',0)->count()) - 3)}} Comments <i class="fa fa-reply" aria-hidden="true"></i> </span>
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

                    <!--blog comment section here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_specific_js')
 <script>
    $(document).ready(function(){
         autosize(document.querySelectorAll('.blog-leave-comment textarea.form-control'));

    $('.blog-page-like').on('click', function(e){
        //prevent the default action
        e.preventDefault();
        var current_click = $(this);
        var current_like = $(this).find('span.current_like').html();
        $.post("{{route('page_like')}}",{_token: "{{csrf_token()}}",blog_id: "{{$blog_details->id}}"},function(data){
            if(data.status == "success"){
                $(current_click).find('span.current_like').html(data.result);
            }
        });
    });

        //add new comment on profile answer 
    $('body').on('click','.btn_comment',function(e){
        e.preventDefault();
        var current_clicked_btn = $(this);
        var _reply_message = $(this).parent().closest('div.form-group').find('textarea').val();
        if(_reply_message.length > 10){
           var comment_details           = $("#_quishi_new_blog_comment").serialize();
            $.ajax({
                url         : "{{URL::to('/blogs/postComment')}}",
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
        $.post("{{url::to('/blogs/comments/plusLike')}}",{ _token : _token , _comment_id : _comment_id }, function(response){
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
                url         : "{{URL::to('/blogs/comments/postComment')}}",
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
                     $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-blog-comments span').html('View all ' + (data.total_reply - 2) + ' Replies <i class="fa fa-reply" aria-hidden="true"></i>');
                     $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-blog-comments').show();
                 }else if(data.total_reply == 1){
                    //add new reply box
                    $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('div.profile-comment-section').after(data.result);
                    $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-blog-comments').hide();
                 }else{
                      $(current_clicked_btn).parent().closest('div.profile-comment-wrapper').find('.view-all-blog-comments').hide();
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