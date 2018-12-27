@extends('front.layout.master')
@section('content')
<div class="blog-page">
    <div class="container">
        <div class="blog-main-body">
        	<div class="blog-search">
        		<div class="top-filter-section">
                  <div class="search-form form-group">
                      <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                      <input type="text" class="form-control" placeholder="search by name">
                  </div>
                </div>
        	</div>
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
                                <div class="chip right">
                                    
                                @if($blog->user->user_profile->image_path != null)
                                  <img src="{{ asset('/front')}}/images/profile/{{$blog->user->user_profile->image_path}}" alt="{{$blog->user->name}}" class="cyan"> 
                                @else
                                   <img src="https://pixinvent.com/materialize-material-design-admin-template/images/avatar/avatar-7.png" alt="{{$blog->user->name}}" class="cyan"> 
                                @endif
                                <a href="#!">{{$blog->user->name}}</a>
                                </div>
	                            <h3><a href="{{ url('/blog').'/'.$blog->id }}">{{ $blog->title }}</a></h3>
	                             <p>{{ ($blog->abstract != "") ? substr($blog->abstract,0,150) .'..' : substr($blog->content,0,150) . '...' }}</p>
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