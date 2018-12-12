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

                    <!-- share this post -->
                    <div class="blog_comment_section">
                        <div id="disqus_thread"></div>
                    </div>
                    <!-- posts -->
                    <div class="profile-leave-comments blog-leave-comment">
                        <h4 class="small">Leave a Comment</h4>
                        <form action="">
                            <div class="profile-reply-form" id="profile-reply-form">
                                <div class="reply-user-image">
                                    <img src="http://localhost/quishi/front /images/profile/1.jpg">
                                </div>
                                <div class="reply-coment-box">
                                    <div class="comment-method">
                                        <ul>
                                            <li><a href="#">Login</a></li>
                                            <li>
                                                <a>
                                                    <input type="checkbox" id="check-for-login">
                                                    <label for="check-for-login">Post Anonymously</label>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group anonymously-user">
                                        <input type="email" name="" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="1" placeholder="Your Message Here !"></textarea>
                                        <button class="btn btn-default"><i class="icon-cursor"></i></button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>

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
                        <!-- end profile comment-wrapper 2-->

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
                        </div>
                        <!-- end profile comment-wrapper 3-->

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
                        </div>
                        <!-- end profile comment-wrapper 4-->

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
                        </div>
                        <!-- end profile comment-wrapper 5-->

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
                        </div>
                        <!-- end profile comment-wrapper 6-->
                        <div class="view-all-blog-comments">
                            <span>View all comments</span>
                        </div>
                    </div>
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
    });
 </script>
@endsection