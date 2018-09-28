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
        order : [[ 0, "desc" ]], //or asc 
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        },
        serverSide : true,
        processing : true,
        ajax       : {
                        url  : "{{route('admin.careerAdvisior')}}",
                        type : 'GET',
        },
        columns   : [
                     
              {
               "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
              },
              {'render'  :function(data, type, JsonResultRow, meta)
                            {
                                return "<img src='"+ JsonResultRow.user_image + "' height='50px' width='50px'>";
                            }
              },
              {"data":"user_profile.first_name","name":"user_profile.first_name"},
              {"data":"email",'name':'email'},
              {"data"         :"job_title",
                render:function(data)
                {
                    return data.split(',').join('<br>');
                }
                ,"name":"careers.title"
              },
              //{"data": "status",'name':"user_profile.status"},
              {
                data: 'user_profile.status', 
                name: 'user_profile.status',
                render: function ( data, type, full, meta ) {
                   return data == "1" ? "Active" : "Inactive" ;
                }
              },
              {"data": "profile_views_count","name":"profile_views_count"},
              {"data":'user_profile.total_likes', "name":"user_profile.total_likes"},
              {"data":"action" , "name" :"action",'orderable':false,'searchable':false},
          
        ]

    });


  // User review modal click
  $('body').on( "click",".review-user", function() {
       tool_tip();
      $.get("{{route('admin.users.admin_reviews')}}",{user_id:$(this).attr('data-user-id')},function(data){
         $('#review-Modal').html(data.result);
         $('#review-Modal').modal('show');
      });
     
  }); // end User review icon click


  //add new reviews

  $('body').on('click','.create-review',function(e){
    e.preventDefault();
    var review_content = $('body').find('#review_content').val();
    if(review_content == ""){
      alert('Review cannot be empty!!');
    }else{

    var career_advisior_id = $('body').find('#career-seeker-id').val();
    //make the post request to the store the review resource
    $.post("{{route('admin.careerAdvisior.reviews')}}",{_token:"{{csrf_token()}}",'career_advisior_id': career_advisior_id, 'review_content': review_content},function(data){
        if(data.status == "success"){
          swal({
              title: "Reviews has been created!",
              text: "Career seeker reviews has been created successfully !!",
              type: "success",
              closeOnConfirm: true,
            });
          $('body').find('#review_content').val(' ');
          $('.career-seeker-reviews').html(data.result);
        }
    });
  }
  });

  // User review resolve button click
  $('body').on("click",".resolve-review", function(){

    var review_id        = $(this).data("review-id");
    var career_seeker_id = $(this).data('career-seeker-id');
    $.post("{{route('admin.reviews.changeStatus')}}",{reivew_id: review_id, career_seeker_id: career_seeker_id ,_token: "{{csrf_token()}}"},function(data){
      //change the modal data 
      if(data.status  == "success"){
        //show the sweet alert message
        swal({
              title: "Reviews has been resolved!",
              text: "Career seeker reviews has been resolved successfully !!",
              type: "success",
              closeOnConfirm: true,
            });
        $('.career-seeker-reviews').html(data.result);
      }
      
    });
  }); // end review resolve button click


  //activate users
  $('body').on('click','.activate-user,.deactivate-user',function(){
    //get the require parameters
    var career_advisior_id = $(this).attr('data-user-id');
    var toggle_status      = $(this).attr('data-status');
    var status             = "";
    var status_msg         = "";
    if(toggle_status       == "activate"){
      status               = 1;
      status_msg           = "activated";
    }else{
      status               = 0;
      status_msg           = "deactivated";
    }

    //request the server to perform the actions
    $.post("{{route('admin.users.update')}}",{'career_advisior_id': career_advisior_id,'_token':"{{csrf_token()}}",'status':status},function(data){
      if(data.status == "success"){
        //show the swal alert success message
        swal({
              title: "User has been " + status_msg + " !",
              text: "Career seeker account status has been updated successfully !!",
              type: "success",
              closeOnConfirm: true,
            });
        //reload the user table 
        user_table.ajax.reload();
      }
    });
  });

  //deactive users

});// end document.ready function

function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}

</script>
@endsection