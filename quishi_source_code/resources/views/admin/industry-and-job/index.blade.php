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
                     <div class="card px-4 py-4 industry-jobs-tab">
                        <div class="card-header">
                           <div class="card-header-left">
                              <h5>Manage industry and jobs</h5>
                           </div>
                           <div class="card-header-right"> 
                              <button class="btn btn-grd-primary add-btn">Add new Industry / Job</button>
                           </div>
                        </div>
                        <div class="card-block">
                           <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#industry" role="tab" aria-controls="industry" aria-selected="true">Industry</a>
                                 <div class="slide"></div>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="true">Jobs</a>
                                 <div class="slide"></div>
                              </li>
                           </ul>
                           <div class="tab-content" >
                              <div class="tab-pane fade show active" id="industry" role="tabpanel" aria-labelledby="home-tab">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-industry">
                                          <thead>
                                             <tr>
                                                <th>S.N</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>No of jobs</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>1</td>
                                                <td>IT and telecommunications</td>
                                                <td>this is information technology industry</td>
                                                <td>61</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-industry-id="1">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-industry-id="1">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>2</td>
                                                <td>Business management</td>
                                                <td>Business is the secret of mine</td>
                                                <td>65</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-industry-id="2">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-industry-id="2">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>3</td>
                                                <td>Finance and banking</td>
                                                <td>money things is here</td>
                                                <td>200</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-industry-id="3">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-industry" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-industry-id="3">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade pt-3" id="jobs" role="tabpanel" aria-labelledby="profile-tab">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-jobs">
                                          <thead>
                                             <tr>
                                                <th>S.N</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>No of jobs</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>1</td>
                                                <td>IT and telecommunications</td>
                                                <td>this is information technology industry</td>
                                                <td>61</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-job-id="1">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-job-id="1">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>2</td>
                                                <td>Business management</td>
                                                <td>Business is the secret of mine</td>
                                                <td>65</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-job-id="2">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-job-id="2">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>3</td>
                                                <td>Finance and banking</td>
                                                <td>money things is here</td>
                                                <td>200</td>
                                                <td>
                                                   <a href="#" class="m-r-15 text-muted edit-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" 
                                                      title="" 
                                                      data-original-title="Edit"
                                                      data-job-id="3">
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-job" 
                                                      data-toggle="tooltip" 
                                                      data-placement="top" title="" 
                                                      data-original-title="Delete" 
                                                      data-job-id="3">
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- tab-content -->
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
<div class="modal fade" id="add-edit-industry" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form name="industry-jobs-form" id="industry-jobs-form">
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add</span> Industry / Job <small>Field denoted as * mark is required field</small></h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
	            </div>
	            <div class="modal-body">
                	<div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Title *</h4>
                            <input type="text" class="form-control fullname" name="title" placeholder="title">
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Select parent <small>If you select parent it automatically recognize as Job</small></h4>
                            <select class="form-control" name="parent_id">
                            	<option value="parent1">Parent 1</option>
                            	<option value="parent1">Parent 2</option>
                            </select>
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Description</h4>
                            <textarea class="form-control" name="description"></textarea>
                        </div> 
                    </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
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

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
	// Page industry and jobs
	$(".industry-jobs-tab").tabs({
	    activate: function (event, ui) {        
          $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
    	},
	   create: function (event, ui) {        
          $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
    	}
	});   

	// datatable for subscription request
    $('.tbl-industry').DataTable({
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
                    columns: [ 0,1,2,3]
                  }
              }
        ],
        destroy : true,
        order : [[ 0, "asc" ]], //or asc 
        columnDefs: [{"targets":0, "type":"date-eu"}],
    });

    // datatable for active subscription
    $('.tbl-jobs').DataTable({
      	dom: 'Bfrtip',
        buttons:[
            'excel',
            'print'
        ],
        destroy:true
        
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
            fields: {
                'title': {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        }
                    }
                },
                'description': {
                    validators: {
                        stringLength: {
                            message: 'Type description must be less than 200 characters',
                            max: function (value, validator, $field) {
                                return 200 - (value.match(/\r/g) || []).length;
                            }
                        }
                    }
                } 
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // find if the action is save or update
            /*if(save_method == 'add')
            {
                URI = "https://foodmario.com/admin/types";
            }else{
                var type_id = $('#type_id').val();
                URI = "https://foodmario.com/admin/types" +"/" +  type_id;
            }

            // get the input values
            result = new FormData($("#type-form")[0]);

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
                     $('#type-add-modal').modal('hide');
                     // $('#category-form')[0].reset();
                     // $('#category-form').data('formValidation').resetForm(true);

                     if(save_method == "add"){
                        swal({
                          title: "New type has been added!",
                          text: "A new type has been added to Food Mario",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     }else{
                        swal({
                          title: "Type has been Updated!",
                          text: "Type has been updated to Food Mario",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     } // check for the form submission type
                    table.ajax.reload();
                    
                    var image="https://foodmario.com/images/food_icon.png";
                     $("#type-image").attr('src',image);
                    $('#type-form')[0].reset();
                    $('#type-form').data('formValidation').resetForm(true);
                }
            },
            error:function(event)
            {
                console.log('Cannot add new user into the food mario system. Please try again later on..');
            }
            
        });*/
    }); // end formvalidation.io code

    // On click add new industry or job
    $( ".add-btn" ).on( "click", function() {
	  $('#add-edit-industry').modal('show');
	}); // end add new button click

	// On edit industry
	$("body").on('click','.edit-industry', function(e){
        e.preventDefault();
        industry_id=$(this).attr('data-industry-id');
        alert(industry_id);

    });// end edit industry click

	// On delete industry
	$("body").on('click','.delete-industry', function(e){
        e.preventDefault();
        industry_id=$(this).attr('data-industry-id');
        //alert(industry_id);

        //show the alert notification
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover industry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },function(isConfirm){
            if(isConfirm){
                //make ajax request 
                /*$.ajax({
                    url:"https://foodmario.com/admin/types" + "/" + industry_id,
                    type:"GET",
                    dataType:"Json",
                    data:{_token:_token},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", "industry has been deleted.", "success");
                            table.ajax.reload();
                        }else{
                            swal('Not allowed!!','The industy cannot be deleted because its contains jobs.','error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The type does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The type cannot be deleted because its contains jobs.','error');
                        }
                    }
                });*/
            }
            else {
                swal.close();
            }
        });

    });	// end delete industry click

    // On edit job
	$("body").on('click','.edit-job', function(e){
        e.preventDefault();
        job_id=$(this).attr('data-job-id');
        alert(job_id);

    }); // end edit job click

	// On delete job
	$("body").on('click','.delete-job', function(e){
        e.preventDefault();
        job_id=$(this).attr('data-job-id');

        //show the alert notification
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this job!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },function(isConfirm){
            if(isConfirm){
                //make ajax request 
                /*$.ajax({
                    url:"https://foodmario.com/admin/types" + "/" + job_id,
                    type:"GET",
                    dataType:"Json",
                    data:{_token:_token},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", "industry has been deleted.", "success");
                            table.ajax.reload();
                        }else{
                            swal('Not allowed!!','The industy cannot be deleted because its contains jobs.','error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The type does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The jobs cannot be deleted because its contains career advisor.','error');
                        }
                    }
                });*/
            }
            else {
                swal.close();
            }
        });

    }); // end delete job click

});// end document.ready function

</script>
@endsection