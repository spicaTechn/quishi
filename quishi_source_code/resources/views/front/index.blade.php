@extends('front.layout.master')
@section('content')
<div class="banner-bg" style="background: url({{asset('/front/images/banner.jpg')}}) no-repeat center; background-size: cover;">
    <div class="most-search-job">
        <ul>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
            <li>Graphics Designer</li>
        </ul>
    </div>
    <div class="container">
        <div class="search-absolute-content text-center">
            <h1>search</h1>
            <form>
                <div class="search-wrapper">

                    <div class="form-group">
                        <i class="icon-magnifier"></i>
                        <input type="text" name="" class="form-control" placeholder="Search keyword or title">
                    </div>
                    <div class="form-group">
                        <i class="icon-location-pin"></i>
                        <input type="text" name="" class="form-control" placeholder="Location" style="background: #f4f4f4;">
                    </div>

                    <button class="btn btn-transpatent"><i class="icon-magnifier"></i></button>

                </div>
            </form>
            <p>Your career guide with sincere and honest tales of experiences from professionals around the world.</p>
        </div>
    </div>
</div>
<div class="page-section trending-profiles">
    <div class="container">
        <div class="section-title">
            <h2>trending profiles</h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="trending-profiles-section">
                    <div class="profile-image">
                        <img src="{{asset('/front')}}/images/profile/1.jpg">
                    </div>
                    <div class="profile-desination">
                        <h3>Felicity Smoak</h3>
                        <span>UI/UX Designer</span>
                    </div>
                    <div class="profile-slills">
                        <ul>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">jQuery</a></li>
                            <li><a href="#">HTML5</a></li>
                        </ul>
                    </div>
                    <div class="profile-info">
                        <p>Felicity is a dedicated UI/UX designer for web and mobile applications.</p>
                    </div>
                    <div class="like-view">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-like"></i></a>
                                    <span>10k Likes</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-eye"></i></a>
                                    <span>10k Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-profile">
                        <a href="#">view profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="trending-profiles-section">
                    <div class="profile-image">
                        <img src="{{asset('/front')}}/images/profile/2.jpg">
                    </div>
                    <div class="profile-desination">
                        <h3>Felicity Smoak</h3>
                        <span>UI/UX Designer</span>
                    </div>
                    <div class="profile-slills">
                        <ul>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">jQuery</a></li>
                            <li><a href="#">HTML5</a></li>
                        </ul>
                    </div>
                    <div class="profile-info">
                        <p>Felicity is a dedicated UI/UX designer for web and mobile applications.</p>
                    </div>
                    <div class="like-view">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-like"></i></a>
                                    <span>10k Likes</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-eye"></i></a>
                                    <span>10k Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-profile">
                        <a href="#">view profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="trending-profiles-section">
                    <div class="profile-image">
                        <img src="{{asset('/front')}}/images/profile/3.jpg">
                    </div>
                    <div class="profile-desination">
                        <h3>Felicity Smoak</h3>
                        <span>UI/UX Designer</span>
                    </div>
                    <div class="profile-slills">
                        <ul>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">jQuery</a></li>
                            <li><a href="#">HTML5</a></li>
                        </ul>
                    </div>
                    <div class="profile-info">
                        <p>Felicity is a dedicated UI/UX designer for web and mobile applications.</p>
                    </div>
                    <div class="like-view">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-like"></i></a>
                                    <span>10k Likes</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="view-section">
                                    <a href="#"><i class="icon-eye"></i></a>
                                    <span>10k Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-profile">
                        <a href="#">view profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-more text-center"><a href="#" class="btn btn-default">view more</a></div>
    </div>
</div>
<!-- trending-profiles -->
<div class="page-section the-media">
    <div class="container">
        <div class="section-title">
            <h2>In the Media</h2>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
               @foreach($blog->page_detail as $blog_detail)
               <?php
                $blog_unserialize = unserialize($blog_detail->meta_value);
               ?>
                <div class="col-md-6">
                    <div class="home-blog-section">
                        <div class="blog-image">
                            <img src="{{asset('/front')}}/images/blogs/{{ $blog_unserialize['image'] }}" alt="#">
                        </div>
                        <div class="blog-conten">
                            <h4>{{ $blog->title }}</h4>
                            <span class="time">Eva Marcel on {{ $blog_unserialize['date'] }}</span>
                            <p>{{ str_limit($blog->content,160) }}</p>
                            <a href="#">Full Story <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
              @endforeach
            @endforeach

        </div>
        <div class="view-more text-center"><a href="#" class="btn btn-default">all blogs</a></div>
    </div>
</div>
<!-- trending-profiles -->
<div class="page-section about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="about-inner-section">
                    <div class="about-icon-section">
                        <img src="{{asset('/front')}}/images/icons/expert.png" alt="expert">
                    </div>
                    <div class="about-content-section">
                        <h4>TALK TO AN EXPERT</h4>
                        <p>Suspendisse sollicitudin tincidunt ex, vitae porta ante pretium a. Vestibulum ultricies velit urna, id eleifend tellus iaculis ac. Nullam tristique sagittis magna id eleifend.</p>
                        <a href="#">More about our experts <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-4">
                <div class="about-inner-section">
                    <div class="about-icon-section">
                        <img src="{{asset('/front')}}/images/icons/career-review.png" alt="career-review">
                    </div>
                    <div class="about-content-section">
                        <h4>CAREER REVIEWS</h4>
                        <p>Suspendisse sollicitudin tincidunt ex, vitae porta ante pretium a. Vestibulum ultricies velit urna, id eleifend tellus iaculis ac. Nullam tristique sagittis magna id eleifend.</p>
                        <a href="#">More about our experts <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-4">
                <div class="about-inner-section">
                    <div class="about-icon-section">
                        <img src="{{asset('/front')}}/images/icons/about-quishi.png" alt="quishi icon">
                    </div>
                    <div class="about-content-section">
                        <h4>ABOUT US</h4>
                        <p>Suspendisse sollicitudin tincidunt ex, vitae porta ante pretium a. Vestibulum ultricies velit urna, id eleifend tellus iaculis ac. Nullam tristique sagittis magna id eleifend.</p>
                        <a href="#">More about our experts <i class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
<!-- end about section -->

@endsection