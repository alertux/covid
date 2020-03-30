<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Login page ">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('assets/css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="kt-page--loading-enabled kt-page--loading kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    
    @yield('content')

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#3d94fb",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#3d94fb",
                    "warning": "#ffb822",
                    "danger": "#fd27eb"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/login.js')}}" type="text/javascript"></script>
    <!--end::Page Scripts -->

</body>
</html>
