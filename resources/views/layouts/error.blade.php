<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<!-- ===== Bootstrap CSS ===== -->
<link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- ===== Plugin CSS ===== -->
<!-- ===== Animation CSS ===== -->
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<!-- ===== Custom CSS ===== -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- ===== Color CSS ===== -->
<link href="{{ asset('css/colors/red.css') }}" id="theme" rel="stylesheet">

</head>



<body class="mini-sidebar fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
   @yield('content')
    <!-- jQuery -->
    <script src="{{ asset('plugins/components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    </script>
</body>

</html>
