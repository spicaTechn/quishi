
        <div class="row">
            @foreach($users as $user)
            <div class="col-lg-4">
                <div class="trending-profiles-section">
                    <div class="full-list-view">
                        <div class="profile-image">
                            <img src="{{asset('/front')}}/images/profile/{{ $user->user_profile->image_path }}">
                        </div>
                        <div class="profile-desination">
                            <h3>{{ $user->user_profile->first_name }}</h3>
                            @foreach($user->careers as $career)
                            <span>{{ $career->title }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="full-list-view">
                        <div class="profile-slills">
                            <ul>
                                @foreach($user->tags as $tag)
                                <li><a href="#">{{$tag->title}}</a></li>
                               <!--  <li><a href="#">jQuery</a></li>
                                <li><a href="#">HTML5</a></li> -->
                                @endforeach
                            </ul>
                        </div>
                        <div class="profile-info">
                            <p>{{ str_limit($user->user_profile->description,70) }}</p>
                        </div>
                    </div>

                    <div class="full-list-view">
                        <div class="like-view">
                            <div class="row">
                                <div class="col-sm-6">
                                    @csrf
                                    <div class="view-section">
                                        <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$user->id}}" id="total_likes">
                                            <i class="icon-like"></i>
                                        </a>
                                        <span class="like{{ $user->id }}" id="like" value="{{ $user->id }}">{{ $user->user_profile->total_likes }} Likes</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="view-section">
                                        <a href="#"><i class="icon-eye"></i></a>
                                        <span>{{ $user->user_profile->profile_views }} Views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="view-profile">
                            <a href="{{URL::to('/career-advisior').'/'.$user->id}}">view profile</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

