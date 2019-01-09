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
                     <div class="card px-4 py-4 major-category-major-tab">
                        <div class="card-header">
                           <div class="card-header-left">
                              <h5>{{ __('Manage education')}}</h5>
                           </div>
                           <div class="card-header-right"> 
                              <button class="btn btn-grd-primary add-btn">{{ __('Add new education title')}}</button>
                           </div>
                        </div>
                        <div class="card-block">
                           <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#major-category" role="tab" aria-controls="major-category" aria-selected="true">{{ __('Major Category')}}</a>
                                 <div class="slide"></div>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#major" role="tab" aria-controls="major" aria-selected="true">{{ __('Major')}}</a>
                                 <div class="slide"></div>
                              </li>
                               <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#submitMajor" role="tab" aria-controls="submitMajor" aria-selected="true">{{ __('User Submitted Major')}}</a>
                                 <div class="slide"></div>
                              </li>
                           </ul>
                           <div class="tab-content" >
                              <div class="tab-pane fade show active" id="major-category" role="tabpanel" aria-labelledby="home-tab">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-major-category">
                                          <thead>
                                             <tr>
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{ __('No Of Majors')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade pt-3" id="major" role="tabpanel" aria-labelledby="profile-tab">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-major">
                                          <thead>
                                             <tr>
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{ __('Major Category')}}</th>
                                                <th>{{ __('No of users')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                               
                               <!--User submitted majors-->
                               <div class="tab-pane fade pt-4" id="submitMajor" role="tabpanel" aria-labelledby="submitMajor">
                                 <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                       <table class="table table-striped table-bordered nowrap hover tbl-user-submitted-major">
                                          <thead>
                                             <tr>
                                                <th>{{ __('S.N')}}</th>
                                                <th>{{ __('Title')}}</th>
                                                <th>{{ __('Major Category')}}</th>
                                                <th>{{ __('No of users')}}</th>
                                                <th>{{ __('Submit Date')}}</th>
                                                <th>{{ __('Submitted by')}}</th>
                                                <th>{{ __('Action')}}</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>1</td>    
                                                <td>Sanskrit</td>    
                                                <td>Others</td>    
                                                <td>1</td>    
                                                <td>10 Jan 2019</td>    
                                                <td><a href="#">Ram Thapa</a></td>  
                                                <td>Edit Delete Approve</td>    
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                               <!--End of user submitted majors-->
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
<div class="modal fade" id="add-edit-major-category" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form name="major-category-major-form" id="major-category-major-form">
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add</span> major subject <small>Field denoted as * mark is required field</small></h4>
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
                            <h4 class="sub-title">Select parent <small>If you select parent it automatically recognize as major else system will treat as major category</small></h4>
                            <select class="form-control parent-major-category" name="parent_id">
                            </select>
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Description</h4>
                            <textarea class="form-control description" name="description"></textarea>
                        </div> 
                    </div>
                    <input type="hidden" name="major_category_id" class="major_category_id" value=""/>
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
	// Page major-category and major
	 $(".major-category-major-tab").tabs({
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
    var major_category_table = $('.tbl-major-category').DataTable({
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
                        url  : "{{route('admin.educations.majorCategory')}}",
                        type : 'GET',
        },
        columns   : [
                     
              {
               "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
              },
              {"data" :"name","name":"name"},
              {"data":"major",'name':"major"},
              {"data":"action" , "name" :"action"},
          
        ],
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        }

    });

    // datatable for active subscription
    var major_table = $('.tbl-major').DataTable({
        dom                   : 'Bfrtip',
        buttons               :[
                                 'excel',
                                 'print'
                               ],
        destroy               :true,
        processing            :true,
        serverSide            :true,
        ajax                  : {
                                 url :"{{route('admin.educations.major')}}",
                                 type : "GET",

                                },
        columns:[
        {
            "data": "id",
             render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
             }
        },
        {"data" :"name","name":"name"},
        {"data":"major_category",'name':"major_category"},
        {"data":"usage","name":"usage"},
        {"data":"action" , "name" :"action"},
        
        ],
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        }
        
    });

    // Fomvalidation setup
    $('#major-category-major-form').on('init.field.fv', function(e, data) {
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
                        remote:{
                          message : 'The title is already taken',
                          method  : 'GET',
                          url     : "{{route('admin.education.checkEducationTitle')}}"
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
                URI = "{{route('admin.educations.store')}}";
            }else{
                var major_category_id  = $(".major_category_id").val();
                URI = "{{URL::to('admin/educations')}}" + "/" + major_category_id;
            }

            // get the input values
            result = new FormData($("#major-category-major-form")[0]);

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
                     $('#add-edit-major-category').modal('hide');
                     var submit_type = $('.parent-major-category').val();
                     var submit_msg = '';
                     if(submit_type == 0){
                        submit_msg = "Major Category";

                     }else{
                        submit_msg = "Major";
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

                    
                     major_category_table.ajax.reload();
                     major_table.ajax.reload();
                    
                    
                    //var image="https://foodmario.com/images/food_icon.png";
                    //$("#type-image").attr('src',image);
                   //resetFormOnClose();
                }
            },
            error:function(event)
            {
                console.log('Cannot add new user into the quishi system. Please try again later on..');
            }
            
        });
    }); // end formvalidation.io code

    // On click add new major-category or job
    $( ".add-btn" ).on( "click", function() {
         save_method = 'add';
         var parent_major_category = "{{route('admin.educations.getMajorCategory')}}";
         //make the ajax request to get the 
         $.get(parent_major_category,function(data){
            $('.parent-major-category').html(data.result);
            console.log(data.result);
         });
	     $('#add-edit-major-category').modal('show');
	}); // end add new button click



    //reset the form validaton and from when the modal was closing
   
      $('.modal').on('hidden.bs.modal', function(){
         $(this).find('form').data('formValidation').resetForm(true);
         $(this).find('form')[0].reset();

      });
    
  

	// On edit major-category
	$("body").on('click','.edit-major-category,.edit-major', function(e){
        e.preventDefault();
        save_method = 'edit';
        major_category_id = $(this).attr('data-major-id');
        //get the details from the db and make ready the modal to popup
        $.get("{{URL::to('admin/educations')}}" + "/" + major_category_id,function(data){
            //prepare the modal to show
            $(".fullname").val(data.result.name);
            //$(".parent-major-category").val(data.result.parent);
             var parent_major_category = "{{route('admin.educations.getMajorCategory')}}";
           
            $('.description').val(data.result.description);
            $('.major_category_id').val(data.result.id);
            $(".parent-major-category").html(data.return_option);
        });
        $('.modal-title').html('Edit Major Category / Major');
        $('#add-edit-major-category').modal('show');

    });// end edit major-category click

	// On delete major-category
	$("body").on('click','.delete-major-category,.delete-major', function(e){
        e.preventDefault();
        major_category_id=$(this).attr('data-major-id');
        //alert(major_category_id);

        //show the alert notification
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover Major Category / Major !",
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
                    url:"{{URL::to('admin/educations')}}" + "/" + major_category_id,
                    type:"DELETE",
                    dataType:"Json",
                    data:{_token:"{{csrf_token()}}"},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", data.message, "success");
                              major_category_table.ajax.reload();
                              major_table.ajax.reload();
                        }else{
                            swal('Not allowed!!',data.message,'error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The major-category does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The major-category cannot be deleted because its contains major.','error');
                        }
                    }
                });
            }
            else {
                swal.close();
            }
        });

    });	// end delete major-category click

});// end document.ready function

function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}
</script>
@endsection