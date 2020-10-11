<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/favicon.png')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<!-- ===== Bootstrap CSS ===== -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- ===== Plugin CSS ===== -->
<!-- ===== Animation CSS ===== -->
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<!-- ===== Custom CSS ===== -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- ===== Color CSS ===== -->
<link href="{{ asset('css/colors/red.css') }}" id="theme" rel="stylesheet">
<link href="{{ asset('plugins/components/bootstrap-sweetalert/dist/sweetalert.css') }}" rel="stylesheet">
</head>

<body class="mini-sidebar fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>


{{--  <nav class="pull-right navb navbar-">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
</nav> --}}

        
    <section id="wrapper" class="login-register">

        <div class="login-box">

            <div class="white-box">
                 <div class="text-center">
                    <h2>Imperial Hotel</h2>
                    <img width="30%" src="{{ asset('plugins/images/login.jpg') }}" alt="Login Image">
                </div>
                <form class="form-horizontal form-material" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
{{--                     <h3 class="box-title m-b-20">Authentication</h3> --}}
                    @if ($errors->has('email'))
                                    <span>
                    <strong style="color: red">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label for="email">Email Address:</label>
                            <input placeholder="Email Address" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="password">Password:</label>
                            <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input  name="remember" id="checkbox-signup" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                             </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </section>
    <!-- jQuery -->
 <script src="{{ asset ('plugins/components/jquery/dist/jquery.min.js') }}"></script>
<!-- ===== Bootstrap JavaScript ===== -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- ===== Slimscroll JavaScript ===== -->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!-- ===== Wave Effects JavaScript ===== -->
<script src="{{ asset('js/waves.js') }}"></script>
<!-- ===== Menu Plugin JavaScript ===== -->
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<!-- ===== Custom JavaScript ===== -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- ===== Plugin JS ===== -->
<!-- ===== Style Switcher JS ===== -->
<script src="{{ asset('plugins/components/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('plugins/components/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
@if (Session::has('logout'))

<script type="text/javascript">
   swal('Logout', "{{ Session::get('logout') }}", 'success');
</script>
@endif
</body>


</html>
