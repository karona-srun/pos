<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: white !important;
            transition: none !important;
        }

        .center-screen {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
        }
    </style>
</head>

<body class="bg-white">
    <div class="center-screen">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1>@yield('code') | @yield('title')</h1>
                        <a href="{{ url()->previous() }}" class=" mt-2 btn btn-outline-danger">
                            <i class="fas fa-arrow-left mr-2"></i> Go back to the previous page
                        </a>
                        <hr class="mt-4 mb-1">
                        <p>@yield('message')</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}'"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
