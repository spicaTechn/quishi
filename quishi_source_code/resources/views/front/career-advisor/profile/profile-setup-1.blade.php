@extends('front.layout.master')
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>Welcome {{ucwords(Auth::user()->name)}}, please setup your profile to continue.. </h3>
        <form action="{{route('profile.setup.step2')}}" method="post" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-md-4">
                    <h6>{{ __('Upload your profile picture')}}</h6>
                    <div class="file-upload">

                        <div class="image-upload-wrap" 
                         @if(Auth::user()->user_profile()->count() > 0)
                            @if(Auth::user()->user_profile->image_path != "")
                                {{ 'style=display:none;'}}
                            @endif
                         @endif

                        >
                            <input class="file-upload-input" type='file' name="user_image" onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                                <h3>{{ __('Drag and drop a file or select add Image')}}</h3>
                            </div>
                        </div>
                        <div class="file-upload-content" 
                        @if(Auth::user()->user_profile()->count() > 0)
                            @if(Auth::user()->user_profile->image_path != "")
                                {{ 'style=display:block;'}}
                            @endif
                         @endif
                        >
                            @if(Auth::user()->user_profile()->count() > 0)
                                @if(Auth::user()->user_profile->image_path != "")
                                    <img class="file-upload-image" src='{{asset("/front/images/profile/")."/".Auth::user()->user_profile->image_path}}' alt="your image" />
                                @else
                                        <img class="file-upload-image" src="#" alt="your image" />
                                @endif
                            @else
                                 <img class="file-upload-image" src="#" alt="your image" />
                            @endif


                        </div>
                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">{{ __('Upload Image')}}</button>
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text"  value="{{ucwords(Auth::user()->name)}}" class="form-control" placeholder="Full Name" name="name" required="">
                       
                    </div>

                    <div class="form-group">
                        <input type="email"  name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <select class="form-control"  name="age_group">
                            <option value="0" disabled="disabled" selected="">{{ __('Select Age Group')}} </option>
                            <option value="1" {{ (old('age_group') == 1) ? 'selected' : '' }} @if(Auth::user()->user_profile()->count() > 0) @if (auth::user()->user_profile->age_group == 1)  {{ 'selected' }} @endif @endif>0-15 years</option>
                            <option value="2" {{ (old('age_group') == 2) ? 'selected' : '' }} @if(Auth::user()->user_profile()->count() > 0) @if (auth::user()->user_profile->age_group == 2)  {{ 'selected' }} @endif @endif>15-30 years</option>
                            <option value="3" {{ (old('age_group') == 3) ? 'selected' : '' }} @if(Auth::user()->user_profile()->count() > 0) @if (auth::user()->user_profile->age_group == 3)  {{ 'selected' }} @endif @endif>30-45 years</option>
                            <option value="4" {{ (old('age_group') == 4) ? 'selected' : '' }} @if(Auth::user()->user_profile()->count() > 0) @if (auth::user()->user_profile->age_group == 4)  {{ 'selected' }} @endif @endif>45-50 years</option>
                            <option value="5" {{ (old('age_group') == 5) ? 'selected' : '' }} @if(Auth::user()->user_profile()->count() > 0) @if (auth::user()->user_profile->age_group == 5)  {{ 'selected' }} @endif @endif>50 above</option>
                        </select>

                        @if ($errors->has('age_group'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('age_group') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Enter your address" value="{{old('address')}} @if(Auth::user()->user_profile()->count() > 0) {{ Auth::user()->user_profile->location }}@endif" id="autocomplete">

                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Describe a little bit about you</label>
                        <textarea class="form-control" name="description" id="description">{{old('description')}} @if(Auth::user()->user_profile()->count() > 0) {{ auth::user()->user_profile->description}} @endif</textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-default"> Proceed and Continue</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection