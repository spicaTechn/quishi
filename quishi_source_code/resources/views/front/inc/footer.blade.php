
<footer class="footer">
            <div class="main-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Address</h4>
                                <p>{{ $contact_social['address'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Contact</h4>
                                <p>Phone: <a href="callto:{{ $contact_social['phone_number'] }}">{{ $contact_social['phone_number'] }}</a><br>Email: <a href="mailto:quishi@quishi.com">{{ $contact_social['email'] }}</a> <br>
                                <a href="mailto:{{ $contact_social['email'] }}">{{ $contact_social['email'] }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-section">
                                <h4>Donate</h4>
                                <div class="donate-image">
                                    <img src="{{asset('/front')}}/images/paypal.png" alt="paypals">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-social-media">
                        <ul>
                            <li><a href="{{ $contact_social['facebook'] }}"><i class="icon-social-facebook"></i></a></li>
                            <li><a href="{{ $contact_social['twitter'] }}"><i class="icon-social-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <div class="copyright text-center">
                        &copy; 2018 Quishi. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<!-- <script src="{{ asset('/front/js/jquery.nice-select.min.js') }}"></script> -->
<script src="{{ asset('/front/js/custom.js') }}"></script>
<script src="{{ asset('/front/js/app.js') }}"></script>
<script src="{{ asset('/front/js/jquery-nice-select.min.js') }}"></script>

