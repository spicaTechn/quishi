@extends('front.career-advisor.layout.master')
@section('content')
        <div class="profile-main-section">
            <div class="profile-first-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-details text-center">
                            <a id="profile-edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                <i class="icon-pencil"></i>
                            </a>
                            <div class="profile-picture">
                                @if(Auth::user()->user_profile->image_path == "")
                                    <img src="{{asset('/front')}}/images/blog1.jpg" alt="profile">
                                @else
                                    <img src="{{asset('/front/images/profile').'/'.Auth::user()->user_profile->image_path}}" alt="profile">
                                @endif
                            </div>
                            <div class="profile-name">
                                {{ Auth::user()->user_profile->first_name }}
                            </div>
                            <div class="profile-pic-detail">
                                <p><a href="mailto:john@gmail.com">{{ Auth::user()->email }}</a></p>
                                <a class="btn btn-default" href="{{URL::to('/career-advisior/'.Auth::user()->id)}}" target="_blank">View Public Profile</a>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="profile-detail-right">
                            <div class="profile-details-content">
                                <h4>My Bio </h4>
                                <p>{{ Auth::user()->user_profile->description }}</p>
                            </div>
                            <!-- profile-details -->
                            <div class="profile-background">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Address:</label> {{ ucwords(Auth::user()->user_profile->location) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Education Level: </label> {{ ucwords(Auth::user()->user_profile->educational_level) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Major:</label> {{ ucwords(Auth::user()->user_profile->education->name) }}</p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">

                                            <p><label>Job Title:</label> {{ ucwords(Auth::user()->careers()->first()->title) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Experience:</label> {{ show_career_advisior_job_experience(Auth::user()->user_profile->job_experience) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Age Group:</label> {{ show_career_advisior_age_group(Auth::user()->user_profile->age_group) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Salary Range:</label> {{ show_career_advisior_salary_range(Auth::user()->user_profile->salary_range) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile-background -->
                            <div class="profile-viewers">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-like"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{ quishi_convert_number_to_human_readable(Auth::user()->user_profile->total_likes) }}</span> Likes
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-eye"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{quishi_convert_number_to_human_readable( Auth::user()->user_profile->profile_views) }}</span> Views
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-bubble"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>200k</span> Comments
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- profile-viewers -->
                            <div class="add-remove-social-media">
                                <div class="media-title-block">
                                    <h6>My External Links</h6>
                                    <span id="add-skill"><i class="icon-plus"></i></span>
                                </div>
                                <div class="social-media-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-social-facebook"></i><span>facebook.com/jondeo</span></a>
                                                <form action=""  style="display: none;" data_link_type="facebook_link">
                                                    <div class="form-group">
                                                        <input type="text" name="facebook-link" class="form-control"  value="https://facebook.com/jondeo">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success btn-save">Save</button>
                                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-social-twitter"></i><span>https://www.twitter.com/jondeo</span></a>
                                                <form action=""  style="display: none;" data_link_type="twitter_link">
                                                    <div class="form-group">
                                                        <input type="text" name="twitter_link-link" class="form-control"  value="https://facebook.com/jondeo">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success btn-save">Save</button>
                                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-social-google"></i><span>https://www.plus.google.com/jondeo</span></a>
                                                <form action=""  style="display: none;" data_link_type="google_plus_link">
                                                    <div class="form-group">
                                                        <input type="text" name="twitter_link-link" class="form-control"  value="https://facebook.com/jondeo">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success btn-save">Save</button>
                                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                       <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-social-linkedin"></i><span>https://www.twitter.com/jondeo</span></a>
                                                <form action=""  style="display: none;" data_link_type="twitter_link">
                                                    <div class="form-group">
                                                        <input type="text" name="twitter_link-link" class="form-control"  value="https://facebook.com/jondeo">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success btn-save">Save</button>
                                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-link"></i><span>https://www.twitter.com/jondeo</span></a>
                                                    <form action=""  style="display: none;" data_link_type="external_link1">
                                                        <div class="form-group">
                                                            <input type="text" name="twitter_link-link" class="form-control"  value="https://facebook.com/jondeo">
                                                        </div>
                                                        <div class="button-groups">
                                                            <button class="btn btn-success btn-save">Save</button>
                                                            <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                        </div>
                                                    </form>
                                                    <div class="editable-icon">
                                                        <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="icon-link"></i><span>https://www.twitter.com/jondeo</span></a>
                                                    <form action=""  style="display: none;" data_link_type="external_link2">
                                                        <div class="form-group">
                                                            <input type="text" name="twitter_link-link" class="form-control"  value="https://facebook.com/jondeo">
                                                        </div>
                                                        <div class="button-groups">
                                                            <button class="btn btn-success btn-save">Save</button>
                                                            <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                        </div>
                                                    </form>
                                                    <div class="editable-icon">
                                                        <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <a class="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <!-- end col -->
                                    </div>
                                </div>
                            </div>
                            <!-- end add-remove-social-media -->
                        </div>
                        <!-- profile-detail-right -->
                    </div>
                    <!-- col-md-9 -->
                </div>
            </div>
            <!-- profile-first-section -->
        </div>
        <!-- profile-main-section -->
    </div>
</div>
@endsection

@section('page_specific_js')
<script>
    $(document).ready(function(){
       
       //make the process back to normal when the user click the cancel button 
        $('.btn-cancel').on('click',function(e){
           //prevent the default action 
           e.preventDefault();
           var _parent_div       = $(this).parents('div.editable-section');
           //hide the form and show the editiable sections and socail icon class
           _parent_div.find('form').hide();
           _parent_div.find('.editable-icon').show();
           _parent_div.find('.hide-social-icon').show();
        });

        //update the process when the user click the save button

        $('.btn-save').on('click',function(e){
            //prevent the default action
            e.preventDefault();
            var _parent_div             = $(this).parents('div.editable-section');
            var _link_type              = $(_parent_div).find('form').attr('data_link_type');
            var _social_link_input      =  _parent_div.find('form input').val();
            $.post("{{route('profile.links.udpate')}}",{_social_link_input: _social_link_input, link_type : _link_type, _token: "{{csrf_token()}}"},function(data){
                if(data.status == 'success'){

                    //update the record value 
                    swal({
                          title: "Link Updated!!",
                          text: "Link has been updated successfully!",
                          type: "success",
                          closeOnConfirm: true,
                        });
                    $(_parent_div).find('.hide-social-icon span').html(_social_link_input);
                    //now hide the form 
                    _parent_div.find('form').hide();
                    //show the editable-icon 
                     _parent_div.find('.editable-icon').show();
                    //show the hide-social -icon
                    _parent_div.find('.hide-social-icon').show();
                }
            });


        });



    });
</script>
@endsection