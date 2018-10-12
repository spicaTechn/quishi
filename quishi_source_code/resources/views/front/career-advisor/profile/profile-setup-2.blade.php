@extends('front.layout.master')
@section('page_specific_css')
    <!-- Load the formvalidation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
    <!--Select 2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">


@endsection
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>Welcome {{ucwords(Auth::user()->name)}}, please setup your profile.</h3>
        <form method="post" action="{{route('profile.setup.step3')}}"  name="step2" id="step2">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Tell us your education level') }}</label>
                        <select class="form-control educational_level" name="education">
                            <option  value="0" selected="selected" disabled="disabled">Select Education Level</option>
                            <option value="high school" @if (auth::user()->user_profile->educational_level == 'high school')  {{ 'selected' }} @endif >High School</option>
                            <option value="associate" @if (auth::user()->user_profile->educational_level == 'associate')  {{ 'selected' }} @endif>Associate</option>
                            <option value="bachelor" @if (auth::user()->user_profile->educational_level == 'bachelor')  {{ 'selected' }} @endif>Bachelor</option>
                            <option value="masters" @if (auth::user()->user_profile->educational_level == 'masters')  {{ 'selected' }} @endif>Masters</option>
                            <option value="phd" @if (auth::user()->user_profile->educational_level == 'phd')  {{ 'selected' }} @endif>PHD</option>
                            <option value="other" @if (auth::user()->user_profile->educational_level == 'other')  {{ 'selected' }} @endif>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Choose your industry</label>
                        <select class="industry  form-control form-control-default open default" name="parent_industry">
                           <option value="0" selected="selected" disabled="disabled">Select Industry</option>
                                @foreach($industries as $industry)
                                    @if($industry->children()->count() > 0)
                                        <option value="{{$industry->id}}"
                                            @if(Auth::user()->careers()->count() > 0)
                                                @foreach(Auth::user()->careers as $user_career)
                                                    @if($industry->id == $user_career->parent)
                                                        {{ 'Selected' }}
                                                    @endif
                                                @endforeach
                                            @endif
                                            > {{ucwords($industry->title)}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                   @csrf

                    <div class="form-group">
                        <label>Job experience (in years)</label>
                        <select class="form-control" name="job_experience">
                            <option value="0" selected="selected" disabled="disabled">Select Job Experience</option>
                            <option value="1" @if (auth::user()->user_profile->job_experience == 1)  {{ 'selected' }} @endif>0 to 2</option>
                            <option value="2" @if (auth::user()->user_profile->job_experience == 2)  {{ 'selected' }} @endif>2 to 4 </option>
                            <option value="3" @if (auth::user()->user_profile->job_experience == 3)  {{ 'selected' }} @endif>4 to 6 </option>
                            <option value="4" @if (auth::user()->user_profile->job_experience == 4)  {{ 'selected' }} @endif>6 to 8</option>
                            <option value="5" @if (auth::user()->user_profile->job_experience == 5)  {{ 'selected' }} @endif>8 to 10</option>
                            <option value="6" @if (auth::user()->user_profile->job_experience == 6)  {{ 'selected' }} @endif>10 to 15</option>
                            <option value="7" @if (auth::user()->user_profile->job_experience == 7)  {{ 'selected' }} @endif>15 to 25</option>
                            <option value="8" @if (auth::user()->user_profile->job_experience == 8)  {{ 'selected' }} @endif>25+</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Choose your Major</label>
                        <select class="form-control faculty" name="faculty">
                            @foreach($majors as $major)
                              <option value="{{$major->id}}" {{(Auth::user()->user_profile->education_id == $major->id) ? 'selected': ''}}>{{$major->name . ' - '. $major->parent_education->name}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose you job title</label>
                        <select class="form-control form-control-default open" name="job_title" id="job_title">
                            @if(Auth::user()->careers()->count() > 0)
                                
                                @foreach(Auth::user()->careers as $user_career)
                                  <option value="{{$user_career->id}}" selected="selected">{{ucwords($user_career->title)}} </option>
                                @endforeach
                            @else
                                 <option value="0" selected="selected" disabled="disabled">Select Job Title</option>
                            @endif
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Salary range (in Dollars)</label>
                        <select class="form-control" name="salary">
                            <option value="0" selected="selected" disabled="disabled">Select Salary Range</option>
                            <option value="1" @if (auth::user()->user_profile->salary_range == 1)  {{ 'selected' }} @endif>0-10000</option>
                            <option value="2" @if (auth::user()->user_profile->salary_range == 2)  {{ 'selected' }} @endif>10000-20000</option>
                            <option value="3" @if (auth::user()->user_profile->salary_range == 3)  {{ 'selected' }} @endif>20000-30000</option>
                            <option value="4" @if (auth::user()->user_profile->salary_range == 4)  {{ 'selected' }} @endif>30000-50000</option>
                            <option value="5" @if (auth::user()->user_profile->salary_range == 5)  {{ 'selected' }} @endif>50000-80000</option>
                            <option value="6" @if (auth::user()->user_profile->salary_range == 6)  {{ 'selected' }} @endif>80000-120000</option>
                            <option value="7" @if (auth::user()->user_profile->salary_range == 7)  {{ 'selected' }} @endif>120000-170000</option>
                            <option value="8" @if (auth::user()->user_profile->salary_range == 8)  {{ 'selected' }} @endif>170000-230000</option>
                            <option value="9" @if (auth::user()->user_profile->salary_range == 9)  {{ 'selected' }} @endif>230000-500000</option>
                            <option value="10" @if (auth::user()->user_profile->salary_range == 10)  {{ 'selected' }} @endif>500000+</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label>{{ __('Enter your skill') }}</label>
                 @if(Auth::user()->tags()->count() > 0)
                    @foreach(Auth::user()->tags as $user_tag)
                        <input type="hidden"  class="selected_user_tag" value="{{$user_tag->title}}"/>
                    @endforeach
                   
                @endif
                    <input class="input-tags form-control" name="skills" type="text" data-role="tagsinput">
                  
                    
            </div>

            <div class="row">
                
                <div class="col-lg-6">
                        <div class="text-left">
                            <button type="button" class="btn btn-default" id="profile_setup_back_btn">{{ __('Back') }}</button>
                        </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-right">
                        <button type="submit" class="btn btn-default"> {{ __('Proceed and Continue') }} </button>
                    </div>
                </div>
            </div>
        </form>
         
    </div>
</div>
@endsection
@section('page_specific_js')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
            $(document).ready(function(){
                $('.industry').select2();

                $('.industry').on('select2:select',function(e){
                    var selected_value = e.params.data;
                    var selected_industry_id = selected_value.id;
                    //make the get request to get the job of the parent category
                    $.get("{{route('jobTitleByParent')}}",{industry_id : selected_industry_id},function(data){
                       $("#job_title").html(data.result);
                       $('#job_title').select2();
                    });
                });

                $('#step2').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh'
                    },
                    excluded: 'disabled',
                    fields: {
                        'education': {
                            validators: {
                                notEmpty: {
                                    message: 'The education level is required'
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
                        }
                    }
                }).on('success.form.fv', function(e) {
                    e.preventDefault();
                    $('#step2')[0].submit();
                });


                //make the select field on faculty
                $('.faculty').select2({
                    placeholder   : 'Select major',
                    ajax          :{
                        url       : "{{URL::to('/profile/setup/getMajor')}}",
                        type      : 'GET',
                        dataType  : 'JSON',
                        data      : function(params){
                            return {
                                q : params.term ,
                            };
                        },
                        delay          : 250,
                        processResults : function(data){
                            return{
                                results: $.map(data.result,function(major){
                                    return {
                                  
                                    text: major.name + ' - ' + major.parent,
                                    id: major.id

                                    }
                                })
                               
                            };
                        },
                        cache : true, 
                    }
                });


                $('#profile_setup_back_btn').on('click',function(e){
                    e.preventDefault();
                    window.location.href = "{{URL::to('/profile/setup/step1/back')}}";
                });



                   $('.selected_user_tag').each(function(){
                        $('input.input-tags').tagsinput('refresh');
                        $('input.input-tags').tagsinput('add', $(this).val());
                   });
                


            });
    </script>

@endsection