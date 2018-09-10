    </div>
    </div>

    </div>
    </div>
    
    <!-- Required Jquery -->
    <script type="text/javascript" src=" {{ asset('/admin/bower_components/jquery/js/jquery.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('/admin/bower_components/modernizr/js/modernizr.js') }}"></script>
    

    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('/admin/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
    <!-- Custom js -->
    
    <script type="text/javascript" src="{{ asset('/admin/assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/demo-12.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/admin/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/admin/assets/js/script.js') }}"></script>
    

    @yield('page_specific_js')
</body>

</html>
