@extends('front.layout.master')
@section('content')
  <div class="top-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Age Group</option>
                                <option>Age Group</option>
                                <option>Age Group</option>
                                <option>Age Group</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Education</option>
                                <option>Education</option>
                                <option>Education</option>
                                <option>Education</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Location</option>
                                <option>Location</option>
                                <option>Location</option>
                                <option>Location</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                        <div class="top-filter-dropdown">
                            <select class="form-control">
                                <option>Industry</option>
                                <option>Industry</option>
                                <option>Industry</option>
                                <option>Industry</option>
                            </select>
                        </div>
                        <!-- top-filter-dropdown -->
                    </div>
                    <div class="col-md-4">
                        <div class="filter-right">
                            <div class="change-view"><i class="icon-list"></i></div>
                            <div class="search-form">
                                <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                                <input type="text" name="search-form" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-section search-results-found">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title">
                            <h2>Search Results (120 Profiles)</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="filter-dropdown">
                            <div class="sort-by">Sort By: </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Recent</option>
                                    <option>Recent</option>
                                    <option>Recent</option>
                                    <option>Recent</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                    <option>Oldest</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Likes</option>
                                    <option>Likes</option>
                                    <option>Likes</option>
                                    <option>Likes</option>
                                </select>
                            </div>
                            <div class="sort-dropdown">
                                <select class="form-control">
                                    <option>Views</option>
                                    <option>Views</option>
                                    <option>Views</option>
                                    <option>Views</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/1.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/2.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/3.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                   <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/1.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/2.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                   <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/3.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/1.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/2.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                   <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trending-profiles-section">
                            <div class="full-list-view">
                                <div class="profile-image">
                                    <img src="images/profile/3.jpg">
                                </div>
                                <div class="profile-desination">
                                    <h3>Felicity Smoak</h3>
                                    <span>UI/UX Designer</span>
                                </div>
                            </div>

                            <div class="full-list-view">
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
                            </div>

                            <div class="full-list-view">
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
                                    <a href="{{route('search-profile.view-profile')}}">view profile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="view-more text-center"><a href="#" class="btn btn-default">load more</a></div>
            </div>
        </div>
@endsection