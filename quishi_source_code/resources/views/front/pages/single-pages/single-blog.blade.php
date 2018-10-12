@extends('front.layout.master')
@section('content')
<div class="blog-single-pg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-single-det">
                    <div class="blog-single-top">
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
                            @if(!empty($blog->user->user_profile->image_path))
                                <img src="{{asset('front/images/profile') .'/'. $blog->user->user_profile->image_path}}" alt="">
                            @else
                                <img src="{{asset('front/images/1536744763.png')}}" alt="">
                            @endif
                        </div>
                        @endif
                        <div class="post-date">
                            <ul>
                                <li>Published on
                                    <time><b>{{ Carbon\Carbon::parse($blog_details['date'])->format('d M Y') }}</b></time>
                                </li>
                                <li>By: <a href="#" target="_blank">{{ucwords($blog->user->name)}}</a></li>
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

                        <ul>
                            <li class="blog-page-like"><i class="icon-like"></i> <span class="current_like">{{$blog->total_likes}}</span> {{($blog->total_likes > 1) ? 'Likes' : 'Like' }}</li>
                        </ul>
                    </div>

                    <!-- share this post -->
                    <div class="blog_comment_section">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_specific_js')
 <script>
    $(document).ready(function(){
        $('.blog-page-like').on('click', function(e){
            //prevent the default action
            e.preventDefault();
            var current_click = $(this);
            var current_like = $(this).find('span.current_like').html();
            $.post("{{route('page_like')}}",{_token: "{{csrf_token()}}",page_id: "{{$blog->id}}"},function(data){
                if(data.status == "success"){
                    $(current_click).find('span.current_like').html(data.result);
                }
            });
        });
    });
 </script>
@endsection