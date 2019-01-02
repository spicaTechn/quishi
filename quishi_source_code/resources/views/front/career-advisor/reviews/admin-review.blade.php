@extends('front.career-advisor.layout.master')
@section('title','Admin reviews')
@section('content')
                <div class="profile-main-section">
                    @foreach($reviews as $review)
                    <div class="profile-admin-review-section">
                        <div class="profile-admin-review-answer">
                            <p>{{$review->content}}</p>
                        </div>
                    </div>
                    <!-- profile-first-section -->

                    @endforeach
                </div>
                <!-- profile-main-section -->
            </div>
        </div>
@endsection