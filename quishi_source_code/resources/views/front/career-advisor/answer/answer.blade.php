@extends('front.career-advisor.layout.master')
@section('content')

                <div class="profile-main-section">
                    @foreach($current_user_answers as $current_user_answer)
                    <div class="profile-question-answer-section">
                        <div class="profile-admin-review-section same-height">
                            <div class="profile-admin-review-title">
                                <h6>{{ucfirst($current_user_answer->question->title)}}</h6>
                            </div>
                            <div class="profile-admin-review-answer">
                                <p>{{$current_user_answer->content}}</p>
                            </div>
                            <!-- to do is to get the comments count on the individual answer -->
                            <div class="find-helpful">
                                <p><i class="icon-like"></i> {{$current_user_answer->total_likes}} people find this answer helpful.</p>
                            </div>
                        </div>
                        <div class="question-editable-icon same-height">
                            <a id="question-edit-link" data-toggle="tooltip"  class="question-edit-link" data-placement="top" title="" data-original-title="Edit Link" data-answer-id="{{$current_user_answer->id}}">
                                <i class="icon-pencil"></i>
                            </a>
                            <a id="question-remove-link" class="question-remove-link" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Link" data-answer-id="{{$current_user_answer->id}}">
                                @if($current_user_answer->status == '1')
                                    <i class="icon-hide"></i>
                                @else
                                    <i class="icon-eye-close"></i>
                                @endif
                                
                            </a>
                        </div>
                    </div>
                    <!-- profile-first-section -->
                @endforeach
                </div>
                <!-- profile-main-section -->
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
        });
    </script>
@endsection