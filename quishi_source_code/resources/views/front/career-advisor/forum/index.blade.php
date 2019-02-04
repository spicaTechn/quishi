@extends('front.career-advisor.layout.master')
@section('title','Forum')
@section('page_specific_css')
<style type="text/css">
a.new_forum_question_add{
	color: #5b980c;
}
.forum-question-list{
	margin-top:20px;
}
</style>
@endsection
@section('content')
<div class="profile-blog-page profile-main-section">
	<div class="forum-title-section">
		<h4>{{ __('Your Forum Question Lists') }}</h4>
	</div>
	<div class="forum-question-list">
        <ul>
        @if($questions->count() > 0)
          @foreach($questions as $question)

              <li>
                <div class="forum-question-image">
                  @if($question->user->user_profile['image_path'] && $question->type == 0)
                    <img src="{{ asset('/front/images/profile/'.$question->user->user_profile['image_path'])}}">
                  @else
                    <img src="{{asset('/front')}}/images/default-profile.jpg">
                  @endif
                </div>
                <div class="forum-question-content forum-main-like-view">
                    <div class="forum-question-content-title">
                        <a href="{{ URL::to('/forums').'/'. $question->id .'/'. $question->slug  }}"><h4>{{ $question->title }}</h4></a>
                          @if(($question->type == '0'))
                           <h6>By {{ $question->user->name }} <span> {{ ucwords($question->user->careers()->first()->title) .' - '.$question->user->user_profile->location }}</span> </h6>
                          @else
                           <h6>By {{ 'Ananymous' }}</h6>
                          @endif
                    </div>
                    @foreach($question->forum_question_answers()->where('parent','0')->orderBy('created_at','desc')->take(1)->get() as $answer)
                    <p>{{ $answer->content }}</p>
                    @endforeach
                    <div class="forum-like-comment-view ">
                        <ul>
                            <li><a href="javascript:void(0);" class="_total_answer_likes" data-forum-question-id="{{$question->id}}"><span class="like-numbers">{{quishi_convert_number_to_human_readable($question->like) }}</span> <i class="icon-like"></i> @if($question->like <= 1) {{ 'Like' }} @else {{ 'Likes'}} @endif</a></li>
                            <li><a href="{{ URL::to('/forums').'/'. $question->id .'/'. $question->slug  }}" class="go-to-comment"><span class="like_forum_question">{{quishi_convert_number_to_human_readable($question->forum_question_answers()->where('parent',0)->count()) }}</span> <i class="icon-bubble"></i> @if($question->forum_question_answers()->where('parent',0)->count() > 1) {{ 'Answers' }} @else {{ 'Answer' }}@endif</a></li>
                        </ul>
                    </div>
                </div>
                <div class="forum-question-replies">

                    <a href="{{ URL::to('/forums').'/'. $question->id .'/'.$question->slug }}">{{$question->forum_question_answers()->where('parent','0')->count()}} <span>@if($question->forum_question_answers()->where('parent',0)->count() > 1) {{ 'Answers' }} @else {{ 'Answer' }} @endif</span></a>

                </div>
            </li>
          @endforeach
        </ul>

    </div>
    <div class="row">
      <div class="col-md-6">
        @if(\Request::has('forum_question_title'))
            {{ $questions->appends(array('forum_question_title'=>\Request::get('forum_question_title')))->links() }}
        @else
            {{ $questions->links() }}
        @endif

      </div>
    </div>

    @else
      <div class="_no_result_found">
        <p>No question were posted by you in Quishi Forum yet, <a href="{{url('/forums') }}" class="new_forum_question_add">add new question</a></p>
      </div>
    @endif
</div>
<!-- profile-main-section -->
</div>
</div>
@endsection
@section('page_specific_js')
<script>
	$(window).load(function(){
		 //like the question when user click on the like icon
      $('body').on('click','._total_answer_likes',function(e){
        //prevent default action
        var current_click   = $(this);
        var forum_question_id = $(this).data('forum-question-id');
        var _token            = "{{csrf_token()}}";
        //make the post request
        $.post("{{route('forums.questions.like')}}",{forum_question_id : forum_question_id , _token : _token},function(data){
          if(data.status == "success"){
            if(data.total_like <= 1){
              $(current_click).html('<span class="like-numbers">' + data.total_like + '</span> <i class="icon-like"></i> Like');
            }else{
                $(current_click).html('<span class="like-numbers">' + data.total_like + '</span> <i class="icon-like"></i> Likes');
            }
          }
        });
      });
	});
</script>
@endsection