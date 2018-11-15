@extends('front.career-advisor.layout.master')

@section('content')
<div class="profile-blog-edit-page profile-main-section">
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
		    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		</div>
	</div>

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
    	
        
    </script>
@endsection