@extends('admin.layout.master')
@section('page_specific_css')
<!--Load the datatable css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css') }}">
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
<!--Select 2-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/select2/css/select2.min.css') }}">
<style type="text/css">
  .select2-container--default 
  .select2-selection--single 
  .select2-selection__rendered {
    background-color: #fff !important;
    padding: 2px 30px 8px 20px !important;
  }

.select2-container--default 
.select2-selection--multiple 
.select2-selection__choice {
    background-color: #181b25 !important;
  }
</style>
@endsection
@section('content')
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <!-- HTML5 Export Buttons table start -->
                     <div class="card px-4 py-4">
                        <div class="card-header">
                           <div class="card-header-left">
                              <h5>{{ __('Manage users')}}</h5>
                           </div>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap hover tbl-users">
                                  <thead>
                                     <tr>
                                        <th>{{ __('S.N')}}</th>
                                        <th>{{ __('Image')}}</th>
                                        <th>{{ __('Name')}}</th>
                                        <th>{{ __('Email')}}</th>
                                        <th>{{ __('Job title')}}</th>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Total views')}}</th>
                                        <th>{{ __('Total likes')}}</th>
                                        <th>{{ __('Action')}}</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td><img src="{{ asset('/admin_assets/assets/images/widget/user2.png') }}"></td>
                                      <td>John Deo</td>
                                      <td>johndeo@gmail.com</td>
                                      <td>PHP Developer</td>
                                      <td>Active</td>
                                      <td>1000 K</td>
                                      <td>200 K</td>
                                      <td>

                                        <a href="#" 
                                          class="m-r-15 text-muted view-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="View More" 
                                          data-user-id="1">
                                          <i class="icofont icofont-business-man-alt-3"></i>
                                        </a>

                                        <a href="#" 
                                          class="m-r-15 text-muted deactivate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Deactivate" 
                                          data-user-id="1">
                                          <i class="icofont icofont-ui-lock"></i>
                                        </a>

                                        <a href="#" 
                                          class="text-muted activate-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Activate" 
                                          data-user-id="1">
                                          <i class="icofont icofont-ui-check"></i>
                                        </a>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
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
<!-- add modal -->
<div class="modal fade" id="add-edit-question" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form name="industry-jobs-form" id="industry-jobs-form">
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add</span> Question</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
	            </div>
	            <div class="modal-body">
                  @csrf
                	<div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Enter question here *</h4>
                            <input type="text" class="form-control question" id="question" name="question"  placeholder="question">
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Select Job <small>choose all if you want to show this question to everybody</small></h4>
                            <select class="form-control form-control-default open parent-job" name="job_id" multiple="">
                                <option>All</option>
                                <option>Graphic design - IT and Commnication</option>
                                <option>Web Design - IT and commnication</option>
                                <option>Cashier - Finanace and banking</option>
                            </select>
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Select question type</h4>
                            <div class="form-radio">
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="question-type" value="1">
                                        <i class="helper"></i>Mandatory
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="question-type" value="2">
                                        <i class="helper"></i>Optional
                                    </label>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <input type="hidden" name="question_id" class="question_id" value=""/>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<!-- end add modal -->
@endsection
@section('page_specific_js')
<!--Datatable-->
<script src="{{ asset('/admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
<!-- Select 2 -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- caretTo -->
<script type="text/javascript" src="{{ asset('/admin_assets/assets/js/caretTo.js') }}"></script>

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    var save_method, uri;   

	// datatable for Questions
    var user_table = $('.tbl-users').DataTable({
        dom: 'Bfrtip',
        LengthChange: true,
        buttons:[
            'excel',
            {
                  extend: 'print',
                  customize: function ( win ) {
                      $(win.document.body)
                          .css( 'font-size', '10pt' );
                      $(win.document.body).find( 'table' )
                          .addClass( 'compact' )
                          .css( 'font-size', 'inherit' );
                  },
                  exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                  }
              }
        ],
        destroy : true,
        order : [[ 0, "asc" ]], //or asc 
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        },
        /*serverSide : true,
        processing : true,
        ajax       : {
                        url  : "{{route('admin.industry.getIndustry')}}",
                        type : 'GET',
        },
        columns   : [
                     
              {
               "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
              },
              {"data" :"title","name":"title"},
              {"data":'description', "name":"description"},
              {"data":"usage",'name':"usage"},
              {"data":"action" , "name" :"action"},
          
        ]*/

    });

    // On start typing add ? mark to question
    $( "input[name='question']" ).keyup(function() {
      
      var question = $(this).val();
      if(question.indexOf("?") == -1){
        $( this ).val(question+" ?"); // add question mark
      }
      $("input[name='question']").caret('?'); // move cursor before question mark
    });

    


    $('.parent-job').select2({
        placeholder: 'Select job title',
        dropdownParent: $('#add-edit-question'),
        // ajax request to pull the category list
          /*ajax: {
              url:"{{url('/admin/categories/getCatgeoryAjax')}}",
              type:"GET",
              dataType:"Json",
              data: function (params) {
                return {
                  _token:_token,
                  q: params.term, // search term
                };
              },
              delay: 250,
              processResults: function (data) {
              return {
                results:  $.map(data.result, function (category) {
                      return {
                          text: category.category_name,
                          id: category.id
                      }
                  })
              };
            },
            cache: true
          }*/
      });

    // Fomvalidation setup
    $('#industry-jobs-form').on('init.field.fv', function(e, data) {
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
                'question': {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        }
                    }
                },
                'job_id': {
                    validators: {
                        notEmpty: {
                            message: 'The Job is required, select all if question covers all sectors'
                        }
                    }
                },
                'question-type': {
                    validators: {
                        notEmpty: {
                            message: 'The question type is required'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // find if the action is save or update
            if(save_method == 'add')
            {
                URI = "{{--{{route('admin.add.question')}}--}}";
            }else{
                var question_id  = $(".question_id").val();
                URI = "{{URL::to('admin/question')}}" + "/" + question_id;
            }

            // get the input values
            result = new FormData($("#industry-jobs-form")[0]);

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
                    //hide the modal
                     $('#add-edit-question').modal('hide');
                     var submit_type = $('.parent-industry').val();
                     var submit_msg = '';
                     submit_msg = "Question";
                     // $('#category-form')[0].reset();
                     // $('#category-form').data('formValidation').resetForm(true);

                     if(save_method == "add"){
                        swal({
                          title: "New " + submit_msg + "  has been added!",
                          text: "A new  " + submit_msg + "   has been added to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     }else{
                        swal({
                          title: submit_msg + " has been Updated!",
                          text: submit_msg + "  has been updated to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     } // check for the form submission type
                    //table.ajax.reload();

                    if(submit_msg == "Industry"){
                     user_table.ajax.reload();
                    }
                   //resetFormOnClose();
                }
            },
            error:function(event)
            {
                console.log('Cannot add new user into the quishi system. Please try again later on..');
            }
            
        });
    }); // end formvalidation.io code

    // On click add new industry or job
    $( ".add-btn" ).on( "click", function() {
         save_method = 'add';
         var parent_industry = "{{route('admin.industry')}}";
         //make the ajax request to get the 
         $.get(parent_industry,function(data){
            $('.parent-industry').html(data.result);
         });
	     $('#add-edit-question').modal('show');
	}); // end add new button click

  //reset the form validaton and from when the modal was closing
  $('.modal').on('hidden.bs.modal', function(){
     $(this).find('form').data('formValidation').resetForm(true);
     $(this).find('form')[0].reset();

  });

});// end document.ready function

function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}

</script>
@endsection