@extends('front.career-advisor.layout.master')
@section('title','Admin reviews')
@section('content')
                <div class="profile-main-section">
                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                        <div class="profile-admin-review-section">
                            <div class="profile-admin-review-answer">
                                <p>{{$review->content}}</p>
                            </div>
                        </div>
                        <!-- profile-first-section -->

                        @endforeach
                    @else
                     <div class="no_review">
                        <h4>You have no reviews</h4>
                        <p>You got no reviews from Quishi.</p>
                     </div>
                    @endif
                </div>
                <!-- profile-main-section -->
            </div>
        </div>
@endsection