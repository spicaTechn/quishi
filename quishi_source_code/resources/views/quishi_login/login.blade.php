@extends('front.layout.master')
@section('title','Quishi | Login')
@section('content')
<div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="login-left-part">
                            <h3>{{ __('Login')}}</h3>
                            @if(Session::has('status'))
                                <div class="activated_account_msg alert alert-success">
                                    {{ Session::get('status') }}
                                </div>
                            @endif
                            <form method="post" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            	@csrf
                                <div class="form-group">
                                    <i class="icon-user"></i>
                                    <input type="email"  name="email" class="form-control {{$errors->has('email') ? 'is-invalid':''}}" placeholder="Email Address" required autofocus="" value="{{old('email')}}">

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <i class="icon-key"></i>
                                    <input type="password" id="password" name="password" class="form-control{{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password" required="required">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="forget-row">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck1">{{ __('Remember Me')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <a href="#">Forget Password?</a> -->
                                        <button  type="submit" class="btn btn-default">{{ __('login')}}</button>
                                    </div>
                                </div>
                                <div class="forget-row new-user">
                                    <div class="form-group">
                                        <p>{{ __('New user?')}} <a href="{{URL::to('register')}}"> {{ __('Register now')}}</a></p>
                                    </div>
                                    <div class="form-group">
                                        <p><a href="{{ route('password.request') }}">{{ _('Forgot Password?')}}</a></p>
                                        
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <button class="btn btn-default">login</button>
                                </div> -->
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