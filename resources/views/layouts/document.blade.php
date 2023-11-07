<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ URL::asset('theme/assets/css/print/dotmatrix.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/assets/css/print/paper.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/assets/css/print/basic.css') }}">
    <title>
        @yield('title')
    </title>

    @yield('styles')
    <style>
        .paper-a4 {
            height: initial;
        }
        header {
            position: relative;
            padding-bottom: 15px;
            border-bottom: solid 3px;
            margin-bottom: 2em;
        }
        header .logo-holder {
            position: absolute;
            top: 0px;
            left: 0px;
        }
        header .logo-holder img {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="paper-a4">
        @yield('content')
    </div>
</body>

{{-- <script src="/theme/libs/jquery/dist/jquery.min.js"></script> --}}
<script>
        window.print();
</script>
</html>
