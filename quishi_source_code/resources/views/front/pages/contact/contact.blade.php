@extends('front.layout.master')
@section('page_specific_css')

<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">


@endsection
@section('content')
<div class="contact-page-form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="contact-left">
                    <div class="social-medias">
                        <ul>
                            <li class="facebook"><a href="{{ $contact_social['facebook'] }}"><i class="icon-social-facebook"></i></a></li>
                            <li class="twitter"><a href="{{ $contact_social['twitter'] }}"><i class="icon-social-twitter"></i></a></li>
                            <li class="google"><a href="{{ $contact_social['google_plus'] }}"><i class="icon-social-google"></i></a></li>
                            <li class="instagram"><a href="{{ $contact_social['instragram'] }}"><i class="icon-social-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="contact-form">
                        <h2>Get in touch</h2>
                        <p>Call or message regarding issue or problem</p>
                        <form name="inquiry-form" id="inquiry-form">
                            <input type="hidden" name="contact_inquiry_id" class="contact_inquiry_id" value="{{$contact->id}}"/>
                            @csrf
                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="number" name="phone" class="form-control" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit"  class="btn btn-default sendMessage">Send message</button>
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

@section('page_specific_js')

<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function () {

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

        // Fomvalidation setup about us top section
      $('#inquiry-form').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

            $icon.on('click.clearing', function() {
                // Check if the field is valid or not via the icon class
                if ($icon.hasClass('fa fa-remove')) {
                    // Clear the field
                    data.fv.resetField(data.element);
                }
            });
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                'full_name': {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required'
                        }
                    }
                },
                'email': {
                    validators: {
                        notEmpty: {
                               message: 'The email is required'
                           },

                    }
                },
                'phone': {
                    validators: {
                        notEmpty: {
                               message: 'The phone is required'
                           },

                    }
                },
                'message': {
                    validators: {
                        notEmpty: {
                               message: 'The message is required'
                           },

                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();
            // find if the action is save or update

            var URI = "{{url('/contact/inquiry')}}";

            //var _token = $("input[name='_token']").val();
            //alert(_token);
            // get the input values
            var result = new FormData($("#inquiry-form")[0]);

            $.ajax({
            //make the ajax request to either add or update the
            url:URI,
            data:result,
            dataType:"Json",
            contentType: false,
            processData: false,
            type:"POST",
            success:function(data)
            {
                if(data.status == "success"){
                    //hide the modal
                  setTimeout(function()
                    {
                            swal({
                              title: "Inquiry Message  has been send to Quishi!",
                              text: "A  inquiry message has been send to Quishi",
                              type: "success",
                              closeOnConfirm: true,
                            }, function() {
                                window.location = "{{route('contact')}}";
                            });
                  }, 1000);
                  $('#inquiry-form')[0].reset();
                  $('#inquiry-form').data('formValidation').resetForm(true);


                }
            },
            error:function(event)
            {
                console.log('Cannot send inquiry message into the quishi system. Please try again later on..');
            }

          });
        });





   });
</script>
@endsection