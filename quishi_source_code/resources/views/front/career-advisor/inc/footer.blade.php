
@if(!Auth::check())
<div class="login-menu login-menu-mobile fixed-login-menu">
    <ul>
        <li class="nav-item">
            <a href="{{route('login')}}" class="nav-link"> {{ __('Sign In')}} <i class="icon-power"></i></a>
        </li>

        <li class="nav-item">
            <a href="{{route('register')}}" class="nav-link"> {{ __('Sign Up')}} <i class="icon-user"></i></a>
        </li>               
    </ul>     
</div>
@endif
<!-- fixed login -->
<footer class="footer">
    <div class="main-footer">
        <div class="container">
            <div class="row">
                @if($contact_social)
                <!-- <div class="col-lg-3 col-sm-6">
                    <div class="footer-section">
                        <h4>Address</h4>

                        <p>{{ $contact_social['address'] }}</p>
                    </div>
                </div> -->
                <!-- <div class="col-lg-3 col-sm-6">
                    <div class="footer-section">
                        <h4>Contact</h4>
                        <p>Phone: <a href="callto:{{ $contact_social['phone_number'] }}">{{ $contact_social['phone_number'] }}</a><br>Email: <a href="mailto:quishi@quishi.com">{{ $contact_social['email'] }}</a> <br>
                        <a href="mailto:{{ $contact_social['email'] }}">{{ $contact_social['email'] }}</a></p>
                    </div>
                </div> -->
                @endif
                
                <div class="col-lg-5 col-md-4">
                    <div class="footer-section">
                        <!-- <h4>Quick links</h4> -->
                        <div class="footer-nav">
                            <ul>
                                <li><a href="{{URL::to('/about')}}">About</a></li>
                                <li><a href="{{ URL::to('/contact')}}">Contact</a></li>
                                <li><a href="{{ URL::to('/privacy-policy') }}">Privacy policy</a></li>
                                <li><a href="{{ URL::to('/terms-and-condition') }}">Terms of use</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="footer-section">
                                @if($contact_social)
                                <div class="footer-social-media">
                                    <ul class="social-links">
                                      @if($contact_social['facebook'] != "")
                                         <li><a href="{{ $contact_social['facebook'] }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                      @endif
                                      @if($contact_social['twitter'] != "")
                                         <li><a href="{{ $contact_social['twitter'] }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                      @endif
                                      @if($contact_social['google_plus'] != "")
                                        <li><a href="{{ $contact_social['google_plus'] }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                      @endif
                                      @if($contact_social['linkedin'] != "")
                                        <li><a href="{{ $contact_social['linkedin'] }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                      @endif
                                      @if($contact_social['instragram'] != "")
                                        <li><a href="{{ $contact_social['instragram'] }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                      @endif
                                    </ul>
                                </div>
                                 @endif
                            </div>
                </div>
                
                <div class="col-lg-4 col-md-4">
                    <div class="footer-section">
                        <!-- <h4>Donate</h4> -->
                        <div class="donate-image">

                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                <input type="hidden" name="cmd" value="_s-xclick" />
                                <input type="hidden" name="hosted_button_id" value="7ANBWK2YU2LY4" />
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                            </form>

                        </div>
                    </div>
                </div>
                


            </div>
            
        </div>
    </div>
     
    <div class="footer-copyright">
        <div class="container">
            <div class="copyright text-center">
                &copy; <?php echo date("Y"); ?> Quishi. All rights reserved.
            </div>
        </div>
    </div>
   
</footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script> <!--Running on safari js-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('/front/js/jquery-nice-select.min.js') }}"></script> -->
<!-- <script src="{{ asset('/front/js/jquery.nice-select.min.js') }}"></script> -->
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('/front/js/autosize.min.js') }}"></script>
<script src="{{ asset('/front/js/isotope.min.js') }}"></script>
<script src="{{ asset('/front/js/jquery-scrolltofixed-min.js') }}"></script>
<script src="{{ asset('/front/js/custom.js') }}"></script>
<!-- <script src="{{ asset('/front/js/app.js') }}"></script> -->
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<!--form validation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
<!-- Select 2 -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/select2/js/select2.full.min.js') }}"></script>


@yield('page_specific_js')
<script>
    $(window).load(function(){
        // //blog masonary
        //   var blogMasonary = window.blogMasonary || {},
        //       $win = $(window);
        //   blogMasonary.Isotope = function() {
        //       // 3 column layout
        //       var isotopeContainer2 = $('.isotopeContainer2');
        //       if (!isotopeContainer2.length || !jQuery().isotope) return;
        //       $win.load(function() {
        //           isotopeContainer2.isotope({
        //               itemSelector: '.isotopeSelector'
        //           });

        //       });
        //   };
        //   blogMasonary.Isotope();
        
        
        $(".notification-box").click(function() {
            $(this).find(".notification-list").slideToggle();
            $(".navbar-light .navbar-nav li.notification-box .badge").hide();
            //now make the ajax request
            if("{{Auth::user()}}"){
                //check for the class name
                if($(this).hasClass('_all_not_seen')){
                    var _token    = "{{csrf_token()}}";
                    $.post("{{URL::to('/profile/notifications/markAsSeen')}}",{ _token : _token }, function(data){
                        if(data.status == "success"){
                            console.log('Notifications has been updated!!');

                            $(".notification-box").removeClass('_all_not_seen');
                        }
                    });
                 
                }


                //add class
                   
                  
            }
           
        });



        $(document).on("click", function(event) {
            var $trigger = $(".notification-box");
            if ($trigger !== event.target && !$trigger.has(event.target).length) {
                $(".notification-list").slideUp();
            }
        });

       //autosize(document.querySelectorAll('.blog-leave-comment textarea.form-control'));

        // read notification
        $(".notification-list li a").click(function(e) {
            //$(this).addClass("mark-as-read");
            e.preventDefault();
            var _quishi_notification    = $(this);
            var _token                  = "{{csrf_token()}}";
            var _quishi_notification_id = $(this).data('notification-id');
            var link                    = $(this).attr('href');

            if($(this).hasClass('mark-as-read')){
                window.location.href    = link;
            }else {
                //request the server
                $.post("{{ URL::to('/profile/notifications/markAsRead') }}", { _token : _token , _quishi_notification_id : _quishi_notification_id} , function(data){
                    //for the success message
                    if(data.status == "success"){
                        $(_quishi_notification).addClass('mark-as-read');
                        //return back to the link 
                         window.location.href    = link;
                    }
                });
            }
            
            
        });

        //mark all the notifications to read 

        $('._quishi_mark_as_read').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            if(!$(this).hasClass('no_unread_notification')){
               var _token = "{{ csrf_token() }}";
                $.post("{{route('profile.markAllAsRead')}}",{ _token : _token }, function(data){
                    if(data.status  == "success"){
                        var notification_list = $('.notification-list-item');
                        $.each(notification_list, function(index,value){
                            var current_list   = $(this);
                            $(current_list).find('a').addClass('mark-as-read');
                        });
                     $('._quishi_mark_as_read').addClass('no_unread_notification');
                    }
                }); 
            }
            
        });
 });

</script>