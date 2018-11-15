@extends('front.career-advisor.layout.master')

@section('content')
<div class="profile-blog-edit-page profile-main-section">
	<form>
	<div class="editable-title">
		<h2>According to the culture</h2>
	</div>
	<div class="editable-content">
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<div class="abstract">
		hello there, I am the abstract
	</div>
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
</form>

</div>
<!-- profile-main-section -->
</div>
</div>
@endsection
@section('page_specific_js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
    	
        
    </script>
@endsection