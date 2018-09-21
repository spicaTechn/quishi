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
 <!-- list css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/pages/list-scroll/list.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/stroll/css/stroll.css') }}">

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

  .basic-list p {
      margin: 0;
      padding-right: 100px;
  }

  .btn.resolve-review {
      right: 1px;
      top: 0;
      width: 100px;
      padding: 8px 0;
      float: right;
      position: absolute;
  }
  .basic-list.list-icons li, 
  .basic-list.list-icons-img li {
    margin-left: 4px;
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
                                          class="m-r-15 text-muted review-user" 
                                          data-toggle="tooltip" 
                                          data-placement="top" 
                                          title="" 
                                          data-original-title="Write Review" 
                                          data-user-id="1">
                                          <i class="icofont icofont-comment"></i>
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

<!-- Review detail user -->
<div class="modal fade" id="review-Modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Review to user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="add-review-form" id="add-review-form">
                   <!--Setting user ID-->
                    <input type="hidden" name="user_id" value="1">
                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Review</h4>
                            <textarea class="form-control review" name="review"></textarea>
                        </div> 
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-xl-12 m-b-30">
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Send review</button>
                      </div>
                    </div>
                </form><!--end form-->

                <!-- Previous review list-->
                <div class="row card-block">
                  <div class="col-sm-12 col-xl-12 m-b-30">
                    <div class="card card-block user-card">
                        <ul class="basic-list list-icons">
                            <li>
                                <p>Laborum nihil aliquam nulla praesentium illo libero
                                    nihil at odio maxime.</p>

                                <button type="button" 
                                  class="btn btn-primary btn-mini waves-effect waves-light  p-absolute text-center d-block resolve-review" 
                                  data-review-id="1">
                                  Resolve review
                                </button>
                            </li>
                            <li>
                                <p>Laborum nihil aliquam nulla praesentium illo libero
                                    nihil at odio maxime.</p>

                                <button type="button" 
                                  class="btn btn-primary btn-mini waves-effect waves-light  p-absolute text-center d-block resolve-review" 
                                  data-review-id="2">
                                  Resolve review
                                </button>
                            </li>

                            <li>
                                <p>Laborum nihil aliquam nulla praesentium illo libero
                                    nihil at odio maxime.</p>

                                <button type="button" 
                                  class="btn btn-primary btn-mini waves-effect waves-light  p-absolute text-center d-block resolve-review" 
                                  data-review-id="3">
                                  Resolve review
                                </button>
                            </li>
                        </ul>
                    </div>
                  </div>
                 </div>
                 <!-- end Previous review list-->

                
            </div>
        </div>
    </div>
</div>
<!-- End review modal -->
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
<!-- list-scroll js -->
<script src="{{ asset('/admin_assets/bower_components/stroll/js/stroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/assets/pages/list-scroll/list-custom.js') }}"></script>

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

    

    // Fomvalidation setup
    $('#add-review-form').on('init.field.fv', function(e, data) {
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
                'review': {
                    validators: {
                        notEmpty: {
                            message: 'The review is required'
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


  // User review modal click
    $( ".review-user" ).on( "click", function() {
       tool_tip();
       $('#review-Modal').modal('show');
  }); // end User review icon click

  // User review resolve button click
  $(".resolve-review").on("click", function(){
    var review_id = $(this).data("review-id");
  }); // end review resolve button click

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