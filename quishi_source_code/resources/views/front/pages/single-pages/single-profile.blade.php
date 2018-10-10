@extends('front.layout.master')
@section('content')
<div class="cover-photo">
    <img src="{{ asset('/front') }}/images/profile/banner.jpg" alt="cover photo">
</div>
<div class="front-profile-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="profile-left">
                            <div class="front-profile">
                                <img src="{{asset('/front')}}/images/profile/{{ $user->user_profile->image_path }}" alt="profile- pic">
                            </div>
                            <!-- end front-profile -->
                            <div class="profile-name-detail profile-name-detail-xs">
                                <h2>{{ $user->user_profile->first_name }}</h2>
                                @foreach($user->careers as $career)
                                 <span class="small">{{ $career->title }}</span>
                                @endforeach
                                <span class="small">{{ $user->email }}</span>
                            </div>
                            <!-- end profile-name-detail -->
                            <div class="about-profile-detail">
                                <p>{{ str_limit($user->user_profile->description,100) }}</p>
                            </div>
                            <!-- end about-profile-detail -->
                            <div class="personal-contacts">
                                <ul>
                               @foreach($user->user_links as $user_link)
                                   @if($user_link->type == '1' && $user_link->status == '1')
                                     <li><a href="{{$user_link->link}}">{{$user_link->link}}</a></li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            <!-- end personal-contacts -->
                            <div class="profile-social-media">
                                <ul>
                                    @foreach($user->user_links as $user_link)
                                       @if($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "facebook_link")
                                          <li><a href="{{$user_link->link}}"><i class="icon-social-facebook"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "twitter_link")
                                          <li><a href="{{$user_link->link}}"><i class="icon-social-twitter"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "linkedin_link")
                                           <li><a href="{{$user_link->link}}"><i class="icon-social-linkedin"></i></a></li>
                                        @elseif($user_link->type == '0' && $user_link->status == '1' && $user_link->label == "google_plus_link")
                                            <li><a href="{{$user_link->link}}"><i class="icon-social-google"></i></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end profile-social-media -->
                            <div class="like-viewers">
                                <ul>

                                    @csrf
                                    <li>
                                        <a href="javascript:void(0);" data-profile-id="{{$user->id}}" id="total_likes">
                                            <i class="icon-like"></i>Likes
                                        </a>
                                        <span class="like" id="like" value="{{ $user->user_profile->total_likes }}">{{ $user->user_profile->total_likes }}
                                        </span>
                                    </li>
                                    <li><a href="#"><i class="icon-eye"></i> Views</a><span>{{ $profile_view }}</span></li>
                                    <li><a href="#"><i class="icon-bubble"></i> Comments</a><span>1,060</span></li>

                                </ul>
                            </div>
                            <!-- end like-viewers -->
                        </div>
                        <!-- end profile-left -->
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="profile-detail-right">
                            <div class="profile-name-detail profile-name-detail-md">
                                <h2>{{ $user->user_profile->first_name }}</h2>
                                @foreach($user->careers as $career)
                                 <span class="small">{{ $career->title }}</span>
                                @endforeach
                                <span class="small">{{ $user->email }}</span>
                            </div>
                            <!-- end profile-name-detail -->
                            <div class="about-my-profile">
                                <h3>About Me</h3>
                                <p>{{ $user->user_profile->description }}</p>
                            </div>
                            <!-- end about-my-profile -->
                            <div class="personal-detail">
                                <h4>More Info:</h4>
                                <ul>
                                    <li><span>Address:</span>{{ ucwords($user->user_profile->location) }}</li>,
                                    <li><span>Age</span> Group: {{ show_career_advisior_age_group($user->user_profile->age_group) }}</li>,
                                    <li><span>Education Level:</span> {{ ucwords($user->user_profile->educational_level) }}</li>,
                                    <li><span>Faculty:</span> {{ucwords($user->user_profile->education->name)}}</li>,
                                     @foreach($user->careers as $career)
                                    <li><span>Job Title:</span> {{ ucwords($career->title) }}</li>,
                                    @endforeach
                                    <li><span>Salary Range:</span> {{ show_career_advisior_salary_range($user->user_profile->salary_range) }}</li>,
                                    <li><span>Experience:</span> {{ show_career_advisior_job_experience($user->user_profile->job_experience) }}</li>
                                </ul>
                            </div>
                            <!-- end personal-detail -->

                            <div class="profile-slills">
                                <ul>
                                    @foreach($user->tags as $tag)
                                        <li><a href="#">{{ucwords($tag->title)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end profile-slills -->
                        </div>
                        <!-- end profile-detail-right -->
                    </div>

                </div>
            </div>
        </div>
        <!-- end front-profile-details -->
        <div class="profileq-profilea">
            <div class="container">
                <h4>Q&A’s with {{ $user->user_profile->first_name }}</h4>
                @foreach ($questions as $question)
                <div class="profile-question-answer-section">
                    <h4><i class="icon-check"></i> {{ $question['question_title'] }}</h4>
                    <p>{{ $question['answer'] }}</p>

                </div>
                @endforeach
                <!-- end profile-question-answer-section -->


            </div>
        </div>
        <!-- end profileq-profilea -->
        <div class="profile-comment">
            <div class="container">
                <div class="profile-comment-wrapper">
                    <div class="profile-comment-section">
                        <div class="profile-coment-user">
                            <img src="images/profile/1.jpg">
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
                            </div>
                            <div class="form-group" id="comment-1">
                                <input type="text" class="form-control">
                                <span class="Submit"><i class="icon-cursor"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- end profile-comment-section 1 -->
                    <div class="profile-comment-section">
                        <div class="profile-coment-user">
                            <img src="images/profile/1.jpg">
                        </div>
                        <div class="profile-coment-comment">
                            <h5>Sarah Conner</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                            nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                            <div class="profile-author-comment">
                                <ul>
                                    <li><a href="#"><i class="icon-like"></i> Likes</a></li>
                                    <li><a class="write-comment" id="write-comment-2"><i class="icon-bubble"></i> Reply</a></li>
                                </ul>
                            </div>
                            <div class="form-group" id="comment-2">
                                <input type="text" class="form-control">
                                <span class="Submit" ><i class="icon-cursor"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- end profile-comment-section 2 -->
                    <div class="profile-comment-section">
                        <div class="profile-coment-user">
                            <img src="images/profile/1.jpg">
                        </div>
                        <div class="profile-coment-comment">
                            <h5>Sarah Conner</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                            nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                            <div class="profile-author-comment">
                                <ul>
                                    <li><a href="#"><i class="icon-like"></i> Likes</a></li>
                                    <li><a href="#"><i class="icon-bubble"></i> Reply</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end profile-comment-section 3 -->
                    <div class="profile-comment-section">
                        <div class="profile-coment-user">
                            <img src="images/profile/1.jpg">
                        </div>
                        <div class="profile-coment-comment">
                            <h5>Sarah Conner</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                            nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                            <div class="profile-author-comment">
                                <ul>
                                    <li><a href="#"><i class="icon-like"></i> Likes</a></li>
                                    <li><a href="#"><i class="icon-bubble"></i> Reply</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end profile-comment-section 4 -->
                    <div class="profile-comment-section">
                        <div class="profile-coment-user">
                            <img src="images/profile/1.jpg">
                        </div>
                        <div class="profile-coment-comment">
                            <h5>Sarah Conner</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut augue vel risusfringilla varius. Cras
                            nec dui gravida, ullamcorper velit eget, auctor metus.</p>
                            <div class="profile-author-comment">
                                <ul>
                                    <li><a href="#"><i class="icon-like"></i> Likes</a></li>
                                    <li><a href="#"><i class="icon-bubble"></i> Reply</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end profile-comment-section 5 -->

                    <div class="profile-leave-comment">
                        <div class="view-all-comment">
                            <i class="icon-arrow-down"></i>
                        </div>
                        <h4>Leave a Comment</h4>
                        <!-- for logdin user -->
                        <form action="">
                            <div class="profile-reply-form">
                                <div class="reply-user-image">
                                    <img src="images/profile/1.jpg">
                                </div>
                                <div class="reply-coment-box">
                                    <div class="comment-method">
                                        <ul>
                                            <li><a href="#">John Thapa</a></li>
                                            <li><a href="#">Reply Anonymously</a></li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Your Message Here !"></textarea>
                                    </div>
                                    <button class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- for Anonymously user -->
                        <form action="">
                            <div class="profile-reply-form">
                                <div class="reply-user-image">
                                    <img src="images/profile/1.jpg">
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
                                        <textarea class="form-control" placeholder="Your Message Here !"></textarea>
                                    </div>
                                    <button class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end  profile-comment-wrapper -->
            </div>
        </div>
@endsection

@section('page_specific_js')
<script type="text/javascript">
$(document).ready(function () {
    $( "#total_likes" ).on( "click", function() {
      var user_profile_id = $(this).attr('data-profile-id');
      var _token          = $("input[name='_token']").val();
      var total_likes     = (parseInt($("#like").html(),10)+1);
      //alert(total_likes);
      $.ajax({
              url:"{{url('')}}" + "/career-advisior/" + user_profile_id,
              type:"POST",
              dataType:"json",
              data: {_token:_token,user_profile_id:user_profile_id,total_likes:total_likes},
              success:function(data){
                  //check for the success status only
                  if(data.status == "success"){
                      //insert the data in the modal
                      // alert('success');
                      $(".like").html(total_likes);

                  }

              },
              error:function(event){
                      console.log('Cannot get the particular team');
              }
          });
    });

});
</script>
@endsection