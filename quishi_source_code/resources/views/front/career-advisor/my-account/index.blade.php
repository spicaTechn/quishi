@extends('front.career-advisor.layout.master')
@section('page_specific_css')
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
<!--Select 2-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">

@endsection
@section('content')
    <div class="profile-main-section">
        {{ (session('user_profile_update')) ? session('user_profile_update') : ''}}
        <form action="{{route('profile.my-account.udpate',['id'=> Auth::user()->id])}}" method="post" enctype="multipart/form-data" id="user_profile_udpate">
        <div class="profile-setup">
            <div class="container">
                <h3>Step 1: General Information </h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Upload your profile picture</h6>
                            <div class="file-upload">
                                @csrf
                                <div class="image-upload-wrap" {{(Auth::user()->user_profile != "") ? 'style=display:none;' : ''}}>
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*"  name="user_image"/>
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content" {{(Auth::user()->user_profile != "") ? 'style=display:block;' : ''}}>
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
                                <select class="form-control" name="age_group">
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
                                <select class="form-control educational_level" name="education">
                                    <option  value="0" disabled="disabled">Select Education Level</option>
                                    <option value="high school" {{(Auth::user()->user_profile->educational_level == 'high school') ? 'selected' : ''}}>High School</option>
                                    <option value="associate" {{(Auth::user()->user_profile->educational_level == 'associate') ? 'selected' : ''}}>Associate</option>
                                    <option value="bachelor" {{(Auth::user()->user_profile->educational_level == 'bachelor') ? 'selected' : ''}} >Bachelor</option>
                                    <option value="masters" {{(Auth::user()->user_profile->educational_level == 'masters') ? 'selected' : ''}}>Masters</option>
                                    <option value="phd" {{(Auth::user()->user_profile->educational_level == 'phd') ? 'selected' : ''}} >PHD</option>
                                    <option value="other" {{(Auth::user()->user_profile->educational_level == 'other') ? 'selected' : ''}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Choose your industry</label>
                                <select class="form-control industry" name="parent_industry" disabled="disabled">
                                     <option value="0" disabled="disabled">Select Industry</option>
                                    @foreach($industries as $industry)
                                        @if($industry->children()->count() > 0)
                                            <option value="{{$industry->id}}" {{ ($industry->id ==  $user_industry_id) ? 'selected' : '' }}> {{ucwords($industry->title)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                           
                            <div class="form-group">
                                <label>Job experience in (years)</label>
                                <select class="form-control" name="job_experience">
                                    <option value="0" disabled="disabled">Select Job Experience</option>
                                    <option value="1" {{(Auth::user()->user_profile->job_experience == 1) ? 'selected' : ''}}>0 to 2</option>
                                    <option value="2" {{(Auth::user()->user_profile->job_experience == 2) ? 'selected' : ''}}>2 to 4 </option>
                                    <option value="3" {{(Auth::user()->user_profile->job_experience == 3) ? 'selected' : ''}}>4 to 6 </option>
                                    <option value="4" {{(Auth::user()->user_profile->job_experience == 4) ? 'selected' : ''}}>6 to 8</option>
                                    <option value="5" {{(Auth::user()->user_profile->job_experience == 5) ? 'selected' : ''}}>8 to 10</option>
                                    <option value="6" {{(Auth::user()->user_profile->job_experience == 6) ? 'selected' : ''}}>10 to 15</option>
                                    <option value="7" {{(Auth::user()->user_profile->job_experience == 7) ? 'selected' : ''}}>15 to 25</option>
                                    <option value="8" {{(Auth::user()->user_profile->job_experience == 8) ? 'selected' : ''}}>25+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choose your Major</label>
                                <select class="form-control faculty" name="faculty">
                                    <option value="0" disabled="disabled">Select Your Major</option>
                                    @foreach($majors as $major)
                                        <option value="{{$major->id}}" {{(Auth::user()->user_profile->education_id == $major->id) ? 'selected': ''}}>{{$major->name . ' - '. $major->parent_education->name}}
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Choose you job title</label>
                                <select class="form-control" name="job_title" id="job_title" disabled="disabled">
                                    <option value="{{$user_careers->id}}" selected="selected">{{ucwords($user_careers->title)}}</option>
                                    @foreach($user_selected_industry_details as $user_industry)
                                        @if($user_industry->parent_career->children()->count() > 0)
                                            @foreach($user_industry->parent_career->children()->get() as $career_children)
                                                <option value="{{$career_children->id}}">{{ucwords($career_children->title)}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Salary range (in Dollars / per annum)</label>
                                <select class="form-control" name="salary">
                                    <option value="0" disabled="disabled">Select Salary Range</option>
                                    <option value="1" {{(Auth::user()->user_profile->salary_range == 1) ? 'selected' : ''}} >0-10,000</option>
                                    <option value="2" {{(Auth::user()->user_profile->salary_range == 2) ? 'selected' : ''}}>10,000 - 20,000</option>
                                    <option value="3" {{(Auth::user()->user_profile->salary_range == 3) ? 'selected' : ''}}>20,000 - 30,000</option>
                                    <option value="4" {{(Auth::user()->user_profile->salary_range == 4) ? 'selected' : ''}}>30,000 - 50,000</option>
                                    <option value="5" {{(Auth::user()->user_profile->salary_range == 5) ? 'selected' : ''}}>50,000 - 80,000</option>
                                    <option value="6" {{(Auth::user()->user_profile->salary_range == 6) ? 'selected' : ''}}>80,000 - 120,000</option>
                                    <option value="7" {{(Auth::user()->user_profile->salary_range == 7) ? 'selected' : ''}}>120,000 - 170,000</option>
                                    <option value="8" {{(Auth::user()->user_profile->salary_range == 8) ? 'selected' : ''}}>170,000 - 230,000</option>
                                    <option value="9" {{(Auth::user()->user_profile->salary_range == 9) ? 'selected' : ''}}>230,000 - 500,000</option>
                                    <option value="10" {{(Auth::user()->user_profile->salary_range == 10) ? 'selected' : ''}}>500,000+</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter your skill</label>
                        @foreach($user_tags as $user_tag)
                            <input type="hidden"  class="selected_user_tag" value="{{$user_tag}}"/>
                        @endforeach
                        <input class="input-tags form-control" name="skills" type="text" data-role="tagsinput" >
                    </div>
            </div>
        </div>

        <div class="profile-setup">
            <div class="container">
                <h3>Step 3: Questions & Answers</h3>
                @foreach($user_questions_and_answers as $user_question_and_answer)
                <div class="form-group">
                    <label>{{ ucfirst($user_question_and_answer['question_title']) }} {{ ($user_question_and_answer['question_type'] == '1') ? '*' : ''}}</label>
                    <input type="hidden" name="question_id[]{{$user_question_and_answer['question_id']}}" value="{{$user_question_and_answer['question_id'] }}"/>
                    <textarea class="form-control" name="answer_id[]{{$user_question_and_answer['question_id']}}" {{($user_question_and_answer['question_type'] == '1') ? 'required' : ''}} cols="19">{{$user_question_and_answer['answer']}}</textarea>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-left">
            <button type="submit" class="btn btn-default">Update profile</button>
        </div>
    </div>
</form>
    <!-- profile-main-section -->
 </div>
</div>
@endsection
@section('page_specific_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script>
    $(document).ready(function(){
        $('.faculty').select2();
        $('.industry').select2();
      
        

        //on industry selected 
        $('.industry').on('select2:select',function(e){
            var selected_value = e.params.data;
            var selected_industry_id = selected_value.id;
            //make the get request to get the job of the parent category
            $.get("{{route('jobTitleByParent')}}",{industry_id : selected_industry_id},function(data){
               $("#job_title").html(data.result);
               $('#job_title').select2();
            });
        });

        $('#job_title').select2();


        //form validation here for the forntend form validaton
        $('#user_profile_udpate').on('init.field.fv', function(e, data) {
            e.preventDefault();
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

            $icon.on('click.clearing', function() {
                // Check if the field is valid or not via the icon class
                if ($icon.hasClass('fa fa-remove')) {
                    // Clear the field
                    data.fv.resetField(data.element);
                }
            });
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            excluded: 'disabled',
            fields: {
                'fullname': {
                    validators: {
                        notEmpty: {
                            message: 'The fullname is required'
                        }
                    }
                },
                'parent_industry': {
                    validators: {
                        notEmpty: {
                            message: 'The industry, please select industry to load the respective job title'
                        }
                    }
                },
                'job_title': {
                    validators: {
                        notEmpty: {
                            message: 'The job title is required'
                        }
                    }
                },
                'faculty': {
                    validators: {
                        notEmpty: {
                            message: 'The faculty is required'
                        }
                    }
                },
                'age_group':{
                    validators:{
                        notEmpty:{
                            message: 'Age Group is required'
                        }
                    }
                },
                'address':{
                    validators:{
                        notEmpty:{
                            message: 'Your address is required'
                        }
                    }
                }

            }
        }).on('success.form.fv',function(e){
            e.preventDefault();
            $('#user_profile_udpate')[0].submit();
            die();
        });

        $('.selected_user_tag').each(function(){
            $('input.input-tags').tagsinput('add', $(this).val());
        });


    });
</script>
@endsection