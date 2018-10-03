@extends('front.career-advisor.layout.master')
@section('content')
    <div class="profile-main-section">
        <form action="{{route('profile.my-account.udpate',['id'=> Auth::user()->id])}}" method="post" enctype="multipart/form-data">
        <div class="profile-setup">
            <div class="container">
                <h3>Step 1: General Information </h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Upload your profile picture</h6>
                            <div class="file-upload">
                                @csrf
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    @if(Auth::user()->user_profile->image_path != "")
                                            <img class="file-upload-image" src='{{asset("/front/images/profile/")."/".Auth::user()->user_profile->image_path}}' alt="your image" />
                                    @else
                                            <img class="file-upload-image" src="#" alt="your image" />
                                    @endif
                                    
                                    
                                    
                                </div>
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload Image</button>
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">&times;</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Full Name" name="fullname" value="{{Auth::user()->user_profile->first_name}}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"  name="email" value="{{Auth::user()->email}}" placeholder="Email" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="0" disabled="disabled" selected="">{{ __('Select Age Group')}} </option>
                                    <option value="1" {{ (old('age_group') == 1) ? 'selected' : '' }} {{(Auth::user()->user_profile->age_group == 1) ? 'selected' : ''}}>0-15 years</option>
                                    <option value="2" {{ (old('age_group') == 2) ? 'selected' : '' }} {{(Auth::user()->user_profile->age_group == 2) ? 'selected' : ''}}>15-30 years</option>
                                    <option value="3" {{ (old('age_group') == 3) ? 'selected' : '' }} {{(Auth::user()->user_profile->age_group == 3) ? 'selected' : ''}}>30-45 years</option>
                                    <option value="4" {{ (old('age_group') == 4) ? 'selected' : '' }} {{(Auth::user()->user_profile->age_group == 4) ? 'selected' : ''}}>45-50 years</option>
                                    <option value="5" {{ (old('age_group') == 5) ? 'selected' : '' }} {{(Auth::user()->user_profile->age_group == 5) ? 'selected' : ''}}>50 above</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Enter your address" value="{{Auth::user()->user_profile->location}}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Describe a little bit about you</label>
                                <textarea class="form-control" name="description"  cols="19">{{Auth::user()->user_profile->description}}</textarea>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="profile-setup">
            <div class="container">
                <h3>Step 2: Education & Skills</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tell us your education level</label>
                                <select class="form-control">
                                    <option>Tell us your education level</option>
                                    <option>Tell us your education level</option>
                                    <option>Tell us your education level</option>
                                    <option>Tell us your education level</option>
                                    <option>Tell us your education level</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Choose your faculty</label>
                                <select class="form-control">
                                    <option>Choose your faculty</option>
                                    <option>Choose your faculty</option>
                                    <option>Choose your faculty</option>
                                    <option>Choose your faculty</option>
                                    <option>Choose your faculty</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Choose you job title</label>
                                <select class="form-control">
                                    <option>Choose you job title</option>
                                    <option>Choose you job title</option>
                                    <option>Choose you job title</option>
                                    <option>Choose you job title</option>
                                    <option>Choose you job title</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Job experience</label>
                                <select class="form-control">
                                    <option>Job experience</option>
                                    <option>Job experience</option>
                                    <option>Job experience</option>
                                    <option>Job experience</option>
                                    <option>Job experience</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choose your major</label>
                                <select class="form-control">
                                    <option>Choose your major</option>
                                    <option>Choose your major</option>
                                    <option>Choose your major</option>
                                    <option>Choose your major</option>
                                    <option>Choose your major</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Choose your industry</label>
                                <select class="form-control">
                                    <option>Choose your industry</option>
                                    <option>Choose your industry</option>
                                    <option>Choose your industry</option>
                                    <option>Choose your industry</option>
                                    <option>Choose your industry</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Salary range</label>
                                <select class="form-control">
                                    <option>Salary range</option>
                                    <option>Salary range</option>
                                    <option>Salary range</option>
                                    <option>Salary range</option>
                                    <option>Salary range</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter your skill</label>
                        <input class="input-tags form-control" type="text" data-role="tagsinput">
                    </div>
            </div>
        </div>

        <div class="profile-setup">
            <div class="container">
                <h3>Step 3: Questions & Answers</h3>
                    <div class="form-group">
                        <label>How is your typical day look like*</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>How is your typical day look like*</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>How is your typical day look like*</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>How is your typical day look like*</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-default">Update Profile</button>
                    </div>
            </div>
        </div>
    </div>
</form>
    <!-- profile-main-section -->
 </div>
</div>
@endsection