@extends('front.layout.master')
@section('content')
<div class="blog-page">
    <div class="container">
        <div class="blog-main-body">
            <div class="row isotopeContainer2">
            	@foreach($blogs as $blog)
            	 @foreach($blog->page_detail as $blog_details)
            	 <?php
            	 	$blog_details_unserialize = unserialize($blog_details->meta_value);
            	 	$date = $blog_details_unserialize['date'];
            	 	 //echo "<pre>"; print_r($date); echo "</pre>";exit;

            	 ?>
	                <div class="col-md-4 isotopeSelector">
	                    <div class="blog-category-section">
	                        <div class="blog-image">
	                            <a href="{{ url('/blog').'/'.$blog->id }}"><img src="{{ asset('/front')}}/images/blogs/{{$blog_details_unserialize['image']}}" alt="#"></a>
	                            <div class="blog-date">
	                                {{ Carbon\Carbon::parse($date)->format('d') }}<span>{{ Carbon\Carbon::parse($date)->format('M') }}</span>
	                            </div>
	                        </div>
	                        <div class="blog-content">
	                            <h3><a href="{{ url('/blog').'/'.$blog->id }}">{{ $blog->title }}</a></h3>
	                            <div class="blog-author-category">
	                                <ul>
	                                    <li><a href="#"><i class="icon-user" aria-hidden="true"></i>author</a></li>
	                                    <li><a href="#"><i class="icon-tag" aria-hidden="true"></i>category</a></li>
	                                    <li><a href="#"><i class="icon-bubbles" aria-hidden="true"></i>comments</a></li>
	                                </ul>
	                            </div>
	                            <p>{{ str_limit($blog->content,130) }}</p>
	                            <a href="{{ url('/blog').'/'.$blog->id }}" class="blog-read-more">read more</a>
	                        </div>
	                    </div>
	                </div>
                 @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_specific_js')
<script type="text/javascript">
                //blog masonary
	var blogMasonary = window.blogMasonary || {},
	    $win = $(window);
	blogMasonary.Isotope = function() {
	    // 3 column layout
	    var isotopeContainer2 = $('.isotopeContainer2');
	    if (!isotopeContainer2.length || !jQuery().isotope) return;
	    $win.load(function() {
	        isotopeContainer2.isotope({
	            itemSelector: '.isotopeSelector'
	        });

	    });
	};
blogMasonary.Isotope();
</script>
@endsection