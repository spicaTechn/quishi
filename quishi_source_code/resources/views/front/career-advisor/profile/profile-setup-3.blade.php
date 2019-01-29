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

            <div class="accordion profile_accordion" id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      I am the six questionto be added in the section? *
                    </button>
                  </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <textarea class="form-control"  required=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      I am the six questionto be added in the section? *
                    </button>
                  </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                           <textarea class="form-control"  required=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      I am the six questionto be added in the section? *
                    </button>
                  </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <textarea class="form-control"  required=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1">
                    <div class="text-left">
                        <button type="button" class="btn btn-default profile_setup_back_btn" id="profile_setup_back">Back</button>
                    </div>
                </div>

                <div class="col-lg-3">
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


