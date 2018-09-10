@extends('front.layout.master')
@section('content')
<div class="my-profile">
            <div class="container">
                <div class="profile-sidemenu">
                    <ul>
                        <li><a href="#"> <i class="ti-dashboard"></i> Dashboard</a></li>
                        <li><a href="#"><i class="ti-write"></i> My answers</a></li>
                        <li class="active"><a href="#"><i class="ti-comment-alt"></i> Admin reviews<span class="badge badge-pill badge-danger">3</span></a></li>
                        <li><a href="#"><i class="ti-user"></i> My account</a></li>
                        <li><a href="#"><i class="ti-user"></i> Logout</a></li>
                    </ul>
                </div>
                <div class="profile-main-section">
                    <div class="profile-admin-review-section">
                        <div class="profile-admin-review-title">
                            <h6>Lorem ipsum dolor sit amet</h6>
                        </div>
                        <div class="profile-admin-review-answer">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita nesciunt aliquam debitis quasi maiores non, amet, dolorum consequuntur magni vel accusamus laborum. Culpa aliquid ea et debitis veniam dicta reiciendis! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim quod, nulla quo doloremque autem, perferendis ipsum reiciendis et quos! Debitis possimus distinctio dolore aliquid. Corporis dicta illum quasi praesentium perspiciatis!</p>
                        </div>
                    </div>
                    <!-- profile-first-section -->
                </div>
                <!-- profile-main-section -->
            </div>
        </div>
@endsectoin