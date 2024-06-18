<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/client/assets/images/favicon.ico') }}">

    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">

    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/vendor/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/style.min.css') }}">


    @yield('styles')

</head>

<body>
    <div id="fui-toast"></div>

    <div class="main-wrapper">
        @include('client.layout.header')

        @yield('banner')

        <div class="section section-padding-02">
            <div class="container">
                @yield('content')
            </div>
        </div>

        @include('client.layout.footer')

    </div>
</body>
<!-- Modernizer & jQuery JS -->
<script src="{{ asset('theme/client/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
<script src="{{ asset('theme/client/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>

<script src="{{ asset('theme/client/assets/js/plugins.min.js') }}"></script>

<script type="text/javascript"
    src="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/js/toast@1.0.1/fuiToast.min.js"></script>

<script src="{{ asset('theme/client/assets/js/main.js') }}"></script>

@yield('scripts')

</html>
