@extends('front.career-advisor.layout.master')
@section('title','Followers List')
@section('page_specific_css')
@endsection
@section('content')

    <div class="follows-section profile-main-section">
        <h4>@if(Auth::user()->followers()->count() == 0)
             {{ 'You have no followers' }}
            @elseif(Auth::user()->followers->count() == 1)
             {{ '1 Career Advisor Follow you' }}
            @else
            {{ Auth::user()->followers()->count().' Career Advisors Follow you' }} 
            @endif
        </h4>
        <div class="follower-wrap">
            @if($followers->count() > 0)
            <div class="row">
                @foreach($followers as $follower)
                <div class="col-lg-3 col-md-4">
                    <div class="trending-profiles-section">
                        <div class="profile-image">
                            @if(empty($follower->user_profile->image_path))
                                <img src="{{asset('/front')}}/images/default-profile.jpg">
                                @else
                                  <img src="{{asset('/front')}}/images/profile/{{ $follower->user_profile->image_path }}">
                            @endif
                           
                        </div>
                        <div class="profile-desination">
                            <h3>{{$follower->user_profile->first_name }}</h3>
                            <span>{{ ucwords($follower->careers()->first()->title) }}</span>
                        </div>
                        <div class="full-list-view">
                            <div class="profile-slills">
                                <ul>
                                    @foreach($follower->tags as $tag)
                                    <li><a href="#">{{ucwords($tag->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="profile-info">
                                <p>{{ ucfirst(str_limit($follower->user_profile->description,70)) }}</p>
                            </div>
                        </div>
                        <div class="full-list-view">
                            <div class="like-view">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @csrf
                                        <div class="view-section">
                                            <a href="javascript:void(0);" class="total_likes" data-profile-id="{{$follower->id }}" id="total_likes">
                                                <i class="icon-like"></i>
                                            </a>
                                            <span class="like{{$follower->id }}" id="like" value="{{$follower->id }}">{{ quishi_convert_number_to_human_readable($follower->user_profile->total_likes) }} Likes</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="view-section">
                                            <a href="#"><i class="icon-eye"></i></a>
                                            <span>{{ quishi_convert_number_to_human_readable($follower->user_profile->profile_views) }} Views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="view-profile">
                                
                                <a href="{{URL::to('/career-advisor').'/'.$follower->id}}">view profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <!-- end col -->
            </div>
            <div class="row follower_following_pagination">
                <div class="pagination">
                    {{ $followers->links() }}
                </div>
            </div>
            @else
                <div class="_no_result_founds">
                </div>
            @endif
            <!-- end row -->
        </div>
        <!-- end follower-wrap -->
    </div>
</div>
</div>


<!-- end follows-section -->
@endsection
@section('page_specific_js')
@endsection