@extends('front.career-advisor.layout.master')
@section('content')
<div class="my-profile">
    <div class="container">
        <div class="profile-sidemenu">
            <ul>
                <li><a href="#"> <i class="ti-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="ti-write"></i> My answers</a></li>
                <li><a href="#"><i class="ti-comment-alt"></i> Admin reviews<span class="badge badge-pill badge-danger">3</span></a></li>
                <li class="active"><a href="#"><i class="ti-user"></i> My account</a></li>
                <li><a href="#"><i class="ti-user"></i> Logout</a></li>
            </ul>
        </div>
        <div class="profile-main-section">
            <div class="profile-login-section">
                <h6>Change Security</h6>
                <form>
                    <div class="form-group">
                        <input type="Password" name="" class="form-control" placeholder="Old Password">
                    </div>
                     <div class="form-group">
                        <input type="Password" name="" class="form-control" placeholder="New Password">
                    </div>
                     <div class="form-group">
                        <input type="Password" name="" class="form-control" placeholder="Conform Password">
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                </form>
            </div>
            <!-- profile-login-section -->
        </div>
        <!-- profile-main-section -->
    </div>
</div>
@endsection