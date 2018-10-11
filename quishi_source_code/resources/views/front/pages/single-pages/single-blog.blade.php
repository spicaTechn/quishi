@extends('front.layout.master')
@section('content')
<div class="blog-single-pg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-single-det">
                    <div class="blog-single-top">
                        <span class="blog-cat">Housing</span>
                        <h1>{{ $blog->title }}</h1>
                        <p>{{ $blog_details['abstract'] }}</p>
                    </div>
                    <div class="blog-single-post clearfix">
                        @if($user = Auth::user())
                          @if($image = $user->user_profile()->where('user_id',$user->id)->select('image_path')->first())
                            <div class="post-img">
                                <img src="asset('/front/images/profile/'.$image)" alt="">
                            </div>
                          @else
                            <div class="post-img">
                               <img src="{{ asset('/front/images/profile/users.png') }}" >
                            </div>
                          @endif
                        @else
                        <div class="post-img">
                            <img src="{{ asset('/front/images/profile/users.png') }}">
                        </div>
                        @endif
                        <div class="post-date">
                            <ul>
                                <li>Published <b><?php echo abs(date('m')-(Carbon\Carbon::parse($blog_details['date'])->format('m'))); ?> months ago</b> on
                                    <time><b>{{ $blog_details['date'] }}</b></time>
                                </li>
                                <li>By: <a href="#" target="_blank">Source Nepal</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-single-img">
                        <img src="{{ asset('/front') }}/images/blogs/{{ $blog_details['image'] }} " alt="" style="">
                    </div>
                    <div class="single-bl-info">
                        <p>{{ $blog->content }}</p>

                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante adipiscing elit. Integer posuere erat a ante.</p>
                        </blockquote>
                    </div>
                    <div class="share-blog" style="display: block;">
                        <ul>
                            <li>Share this post</li>
                            <li><a href="#"><i class="icon-social-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="icon-social-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="icon-social-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="icon-social-google" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <!-- share this post -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection