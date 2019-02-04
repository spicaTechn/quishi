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
                              <h5>{{ __('Manage industry and jobs')}}</h5>
                           </div>
                           <div class="card-header-right"> 
                              <button class="btn btn-grd-primary add-btn">{{ __('Add new Industry / Job')}}</button>
                           </div>
                        </div>
                        <div class="card-block">
                           <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#industry" role="tab" aria-controls="industry" aria-selected="true">{{ __('Industry')}}</a>
                                 <div class="slide"></div>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="true">{{ __('Jobs')}}</a>
                                 <div class="slide"></div>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="user-job-tab" data-toggle="tab" href="#userJobs" role="tab" aria-controls="userJobs" aria-selected="true">{{ __('User Submitted Jobs')}}</a>
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
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{ __('Description')}}</th>
                                                <th>{{ __('No of jobs')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
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
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{__('Industry')}}</th>
                                                <th>{{ __('Description')}}</th>
                                                <th>{{ __('Usage')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                               
                               <!--user submitted jobs-->
                               <div class="tab-pane fade pt-3" id="userJobs" role="tabpanel" aria-labelledby="userJobs">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-userJobs">
                                          <thead>
                                             <tr>
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{__('Industry')}}</th>
                                                <th>{{ __('Description')}}</th>
                                                <th>{{ __('Submitted Date')}}</th>
                                                <th>{{ __('Submitted by')}}</th>
                                                <th>{{ __('Usage')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                               <!--end of user submitted jobs-->
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
                  @csrf
                	<div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Title *</h4>
                            <input type="text" class="form-control fullname" name="title" placeholder="title">
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Select parent <small>If you select parent it automatically recognize as Job</small></h4>
                            <select class="form-control parent-industry" name="parent_id">
                            </select>
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Description</h4>
                            <textarea class="form-control description" name="description"></textarea>
                        </div> 
                    </div>
                    <input type="hidden" name="industry_id" class="industry_id" value=""/>
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

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    var save_method, uri;
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
    var industry_table = $('.tbl-industry').DataTable({
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
        //columnDefs: [{"targets":0, "type":"date-eu"}],
        serverSide : true,
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
          
        ],
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        }

    });

    // datatable for active subscription
    var job_table = $('.tbl-jobs').DataTable({
        dom                   : 'Bfrtip',
        buttons               :[
                                 'excel',
                                 'print'
                               ],
        destroy               :true,
        processing            :true,
        serverSide            :true,
        ajax                  : {
                                 url :"{{route('admin.jobs.getJobs')}}",
                                 type : "GET",

                                },
        columns:[
        {
            "data": "id",
             render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
             }
        },
        {"data" :"title","name":"title"},
        {"data": "parent_industry", "name": "parent_industry"},
        {"data":'description', "name":"description"},
        {"data":"usage",'name':"usage"},
        {"data":"action" , "name" :"action"},
        
        ],
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        }
        
    });


    // datatable for active subscription
    var user_job_table = $('.tbl-userJobs').DataTable({
        dom                   : 'Bfrtip',
        buttons               :[
                                 'excel',
                                 'print'
                               ],
        destroy               :true,
        processing            :true,
        serverSide            :true,
        ajax                  : {
                                 url :"{{route('admin.unapproved.jobs')}}",
                                 type : "GET",

                                },
        columns:[
        {
            "data": "id",
             render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
             }
        },
        {"data" :"title","name":"title"},
        {"data": "parent_industry", "name": "parent_industry"},
        {"data":'description', "name":"description"},
        {"data":'created_at', "name":"created_at"},
        {"data":'submitted_by', "name":"submitted_by",'searchable':false,'orderable':false},
        {"data":"usage",'name':"usage"},
        {"data":"action" , "name" :"action"},
        
        ],
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        }
        
    });

    // Fomvalidation setup
    var form = document.getElementById('industry-jobs-form');
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
                'title': {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        },
                        remote  : {
                          message : 'The title is already taken',
                          method  : 'GET',
                          data    : function(){
                            return{
                                'id': form.querySelector('[name="industry_id"]').value
                            };
                          },
                          url     : "{{route('admin.industryJobs.checkIndustryTitle')}}"
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
            if(save_method == 'add')
            {
                URI = "{{route('admin.add.industryJobs')}}";
            }else{
                var industry_id  = $(".industry_id").val();
                URI = "{{URL::to('admin/industryJobs')}}" + "/" + industry_id;
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
                     $('#add-edit-industry').modal('hide');
                     var submit_type = $('.parent-industry').val();
                     var submit_msg = '';
                     if(submit_type == 0){
                        submit_msg = "Industry";

                     }else{
                        submit_msg = "Job";
                     }
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

                    
                     industry_table.ajax.reload();
                     job_table.ajax.reload();
                     user_job_table.ajax.reload();
                    
                    
                    //var image="https://foodmario.com/images/food_icon.png";
                    //$("#type-image").attr('src',image);
                   resetFormOnClose();
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
	     $('#add-edit-industry').modal('show');
	}); // end add new button click



    //approve jobs by the superadmin

    //approve the career advisor submitted education
    $('body').on('click','.approve-jobs',function(e){
      e.preventDefault();
      var career_id = $(this).attr('data-industry-id');
      var status       = 'approved';
      $.post("{{route('admin.approve.jobs')}}",{career_id : career_id , _token : "{{csrf_token() }}",status : status},function(response){
        if(response.status == "success"){
          swal({
                title: "Career Advisor Job title approved!",
                text: "Career added job title has been approved and updated successfully!",
                type: "success",
                closeOnConfirm: true,
            });

          //need to reload the table
          user_job_table.ajax.reload();
          job_table.ajax.reload();
        }else if(reponse.status == "failed"){
          swal({
                title: "Job title cannot be approved!",
                text: response.msg,
                type: "error",
                closeOnConfirm: true,
            });
        }

      });
    });



    //reset the form validaton and from when the modal was closing
   
      $('.modal').on('hidden.bs.modal', function(){
         $(this).find('form').data('formValidation').resetForm(true);
         $(this).find('form')[0].reset();

      });
    
  

	// On edit industry
	$("body").on('click','.edit-industry,.edit-job', function(e){
        e.preventDefault();
        save_method = 'edit';
        industry_id = $(this).attr('data-industry-id');
        //get the details from the db and make ready the modal to popup
        $.get("{{URL::to('admin/industryJobs')}}" + "/" + industry_id,function(data){
            //prepare the modal to show
            $(".fullname").val(data.result.title);
            //$(".parent-industry").val(data.result.parent);
             var parent_industry = "{{route('admin.industry')}}";
           
            $('.description').val(data.result.description);
            $('.industry_id').val(data.result.id);
            $(".parent-industry").html(data.return_option);
        });
        $('.modal-title').html('Edit Industry / Job');
        $('#add-edit-industry').modal('show');

    });// end edit industry click

	// On delete industry
	$("body").on('click','.delete-industry,.delete-job', function(e){
        e.preventDefault();
        industry_id=$(this).attr('data-industry-id');
        //alert(industry_id);

        //show the alert notification
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
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
                $.ajax({
                    url:"{{URL::to('admin/industryJobs')}}" + "/" + industry_id,
                    type:"DELETE",
                    dataType:"Json",
                    data:{_token:"{{csrf_token()}}"},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", data.message, "success");
                             user_job_table.ajax.reload();
                             industry_table.ajax.reload();
                             job_table.ajax.reload();
                        }else{
                            swal('Not allowed!!',data.message,'error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The industry does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The industry cannot be deleted because its contains jobs.','error');
                        }
                    }
                });
            }
            else {
                swal.close();
            }
        });

    });	// end delete industry click

});// end document.ready function

function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}
</script>
@endsection