@extends('front.layout.master')
@section('content')
<div class="my-profile">
    <div class="container">
        <div class="profile-sidemenu">
            <ul>
                <li class="active"><a href="{{route('profile')}}"> <i class="ti-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="ti-write"></i> My answers</a></li>
                <li><a href="#"><i class="ti-comment-alt"></i> Admin reviews<span class="badge badge-pill badge-danger">3</span></a></li>
                <li><a href="#"><i class="ti-user"></i> My account</a></li>
                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-user"></i> Logout</a><form id="logout-form" method="post" action="{{route('logout')}}" style="display:none;">{{csrf_field()}}</form></li>
            </ul>
        </div>
        <div class="profile-main-section">
            <div class="profile-first-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-details text-center">
                            <a id="profile-edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                <i class="icon-pencil"></i>
                            </a>
                            <div class="profile-picture">
                                <img src="{{asset('/front')}}/images/blog1.jpg" alt="profile">
                            </div>
                            <div class="profile-name">
                                {{ Auth::user()->user_profile->first_name }}
                            </div>
                            <div class="profile-pic-detail">
                                <p><a href="mailto:john@gmail.com">{{ Auth::user()->email }}</a></p>
                                <a class="btn btn-default">View Public Profile</a>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="profile-detail-right">
                            <div class="profile-details-content">
                                <h4>My Bio </h4>
                                <p>{{Auth::user()->user_profile->description }}</p>
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
                                            <p><label>Faculty:</label> {{ ucwords(Auth::user()->user_profile->faculty) }}</p>
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
                                                <span>{{ Auth::user()->user_profile->total_likes }}</span> Likes
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-eye"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{ Auth::user()->user_profile->profile_views }}</span> Views
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
                                                <a href="#" class="hide-social-icon"> <i class="icon-social-facebook"></i>facebook.com/jondeo</a>
                                                <form action=""  style="display: none;">
                                                    <div class="form-group">
                                                        <input type="text" name="facebook-link" class="form-control"  value="https://facebook.com/jondeo">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success">Save</button>
                                                        <button class="btn btn-secondary">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#"> <i class="icon-social-twitter"></i>facebook.com/jondeo</a>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#"> <i class="icon-social-google"></i>facebook.com/jondeo</a>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#"> <i class="icon-social-linkedin"></i>facebook.com/jondeo</a>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#"> <i class="icon-link"></i>facebook.com/jondeo</a>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#"> <i class="icon-link"></i>facebook.com/jondeo</a>
                                                <div class="editable-icon">
                                                    <a id="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <a id="remove-link" data-toggle="tooltip" data-placement="top" title="Delete Link">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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