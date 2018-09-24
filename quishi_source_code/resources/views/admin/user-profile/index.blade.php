@extends('admin.layout.master')
@section('page_specific_css')

<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
<!--Select 2-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">

@endsection
@section('content')
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="card px-4 py-4">
                        <div class="card-header">
                           <div class="card-header-left">
                              <h5>{{ __('My profile: change Credentials')}}</h5>
                           </div>
                        </div>
                        <div class="card-block">
                            <form name="update-super-admin-credentials" id="update-super-admin-credentials">
                               <!--Setting user ID-->
                                <input type="hidden" name="user_id" value="1" class="user_id">
                                <div class="row">
                                   <div class="col-sm-12 col-xl-12 m-b-30">
                                        <h4 class="sub-title">Full Name</h4>
                                        <input type="text" class="form-control " name="full-name">
                                    </div> 
                                </div>
                                <div class="row">
                                   <div class="col-sm-12 col-xl-12 m-b-30">
                                        <h4 class="sub-title">Email adress <small>You are not allowed to change your email address</small></h4>
                                        <input type="text" class="form-control " name="email" readonly="readonly">
                                    </div> 
                                </div>
                                <h3 class="sub-title">Change Password</h3>
                                <div class="row">
                                   <div class="col-sm-12 col-xl-12 m-b-30">
                                        <h4 class="sub-title">Old password</h4>
                                        <input type="text" class="form-control " name="old-password">
                                    </div> 
                                </div>
                                <div class="row">
                                   <div class="col-sm-12 col-xl-12 m-b-30">
                                        <h4 class="sub-title">New password</h4>
                                        <input type="password" class="form-control " name="new-password">
                                    </div> 
                                </div>
                                <div class="row">
                                   <div class="col-sm-12 col-xl-12 m-b-30">
                                        <h4 class="sub-title">Retype password</h4>
                                        <input type="password" class="form-control " name="retype-password">
                                    </div> 
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 col-xl-12 m-b-30">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
                                  </div>
                                </div>
                            </form><!--end form-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Page-body end -->
         </div>
      </div>
   </div>
</div>
@endsection
@section('form_modal')

@endsection
@section('page_specific_js')

<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    // Fomvalidation setup
    $('#update-super-admin-credentials').on('init.field.fv', function(e, data) {
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
                'full-name': {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required'
                        }
                    }
                },
                'email': {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        }
                    }
                },
                'old-password': {
                    validators: {
                        notEmpty: {
                            message: 'The old password is required'
                        }
                    }
                },
                'new-password': {
                    validators: {
                        identical: {
                            field: 'retype-password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                'retype-password': {
                    validators: {
                        identical: {
                            field: 'new-password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
            var user_id  = $(".user_id").val();
            URI = "{{URL::to('admin/question')}}" + "/" + user_id;
            // get the input values
            result = new FormData($("#update-super-admin-credentials")[0]);

            $.ajax({
            //make the ajax request to either add or update the 
            url:URI,
            data:result,
            dataType:"Json",
            contentType: false,
            processData: false,
            type:"POST",
            success:function(data)
            {
                if(data.status == "success"){
                     var submit_msg = '';
                     submit_msg = "Credentials and name";
                     // $('#category-form')[0].reset();
                     // $('#category-form').data('formValidation').resetForm(true);

                     
                        swal({
                          title: submit_msg + " has been Updated!",
                          text: submit_msg + "  has been updated to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                }
            },
            error:function(event)
            {
                console.log('Cannot update user into the quishi system. Please try again later on..');
            }
            
        });
    }); // end formvalidation.io code

});// end document.ready function
</script>
@endsection