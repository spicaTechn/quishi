@extends('front.layout.master')
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>Welcome John, please setup your profile to continue </h3>
        <form action="">
            <div class="row">
                <div class="col-md-4">
                    <h6>Upload your profile picture</h6>
                    <div class="file-upload">

                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />


                        </div>
                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload Image</button>
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option>Age Group</option>
                            <option>Age Group</option>
                            <option>Age Group</option>
                            <option>Age Group</option>
                            <option>Age Group</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter your address">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Describe a little bit about you</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-default"> Proceed and Continue</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsectoin