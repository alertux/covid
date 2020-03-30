<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('layouts/partials/head')

    @yield('additional_css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="kt-page--loading-enabled kt-page--loading kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled kt-subheader--transparent kt-page--loading">

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                        @if (!$errors->isEmpty())
                        <div class="alert alert-light alert-elevate" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if (session('fail'))
                        <div class="alert alert-light alert-elevate" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                {{ session('fail') }}
                            </div>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-light alert-elevate" role="alert">
                            <div class="alert-icon"><i class="flaticon2-checkmark kt-font-brand"></i></div>
                            <div class="alert-text">
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif

                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>

            </div>
        </div>
    </div>

    @include('layouts/partials/foot')

    @yield('additional_js')

</body>
</html>
