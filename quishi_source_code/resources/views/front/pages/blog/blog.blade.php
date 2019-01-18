@extends('front.layout.master')
@section('content')
<div class="blog-page">
    <div class="container">
        <div class="blog-main-body">
          @if($blogs->count() > 0)
        	<div class="blog-search">
        		<div class="top-filter-section">
                  <div class="search-form form-group">
                      <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                      <input type="text" class="form-control" placeholder="search by blog title" name="_quishi_blog_search" value="{{\Request::get('blog_title')}}" id="_quishi_blog_search">
                  </div>
                </div>
        	</div>
            <div class="row isotopeContainer2">
             @foreach($blogs as $blog)
	                <div class="col-md-4 isotopeSelector">
	                    <div class="blog-category-section">
	                        <div class="blog-image">
	                        	@if($blog->image_path != null)
	                            	<a href="{{ url('/blog').'/'.$blog->id .'/'.$blog->slug }}"><img src="{{ asset('/front')}}/images/blogs/{{$blog->image_path}}" alt="{{ $blog->title }}"></a>
	                            @else
	                            	<a href="{{ url('/blog').'/'.$blog->id .'/'.$blog->slug }}"><img src="{{ asset('/front/images/default-blog.jpg') }}" alt="{{ $blog->title }}"></a>
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
	                            <h3><a href="{{ url('/blog').'/'.$blog->id .'/'.$blog->slug }}">{{ $blog->title }}</a></h3>
	                             <p>{{ ($blog->abstract != "") ? substr($blog->abstract,0,150) .'..' : substr($blog->content,0,150) . '...' }}</p>
	                            <a href="{{ url('/blog').'/'.$blog->id .'/'.$blog->slug }}" class="blog-read-more">read more</a>
	                        </div>
	                    </div>
	                </div>
                 @endforeach
            </div>

            <div class="blog_pagination">
              @if(\Request::has('blog_title'))
                {{ $blogs->appends(array('blog_title'=>\Request::get('blog_title')))->links() }}
              @else
                   {{ $blogs->links() }}

              @endif
            </div>
           @else
            <div class="_no_blog_results">
              <div class="blog-search">
                <div class="top-filter-section">
                      <div class="search-form form-group">
                          <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                          <input type="text" class="form-control" placeholder="search by blog title" name="_quishi_blog_search" value="{{\Request::get('blog_title')}}" id="_quishi_blog_search">
                      </div>
                    </div>
              </div>
              <div class="no_result_found">
                <img src="{{ asset('/front/images/blog-not-found.png') }}">
                 <p>Sorry ! No blog results were found. Please try again with different keyword.</p>
                 @if(Auth::check())
                  <a href="{{URL::to('/profile/blogs/create')}}"><button class="btn btn-sm btn-default">Create New</button></a>
                 @endif
                 
              </div>
            </div>
           @endif
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

$("#_quishi_blog_search").on('keyup',function(e){
  //prevent default action
  var _search_input  = $(this);
  //$(_search_input).parent('div.search-form').find('span').remove();
  var _search_value  = $(this).val();
  if(e.keyCode == 13){
    if(_search_value.length == 0){
      //add invalid class to the current input field
      //$(_search_input).addClass('invalid');
      //$(_search_input).after('<span class="invalid-feedback">Search key should be 2 characters long</span>');
       var redirect_uri = "{{$url}}"; 

    }else{
      
      var url_parameters = "?blog_title=" + _search_value;
      var redirect_uri = "{{$url}}" + url_parameters;

      //now redirect to the page
      
    }
    return window.open(redirect_uri, "_self");
  }
});

</script>
@endsection