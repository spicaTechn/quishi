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
                              <h5>{{ __('Manage questions for career advisor')}}</h5>
                           </div>
                           <div class="card-header-right"> 
                              <button class="btn btn-grd-primary add-btn">{{ __('Add new Question')}}</button>
                           </div>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap hover tbl-questions">
                                  <thead>
                                     <tr>
                                        <th>{{ __('S.N')}}</th>
                                        <th>{{ __('Question')}}</th>
                                        <th>{{ __('Job title')}}</th>
                                        <th>{{ __('Type')}}</th>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Total answers')}}</th>
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
<!-- add modal -->
<div class="modal fade" id="add-edit-question" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form name="industry-jobs-form" id="industry-jobs-form">
	            <div class="modal-header">
	                <h4 class="modal-title"><span>{{ __('Add') }}</span> {{ __('Question')  }}</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
	            </div>
	            <div class="modal-body">
                  @csrf
                	<div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">{{ __('Enter question here *') }}</h4>
                            <input type="text" class="form-control question" id="question" name="question"  placeholder="question">
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">{{ __('Select Job')}} <small>{{ __('choose all if you want to show this question to everybody') }}</small></h4>
                            <select class="form-control form-control-default open parent-job" name="parent-job[]" multiple="">
            
                            </select>
                        </div> 
                    </div>

                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">{{ __('Select question type') }}</h4>
                            <div class="form-radio">
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="question-type" class="question-type" value="1">
                                        <i class="helper"></i>{{ __('Mandatory') }}
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="question-type" class="question-type" value="0">
                                        <i class="helper"></i>{{ __('Optional') }}
                                    </label>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <input type="hidden" name="question_id" class="question_id" value=""/>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">{{ __('Close')}}</button>
	                <button type="submit" class="btn btn-primary waves-effect waves-light ">{{ __('Save changes')}}</button>
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
<!-- <script type="text/javascript" src="{{ asset('/admin_assets/assets/js/caretTo.js') }}"></script> -->

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    var save_method, uri;   

	// datatable for Questions
    var question_table = $('.tbl-questions').DataTable({
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
                    columns: [ 0,1,2,3,4,5,6]
                  }
              }
        ],
        destroy : true,
        order : [[ 0, "asc" ]], //or asc 
        "fnInitComplete": function(oSettings, json) {
          tool_tip();
        },
        serverSide : true,
        processing : true,
        ajax       : {
                        url  : "{{route('admin.question.getQuestions')}}",
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
              {"data"         :"job_title",
                render:function(data)
                {
                    return data.split(',').join('<br>');
                }
                ,"name":"job_title"
              },
              {"data":"type",'name':"type"},
              {'data':'status','name':'status'},
              {'data':'total_answer','name':'total_answer'},
              {"data":"action" , "name" :"action"},
          
        ]

    });

    // On start typing add ? mark to question
    $( "input[name='question']" ).keyup(function() {
      
      var question = $(this).val();
      if(question.indexOf("?") == -1){
        $( this ).val(question+" ?"); // add question mark
      }
      $("input[name='question']").caret('?'); // move cursor before question mark
    });

    $( ".add-btn" ).on( "click", function() {
        save_method = 'add';
       $('.parent-job').select2({
            placeholder: 'Select job title..',
            dropdownParent: $('#add-edit-question'),
            // ajax request to pull the category list
              ajax: {
                  url:"{{route('admin.getIndustryJobs')}}",
                  type:"GET",
                  dataType:"Json",
                  data: function (params) {
                    return {
                      q: params.term, // search term
                    };
                  },
                  delay: 250,
                  processResults: function (data) {
                  return {
                    results:  $.map(data.result, function (job) {
                          return {
                                
                                  text: job.title + ' - ' + job.parent_title,
                                  id: job.id

                          }
                      })
                  };
                },
                cache: true,

              }
          });

       $('#add-edit-question').modal('show');
   }); // end add new button click
    
    
    
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
                URI = "{{route('admin.add.question')}}";
            }else{
                var question_id  = $(".question_id").val();
                URI = "{{URL::to('admin/questions')}}" + "/" + question_id;
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

                     // $('#category-form')[0].reset();
                     // $('#category-form').data('formValidation').resetForm(true);

                     if(save_method == "add"){
                        swal({
                          title: "New question  has been added!",
                          text: "A new  question  has been added to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     }else{
                        swal({
                          title: "Question has been Updated!",
                          text: "Question has been updated to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     } // check for the form submission type
                    //table.ajax.reload();
                     question_table.ajax.reload();
                   
                }
            },
            error:function(event)
            {
                console.log('Cannot add new user into the quishi system. Please try again later on..');
            }
            
        });
    }); // end formvalidation.io code

    // On click add new industry or job


  //edit question 

  // On edit industry
  $("body").on('click','.edit-question', function(e){
        e.preventDefault();
        save_method = 'edit';
        question_id = $(this).attr('data-question-id');
        //get the details from the db and make ready the modal to popup
        $.get("{{URL::to('admin/questions')}}" + "/" + question_id,function(data){
            //prepare the modal to show
            $(".question").val(data.result.title);
            $('.question_id').val(data.result.id);
            //$(".parent-industry").val(data.result.parent);
             //var parent_industry = "{{route('admin.industry')}}";
            $("input[name=question-type][value=" + data.result.type + "]").prop('checked', true);
            $.map(data.career, function (career) {
                       
              if(data.result.assigned_career == 1){
                var select2=$(".parent-job").data('select2').trigger("select", { 
                      data: 
                          { 
                              id: 'all',
                              text:'All - All' 
                          } 
                  });
              }else{
                var select2=$(".parent-job").data('select2').trigger("select", { 
                      data: 
                          { 
                              id: career.id,
                              text:career.title 
                          } 
                  });
              }     
              
          });
        });
        $('.modal-title').html('Edit Question');
        $('#add-edit-question').modal('show');

    });// end edit industry click


  //reset the form validaton and from when the modal was closing
  $('.modal').on('hidden.bs.modal', function(){
     $(this).find('form').data('formValidation').resetForm(true);
     $(this).find('form')[0].reset();

  });


  //delete the question on click of the delete button
  $("body").on('click','.delete-question', function(e){
        e.preventDefault();
        question_id=$(this).attr('data-question-id');
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
                $.ajax({
                    url:"{{URL::to('admin/questions')}}" + "/" + question_id,
                    type:"DELETE",
                    dataType:"Json",
                    data:{_token:"{{csrf_token()}}"},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", data.message, "success");
                            question_table.ajax.reload();
                             
                        }else{
                            swal('Not allowed!!',data.message,'error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The question does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The question cannot be deleted because its contains jobs.','error');
                        }
                    }
                });
            }
            else {
                swal.close();
            }
        });

    }); // end delete industry click

});// end document.ready function

function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}

</script>
@endsection