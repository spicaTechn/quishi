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
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 631.86 458.71">
  <title>Untitled-1</title>
  <g>
    <ellipse cx="338.85" cy="370.93" rx="136.99" ry="18.74" fill="#8bc43f"/>
    <g>
      <line x1="85.68" y1="400.81" x2="85.68" y2="400.81" fill="none" stroke="#8bc43f" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
      <path d="M135.67,434.1a103.89,103.89,0,0,1-45.79-65c-2.23-10.16-2.39-22.24,5-29.36,8-7.61,25.76-1,20.91,10.66a13.1,13.1,0,0,1-6.12,6.43c-21.88,11.47-48.12-9.51-50.91-33.53-2.64-22.78,10.6-44.81,27.72-59.62s38-24.17,57.37-35.68,38.29-26.28,47.25-47.3,4.58-49.38-14.67-61.13c-10.1-6.17-27.58-3-27.7,9-.11,11.08,14.11,15.53,24.92,14.76,29.44-2.1,56.36-17.56,80.37-35.11s46.48-37.67,72.77-51.38,58-20.43,85.4-9.31c8.27,3.35,17.14,11.17,14.4,19.82-3,9.36-18.44,8.24-22.29-.77s2.16-19.94,10.74-24.37,18.77-3.88,28.27-2.42C503.28,49,557,92.75,579.14,150.44c3.85,10,6.8,21.51.54,31.07a13.87,13.87,0,0,1-14.59,6.27c-11.14-2.57-10.48-17.24-2.84-22.75,6.3-4.54,15.33-3.47,21.73.91s10.58,11.47,13.57,18.74c9.14,22.16,9,47,11,70.94s7.19,49.39,24,66.21c7.12,7.12,17.06,12.49,26.83,10.48,5.49-1.13,10.32-5.42,12.63-10.53,2.11-4.68-4.8-7.94-7-3.33-3.16,6.47-4.22,14.22-3.81,21.53.63,11.24,4.14,22.08,6,33.18,5.32,32.59-5.1,67.44-27.15,91.55" transform="translate(-56.96 -37.24)" fill="none" stroke="#8bc43f" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" stroke-dasharray="0 8.02"/>
      <line x1="580.23" y1="430.37" x2="580.23" y2="430.37" fill="none" stroke="#8bc43f" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
    </g>
    <g>
      <rect x="351.37" y="336.27" width="103.11" height="68.41" transform="translate(-57.84 -36.29) rotate(-0.14)" fill="#e2b52a"/>
      <polygon points="345.8 259.4 294.33 299.15 397.44 298.9 345.8 259.4" fill="#e2b52a"/>
      <g>
        <rect x="361.16" y="305.62" width="83.46" height="99.06" transform="translate(-57.8 -36.29) rotate(-0.14)" fill="#fff6db"/>
        <path d="M435.9,318.16l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.16a1.78,1.78,0,0,1,0,3.56Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
        <path d="M435.92,328.07l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.17a1.79,1.79,0,0,1,0,3.57Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
        <path d="M436,338l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.16a1.78,1.78,0,0,1,0,3.56Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
        <path d="M436,347.88l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.17a1.79,1.79,0,0,1,0,3.57Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
        <path d="M436,357.78l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.16a1.78,1.78,0,0,1,0,3.56Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
        <path d="M436,367.69l-68.39.16a1.78,1.78,0,0,1,0-3.56l68.39-.17a1.79,1.79,0,0,1,0,3.57Z" transform="translate(-56.96 -37.24)" fill="#e3dac3"/>
      </g>
      <polygon points="331.41 367.47 294.49 367.56 294.33 299.15 331.35 340.39 331.41 367.47" fill="#ffcc31"/>
      <polygon points="360.67 367.4 397.6 367.32 397.44 298.9 360.61 340.32 360.67 367.4" fill="#ffcc31"/>
      <polygon points="294.49 367.56 331.35 340.39 360.61 340.32 397.6 367.32 294.49 367.56" fill="#ffda70"/>
    </g>
    <g>
      <ellipse cx="581.24" cy="397.65" rx="50.6" ry="51.76" fill="#e4eebb"/>
      <path d="M653.2,452.67a27.69,27.69,0,0,1-12.44,6.49c-12.16,3.18-24.74-3.23-28.38-17.79-3.91-15.62,3.32-31.89,19.78-36.2,12.9-3.37,23.88,3.61,27.05,16.28,2.84,11.37-1.71,19.68-8.68,21.5-3,.77-6.22-.55-7.16-5.24l-.29.08c-1.48,5.15-4.34,8.24-8.79,9.41-4.3,1.12-8.9-1.47-10.39-7.47-2.36-9.4,2.77-19.87,13.07-22.56a19.75,19.75,0,0,1,8.33-.49l.91,14.39c.33,6.05,1.89,8.48,4.35,7.91,3.8-.91,6.74-7.18,4.54-16-2.75-11-11.17-17.2-22.66-14.19-12.09,3.16-19.8,15.6-16,31,3.17,12.67,13.2,18.37,24.17,15.5a23.7,23.7,0,0,0,10.53-5.59ZM640.93,421a12.92,12.92,0,0,0-3.84.44c-6.53,1.7-10.21,9.38-8.38,16.73.84,3.34,3.08,5.34,6.34,4.48,4.3-1.12,6.82-7.76,6.46-12.67Z" transform="translate(-56.96 -37.24)" fill="#f48055"/>
    </g>
    <g>
      <ellipse cx="72.64" cy="202.08" rx="56.02" ry="57.3" fill="#e4eebb"/>
      <g>
        <path d="M152.33,201.69l-48.1,9.05A15.6,15.6,0,0,0,92,228.92l4.44,24.66a15.28,15.28,0,0,0,17.76,12.52l37.25-7,14.42,10.17-2.25-12.53a15.63,15.63,0,0,0,10.93-17.86l-4.44-24.66A15.27,15.27,0,0,0,152.33,201.69Z" transform="translate(-56.96 -37.24)" fill="#d2a72b"/>
        <path d="M157.61,233.91l-4.44-24.66a15.53,15.53,0,0,0-3.24-7.11l-45.7,8.6A15.6,15.6,0,0,0,92,228.92l4.44,24.66a15.56,15.56,0,0,0,8,11l3.72-5.52,37.24-7A15.58,15.58,0,0,0,157.61,233.91Z" transform="translate(-56.96 -37.24)" fill="#b4902f"/>
        <path d="M83.09,201.81l48.1-9.06A15.29,15.29,0,0,1,149,205.27l4.44,24.66a15.6,15.6,0,0,1-12.25,18.18l-37.24,7L94,269.87l-2.25-12.52a15.31,15.31,0,0,1-16.43-12.71L70.85,220A15.58,15.58,0,0,1,83.09,201.81Z" transform="translate(-56.96 -37.24)" fill="#ffcc31"/>
      </g>
    </g>
    <g>
      <ellipse cx="81.16" cy="403.03" rx="54.42" ry="55.67" fill="#e4eebb"/>
      <g>
        <g>
          <path d="M131.24,403.92a36.27,36.27,0,0,0-26.16,21.25c.41.28.83.55,1.25.81a36.36,36.36,0,0,0,3.9,2.19,20.54,20.54,0,0,0,4.54,1.4,25.43,25.43,0,0,1,48.48,5.73,26.39,26.39,0,0,1-12.59,27.8,5.92,5.92,0,0,1,1.54,1.72,11.93,11.93,0,0,1,1.46,6.89,11.35,11.35,0,0,1-.47,2.23,37.25,37.25,0,0,0,20.47-40.7C169.86,413.16,150.87,400,131.24,403.92Z" transform="translate(-56.96 -37.24)" fill="#6dcff5"/>
          <polygon points="45.2 377.76 66.93 392.78 48.73 396.39 45.2 377.76" fill="#6dcff5"/>
          <g>
            <path d="M121.35,457.35,121,455.5l1.88-2.75c4.54-6.52,6.51-9.9,5.9-13.27-.42-2.26-1.89-4.14-5.14-3.49a7.5,7.5,0,0,0-4.27,2.8L118,436.85a9.7,9.7,0,0,1,5.74-3.49c4.69-.92,7.29,2,7.89,5.16.78,4.12-1.51,8-5.24,13.46L125,454V454l9.79-1.94.47,2.5Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
            <path d="M147.66,452.15l-1.15-6.07-10.12,2-.37-2,7-16.15,3.19-.63,2.62,13.85,3.05-.6.44,2.36-3.05.61,1.15,6.07Zm-1.59-8.44-1.41-7.44c-.22-1.16-.41-2.34-.56-3.52l-.1,0c-.43,1.43-.78,2.5-1.19,3.65l-3.9,8.63,0,.07Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
          </g>
        </g>
        <g>
          <path d="M132,457.18l.36,1.9,2.14-.43-.35-1.9.57-.11.86,4.54-.58.11-.4-2.12-2.14.42.4,2.13-.57.11-.86-4.54Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
          <path d="M139.09,458.76a1.62,1.62,0,0,1-1.26,2,1.54,1.54,0,0,1-1.84-1.37,1.62,1.62,0,0,1,1.25-2A1.54,1.54,0,0,1,139.09,458.76Zm-2.52.53c.14.72.64,1.17,1.21,1.06s.86-.72.72-1.45c-.1-.56-.5-1.2-1.19-1.07S136.46,458.67,136.57,459.29Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
          <path d="M142.63,458.85c.06.34.13.64.19.89l-.51.1-.13-.53h0a1.22,1.22,0,0,1-.93.81c-.5.1-1.15-.06-1.37-1.21l-.36-1.9.58-.12.34,1.81c.12.61.38,1,.91.89a.86.86,0,0,0,.66-.69,1.1,1.1,0,0,0,0-.31l-.38-2,.58-.12Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
          <path d="M143.33,457.31c-.07-.38-.14-.71-.21-1l.5-.1.14.64h0a1,1,0,0,1,.74-.89h.17l.11.56a.75.75,0,0,0-.2,0,.83.83,0,0,0-.63.91,1.37,1.37,0,0,0,0,.28l.33,1.74-.57.11Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
          <path d="M145.71,458.54a1.51,1.51,0,0,0,.81.08c.42-.08.58-.33.53-.6s-.25-.41-.71-.49c-.61-.09-.94-.36-1-.75a1,1,0,0,1,.91-1.18,1.63,1.63,0,0,1,.82,0l-.06.46a1.29,1.29,0,0,0-.69-.06c-.34.07-.49.31-.44.55s.26.35.71.43.92.34,1,.82-.25,1.06-1,1.21a1.77,1.77,0,0,1-.93,0Z" transform="translate(-56.96 -37.24)" fill="#11aee5"/>
        </g>
      </g>
    </g>
    <g>
      <ellipse cx="510.36" cy="125.78" rx="46.14" ry="47.2" fill="#e4eebb"/>
      <g>
        <g>
          <path d="M537.67,155.54l-.38.28a20.07,20.07,0,0,0-3.91,3.9l1.56,2.65a17.28,17.28,0,0,0-2.08,4.36l-3.06.65a20.73,20.73,0,0,0-.53,5.72l2.86,1a17.78,17.78,0,0,0,1.41,5.2l-1.9,2.47a22.75,22.75,0,0,0,1.48,2.37,20.61,20.61,0,0,0,1.78,2.14l2.86-1.13a17.07,17.07,0,0,0,4.45,2.91l.09,3.09a19.58,19.58,0,0,0,5.49,1.17l1.52-2.8a16.35,16.35,0,0,0,4.68-.75l2,2.3a19.57,19.57,0,0,0,4.79-2.67l.38-.3-.61-3.18a17.25,17.25,0,0,0,2.57-3l3,.44a20.28,20.28,0,0,0,2.26-6l-2.47-2A18.08,18.08,0,0,0,566,171l2.62-1.67A20.3,20.3,0,0,0,566.7,163l-3.14.06c-.26-.42-.53-.84-.83-1.25s-.6-.8-.92-1.17l1-3.06a19.66,19.66,0,0,0-5.36-3.77l-2.33,2.07A16.59,16.59,0,0,0,552,155l-1.18-3a19.2,19.2,0,0,0-6.27.44l-.48,3.07a16.69,16.69,0,0,0-3.6,1.61Zm20.91,9.37a12.32,12.32,0,0,1-2.49,17,11.69,11.69,0,0,1-16.59-2.55,12.32,12.32,0,0,1,2.5-17A11.68,11.68,0,0,1,558.58,164.91Z" transform="translate(-56.96 -37.24)" fill="#ffcc31"/>
          <path d="M561,163.1a14.62,14.62,0,0,0-20.75-3.19,15.39,15.39,0,0,0-3.12,21.21,14.61,14.61,0,0,0,20.74,3.2A15.41,15.41,0,0,0,561,163.1Zm-4.89,18.77a11.69,11.69,0,0,1-16.59-2.55,12.32,12.32,0,0,1,2.5-17,11.68,11.68,0,0,1,16.58,2.56A12.32,12.32,0,0,1,556.09,181.87Z" transform="translate(-56.96 -37.24)" fill="#edbd29"/>
        </g>
        <g>
          <path d="M569.74,130.84l-.39.29a20.07,20.07,0,0,0-3.91,3.9l1.56,2.64a17.63,17.63,0,0,0-2.08,4.36l-3.06.66a21,21,0,0,0-.52,5.71l2.86,1a17.56,17.56,0,0,0,1.41,5.2l-1.9,2.46a19.43,19.43,0,0,0,1.47,2.37,20.82,20.82,0,0,0,1.78,2.14l2.87-1.13a16.61,16.61,0,0,0,4.44,2.91l.1,3.09a19.23,19.23,0,0,0,5.49,1.17l1.51-2.8a16.76,16.76,0,0,0,4.69-.74l2,2.3a20.06,20.06,0,0,0,4.79-2.67l.39-.3-.61-3.19a17.13,17.13,0,0,0,2.56-3l3,.44a20.49,20.49,0,0,0,2.26-6L598,149.57a18.07,18.07,0,0,0,.09-3.29l2.63-1.67a20.7,20.7,0,0,0-2-6.34l-3.15.06a14.94,14.94,0,0,0-.82-1.25c-.29-.41-.6-.8-.93-1.18l1-3.05a19.44,19.44,0,0,0-5.35-3.78l-2.33,2.08a16.19,16.19,0,0,0-3.11-.88l-1.18-3a19.52,19.52,0,0,0-6.27.44l-.47,3.07a16.75,16.75,0,0,0-3.6,1.61Zm20.91,9.37a12.31,12.31,0,0,1-2.5,17,11.68,11.68,0,0,1-16.58-2.55,12.32,12.32,0,0,1,2.49-17A11.69,11.69,0,0,1,590.65,140.21Z" transform="translate(-56.96 -37.24)" fill="#ffcc31"/>
          <path d="M593,138.4a14.61,14.61,0,0,0-20.74-3.19,15.41,15.41,0,0,0-3.13,21.22,14.62,14.62,0,0,0,20.75,3.19A15.4,15.4,0,0,0,593,138.4Zm-4.89,18.77a11.68,11.68,0,0,1-16.58-2.55,12.32,12.32,0,0,1,2.49-17,11.69,11.69,0,0,1,16.59,2.55A12.31,12.31,0,0,1,588.15,157.17Z" transform="translate(-56.96 -37.24)" fill="#edbd29"/>
        </g>
      </g>
    </g>
  </g>
</svg>

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