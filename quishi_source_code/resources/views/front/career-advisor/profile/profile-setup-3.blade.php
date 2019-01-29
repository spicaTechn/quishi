@extends('front.layout.master')
@section('title','Profile setup')
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>{{ ucwords(Auth::user()->name) }}, please answers the following questions so that new career seeker will get knowlege about your field</h3>
        <form method="post" action="{{route('complete.profile')}}">
            @csrf
            @foreach($user_questions as $user_question)
                <div class="form-group">
                    <label>{{ ucfirst($user_question['question_title']) }} {{ ($user_question['question_type'] == '1') ? '*' : ''}}</label>
                    <input type="hidden" name="question_id[]{{$user_question['question_id']}}" value="{{$user_question['question_id'] }}"/>
                    <textarea class="form-control" name="answer_id[]{{$user_question['question_id']}}" {{($user_question['question_type'] == '1') ? 'required' : ''}}></textarea>
                </div>
            @endforeach
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-left">
                        <button type="button" class="btn btn-default" id="profile_setup_back">Back</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-left">
                        <button type="submit" class="btn btn-default">Setup my profile</button>
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
    });

</script>
@endsection


