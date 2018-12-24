@extends('front.layout.master')
@section('content')
@section('page_specific_css')
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">
@endsection
<div class="forum-comment-section">
    <div class="container">
        <div class="forum-title-section forum-comment-title-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="forum-title-bar">
                        <h4>New year new begenning...</h4>
                        <div class="time">1 hour ago</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="forum-share-bar">
                        <div class="product-share">
                            <div class="sh-title"> <i class="icon-share"></i> Share</div>
                            <div class="show-on-share social-share">
                                <ul>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-google" aria-hidden="true"></i>
                                        </a>
                                    </li>

                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- forum-comment-title-section" -->
        <div class="forum-comment-description">
            <div class="clearfix">
                <div class="forum-image-left">
                  @if($question->user->user_profile['image_path'])
                    <img src="{{ asset('/front/images/profile/'.$question->user->user_profile['image_path'])}}">
                  @else
                    <img src="{{ asset('/front/images/profile/user.png') }}">
                  @endif
                </div>
                <div class="forum-content-right">

                    @if(($question->user->logged_in_type == '0') || ($question->user->logged_in_type == '1'))
                           <h5>By {{ $question->user->name }}   about 1 hour ago</h5>
                          @else
                           <h5>By {{ $question->user->name }}   about 1 hour ago</h5>
                          @endif
                    <p>{{ $question->title }}</p>

                    <div class="btn btn-outline-secondary">Reply</div>
                    <div class="profile-leave-comment" style="display: none;">

                        <h4>Reply answer</h4>
                        <!-- for logdin user -->
                        <form name="reply-form" id="reply-form">
                            @csrf
                            <input type="hidden" class="question_id" name="question_id" id="question_id" value="{{ $question->id }}">
                            <input type="hidden" class="user_id" name="user_id" id="user_id" value="{{ $question->user_id }}">
                            <div class="profile-reply-form">
                                <div class="reply-user-image">
                                    @if($id = Auth::id())
                                      <?php $image = $question->user->user_profile()->where('id',$id)->first(); ?>
                                      @if($image)
                                        <img src="{{ asset('/front/images/profile/'.$question->user->user_profile['image_path'])}}">
                                      @else
                                        <img src="{{ asset('/front/images/profile/user.png') }}">
                                      @endif
                                    @else
                                      <img src="{{ asset('/front/images/profile/user.png') }}">
                                    @endif
                                </div>
                                <div class="reply-coment-box">
                                    <div class="comment-method">
                                        <ul>
                                          @if(Auth::id())
                                          <li><a href="#">{{ Auth::user()->name }}</a></li>
                                          @else
                                          <li><a href="{{asset('/login')}}">Login</a></li>
                                          @endif
                                          <li>
                                            <a>
                                              <input type="checkbox" name="post-anonymously" id="check-for-login">
                                              <label for="check-for-login">Reply Anonymously</label>
                                            </a>
                                          </li>
                                        </ul>
                                    </div>
                                    <div class="form-group anonymously-user">
                                        <input type="email" name="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Your Message Here !" name="answer"></textarea>
                                    </div>
                                    <button type="submit" id="saveLoggedin" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
             <!-- end comment reply -->
            @foreach($question->forum_question_answers()->where('parent','0')->get() as $answer)
            <div class="media-block">
                <div class="media">
                    @if($answer->user->user_profile['image_path'])
                      <img class="mr-3" src="{{ asset('/front/images/profile/'.$answer->user->user_profile['image_path'])}}">
                    @else
                      <img class="mr-3" src="{{ asset('/front/images/profile/user.png') }}">
                    @endif
                    <div class="media-body reply-to" id="reply-to">
                        @if(($answer->user->logged_in_type == '0') || ($answer->user->logged_in_type == '1'))
                           <h5 class="mt-0">By {{ $answer->user->name }}   about 1 hour ago</h5>
                          @else
                           <h5 class="mt-0">By {{ $answer->user->name }}   about 1 hour ago</h5>
                          @endif
                        <p>{{ $answer->content }}</p>
                      <a href="javascript:void(0);" class="reply-to-answer" data-answer-id = "{{ $answer->id }}"><i class="icon-action-undo"></i> Reply</a>



                        <!-- for logdin user -->
                       <form  name="reply-answer-form"  class="reply-answer-form" id="reply-answer-form" style="display: none;">
                        @csrf
                        <input type="hidden" class="question_id" name="question_id" id="question_id" value="{{ $answer->forum_question_id }}">
                        <input type="hidden" class="answer_id" name="answer_id" id="answer_id" value="{{ $answer->id }}">

                            <div class="profile-reply-form forum-reply-form">
                                <div class="reply-user-image">
                                    @if($id = Auth::id())
                                      <?php $image = $question->user->user_profile()->where('id',$id)->first(); ?>
                                      @if($image)
                                        <img src="{{ asset('/front/images/profile/'.$question->user->user_profile['image_path'])}}">
                                      @else
                                        <img src="{{ asset('/front/images/profile/user.png') }}">
                                      @endif
                                    @else
                                      <img src="{{ asset('/front/images/profile/user.png') }}">
                                    @endif
                                </div>
                                <div class="reply-coment-box">
                                    <div class="comment-method">
                                        <ul>

                                           @if(Auth::id())
                                          <li><a href="#">{{ Auth::user()->name }}</a></li>
                                          @else
                                          <li><a href="{{asset('/login')}}">Login</a></li>
                                          @endif
                                            <li>
                                              <a>
                                                <input type="checkbox" name="reply_answer_anonymously" id="check-for-login">
                                                <label for="check-for-login">Reply Anonymously</label>
                                              </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group anonymously-user">
                                        <input type="email" name="reply_answer_email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                     <textarea class="form-control" placeholder="Your Message Here !" name="reply_answer_answer" required></textarea>
                                    </div>
                                    <button  id="saveAnswerReply" class="btn btn-default saveAnswerReply">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                        @foreach($answer->children as $child_answer)

                        <div class="media-block">
                          <div class="media">
                              @if($child_answer->user->user_profile['image_path'])
                                <img class="mr-3" src="{{ asset('/front/images/profile/'.$child_answer->user->user_profile['image_path'])}}">
                              @else
                                <img class="mr-3" src="{{ asset('/front/images/profile/user.png') }}">
                              @endif
                              <div class="media-body reply-to" id="reply-to">
                                  @if(($child_answer->user->logged_in_type == '0') || ($child_answer->user->logged_in_type == '1'))
                                     <h5 class="mt-0">By {{ $child_answer->user->name }}   about 1 hour ago</h5>
                                    @else
                                     <h5 class="mt-0">By {{ $child_answer->user->name }}   about 1 hour ago</h5>
                                    @endif
                                  <p>{{ $child_answer->content }}</p>
                              </div>
                          </div>
                        </div>
                        @endforeach
                    <div class="reply-form" style="display: none;">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="button">
                                    <i class="icon-cursor"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                  </div>
                </div>
            </div>
            @endforeach

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
     // show answer field when click reply button
    $( ".btn-outline-secondary" ).click( function() {
      $('#reply-form')[0].reset();
      $('#reply-form').data('formValidation').resetForm(true);
      $( ".profile-leave-comment" ).toggle( 'slow' );
    });

    $( ".reply-to-answer" ).click( function(e) {
        // var answer_id = $('.reply-to-answer').attr('data-answer-id');
        //   alert(answer_id);
      var parent_div = $(this).parent('div.reply-to').find('.reply-answer-form');

      parent_div.toggle('slow');
    });

    // from validation for reply answer logged in user
    $('#reply-form').on('init.field.fv', function(e, data) {
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
              'answer': {
                  validators: {
                      notEmpty: {
                          message: 'The answer  is required'
                      }
                  }
              }
          }
    })
    .on('success.form.fv', function(e) {
          // Prevent form submission
          e.preventDefault();
          //alert("success");
          // get the form input value
          var result = new FormData($("#reply-form")[0]);

          $.ajax({
          //make the ajax request to either add or update the
          url:"{{url('')}}" + "/forums/answer",
          data:result,
          dataType:"Json",
          contentType: false,
          processData: false,
          type:"POST",
          success:function(data)
          {
            if(data.status == "success"){
              //hide the modal
               //$('#add-new-question-modal').modal('hide');
                setTimeout(function()
                  {
                  swal({
                    title: "Answer has been added to Question!",
                    text: "A  answer  has been added to Question",
                    type: "success",
                    closeOnConfirm: true,
                  }, function() {
                      window.location.reload();
                  });
                }, 1000);
                $('#reply-form')[0].reset();
                $('#reply-form').data('formValidation').resetForm(true);

            }
          },
          error:function(event)
          {
              console.log('Cannot reply answer  to the question . Please try again later on..');
          }

        });
    });

    // saving reply to answer reply-anonymously
    $(".saveAnswerReply").click( function(e) {
          //alert("click");
          //Prevent form submission
          e.preventDefault();

          //var id =$(this).parent('div.reply-to').find('.reply-to-answer');

          //var answer_id = $('.reply-to-answer').attr('data-answer-id');
          //alert(answer_id);\
          var form = $(this).parents('form.reply-answer-form');
          var data = new FormData($(form)[0]);
          //alert(data);
          $.ajax({
          //make the ajax request to either add or update the
          url:"{{url('')}}" + "/forums/answer/reply",
          data:data,
          dataType:"Json",
          contentType: false,
          processData: false,
          type:"POST",
          success:function(data)
          {
            if(data.status == "success"){
              //hide the modal
               //$('#add-new-question-modal').modal('hide');
                setTimeout(function()
                  {
                  swal({
                    title: "Reply has been added to Answer!",
                    text: "A  reply  has been added to Answer",
                    type: "success",
                    closeOnConfirm: true,
                  }, function() {
                      window.location.reload();
                  });
                }, 1000);
                $('.reply-answer-form')[0].reset();
                $('.reply-answer-form').data('formValidation').resetForm(true);

            }
          },
          error:function(event)
          {
              console.log('Cannot reply answer to the quesiton . Please try again later on..');
          }

        });
    });



});
</script>
@endsection