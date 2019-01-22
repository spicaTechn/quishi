@extends('admin.layout.master')
@section('page_specific_css')
<!--Load the datatable css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css') }}">

<!-- File Input css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/file-input/css/fileinput.css') }}">
<!-- datepicker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/css/jquery-ui.css') }}">
<style type="text/css">
  /*wysisyg editor initial notification hiding*/

#mceu_70,#mceu_68,#mceu_69 {

    display: none;
}


img {
  max-width: 100%;
  height: auto;
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
               <div class="card px-4 py-4 industry-jobs-tab">
                  <div class="card-header">
                     <div class="card-header-left">
                        <h5>Manage In the Media</h5>
                     </div>
                  </div>
                  <div class="tab-pane fade show" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <div class="card-block">
                      <div class="row">

                         <div class="col-md-6">
                            <h4>
                               <button class="btn btn-grd-primary blog-add-btn">Add New Media</button>
                            </h4>
                         </div>
                      </div>
                      <div class="dt-responsive table-responsive">
                          <table id="our_team_table" class="table table-striped table-bordered our_team_table">
                              <thead>
                              <tr>
                                  <th>S.N.</th>
                                  <th>Image</th>
                                  <th>Title</th>
                                  <th>Description</th>
                                  <th>Abstract</th>


                                  <th>Date</th>
                                  <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>
                                <?php $i=1;?>
                                @foreach($all_blogs as $all_blog)
                                  <tr>
                                      <td>{{ $i }}</td>
                                      <td>
                                        <img src="{{ ($all_blog->image_path != '') ? asset('/front/images/blogs').'/'
                                        .$all_blog->image_path : asset('/front/images/banner.jpg') }}" style="height: 40px; width: 40px;">
                                      </td>
                                      <td>{{ $all_blog->title }}</td>
                                      <td>{!! (strlen($all_blog->content) > 50) ? substr($all_blog->content,0,50) . '..' : $all_blog->content !!}</td>
                                      <td>{{ (strlen($all_blog->abstract) > 50) ? substr($all_blog->abstract,0,50) .'...' : $all_blog->abstract }}</td>

                                      <td>{{ Carbon\Carbon::parse($all_blog->published_date)->format('d-M-Y') }}</td>
                                      <td>

                                          <a href="#" class="m-r-15 text-muted edit-blog"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-original-title="Edit"
                                                data-blog-id="{{ $all_blog->id }}"
                                                data-serialize-id="{{ $all_blog->id }}"
                                                >
                                             <i class="icofont icofont-ui-edit" ></i>
                                             </a>
                                             <a href="#" class="text-muted delete-blog"
                                                data-toggle="tooltip"
                                                data-placement="top" title=""
                                                data-original-title="Delete"
                                                data-blog-id="{{ $all_blog->id }}"
                                                data-serialize-id="{{ $all_blog->id }}"
                                                >
                                             <i class="icofont icofont-delete-alt"></i>
                                             </a>
                                      </td>
                                  </tr>
                                  <?php $i++;?>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                    </div>
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
<div class="modal fade" id="add-blog" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form role="form" name="blog-form" id="blog-form" enctype="multipart/form-data">
            @csrf

              <div class="modal-header">
                  <h4 class="modal-title"><span>Add New Media </span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="blog_id" class="blog_id" value=""/>
                <input type="hidden" name="page_detail_id" class="page_detail_id" value="">
                <div class="row">
                  <div class="col-sm-12 col-xl-12 m-b-30">
                       <h4 class="sub-title">Title *</h4>
                       <input type="text" class="form-control blog_title" name="blog_title" placeholder="Title" value="">
                   </div>

                </div>

                <div class="row">
                   <div class="col-sm-12 col-xl-12 m-b-30">
                       <h4 class="sub-title">Description *</h4>
                       <textarea id="add-tinymce" style="height: 283px;"  class="form-control blog_description" name="blog_description" placeholder="Description"></textarea>
                   </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-6 m-b-30">
                      <div class="row">
                        <div class="col-sm-12 col-xl-12 m-b-30">
                           <h4 class="sub-title">Date *</h4>
                           <input type="text" class="form-control date" id="select_date" name="date" placeholder="Date" value="">
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-sm-12 col-xl-12 m-b-30">
                             <h4 class="sub-title">Abstract *</h4>
                             <textarea  type="text" class="form-control blog_abstract" style="height: 250px;" name="blog_abstract" placeholder="Abstract" value="">
                             </textarea>
                         </div>
                       </div>
                    </div>
                    <div class="col-sm-6 col-xl-6 m-b-30">
                       <h4 class="sub-title">Image *</h4>
                       <div class="fileinput fileinput-new" data-provides="fileinput">
                           <div class="fileinput-new thumbnail"  data-trigger="fileinput">

                            <img src="{{asset('/front')}}/images/blogs/career.jpg" id="blog-image">

                           </div>
                           <div class="fileinput-preview fileinput-exists thumbnail">
                           </div>
                           <div>
                             <span class="btn btn-file btn-block btn-primary btn-sm">
                               <span class="fileinput-new">Select Profile Image</span>
                               <span class="fileinput-exists">Change</span>
                               <input name="blog_image" accept="image/*" type="file">
                             </span>
                             <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                           </div>
                       </div>
                    </div>

                </div>
              </div>

              <div class="modal-footer">
               <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
               <button type="submit"  class="btn btn-primary waves-effect waves-light">Save changes</button>
              </div>
         </form>
        </div>
    </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="edit-blog" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form role="form" name="edit-blog-form" id="edit-blog-form" enctype="multipart/form-data">
            @csrf

              <div class="modal-header">
                  <h4 class="modal-title"><span>Edit Media </span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="blog_id" class="blog_id" value=""/>
                <input type="hidden" name="page_detail_id" class="page_detail_id" value="">
                <input type="hidden" name="edit_description" class="edit_description" value="">
                <div class="row">
                  <div class="col-sm-12 col-xl-12 m-b-30">
                       <h4 class="sub-title">Title *</h4>
                       <input type="text" class="form-control blog_title" name="blog_title" placeholder="Title" value="">
                   </div>

                </div>

                <div class="row">
                   <div class="col-sm-12 col-xl-12 m-b-30">
                       <h4 class="sub-title">Description *</h4>
                       <textarea id="edit-tinymce" style="height: 283px;"  class="form-control edit_blog_description"
                       name="edit_blog_description" placeholder="Description" value=""></textarea>
                   </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-6 m-b-30">
                      <div class="row">
                        <div class="col-sm-12 col-xl-12 m-b-30">
                           <h4 class="sub-title">Date *</h4>
                           <input type="text" class="form-control date" id="edit_date" name="date" placeholder="Date" value="">
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-sm-12 col-xl-12 m-b-30">
                             <h4 class="sub-title">Abstract *</h4>
                             <textarea type="text" class="form-control blog_abstract" style="height: 250px;" name="blog_abstract" placeholder="Abstract" value="">
                             </textarea>
                         </div>
                       </div>
                    </div>
                    <div class="col-sm-6 col-xl-6 m-b-30">
                       <h4 class="sub-title">Image *</h4>
                       <div class="fileinput fileinput-new" data-provides="fileinput">
                           <div class="fileinput-new thumbnail"  data-trigger="fileinput">

                            <img src="{{asset('/front')}}/images/blogs/career.jpg" id="edit-blog-image">

                           </div>
                           <div class="fileinput-preview fileinput-exists thumbnail">
                           </div>
                           <div>
                             <span class="btn btn-file btn-block btn-primary btn-sm">
                               <span class="fileinput-new">Select Profile Image</span>
                               <span class="fileinput-exists">Change</span>
                               <input name="blog_image" accept="image/*" type="file">
                             </span>
                             <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                           </div>
                       </div>
                    </div>

                </div>
              </div>

              <div class="modal-footer">
               <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
               <button type="submit"  class="btn btn-primary waves-effect waves-light " id="saveBlog">Save changes</button>
              </div>
         </form>
        </div>
    </div>
</div>




<!-- end add modal -->
@endsection
@section('page_specific_js')
<!-- file input js -->
<script src="{{ asset('/admin_assets/bower_components/file-input/js/fileinput.js') }}"></script>
<!-- Datatable -->
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
<!-- Datepicker -->
<script src="{{ asset('/admin_assets/assets/js/jquery-ui.js') }}"></script>
<!-- wysiwyg editor -->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ihfid13c6c1ygvc66guxqmkllfkfjbgtewnm9komiqvsm6to"></script>

<!-- Page wise Javascript code -->
<script type="text/javascript">
$(document).ready(function () {
    // loading add our team modal
    var save_method, URI;
    $( ".blog-add-btn" ).on( "click", function() {
      save_method = 'add';
      $('.modal-title').text('Add New Media'); // Set Title to Bootstrap modal title
      $('#add-blog').modal('show');
    });




    // Fomvalidation setup blog page content
    $('#blog-form').on('init.field.fv', function(e, data) {
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
              'blog_title': {
                  validators: {
                      notEmpty: {
                          message: 'The title is required'
                      }
                  }
              },
              'blog_description': {
                  validators: {
                      notEmpty: {
                             message: 'The description is required'
                         },
                  }
              },
              'blog_abstract': {
                  validators: {
                      notEmpty: {
                             message: 'The abstract is required'
                         },
                  }
              }
          }
      }).on('success.form.fv', function(e) {
          // Prevent form submission
          e.preventDefault();
          if(save_method == 'add')
          {
              URI = "{{route('admin.cms.blog')}}";
          }

          // get the form input values
          result = new FormData($("#blog-form")[0]);

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
                   $('#add-blog').modal('hide');
                   if(save_method == "add")
                   {
                    setTimeout(function()
                      {
                              swal({
                                title: "Blog has been added to Quishi!",
                                text: "A  blog  has been added to Quishi",
                                type: "success",
                                closeOnConfirm: true,
                              }, function() {
                                  window.location = "{{route('admin.cms.blog')}}";
                              });
                    }, 1000);
                    $('#blog-form')[0].reset();
                    $('#blog-form').data('formValidation').resetForm(true);
                   }
              }
          },
          error:function(event)
          {
              console.log('Cannot add new blog into the quishi system. Please try again later on..');
          }

        });
      });



      // blog edit model pop up
      $( ".edit-blog" ).on( "click", function(e) {
          e.preventDefault();
          var blog_id = $(this).attr('data-blog-id');
          var blog_page_detail_id = $(this).attr('data-serialize-id');
          //alert(blog_page_detail_id);

          $.ajax({
              url:"{{url('')}}" + "/admin/cms/blog/editBlog/" + blog_id,
              type:"GET",
              dataType:"json",
              //data: {'edit_id':blog_id,'hidden_id':blog_page_detail_id},
              success:function(data){
                  //check for the success status only
                  if(data.status == "success"){
                      //insert the data in the modal

                      //alert(data.result.description);
                      $(".blog_id").val(blog_id);
                      $(".page_detail_id").val(blog_page_detail_id);
                      $(".blog_title").val(data.result.title);

                      var content = tinymce.activeEditor.setContent(data.result.content);
                      $("textarea#edit-tinymce").val(content);
                      //$(".edit_blog_description").val();

                      $("textarea#edit-tinymce").attr("value", data.result.content);


                      $(".blog_abstract").val(data.result.abstract);


                      // $(".facebook").val(data.result.facebook);
                      // $(".twitter").val(data.result.twitter);
                      // $(".instragram").val(data.result.instragram);
                      $(".date").val(data.published_date);

                      var image="{{asset('/front')}}/images/blogs" + "/" +data.result.image_path;
                      $("#edit-blog-image").attr('src',image);

                       $('#edit-blog').modal('show'); // show bootstrap modal
                       $('.modal-title').text('Update Media'); // Set Title to Bootstrap modal title
                      //console.log(data.result);
                  }

              },
              error:function(event){
                      console.log('Cannot get the particular team');
              }
          });

      });

      // updating blog content
      $('#edit-blog-form').on('init.field.fv', function(e, data) {
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
              'blog_title': {
                  validators: {
                      notEmpty: {
                          message: 'The title is required'
                      }
                  }
              },
              'edit_blog_description': {
                  validators: {
                      notEmpty: {
                             message: 'The description is required'
                         },
                  }
              },
              'blog_abstract': {
                  validators: {
                      notEmpty: {
                             message: 'The abstract is required'
                         },
                  }
              }
          }
      });
      $( "#saveBlog" ).on( "click", function(e) {
          // Prevent form submission
          e.preventDefault();
          tinymce.triggerSave();


          var blog_id  = $(".blog_id").val();

          //var team_update_id = $(this).attr('data-serialize-id');
          URI = "{{url('/admin/cms/blog/updateBlog')}}" +"/" +  blog_id;

          // get the form input values
          var result = new FormData($("#edit-blog-form")[0]);

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
                   $('#edit-blog').modal('hide');
                    setTimeout(function()
                      {
                              swal({
                                title: "Media has been updated to Quishi!",
                                text: "Media has been updated to Quishi",
                                type: "success",
                                closeOnConfirm: true,
                              }, function() {
                                  window.location = "{{route('admin.cms.blog')}}";
                              });
                    }, 1000);
                    $('#edit-blog-form')[0].reset();
                    $('#edit-blog-form').data('formValidation').resetForm(true);


              }
          },
          error:function(event)
          {
              console.log('Cannot add update media into the quishi system. Please try again later on..');
          }

        });
      });



      $( ".delete-blog" ).on( "click", function(e) {

        e.preventDefault();
        var delete_id             = $(this).attr('data-blog-id');
        var page_detail_delete_id = $(this).attr('data-serialize-id');
        //alert(hidden_id);
        var _token="{{csrf_token()}}";
        //show the alert notification
        swal({
            title: "Are you sure?",
            text: "You will not be able to your team!",
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
                    url:"{{url('/admin/cms/blog')}}" + "/" + delete_id,
                    type:"POST",
                    dataType:"Json",
                    data:{_token:_token,page_detail_delete_id:page_detail_delete_id,delete_id:delete_id},
                    success:function(data){
                        if(data.status == "success")
                        {
                          setTimeout(function() {
                            swal({
                              title: "Media  has been deleted from Quishi!",

                              type: "success",
                              closeOnConfirm: true,
                            }, function() {
                                window.location = "{{route('admin.cms.blog')}}";
                            });
                  }, 1000);

                        }
                        else
                        {
                          setTimeout(function() {
                            swal({
                              title: "Media has not been updated to Quishi!",

                              type: "success",
                              closeOnConfirm: true,
                            }, function() {
                                window.location = "{{route('admin.cms.blog')}}";
                            });
                  }, 1000);

                        }
                    }
                });
            }
            else {
                swal("Cancelled", "Your Blog is safe :)", "error");
            }
        });
      });

      //Datepicker
      $( "#select_date" ).datepicker({ dateFormat: 'M d, yy' });
      $( "#edit_date" ).datepicker({ dateFormat: 'M d, yy' });



      // installing wysiwyg editor
      tinymce.init({
        forced_root_block : "",
        selector: '#add-tinymce',
        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
         });
        },
        height: 300,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor textcolor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css']
      });
      tinymce.init({
        forced_root_block : "",
        selector: '#edit-tinymce',
        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
         });
        },
        height: 300,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor textcolor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css']
      });


});
</script>
@endsection