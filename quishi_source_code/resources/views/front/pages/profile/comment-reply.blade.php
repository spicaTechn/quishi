@if($total_record == 1)
<div class="reply-inner">
@endif
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

@if($total_record == 1)
<div class="view-all-comment" style="display: none;">
    <span>View all {{ $total_record }} Replies <i class="fa fa-reply" aria-hidden="true"></i> </span>
</div>
@endif