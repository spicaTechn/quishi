@extends('front.layout.master')
@section('page_specific_css')
    <!-- Load the formvalidation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
    <!--Select 2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">
    <!--typehead css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/front/css/typehead.css') }}">

@endsection
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>Welcome {{ucwords(Auth::user()->name)}}, please setup your profile.</h3>
        <form method="post" action="{{route('profile.setup.step3')}}"  name="step2" id="step2">
            <div class="row">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Tell us your education level') }}</label>
                        <select class="form-control educational_level" name="education">
                            <option  value="0" selected="selected" disabled="disabled">Select Education Level</option>
                            <option value="high school">High School</option>
                            <option value="associate">Associate</option>
                            <option value="bachelor">Bachelor</option>
                            <option value="masters">Masters</option>
                            <option value="phd">PHD</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose your industry</label>
                        <select class="industry  form-control form-control-default open default" name="parent_industry">
                           <option value="0" selected="selected" disabled="disabled">Select Industry</option>
                                @foreach($industries as $industry)
                                    @if($industry->children()->count() > 0)
                                        <option value="{{$industry->id}}"> {{ucwords($industry->title)}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                   
                    
                    <div class="form-group">
                        <label>Job experience (in years)</label>
                        <select class="form-control" name="job_experience">
                            <option value="0" selected="selected" disabled="disabled">Select Job Experience</option>
                            <option value="1">0 to 2</option>
                            <option value="2">2 to 4 </option>
                            <option value="3">4 to 6 </option>
                            <option value="4">6 to 8</option>
                            <option value="5">8 to 10</option>
                            <option value="6">10 to 15</option>
                            <option value="7">15 to 25</option>
                            <option value="8">25+</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Choose your faculty</label>
                        <select class="form-control" name="faculty">
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose you job title</label>
                        <select class="form-control form-control-default open" name="job_title" id="job_title">
                            <option value="0" selected="selected" disabled="disabled">Select Job Title</option>
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Salary range (in Dollars)</label>
                        <select class="form-control" name="salary">
                            <option value="0" selected="selected" disabled="disabled">Select Salary Range</option>
                            <option value="1">0-10000</option>
                            <option value="2">10000-20000</option>
                            <option value="3">20000-30000</option>
                            <option value="4">30000-50000</option>
                            <option value="5">50000-80000</option>
                            <option value="6">80000-120000</option>
                            <option value="7">120000-170000</option>
                            <option value="8">170000-230000</option>
                            <option value="9">230000-500000</option>
                            <option value="10">500000+</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Enter your skill') }}</label>
                <input class="input-tags form-control" type="text"  id="tags-input" data-role="tagsinput" name="skills">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-default"> {{ __('Proceed and Continue') }} </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page_specific_scripts')
    <!-- Formvalidation -->
    <script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
    <!--form validation -->
    <script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
    <!-- Select 2 -->
    <script type="text/javascript" src="{{ asset('/admin_assets/bower_components/select2/js/select2.full.min.js') }}"></script>

    <!--typehead -->
    <script type="text/javascript" src="{{ asset('/front/js/typehead.js') }}"></script>

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


                $('#step2').on('init.field.fv', function(e, data) {
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
                });
            });
    </script>
@endsection