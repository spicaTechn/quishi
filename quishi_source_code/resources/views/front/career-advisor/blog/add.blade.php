@extends('front.career-advisor.layout.master')

@section('content')
<div class="profile-blog-edit-page profile-main-section">
	<form>
		<div class="row">
		<div class="col-md-8 col-lg-6">
			<div class="editable-title">
				<h5>Title</h5>
				<div class="form-group">
					<input class="form-control" placeholder="According to the culture">
				</div>
			</div>
			<div class="editable-content">
				<h5>Description</h5>
				<textarea class="text-editor"></textarea>
			</div>

			<div class="abstract">
				<h5>Abstract</h5>
				<textarea class="form-control" placeholder="hello there, I am the abstract"></textarea>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
				
				<div class="published-date">
					<label>Published Date: </label>
					<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
					    <input class="form-control" type="text" readonly />
					    <span class="input-group-addon"><i class="icon-calendar"></i></span>
					</div>
				</div>
				<div class="featured-image">
					<h5>Featured Image</h5>

					<div class="avatar-upload">
			        <div class="avatar-edit">
			            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
			            <label for="imageUpload"></label>
			        </div>
			        <div class="avatar-preview">
			            <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
			            </div>
			        </div>
			    </div>
				</div>
				<div class="form-group">
					<button class="btn btn-default">Update</button>
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
    	
        
    </script>
@endsection