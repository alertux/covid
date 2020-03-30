<meta charset="utf-8" />
<meta name="description" content="Login page ">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->

<!--begin::Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
<!--end::Fonts -->

<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles -->

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

<!--begin::Layout Skins(used by all pages) -->
<!--end::Layout Skins -->
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />