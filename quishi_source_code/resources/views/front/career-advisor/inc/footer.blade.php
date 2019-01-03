
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
                        <div class="col-lg-4 col-md-4">
                            <div class="footer-section">
                                <!-- <h4>Donate</h4> -->
                                <div class="donate-image">
                                    <a class="donation-modal-btn btn btn-default"><!-- <img src="{{asset('front/images/paypal.png')}}" alt="paypals"> -->
                                        Donate Now
                                    </a>
                                </div>
                                <!-- Modal -->
                                <div class="modal modal-quishi" id="donation-Modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="paypal-logo">
                                                    <img src="{{ asset('front/images/logo-paypal.png')}}" alt="#">
                                                </div>
                                                <h5 class="modal-title" id="exampleModalLabel">Donate us now</h5>
                                                <h6>Payment Method</h6>
                                                <div class="card-images">
                                                    <div class="card-image">
                                                        <img src="{{ asset('front/images/master-card.png')}}" alt="paypal">
                                                    </div>
                                                    <div class="card-image">
                                                        <img src="{{asset('front/images/paypals.png')}}" alt="paypal">
                                                    </div>
                                                    <div class="card-image">
                                                        <img src="{{ asset('front/images/visa.png')}}" alt="paypal">
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form name="donate_now" id="donate_now" action="#" method="post">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <label class="col-form-label">Name on Card</label>
                                                                <input type="text"  class="form-control" name="name_on_card" placeholder="Name on Card">
                                                            </div>
                                                        </div>
                                                        <!-- end column -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <label class="col-form-label">Card Number</label>
                                                                <input type="text" class="form-control" name="card_number" placeholder="Card Number">
                                                            </div>
                                                        </div>
                                                        <!-- end col -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <!-- <label class="col-form-label">Expiration</label> -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label class="col-form-label">Expiration</label>
                                                                        <input type="text"  class="form-control" placeholder="MM" name="expiration_month">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="col-form-label" style="opacity: 0;">Year</label>
                                                                        <input type="text"  class="form-control" placeholder="YYYY" name="expiration_year">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end column -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <label class="col-form-label">CVC Number</label>
                                                                <input type="text"  class="form-control" placeholder="cvv" name="card_code">
                                                            </div>
                                                        </div>
                                                        <!-- end column -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <label class="col-form-label">Amount</label>
                                                                <input type="number"  class="form-control" placeholder="Amount" name="amount" step="0.2" required="required">
                                                            </div>
                                                        </div>
                                                        <!-- end column -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group ">
                                                                <label class="col-form-label">Currency</label>
                                                                <select class="form-control" name="currency">
                                                                    <option>USD</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- end column -->
                                                        
                                                    </div>
                                                    <!-- end row -->
                                                    
                                                    
                                                    <div class="form-group row">
                                                        <div class="col-sm-8 offset-sm-4">
                                                            <button type="submit" class="btn btn-default donate_us">Dontate Now</button>
                                                        </div>
                                                    </div>
                                                    <!-- end form group -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4">
                            <div class="footer-section">
                                <!-- <h4>Quick links</h4> -->
                                <div class="footer-nav">
                                    <ul>
                                        <li><a href="{{URL::to('/about')}}">About</a></li>
                                        <li><a href="{{ URL::to('/contact')}}">Contact</a></li>
                                        <li><a href="#">Privacy policy</a></li>
                                        <li><a href="#">Terms of use</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="footer-section">
                                @if($contact_social)
                                <div class="footer-social-media">
                                    <ul>
                                        <li><a href="{{ $contact_social['facebook'] }}" target="_blank"><i class="icon-social-facebook"></i></a></li>
                                        <li><a href="{{ $contact_social['twitter'] }}" target="_blank"><i class="icon-social-twitter"></i></a></li>
                                    </ul>
                                </div>
                                 @endif
                            </div>
                        </div>
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
    $(document).ready(function(){
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




        $("#donate_now").formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            excluded: 'disabled',
            fields: {
                name_on_card: {
                    validators: {
                        notEmpty: {
                            message: 'The Name on card is required'
                        }
                    }
                },
                card_number: {
                    validators: {
                        notEmpty: {
                            message: 'The card number is required'
                        },
                    
                    creditCard: {

                                message: 'The credit card number is not valid'

                    }
                 }

                },
                card_code: {

                        validators: {

                            notEmpty: {

                                message: 'The CVV is required'

                            },

                            card_code: {

                                creditCardField: 'cardNumber',

                                message: 'The CVV number is not valid'

                            }

                        }

                },
                expiration_month: {

                        validators: {

                            notEmpty: {

                                message: 'The expiration month is required'

                            },

                            digits: {

                                message: 'The expiration month can contain digits only'

                            },

                            callback: {

                                message: 'Expired',

                                callback: function(value, validator, $field) {

                                    value = parseInt(value, 10);

                                    var year         = validator.getFieldElements('expiration_year').val(),

                                        currentMonth = new Date().getMonth() + 1,

                                        currentYear  = new Date().getFullYear();

                                    if (value < 0 || value > 12) {

                                        return false;

                                    }

                                    if (year == '') {

                                        return true;

                                    }

                                    year = parseInt(year, 10);

                                    if (year > currentYear || (year == currentYear && value >= currentMonth)) {

                                        validator.updateStatus('expYear', 'VALID');

                                        return true;

                                    } else {

                                        return false;

                                    }

                                }

                            }

                        }

                },
                expiration_year: {

                        validators: {

                            notEmpty: {

                                message: 'The expiration year is required'

                            },

                            digits: {

                                message: 'The expiration year can contain digits only'

                            },

                            callback: {

                                message: 'Expired',

                                callback: function(value, validator, $field) {

                                    value = parseInt(value, 10);

                                    var month        = validator.getFieldElements('expiration_month').val(),

                                        currentMonth = new Date().getMonth() + 1,

                                        currentYear  = new Date().getFullYear();

                                    if (value < currentYear || value > currentYear + 10) {

                                        return false;

                                    }

                                    if (month == '') {

                                        return false;

                                    }

                                    month = parseInt(month, 10);

                                    if (value > currentYear || (value == currentYear && month >= currentMonth)) {

                                        validator.updateStatus('expiration_month', 'VALID');

                                        return true;

                                    } else {

                                        return false;

                                    }

                                }

                            }

                        }

                    }

                },
                amount:{
                    validators:{
                        notEmpty:{
                            message : 'The amount is required'
                        }
                    }
                }
        }).on('success.field.fv', function(e, data) {
            // Show card icons

            if (data.field === 'card_number' && data.validator === 'creditCard') {

                var $icon = data.element.data('fv.icon');

                switch (data.result.type) {
                    case 'MASTERCARD':
                    case 'DINERS_CLUB_US':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-mastercard');
                        break;
                    case 'VISA':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-visa');
                        break;
                    case 'AMERICAN_EXPRESS':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-amex');
                        break;
                    case 'DISCOVER':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-discover');
                        break;
                    default:
                        $icon.removeClass().addClass('form-control-feedback fa fa-times');
                        break;

                }

            }

        })

        .on('err.field.fv', function(e, data) {

            if (data.field === 'card_number') {

                var $icon = data.element.data('fv.icon');

                $icon.removeClass().addClass('form-control-feedback fa fa-times');

            }

        });
    }).on('success.form.fv', function(e) {
           
            e.preventDefault();
            var result = new FormData($("#donate_now")[0]);
            result.append('_token',"{{csrf_token()}}");

            //make the ajax request to get the result
            $.ajax({
                url         : "{{route('makePayment')}}",
                data        : result,
                type        : 'POST',
                dataType    : 'JSON',
                processData : false,
                contentType : false,
                success     : function(data){
                    if(data.status == 'success'){
                        swal({
                            title           : 'Payment completed!!',
                            text            : 'Thank you for your donation, the payment process has been completed successfully',
                            type            : 'success',
                            closeOnConfirm  : true
                        },
                            function(){
                                location.reload();
                        });

                        //hide the modal 
                        $('#donation-Modal').modal('hide');
                    }else{
                         swal({
                            title           : 'Payment incomplete!!',
                            text            : data.result,
                            type            : 'error',
                            closeOnConfirm  : true
                        },
                            function(){
                                //location.reload()
                        });

                         //$('#donation-Modal').modal('hide');
                    }
                },
                error       : function(e){

                }


            });


    });
</script>