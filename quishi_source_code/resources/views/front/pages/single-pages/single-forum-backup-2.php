<!-- end forume title section -->
        <div class="all-forum-comments profile-leave-comments">
            <h6>Post a new answer</h6>
            <form action="javascript:void(0);" method="post" name="_quishi_new_forum_answer" id="_quishi_new_forum_answer">
                {{csrf_field()}}
                <input type="hidden" name="_parent_forum_question_id" value="{{$question->id}}"/>
                <input type="hidden" name="_parent_answer_id" value="0"/>
                <input type="hidden" name="_forum_career_advisor_id" value="{{$question->user->id}}"/>
                <div class="profile-reply-form" id="profile-reply-form">
                    <div class="reply-user-image">
                         @if(Auth::check())
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
                            <button class="btn btn-default btn_comment"  data-blog-id="{{$question->id}}"><i class="icon-cursor"></i></button>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </form>
            @if($question->forum_question_answers()->where('parent',0)->count() > 0)
                @foreach($question->forum_question_answers()->where('parent',0)->get() as $forum_answer)
                <div class="forum-question-answer-section @if($forum_answer->type == 1) {{ 'veirfied' }} @endif" id="forum_question_answer{{$forum_answer->id}}">
                    <div class="post-user-detail">
                        <div class="post-user">
                            @if($forum_answer->user->user_profile->image_path == "" || $forum_answer->type == 1)
                            <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            @else
                                <img src="{{ asset('/front/images/profile/'.$forum_answer->user->user_profile->image_path) }}">
                                <span class="icon-check"></span>
                            @endif
    
                        </div>
                        <div class="post-user-detail">
                            @if($forum_answer->type == 0)
                                <h6>{{ $forum_answer->user->user_profile->first_name }} <span>{{ ucwords($forum_answer->user->careers()->first()->title) .' - ' .$forum_answer->user->user_profile->location }}</span></h6>
                            @else
                                <h6>Ananymous</h6>
                            @endif
                        </div>
                    </div>
                    <p>{{ $forum_answer->content }}</p>

                    <div class="forum-like-comment-view ">
                        <ul>
                            <li><a href="#" class="_total_answer_likes"><span class="like-numbers">0</span> <i class="icon-like"></i> Like</a></li>
                            <li><a href="#" class="go-to-comment"><span class="like-numbers">0</span> <i class="icon-bubble"></i> Comments</a></li>
                        </ul>
                    </div>

                    <div class="forum-leave-comment">
                        <h4 class="small">Leave a Comment</h4>
                        <form>
                            <div class="forum-reply-form">
                                <div class="reply-user-image">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>
                                <div class="forum-reply-coment-box">
                                    <div class="comment-method">
                                        <ul>
                                            <li>
                                                <a>
                                                    <input type="checkbox" id="check-for-login17" name="_hide_name17">
                                                    <label for="check-for-login">Post Anonymously</label>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="1" placeholder="Your Message Here !" required=""></textarea>
                                        <button class="btn btn-default btn_comment" data-question-id="17"><i class="icon-cursor"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->
                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->

                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->
                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->

                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->
                        <div class="forum-comment-wrapper">
                            <div class="forum-comment-section">
                                <div class="profile-coment-user">
                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                </div>

                                <div class="forum-coment-comment">
                                    <h5>Trishal Kandel</h5>
                                    <p>Hello ram i am posting the comment on your profile</p>
                                    <div class="forum-author-comment profile-author-comment">
                                        <ul>
                                            <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                            <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                        </ul>
                                        <form>

                                            <div class="clearfix">
                                                <div class="reply-user-image">
                                                    <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                                </div>

                                                <div class="comment-method">
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <input type="checkbox" id="check-for-login">
                                                                <label for="check-for-login">Post Anonymously</label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                                <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end forum-comment-wrapper -->

                        <div class="view-all-forum-comment">
                            <span>View more <i class="fa fa-reply" aria-hidden="true"></i> </span>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($question->forum_question_answers()->count() > 5)
                <div class="show-more-cmts">
                    <a href="#" class="btn btn-default">show more comments</a>
                </div>
                @endif
            @else
                <div class="_no_comment_posted_yet">
                    
                    <p>There are no answer posted yet</p>
                </div>
            @endif
        </div>