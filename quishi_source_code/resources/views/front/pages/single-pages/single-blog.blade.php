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
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::path() }}" target="_blank"><i class="icon-social-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ Request::path() }}" target="_blank"#"><i class="icon-social-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::path() }}" target="_blank""><i class="icon-social-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{ Request::path() }}" target="_blank""><i class="icon-social-google" aria-hidden="true"></i></a></li>
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
                        <div class="profile-comment-wrapper">
                            <div class="profile-comment-section">
                                <div class="profile-coment-user">
                                    <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                </div>

                                <div class="profile-coment-comment">
                                    <h5>Sarah Conner</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                    nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                    <div class="profile-author-comment">
                                        <ul>
                                            <li><a href="#"><i class="icon-like"></i> Likes</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <div class="form-group" id="comment-1" style="display: none;">
                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" style="overflow: hidden; overflow-wrap: break-word; border-color: rgb(138, 196, 63);"></textarea>
                                            <button class="btn btn-default"><i class="icon-cursor"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="reply-inner">
                                <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>Sarah Conner</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                        nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                        
                                    </div>
                                </div>
                                <!-- end inner profile-comment-section 1 -->

                                 <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>Sarah Conner</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                        nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                        
                                    </div>
                                </div>
                                <!-- end inner profile-comment-section 2 -->

                                 <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>Sarah Conner</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                        nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                        
                                    </div>
                                </div>
                                <!-- end inner profile-comment-section 3 -->

                                 <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>Sarah Conner</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                        nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                        
                                    </div>
                                </div>
                                <!-- end inner profile-comment-section 4 -->

                                 <div class="profile-comment-section">
                                    <div class="profile-coment-user">
                                        <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                    </div>
                                    
                                    <div class="profile-coment-comment">
                                        <h5>Sarah Conner</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                                        nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                                        
                                    </div>
                                </div>
                                <!-- end inner profile-comment-section 5 -->
                                <div class="view-all-comment">
                                    <span>View all 4 Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
                                </div>
                            </div>                                                                        
                        </div>
                        <!-- end profile comment-wrapper 1-->

                        @else

                        @endif
                        <div class="view-all-blog-comments">
                            <span>View all comments</span>
                        </div>
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

    });
 </script>
@endsection