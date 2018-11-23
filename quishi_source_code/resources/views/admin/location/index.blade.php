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
                     <div class="card px-4 py-4">
                        <div class="card-header">
                           <div class="card-header-left">
                              <h5>{{ __('Manage Locations')}}</h5>
                           </div>
                           <div class="card-header-right"> 
                              <button class="btn btn-grd-primary add-location">{{ __('Add new Location')}}</button>
                           </div>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap hover tbl-locations">
                                  <thead>
                                     <tr>
                                        <th>{{ __('S.N')}}</th>
                                        <th>{{ __('Country')}}</th>
                                        <th>{{ __('States / Province / Territories')}}</th>
                                        <th>{{ __('City')}}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Total Users Live In')}}</th>
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
<div class="modal fade" id="add-edit-location" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form name="location-form" id="location-form" autocomplete="off">
              <div class="modal-header">
                  <h4 class="modal-title"><span>{{ __('Add') }}</span> {{ __('Location')  }}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @csrf
                  <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">{{ __('Country*') }}</h4>
                            <input type="text" class="form-control country" id="country" name="country"  placeholder="country" autofocus="">
                            <div class="col-sm-12 show_country_search form-control">
                            </div>
                        </div> 
                        <!--to do place the div to show the list of the countries if exists in the db-->
                    </div>

                    <div class="row">
                      <div class="col-sm-12 col-xl-12 m-b-30">
                        <h4 class="sub-title">{{ __('States / Provinces / Territories*')}}</h4>
                          <input type="text" class="form-control state" id="state" name="state" placeholder="state / province / territory">
                          <div class="col-sm-12 show_state_search form-control">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-xl-12 m-b-30">
                        <h4 class="sub-title">{{ __('City')}}</h4>
                          <input type="text" class="form-control city" id="city" name="city" placeholder="city">
                           <div class="col-sm-12 show_city_search form-control">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">{{ __('Select status') }}</h4>
                            <div class="form-radio">
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="status" class="status" value="1" checked="checked">
                                        <i class="helper"></i>{{ __('Active') }}
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="status" class="status" value="0">
                                        <i class="helper"></i>{{ __('Inactive') }}
                                    </label>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <input type="hidden" name="location_id" class="location_id" value=""/>
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

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    var save_method, uri;
    //from validation

    var location_table = $('.tbl-locations').DataTable({
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
                        url  : "{{route('admin.location.getLocations')}}",
                        type : 'GET',
        },
        columns   : [
                     
              {
               "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
              },
              {"data" :"country","name":"country"},
              {"data" :"state","name":"state"},
              {"data":"city",'name':"city"},
              {'data':'status','name':'status'},
              {'data':'total_people_live_in','name':'total_people_live_in',searchable: false},
              {"data":"action" , "name" :"action"},
          
        ]

    });
    // Fomvalidation setup
    $('#location-form').on('init.field.fv', function(e, data) {
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
                'country': {
                    validators: {
                        notEmpty: {
                            message: 'The country is required'
                        }
                    }
                },
                'state': {
                    validators: {
                        notEmpty: {
                            message: 'The state is required'
                        }
                    }
                },
                'city': {
                    validators: {
                        notEmpty: {
                            message: 'The city field is required'
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
                URI = "{{route('admin.add.location')}}";
            }else{
                var location_id  = $(".location_id").val();
                URI = "{{URL::to('admin/locations')}}" + "/" + location_id;
            }

            // get the input values
            result = new FormData($("#location-form")[0]);

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
                     $('#add-edit-location').modal('hide');

                     // $('#category-form')[0].reset();
                     // $('#category-form').data('formValidation').resetForm(true);

                     if(save_method == "add"){
                        swal({
                          title: "New Location  has been added!",
                          text: "A new  location  has been added to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     }else{
                        swal({
                          title: "Location has been Updated!",
                          text: "Location has been updated to Quishi",
                          type: "success",
                          closeOnConfirm: true,
                        });
                     } // check for the form submission type
                    //table.ajax.reload();
                    location_table.ajax.reload();
                   
                }else if(data.status == "dublicate"){
                  $('#add-edit-location').modal('hide');
                   swal({
                        title : "Location already exists",
                        text  : 'Location already exists in the Quishi, Please try with other address!!',
                        type  : "error",
                        closeOnConfirm : true,
                   });
                }
            },
            error:function(event)
            {
                console.log('Cannot add new location into the quishi system. Please try again later on..');
            }
            
        });
    }); // end formvalidation.io code



    //1 show the modal when click on the add location button
    $(".add-location").on('click',function(e){
      //prevent the default action
      e.preventDefault();
      save_method = 'add';
      //show the modal
      $("#add-edit-location").modal('show');
    });



    //2 edit locations
    $("body").on('click','.edit-location', function(e){
        e.preventDefault();
        save_method = 'edit';
        location_id = $(this).attr('data-location-id');
        //get the details from the db and make ready the modal to popup
        $.get("{{URL::to('admin/locations')}}" + "/" + location_id, function(data){
            //prepare the modal to show
            $('.country').val(data.result.country);
            $('.state').val(data.result.state);
            $('.city').val(data.result.city);
            $.each($('input[type="radio"]'),function(index,value){
              if(value.value == data.result.status){
                $(this).prop('checked',true);
              }
            });
            $('.location_id').val(data.result.id);
        });

        $('.modal-title').html('Edit Location');
        $('#add-edit-location').modal('show');

    });// end edit location click

    //3 delete locations
    $("body").on('click','.delete-location', function(e){
        e.preventDefault();
        location_id = $(this).attr('data-location-id');
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
                    url:"{{URL::to('admin/locations')}}" + "/" + location_id,
                    type:"DELETE",
                    dataType:"JSON",
                    data:{_token:"{{csrf_token()}}"},
                    success:function(data){
                        if(data.status == "success")
                        {
                            swal("Deleted!", data.message, "success");
                            location_table.ajax.reload();
                             
                        }else{
                            swal('Not allowed!!',data.message,'error');
                        }
                    },
                    error:function(jqXHR,textStatus,errorThrown)
                    {
                        if(jqXHR.status == '404')
                        {
                            swal('Not found in server','The location does not exists','error');
                        }else if(jqXHR.status == '201')
                        {
                            swal('Not allowed!!','The location cannot be deleted because its contains users.','error');
                        }
                    }
                });
            }
            else {
                swal.close();
            }
        });

    }); // end delete industry click


      $('.modal').on('hidden.bs.modal', function(){
         $(this).find('form').data('formValidation').resetForm(true);
         $(this).find('form')[0].reset();
         $('.show_country_search').hide();
         $('.show_state_search').hide();

      });

      //hide the autocomplete country and state field intially
      $('.show_country_search').hide();
      $('.show_state_search').hide();
      $('.show_city_search').hide();



      //show the list of search on the keyup
      $('.country').keyup(function(e){
        //need to make the ajax request to show the list of the addresss
        getSearchResult($(this).val(),1,'show_country_search');
      });

      $(".state").keyup(function(e){
        getSearchResult($(this).val(),2,'show_state_search');
      });

      $(".city").keyup(function(e){
        getSearchResult($(this).val(),3,'show_city_search');
      });


      //hide the autocomplete country and state after outfoucs

      // $('.country , .state').focusout(function(e){
      //    $('.show_country_search').hide();
      //    $('.show_state_search').hide();
      // });


      //function to get the results

      function getSearchResult(search_value,type,class_name){
        var _quishi_entered_value = search_value;
        var _token   = "{{csrf_token()}}";

        //make the request to the server to get the result
        $.post("{{route('admin.location.getSearchLocation')}}",{_token: _token , _q : _quishi_entered_value, type : type},function(data){
          if(data.status == 'success'){
             //append the value and show the result
            
             $('.' + class_name).html(data.message);
             $('div.' + class_name + '').show();
          }else{
              $('div.' + class_name + '').hide();
          }
        });
      }


      $('body').on('click','.country_option', function(e){
        e.preventDefault();
        var selected_country = $(this).attr('data-value');
        $(this).closest('div.m-b-30').find('input').val(selected_country);
        $(this).parent().closest('div').hide();

      });

});// end document.ready function




function tool_tip() {
     $('[data-toggle="tooltip"]').tooltip()
}
</script>
@endsection