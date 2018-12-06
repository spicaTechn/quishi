<div class="profile-comment-wrapper">
    <div class="profile-comment-section">
        <div class="profile-coment-user">
            <img src="http://localhost/quishi/front /images/profile/1.jpg">
        </div>

        <div class="profile-coment-comment">
            <h5>Sarah Conner</h5>
            <p>{{$recent_comments->content}}</p>
            <div class="profile-author-comment">
                <ul>
                    <li><a href="#"><i class="icon-like"></i> {{$recent_comments->total_likes}} {{ ($recent_comments->total_likes > 1) ? 'Likes' : 'Like' }}</a></li>
                    @if(Auth::check())
                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                    @endif
                </ul>
                <form action="javascript:void(0);" name="_comment_reply_form">
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
                                <input type="checkbox" id="check-for-login" name="_hide_name">
                                <label for="check-for-login">Post Anonymously</label>
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
                <div class="form-group" id="comment-1">
                        <input type="hidden" name="_comment_parent_id" value=""/>
                        <input type="hidden" name="answer_id" value="{{--{{$question['answer_id']}}--}}"/>
                        <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required"></textarea>
                        <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>
                    
                </div>
            </div>
            </form>
        </div>
    </div>                                                                  
</div>
<!-- end profile comment-wrapper 1-->