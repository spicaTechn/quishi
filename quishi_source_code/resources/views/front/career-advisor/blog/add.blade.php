@extends('front.career-advisor.layout.master')
@section('title','Add New Blog')
@section('content')
<div class="profile-blog-edit-page profile-main-section">
	<form action="{{route('profile.blog.store')}}" method="POST" id="add-new-blog" class="add-new-blog" name="add-new-blog" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="row">
		<div class="col-md-8 col-lg-6">
			<div class="editable-title">
				<h5>Title</h5>
				<div class="form-group">
					<input class="form-control" placeholder="According to the culture" name="blog_title">
				</div>
			</div>
			<div class="editable-content">
				<h5>Description</h5>
				<textarea class="text-editor input-reset ba b--black-20 pa2 mb2 db w-100" name="blog_description" style = " height:250px;" id="blog_description"></textarea>
			</div>

			<div class="abstract">
				<h5>Abstract</h5>
				<textarea class="form-control" placeholder="hello there, I am the abstract" name="blog_abstract"></textarea>
				
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
				
				<div class="published-date">
					<label>Published Date: </label>
					<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
					    <input class="form-control" name="_blog_published_date" type="text" readonly />
					    <span class="input-group-addon"><i class="icon-calendar"></i></span>
					</div>
				</div>
				<div class="featured-image">
					<h5>Featured Image</h5>

					<div class="avatar-upload">
			        <div class="avatar-edit">
			            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="_featured_image" />
			            <label for="imageUpload"></label>
			        </div>
			        <div class="avatar-preview">
			            <div id="imagePreview" style="background-image: url({{asset('/front')}}/images/default-home-blog.jpg);">
			            </div>
			        </div>
			    </div>
				</div>
				<div class="form-group">
					<button class="btn btn-default" type="submit">Create</button>
				</div>
		</div>
	
</div>
	
</form>

</div>
<!-- profile-main-section -->
</div>
</div>
@endsection
@section('page_specific_js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc"></script>
    <script>

		$(function () {
			$("#datepicker").datepicker({ 
				autoclose: true, 
				format  : 'yyyy-mm-dd',
				todayHighlight: true
			}).datepicker('update', new Date());
		});

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
		            $('#imagePreview').hide();
		            $('#imagePreview').fadeIn(650);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imageUpload").change(function() {
		    readURL(this);
		});

		//tinymce
		tinymce.init({
		  selector: 'textarea.text-editor',
		  height: 400,
		  menubar: true,
		  setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
	            });
	        },
		  plugins: [
		    'fullpage advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks advcode fullscreen',
		    'insertdatetime media table contextmenu'
		  ],
		  toolbar: 'code fullpage',
		  content_css: [
		    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    '//www.tinymce.com/css/codepen.min.css']
		});



		//add the form validation here to validate the field
    	 $('#add-new-blog').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            excluded: 'disabled',
            fields: {
                'blog_title': {
                    validators: {
                        notEmpty: {
                            message: 'The blog title is required'
                        }
                    }
                },
                'blog_description':{
                	validators:{
                		notEmpty:{
                			message: 'Blog Description is required'
                		}
                	}
                },
                'blog_abstract':{
                	validators:{
                		notEmpty:{
                			message:'Blog abstract is required field'
                			
                		}
                	}
                },
                
                '_blog_published_date': {
                    validators: {
                        notEmpty: {
                            message: 'The blog published date is required'
                        }
                    }
                },
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $('#add-new-blog')[0].submit();
        });



		        
    </script>
@endsection