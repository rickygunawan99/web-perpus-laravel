<!-- BEGIN: Vendor JS-->
{{--@vite([--}}
{{--    'public/assets/vendor/libs/jquery/jquery.js',--}}
{{--    'public/assets/vendor/libs/popper/popper.js',--}}
{{--    'public/assets/vendor/js/bootstrap.js',--}}
{{--    'public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',--}}
{{--    'public/assets/vendor/libs/node-waves/node-waves.js',--}}
{{--    'public/assets/vendor/libs/hammer/hammer.js',--}}
{{--    'public/assets/vendor/libs/typeahead-js/typeahead.js',--}}
{{--    'public/assets/vendor/js/menu.js',--}}
{{--])--}}

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>
{{--@vite('public/assets/js/main.js')--}}

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

