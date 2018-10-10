@extends('front.layout.master')
@section('content')
@section('page_specific_css')
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
@endsection
<div class="forum-section">
 <div class="container">
    <div class="forum-title-section">
        <div class="row">
            <div class="col-md-6">
                <div class="forum-title-bar">
                    <h4>Questions</h4>
                    <ul>
                        <li class="active">Recent</li>
                        <li>Popular</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="forum-search-bar">
                    <div class="search-form">
                        <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                        <input name="search-form" class="form-control" type="text" placeholder="Type and enter">
                    </div>
                    <div class="new-questions"><a href="javascript:void(0);" class="btn btn-default" id="show-qusetion-modal">new questions</a></div>
                    <div class="modal fade" id="add-new-question-modal">
                        <div class="modal-dialog" role="document">
                            <form  name="save-question" id="save-question">
                            	@csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Question</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="user-question-adds">
                                            <a href="#"><img src="images/blog1.jpg">Laxman Tako </a>added
                                        </div>
                                        <div class="user-Anonymous-question-adds">
                                            <img src="images/blog1.jpg">Anonymous asks
                                        </div>
                                        <div class="form-group" style="display: none;" id="anonymous_question">
                                          <input type="email" name="ask-anonymous" placeholder="Email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="question" class="form-control" rows="1" placeholder="Start your question with &quot;What&quot;, &quot;How&quot;, &quot;Why&quot;, etc."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="btn" id="cancel" data-dismiss="modal">Cancel</span>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="add-anomynouse-question" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1" id="anonymous-user">Add Anonymously</label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Add Question</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- forum-title-section" -->
    <div class="forum-question-list">
        <ul>
          @foreach($questions as $question)

              <li>
                <div class="forum-question-image">
                  @if($question->user->user_profile['image_path'])
                    <img src="{{ asset('/front/images/profile/'.$question->user->user_profile['image_path'])}}">
                  @else
                    <img src="{{ asset('/front/images/profile/user.png') }}">
                  @endif
                </div>
                <div class="forum-question-content">
                    <div class="forum-question-content-title">
                        <a href="{{ URL::to('/forums').'/'. $question->id  }}"><h4>{{ $question->title }}</h4></a>
                          @if(($question->user->logged_in_type == '0') || ($question->user->logged_in_type == '1'))
                           <h6>By {{ $question->user->name }}   about 1 hour ago</h6>
                          @else
                           <h6>By {{ $question->user->name }}  about 1 hour ago</h6>
                          @endif
                    </div>
                    @foreach($question->forum_question_answers()->where('parent','0')->orderBy('created_at','desc')->take(1)->get() as $answer)
                    <p>{{ $answer->content }}</p>
                    @endforeach
                </div>
                <div class="forum-question-replies">

                    <a href="{{ URL::to('/forums').'/'. $question->id  }}">{{$question->forum_question_answers()->where('parent','0')->count()}} <span>Replies</span></a>

                </div>
            </li>
          @endforeach
        </ul>

    </div>
    <div class="row">
      <div class="col-md-6">
        {{ $questions->links() }}
      </div>
    </div>
 </div>
</div>
@endsection
@section('page_specific_js')
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>


<script type="text/javascript">
$(document).ready(function () {
	// question add model pop up
	  $( "#show-qusetion-modal" ).on( "click", function() {
      $('.modal-title').text('Add New Question'); // Set Title to Bootstrap modal title
      $('#add-new-question-modal').modal('show');
    });

    //show input field if Add Anonymously check
    $('input[name="add-anomynouse-question"]').on('click', function () {
      if ( $(this).prop('checked') ) {
          $('#anonymous_question').toggle( "slow" );
      }
      else {
          $('#anonymous_question').toggle( "hide" );
      }

    });


	$('#save-question').on('init.field.fv', function(e, data) {
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
              'question': {
                  validators: {
                      notEmpty: {
                          message: 'The question is required'
                      }
                  }
              }
          }
      })
      .on('success.form.fv', function(e) {
          // Prevent form submission
          e.preventDefault();
          //alert("success");
          var URI = "{{route('forum.store')}}";


          // get the form input values
          var result = new FormData($("#save-question")[0]);

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
               $('#add-new-question-modal').modal('hide');
                setTimeout(function()
                  {
                  swal({
                    title: "Question has been added to Quishi!",
                    text: "A  question  has been added to Quishi",
                    type: "success",
                    closeOnConfirm: true,
                  }, function() {
                      window.location = "{{route('forum')}}";
                  });
                }, 1000);
                $('#save-question')[0].reset();
                $('#save-question').data('formValidation').resetForm(true);

          	}
          },
          error:function(event)
          {
              console.log('Cannot add new blog into the quishi system. Please try again later on..');
          }

        });
      });
});
</script>
@endsection