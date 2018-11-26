@extends('front.career-advisor.layout.master')
@section('content')

<div class="profile-blog-page profile-main-section">
    <div class="row isotopeContainer2">
        @foreach($blogs as $blog)
        <div class="col-md-4 isotopeSelector">
            <div class="blog-category-section">
                <div class="blog-image">
                    <a href="{{URL::to('/blog/'.$blog->id)}}">
                            @if($blog->image_path != "")
                                 <img src="{{asset('/front/images/blogs/'.$blog->image_path)}}" alt="#">
                            @else
                                <img src="http://localhost/quishi/front/images/blogs/1539154047.jpg" alt="#">
                            @endif 
                    </a>
                    <div class="blog-date">

                        {{Carbon\Carbon::parse($blog->published_date)->format('d')}}<span>{{Carbon\Carbon::parse($blog->published_date)->format('M')}}</span>
                    </div>
                </div>
                <div class="blog-content">
                    <h3><a href="{{URL::to('blog/'.$blog->id)}}">{{$blog->title}}</a></h3>

                    <p>{{$blog->abstract}}</p>
                    <div class="blog-footer">
                    	<a href="{{URL::to('/blog/'.$blog->id)}}" class="blog-read-more">{{ __('Read more') }}</a>
                    	<div class="edit-blog">
                    		<a href="javascript:void(0);" class="btn-edit-blog" data-blog-id="{{$blog->id}}">Edit</a>
                    		<a href="javascript:void(0);" data-blog-id="{{$blog->id}}" class="btn-delete-blog">Delete</a>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="blog_pagination">
     {{ $blogs->links() }}
    </div>
   
</div>
<!-- profile-main-section -->
</div>
</div>


@endsection
@section('page_specific_js')
    <script>
        jQuery(document).ready(function(){
        	equalheight = function(container){

        	var currentTallest = 0,
        	     currentRowStart = 0,
        	     rowDivs = new Array(),
        	     $el,
        	     topPosition = 0;
        	 $(container).each(function() {

        	   $el = $(this);
        	   $($el).height('auto')
        	   topPostion = $el.position().top;

        	   if (currentRowStart != topPostion) {
        	     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
        	       rowDivs[currentDiv].height(currentTallest);
        	     }
        	     rowDivs.length = 0; // empty the array
        	     currentRowStart = topPostion;
        	     currentTallest = $el.height();
        	     rowDivs.push($el);
        	   } else {
        	     rowDivs.push($el);
        	     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        	  }
        	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
        	     rowDivs[currentDiv].height(currentTallest);
        	   }
        	 });
        	}


        });


        	$(window).load(function() {
        	  equalheight('.blog-content h3');
        	});


        	$(window).resize(function(){
        	  equalheight('.blog-content h3');
        	});


            //edit blog
            $('.btn-edit-blog').on('click',function(e){
                var _quishi_blog_id = $(this).data('blog-id');
                window.open("{{URL::to('/profile/blogs')}}" + "/" + _quishi_blog_id);
            });
            //delete blog
            $('.btn-delete-blog').on('click',function(e){
                e.preventDefault();
                console.log('i need to delete the blog');
            });
    </script>
@endsection