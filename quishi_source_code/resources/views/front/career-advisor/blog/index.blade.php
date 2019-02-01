@extends('front.career-advisor.layout.master')
@section('title','Quishi | Career Advsior Blogs')
@section('content')

<div class="profile-blog-page profile-main-section">
    <div class="row isotopeContainer2">
        @foreach($blogs as $blog)
        <div class="col-md-4 isotopeSelector">
            <div class="blog-category-section">
                <div class="blog-image">
                    <a href="{{URL::to('/blog/'.$blog->id .'/'.$blog->slug)}}">
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
                    <h3><a href="{{URL::to('blog/'.$blog->id.'/'.$blog->slug)}}">{{$blog->title}}</a></h3>

                    <p>{{$blog->abstract}}</p>
                    <div class="blog-footer">
                    	<a href="{{URL::to('/blog/'.$blog->id .'/'.$blog->slug)}}" class="blog-read-more">{{ __('Read more') }}</a>
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
                window.open("{{URL::to('/profile/blogs')}}" + "/" + _quishi_blog_id,'_self');
            });


            //delete blog
            $('.btn-delete-blog').on('click',function(e){
                e.preventDefault();
                var _quishi_blog_id = $(this).data('blog-id');

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover Blog & Comments !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },function(isConfirm){
                    if(isConfirm){
                        //make ajax request 
                        $.ajax({
                            url:"{{URL::to('/profile/blogs')}}" + "/" + _quishi_blog_id,
                            type:"DELETE",
                            dataType:"Json",
                            data:{_token:"{{csrf_token()}}"},
                            success:function(data){
                                if(data.status == "success")
                                {
                                    swal({
                                        title: "Deleted!",
                                        text : data.message,
                                        type : "success",
                                    }, function(){
                                        window.location.href = "{{route('profile.blog.index')}}";
                                    });
                                    
                                }else{
                                    swal('Not allowed!!',data.message,'error');
                                }
                            },
                            error:function(jqXHR,textStatus,errorThrown)
                            {
                                if(jqXHR.status == '404')
                                {
                                    swal('Not found in server','The major-category does not exists','error');
                                }else if(jqXHR.status == '201')
                                {
                                    swal('Not allowed!!','The major-category cannot be deleted because its contains major.','error');
                                }
                            }
                        });
                    }
                    else {
                        swal.close();
                    }
                });
            });
    </script>
@endsection