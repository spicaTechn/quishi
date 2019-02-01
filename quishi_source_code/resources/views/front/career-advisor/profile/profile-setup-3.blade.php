@extends('front.layout.master')
@section('title','Profile setup')
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>{{ ucwords(Auth::user()->name) }}, please answers the following questions so that new career seeker will get knowlege about your field</h3>
        <form method="post" action="{{route('complete.profile')}}" name="question_answer" id="question_answer">
            <div class="accordion profile_accordion" id="accordion">
            @csrf
            @foreach($user_questions as $user_question)
                @if($user_question['question_type'] == '1')
                <div class="card">
                     <input type="hidden" name="question_id[]{{$user_question['question_id']}}" value="{{$user_question['question_id'] }}"/>
                    <div class="card-header" id="heading{{$user_question['question_id']}}">
                        <h2 class="mb-0">
                            <button class="btn btn-link @if($user_question['question_type'] == '1') {{''}} @else {{'collapsed'}}@endif" type="button" data-toggle="collapse" data-target="#collapse{{$user_question['question_id']}}" aria-expanded="true" aria-controls="collapseOne">
                              {{ ucfirst($user_question['question_title']) }} {{ ($user_question['question_type'] == '1') ? '*' : ''}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{$user_question['question_id']}}" class="collapse  @if($user_question['question_type'] == '1') {{'show'}} @else {{''}}@endif" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                             <textarea class="form-control  @if($user_question['question_type'] == '1') {{'profile_question_answer'}} @endif" name="answer_id[]{{$user_question['question_id']}}" ></textarea>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @foreach($user_questions as $user_question)
                @if($user_question['question_type'] == '0')
                <div class="card">
                     <input type="hidden" name="question_id[]{{$user_question['question_id']}}" value="{{$user_question['question_id'] }}"/>
                    <div class="card-header" id="heading{{$user_question['question_id']}}">
                        <h2 class="mb-0">
                            <button class="btn btn-link @if($user_question['question_type'] == '1') {{''}} @else {{'collapsed'}}@endif" type="button" data-toggle="collapse" data-target="#collapse{{$user_question['question_id']}}" aria-expanded="true" aria-controls="collapseOne">
                              {{ ucfirst($user_question['question_title']) }} {{ ($user_question['question_type'] == '1') ? '*' : ''}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{$user_question['question_id']}}" class="collapse  @if($user_question['question_type'] == '1') {{'show'}} @else {{''}}@endif" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                             <textarea class="form-control  @if($user_question['question_type'] == '1') {{'profile_question_answer'}} @endif" name="answer_id[]{{$user_question['question_id']}}" {{($user_question['question_type'] == '1') ? 'required' : ''}}></textarea>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            </div><!--end of accordion profile_accordion-->
            <div class="row">
                <div class="col-lg-1">
                    <div class="text-left">
                        <button type="button" class="btn btn-default profile_setup_back_btn" id="profile_setup_back">Back</button>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="text-left">
                        <button type="submit" class="btn btn-default setup_profile" onSubmit="return checkQuestionAnswer()">Setup my profile</button>
                    </div>
                </div>
            </div> 
        </form>
    </div>
</div>
@endsection
@section('page_specific_js')
<script>
    $(document).ready(function(){
        $("#profile_setup_back").on('click',function(e){
            e.preventDefault();
            window.location.href = "{{URL::to('/profile/setup/step2/back')}}";
        });

        //form validation for the question answer to check for the 10 characters long and show the error message accordingly
        $('body').on('keyup','.profile_question_answer',function(e){
            if(($(this).val()).length < 10){
                $(this).parent('div.card-body').find('.invalid-feedback').remove();
                $(this).parent('div.card-body').hasClass('.invalid-feedback')
                var return_html ='<span class="invalid-feedback" role="alert"><strong>Answer should be 10 characters long</strong></span>';
                $(this).after(return_html);
                $('.setup_profile').prop('disabled',true);
            }else{
                $(this).parent('div.card-body').find('.invalid-feedback').remove();
                 $('.setup_profile').prop('disabled',false);
            }
            
        });

        $("#question_answer").on('submit',function(e){

            var question_answer = $('.profile_question_answer');
            var form_valid      = true;
            $.each(question_answer,function(index,value){
                if(($(this).val()).length == 0){
                   $(this).parent('div.card-body').find('.invalid-feedback').remove();
                   var return_html ='<span class="invalid-feedback" role="alert"><strong>This is a mandatory question. Please answer this question.</strong></span>';
                    $(this).after(return_html);
                    form_valid = false; 
                    $('.setup_profile').prop('disabled',true);
                }
            });
            return form_valid;
        });
    });

</script>
@endsection


