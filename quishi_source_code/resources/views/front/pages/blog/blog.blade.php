@extends('front.layout.master')
@section('content')
<div class="blog-page">
    <div class="container">
        <div class="blog-main-body">
            <div class="row isotopeContainer2">
             @foreach($blogs as $blog)
	                <div class="col-md-4 isotopeSelector">
	                    <div class="blog-category-section">
	                        <div class="blog-image">
	                        	@if($blog->image_path != null)
	                            	<a href="{{ url('/blog').'/'.$blog->id }}"><img src="{{ asset('/front')}}/images/blogs/{{$blog->image_path}}" alt="#"></a>
	                            @else
	                            	<a href="{{ url('/blog').'/'.$blog->id }}"><img src="{{ asset('/front/images/blogs/1539154047.jpg') }}" alt="" style=""></a>
	                            @endif
	                            <div class="blog-date">
	                                {{ Carbon\Carbon::parse($blog->published_date)->format('d') }}<span>{{ Carbon\Carbon::parse($blog->published_date)->format('M') }}</span>
	                            </div>
	                        </div>
	                        <div class="blog-content">
	                            <h3><a href="{{ url('/blog').'/'.$blog->id }}">{{ $blog->title }}</a></h3>
	                            <p>{{ $blog->abstract }}</p>
	                            <a href="{{ url('/blog').'/'.$blog->id }}" class="blog-read-more">read more</a>
	                        </div>
	                    </div>
	                </div>
                 @endforeach
            </div>

            <div class="blog_pagination">
            	{{ $blogs->links() }}
            </div>
            <!-- blog pagination -->
           <!--  <nav class="navigation blog-pagination">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><i class="icon-arrow-left"></i></a></li>
                    <li class="page-item current-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="icon-arrow-right"></i></a></li>
                </ul>
            </nav> -->
            <!-- End blog pagination -->
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