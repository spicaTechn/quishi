@extends('front.layout.master')
@section('content')
<div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="login-left-part">
                            <h3>{{ __('Login')}}</h3>
                            
                            <form>
                            	@csrf
                                <div class="form-group">
                                    <i class="icon-user"></i>
                                    <input type="text" name="" class="form-control" placeholder="User Name">
                                </div>
                                <div class="form-group">
                                    <i class="icon-key"></i>
                                    <input type="password" name="" class="form-control" placeholder="Password">
                                </div>
                                <div class="forget-row">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">{{ __('Remember Me')}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <a href="#">Forget Password?</a> -->
                                        <button class="btn btn-default">{{ __('login')}}</button>
                                    </div>
                                </div>
                                <div class="forget-row new-user">
                                    <div class="form-group">
                                        <p>New user? <a href="{{URL::to('register')}}"> {{ __('register now')}}</a></p>
                                    </div>
                                    <div class="form-group">
                                        <p><a href="#">{{ _('Forget Password?')}}</a></p>
                                        
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <button class="btn btn-default">login</button>
                                </div> -->
                            </form>
                            <div class="login-with-social-media">
                                <div class="or"><span>{{ __('or')}}</span></div>
                                <ul>
                                    <li><a href="#" class="facebook"><i class="icon-social-facebook"></i> {{ __('Login using Facebook')}}</a></li>
                                    <li><a href="#" class="google"><i class="icon-social-google"></i> {{ __('Login using Google')}}</a></li>
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