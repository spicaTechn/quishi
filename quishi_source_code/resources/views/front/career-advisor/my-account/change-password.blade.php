@extends('front.career-advisor.layout.master')
@section('page_specific_css')
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
@endsection
@section('content')
	 <div class="profile-main-section">
                    <div class="profile-login-section">
                        <h6>Change Password</h6>
                        <form action="{{route('profile.my-account.reset-password')}}" method="post" id="change-password">
                        	
                        	@if($errors->has('old_password'))
	                        	<span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('old_password') }}</strong>
	                            </span>
	                         @endif
                        	@csrf
                            <div class="form-group">
                                <input type="Password" name="old_password" class="form-control" placeholder="Old Password">
                            </div>
                             <div class="form-group">
                                <input type="Password" name="password" class="form-control" placeholder="New Password">
                            </div>
                             <div class="form-group">
                                <input type="Password" name="confirmPassword" class="form-control" placeholder="Conform Password">
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
                        </form>
                    </div>
                    <!-- profile-login-section -->
                </div>
                <!-- profile-main-section -->
            </div>
        </div>
@endsection
@section('page_specific_js')
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<!--form validation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>

<script>
	$(document).ready(function(){
		$('#change-password').on('init.field.fv', function(e, data) {
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
                'old_password': {
                    validators: {
                        notEmpty: {
                            message: 'The current passowrd is required'
                        }
                    }
                },
                'password': {
                    validators: {
                        notEmpty: {
                            message: 'The passowrd is required'
                        },
                        stringLength:{
                        	 min:6,
                        }
                       
                  
                    }
                },
                'confirmPassword': {
                    validators: {
                        identical: {
                            field:'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },

            }
        });

        
	});

</script>

@endsection