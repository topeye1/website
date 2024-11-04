<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head>
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0">
        <meta http-equiv="Pragma" content="0">
        <title>Login</title>
        @include('layouts.header')
    </head>

    <body class="bg-gradient-primary my-body">
        <div class="container">

        <!-- Outer Row -->
            <div class="row justify-content-center">
                @yield('content')
            </div>

        </div>
        @include('layouts.footer-scripts')
    </body>
</html>
