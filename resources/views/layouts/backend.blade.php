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
<link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- ===== Plugin CSS ===== -->
 <link href="{{ asset('plugins/components/custom-select/custom-select.css') }}" rel="stylesheet">
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
<div id="wrapper">
<!-- ===== Top-Navigation ===== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
<a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
<i class="fa fa-bars"></i>
</a>
<div class="top-left-part">

<a class="logo" href="{{ url('/admin') }}">
<b>
<img src="{{ asset('plugins/images/logo.png') }}" alt="{{ config('custom.site_name')}}" />
</b>
<span style="font-weight: bolder;">
{{-- <img src="{{ asset('plugins/images/logo-text.png') }}" alt="homepage" class="dark-logo" /> --}}
{{ config('custom.site_name') }}
</span>
</a>

</div>

</div>
</nav>
<!-- ===== Top-Navigation-End ===== -->
<!-- ===== Left-Sidebar ===== -->
<aside class="sidebar">
<div class="scroll-sidebar">
<nav class="sidebar-nav">
<ul id="side-menu">
<li>
<a class="waves-effect" href="{{ url('/admin') }}" aria-expanded="false"><i class="fa fa-home"></i> <span class="hide-menu"> Dashboard </span></a>
</li>

@if(Auth::check() && Auth::user()->hasRole('admin'))

<li class="one-column">
<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-users"></i> <span class="hide-menu"> Manage Users</span></a>
<ul aria-expanded="false" class="collapse">

<li><a href="{{ url("/admin/users") }}">{{ __('Guest & Staff') }}</a></li>
<li><a href="{{ url("/admin/permissions") }}">{{ __('Permissions') }}</a></li>
<li><a href="{{ url("/admin/roles") }}">{{ __('Roles') }}</a></li>
</ul>
</li>


<li class="one-column">
<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-hotel"></i> <span class="hide-menu"> Manage Rooms</span></a>
<ul aria-expanded="false" class="collapse">

<li><a href="{{ url("/admin/rooms") }}">{{ __('Rooms') }}</a></li>
<li><a href="{{ url("/admin/roomtypes") }}">{{ __('Room Category') }}</a></li>
<li><a href="{{ url("/admin/facilities") }}">{{ __('Room Facilities') }}</a></li>
</ul>
</li>


<li class="one-column">
<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-cutlery"></i> <span class="hide-menu"> Manage Menus</span></a>
<ul aria-expanded="false" class="collapse">

<li><a href="{{ url("/admin/menus") }}">{{ __('Food & Drink') }}</a></li>
<li><a href="{{ url("/admin/menutypes") }}">{{ __('Food & Drink Categories') }}</a></li>
<li><a href="{{ url("/admin/menuorders") }}">{{ __('Food & Drink Orders') }}</a></li>
<li><a href="{{ url("/admin/services") }}">{{ __('Extra Services') }}</a></li>
<li><a href="{{ url("/admin/serviceorders") }}">{{ __('Services Order') }}</a></li>
</ul>
</li>


<li class="one-column">
<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-calendar"></i> <span class="hide-menu"> Manage Bookings</span></a>
<ul aria-expanded="false" class="collapse">

<li><a href="{{ url("/admin/bookings") }}">{{ __('Manage Bookings') }}</a></li>
<li><a href="{{ url("/admin/paymenttypes") }}">{{ __('Payment Types') }}</a></li>
</ul>
</li>

<li>
<a class="active waves-effect" href="{{ url('#') }}" aria-expanded="false"><i class="fa fa-cog"></i> <span class="hide-menu"> Settings </span></a>
</li>

@endif
@if (Auth::user()->hasRole('chef'))
<li>
<a class="waves-effect" href="{{ url("admin/menus") }}">
<i class="fa fa-money"></i>
{{ __('Manage Food/Drink Menu') }}
</a>
</li>
<li>
<a class="waves-effect" href="{{ url("admin/menutypes") }}">
<i class="fa fa-sign-out"></i>
{{ __('Manage Food Catergory') }}
</a>
</li>
<li>
<a class="waves-effect" href="{{ url("admin/menuorders") }}">
<i class="fa fa-money"></i>
{{ __('Manage Menu Order') }}
</a>
</li>
<li>
<a class="waves-effect" href="{{ url("admin/menuorders/create") }}">
<i class="fa fa-sign-out"></i>
{{ __('Place Food/Drink Order') }}
</a>
</li>
@endif

    <li class="pull-right">
<a class="waves-effect" href="javascript:;"
                                       onclick="confirmLogout()">
                                      <i class="fa fa-sign-out"></i>  Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
    </li>
<li class="pull-right"><a href="#" class="waves-effect">Today is {{ date('F d, Y') }}</a></li>

</ul>

</nav>
</div>
</aside>
<!-- Page Content -->

        @if ( ! request()->is('admin'))
        <div class="page-wrapper">
            <div class="container-fluid">
         @endif
<!-- ===== Left-Sidebar-End ===== -->
@yield('content')

</div>
<!-- /.container-fluid -->
<footer class="footer t-a-c"> &copy; {{ date('Y') }}. Powered by <a href="https://kodehauz.com" target="_blank">KodeHauz Solution Planet</a>
</footer>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- ==============================
Required JS Files
=============================== -->
<!-- ===== jQuery ===== -->
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

<script src="{{ asset('plugins/components/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('plugins/components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/components/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
<!-- ===== Style Switcher JS ===== -->
@yield('scripts')
<script>
        jQuery(document).ready(function() {
            // For select 2
            $(".select2").select2();
        });
        </script>

    <script type="text/javascript">
        $( document ).ready(function() {
            let i = 0;
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                i++;
                let menuItemName = $('#menu-item option:selected').text();
                let menuItemValue = $('#menu-item').val();
                let guestId = $('#guest_id').val();
                let quanityName = $('#quantity option:selected').text();
                let quantityValue = $('#quantity').val();
                let  menuTable= $('#menu-item-table tr:last');
                 if(guestId == ''){
                   alert('Please! Select a guest requesting for this item');
                }
                else if(menuItemValue == ''){
                   alert('Please! Select an item from the list of food/Drink');
                }

                else if(quantityValue == ''){
                   alert('Please! Select a quantity for your item.');
                }
                else {
                    $('#menu-order-table').show();
                menuTable.after(`<tr id='row${i}'>
                    <td>${i}</td>
                    <td>${menuItemName}<input name='menus[]' value='${menuItemValue}' type='hidden' /></td>
                    <td>${quanityName} <input name='quantity[]' value='${quantityValue}' type='hidden' /></td>
                    <td>
                    <button class="btn_remove btn-danger" id='${i}'> <i class="fa fa-close"></i> Remove</button>
                    </td>
                    </tr>`);

                // success fading in and out
                $("#added-item").fadeIn();
                $('#added-item').fadeOut(4000);
                //fading ends
            }
                $(document).on('click', '.btn_remove', function(){
                        var btn_id = $(this).attr("id");
                    $('#row'+btn_id).remove();
                    e.preventDefault();
                return false;
                });


             });

        });
    </script>
<script>
        function confirmLogout(){
    swal({
        title: "Are you sure?",
        text: "You are about to logout of your account",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        closeOnConfirm: false,
    },
    function(){
        document.getElementById('logout-form').submit();
        //window.location.href="{{ url('/logout') }}";
    }
    );
}
//end of function
    </script>


<script src="{{ asset('plugins/components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>
