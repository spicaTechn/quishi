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
               
                <span>{{ $user_list['career']  }}</span>
           
            </div>
        </div>

        <div class="full-list-view">
            <div class="profile-slills">
                <ul>
                    @foreach($user_list['user_tag'] as $key=>$tag)
                    <li><a href="#">{{$tag['tag_title']}}</a></li>
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