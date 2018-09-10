@extends('front.layout.master')
@section('content')
<div class="contact-page-form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="contact-left">
                    <div class="social-medias">
                        <ul>
                            <li class="facebook"><a href="#"><i class="icon-social-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="icon-social-twitter"></i></a></li>
                            <li class="google"><a href="#"><i class="icon-social-google"></i></a></li>
                            <li class="instagram"><a href="#"><i class="icon-social-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="contact-form">
                        <h2>Get in touch</h2>
                        <p>Call or message regarding issue or problem</p>
                        <form>
                            <div class="form-group">
                                <input type="text" name="" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="number" name="" class="form-control" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-default">Send message</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.3847688569476!2d85.32448051557128!3d27.705403982792735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a77f1ab301%3A0xb213d09ebce4b3da!2sDillibazar!5e0!3m2!1sen!2snp!4v1535978339071" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection