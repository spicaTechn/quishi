  <div class="profile-comment-wrapper" id="profile-comment-wrapper-{{$recent_comments->id}}">
    <div class="profile-comment-section">
        <div class="profile-coment-user">
            @if($recent_comments->comment_poster->user_profile->image_path != "" && $recent_comments->type != '1')
                <img src="{{ asset('/front/images/profile/'.$recent_comments->comment_poster->user_profile->image_path)}}">
            @else
                <img src="http://localhost/quishi/front /images/profile/1.jpg">
            @endif
        </div>

        <div class="profile-coment-comment">
            <h5>{{ ($recent_comments->type == '0') ? $recent_comments->comment_poster->user_profile->first_name : 'Ananymous' }}</h5>
            <p>{{ ucfirst($recent_comments->comment) }}</p>
            <div class="profile-author-comment">
                <ul>
                    <li><a href="javascript:void(0);" class="_comment_like" data-comment-id="{{ $recent_comments->id}}"><i class="icon-like"></i> {{ $recent_comments->total_like_counts }} {{ ($recent_comments->total_like_counts > 1) ? 'Likes' : 'Like' }}</a></li>
                    @if(Auth::check())
                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                    @endif
                </ul>
                @if(Auth::check())
                <form action="javascript:void(0);" name="_comment_reply_form" id="_comment_reply_form_{{ $recent_comments->id }}">
                     <input type="hidden" name="_parent_comment_id"  value="{{$recent_comments->id}}"/>
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
                                <input type="checkbox" id="check-for-login" name="_hide_name_{{$recent_comments->id}}">
                                <label for="check-for-login">Post Anonymously</label>
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
                <div class="form-group" id="comment-1">
                        <input type="hidden" name="_comment_parent_id" value="{{$recent_comments->id}}"/>
                        <input type="hidden" name="post_id" value="{{$recent_comments->post_id}}"/>
                        <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                        <button class="btn btn-default _comment_reply_btn" data-answer-id="{{$recent_comments->id}}" ><i class="icon-cursor"></i></button>
                    
                </div>
            </div>
            </form>
            @endif
        </div>
    </div>
    @if($recent_comments->childern()->count() > 0)
    <div class="reply-inner">
        @foreach($recent_comments->childern as $comment_reply)
        <div class="profile-comment-section">
            <div class="profile-coment-user">
                @if($recent_comments->answer->user->user_profile->image_path != "")
                <img src="{{ asset('/front/images/profile/'.$recent_comments->answer->user->user_profile->image_path)}}">
                @else
                    <img src="http://localhost/quishi/front /images/profile/1.jpg">
                @endif
            </div>
            
            <div class="profile-coment-comment">
                <h5>{{$comment_reply->answer->user->user_profile->first_name}}</h5>
                <p>{{ $comment_reply->comment }}</p>
                
            </div>
        </div>
        @endforeach
        <!-- end inner profile-comment-section 1 -->
        <div class="view-all-comment">
            <span>View all {{ ($recent_comments->childern()->count() - 2)}} Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
        </div>
    </div> 
    @endif                                                                   
</div>