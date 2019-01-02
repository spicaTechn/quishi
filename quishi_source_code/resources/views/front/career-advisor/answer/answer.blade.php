@extends('front.career-advisor.layout.master')
@section('title','Public profile question answers')
@section('content')

                <div class="profile-main-section">
                    @foreach($current_user_answers as $current_user_answer)
                    <div class="profile-question-answer-section">
                        <div class="profile-admin-review-section same-height">
                            <div class="profile-admin-review-title">
                                <h6>{{ucfirst($current_user_answer->question->title)}}</h6>
                            </div>
                            <div class="profile-admin-review-answer" id="user_answer_{{$current_user_answer ->id}}">
                                <p>{{$current_user_answer->content}}</p>
                            </div>
                            <!-- to do is to get the comments count on the individual answer -->
                            <div class="find-helpful">
                                <p><i class="icon-like"></i> {{$current_user_answer->total_likes}} people find this answer helpful.</p>
                            </div>
                        </div>
                        <div class="question-editable-icon same-height">
                            <a id="question-edit-link" data-toggle="tooltip"  class="question-edit-link edit-answer" data-placement="top" title="" data-original-title="Edit Link" data-answer-id="{{$current_user_answer->id}}" >
                                <i class="icon-pencil"></i>
                            </a>
                             <a class="question-remove-link eye-on {{($current_user_answer->status == '1') ? '' : 'eye-close'}}"  data-toggle="tooltip" data-placement="top" title="" data-original-title="{{($current_user_answer->status == '1') ? 'Hide Answer for career seeker' : 'Show Answer for career seeker' }}" data-answer-id="{{$current_user_answer->id}}">
                                <i class="icon-eye"></i>
                            </a>
                        </div>
                    </div>
                    <!-- profile-first-section -->
                @endforeach
                </div>
                <!-- profile-main-section -->
            </div>
        </div>
        <div class="modal modal-quishi modal-answer fade" id="editanswer modal-quishi" tabindex="-1" role="dialog" aria-labelledby="editanswerLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editanswerLabel">Edit your answer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="answer_id" value="" id="answer_id" />
                        <form>
                            <div class="form-group">
                                <label disabled class="question">Here is a Question</label>
                                <!-- <input type="text" name="" disabled=""> -->
                            </div>
                            <div class="form-group">
                                <textarea class="form-control user_question_answer" name="user_answer" placeholder="Edit Your Answer" rows="9"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default save-answer-btn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('page_specific_js')
    <script>
        $(window).ready(function(){
            $(".question-remove-link").on('click',function(e){
                e.preventDefault();
                var current_user_answer_id    = $(this).attr('data-answer-id');
                var current_user_question_id  = $(this).attr('data-question-id');
                //make the ajax request to delete the specific users answer resources
                var url                       = "{{URL::to('/profile/answers')}}" + "/" + current_user_answer_id;
                makeAjaxRequest(url,request_type="DELETE",current_user_question_id,current_user_answer_id);
            });


            $(".question-edit-link").on('click',function(e){
                e.preventDefault();

                var current_user_answer_id    = $(this).attr('data-answer-id');
                var current_user_question_id  = $(this).attr('data-question-id');
                //make the ajax request to delete the specific users answer resources
                var url                       = "{{URL::to('/profile/answers')}}" + "/" + current_user_answer_id;

                //make the ajax request
                makeAjaxRequest(url,request_type="GET",current_user_question_id,current_user_answer_id);
            });

            function makeAjaxRequest(url,reqeust_type,current_user_question_id,current_user_answer_id){
                $.ajax({
                    'url'       : url ,
                    'type'      : request_type,
                    'dataType'  : 'JSON',   
                    'data'      : {
                        'current_user_question_id'  : current_user_question_id,
                        'current_user_answer_id'    : current_user_answer_id,
                        '_token'                    : "{{csrf_token()}}"
                    },
                    success     : function(data){

                    },
                    error       : function(){

                    }

                });
            }


            //edit answer

            $(".edit-answer").on('click',function(e){
                //firs the user answer details 
                var answer_id = $(this).attr('data-answer-id');
                //get the answer details
                $.get("{{URL::to('/profile/answers/show')}}" + "/" + answer_id,function(data){
                    if(data.status == "success"){
                        //now show the modal 
                        $('.question').html(data.question);
                        $('#answer_id').val(data.result.id);
                        $('.user_question_answer').html(data.result.content);
                        $('.modal-answer').modal('show');
                    }
                });
                
            });


            //update the user profile
            $('.save-answer-btn').on('click',function(e){
                e.preventDefault();

                var answer_id = $("#answer_id").val();
                var data      = {
                        'answer_id'            : answer_id,
                        'answer_content'       : $('.user_question_answer').val(),
                        '_token'               : "{{csrf_token()}}"
                };

                $.post("{{URL::to('/profile/answers')}}" + "/" + answer_id,data,function(data){
                    if(data.status == "success"){
                        //hide the modal 
                        $('.modal-answer').modal('hide');
                        //load the new answer in the user answer
                        $("#user_answer_" + answer_id).html('<p>' + $('.user_question_answer').val() + '</p>');
                        
                        //sweet alert message
                        swal({
                            title           : "Answer has been updated!!",
                            text            : "Your answer to the question has been updated successfully !!",
                            type            : 'success',
                            closeOnConfirm  : true, 

                        });
                    }
                });
            });

            //hide or show the answer on the frontend of the career advisior
            $('.question-remove-link').on('click',function(e){
                  //prevent the default action
                  e.preventDefault();
                  var click_answer = $(this);
                  var answer_id    = $(this).attr('data-answer-id');
                  var data         = {
                                        '_token' : "{{csrf_token()}}",
                                        'type'   : '1'
                  };
                  //make the request to the server
                  $.post("{{URL::to('/profile/answers')}}" + "/" + answer_id,data,function(data){
                            if(data.status == "success"){
                               swal({
                                title           : "Answer status has been updated!!",
                                text            : data.message,
                                type            : 'success',
                                closeOnConfirm  : true, 

                            }); 

                            //toggle the class
                            $(click_answer).toggleClass('eye-close');
                        }
                  });
                  
            });
        });
    </script>
@endsection