@extends('front.layout.master')
@section('content')
        <div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="login-left-part">
                            <h3>{{ __('Register')}}</h3>
                            
                            <form method="POST" action="{{route('register')}}" aria-lable="{{ __('Register')}}">
                                @csrf

                                <div class="form-group">
                                    <i class="icon-user"></i>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>

                                     @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                     @endif
                                </div>

                                <div class="form-group">
                                    <i class="icon-envelope"></i>
                                    <input type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email" value="{{old('email')}}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                     @endif

                                </div>

                                <div class="form-group">
                                    <i class="icon-key"></i>
                                    <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                     @endif
                                </div>

                                <div class="form-group">
                                    <i class="icon-key"></i>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder=" Confirm password"/>

                                </div>

                                <div class="forget-row">
                                    

                                    <div class="form-group accept-terms-conditions">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="terms_conditions" required="">
                                          <label class="custom-control-label" for="terms_conditions">By clicking register you agree to our <a href="{{ URL::to('/terms-and-condition') }}" target="_blank"><span class="terms_conditions">Terms and Conditions</span></a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <p><button  type="submit" class="btn btn-default btn-register">{{ __('Register Now')}}</button></p>
                                        

                                    </div>
                                <div class="form-group have-account">
                                        <p>{{ __('Have an account?')}} <a href="{{route('login')}}">{{ __('Login now')}}</a></p>
                                    </div>
                                
                            </form>
                            <div class="login-with-social-media">
                                <div class="or"><span>{{ __('or')}}</span></div>
                                <ul>
                                    <li><a href="{{URL::to('/auth/facebook')}}" class="facebook"><i class="icon-social-facebook"></i> {{ __('Login using Facebook')}}</a></li>
                                    <li><a href="{{URL::to('/auth/google')}}" class="google"><i class="icon-social-google"></i> {{ __('Login using Google')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 " style="background: url({{asset('/front/images/career.jpg')}}) no-repeat;">
                        <div class="login-right-part">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
  @endsection