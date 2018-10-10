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
<img src="{{ asset('plugins/images/logo.png') }}" alt="home" />
</b>
<span style="font-weight: bolder;">
{{-- <img src="{{ asset('plugins/images/logo-text.png') }}" alt="homepage" class="dark-logo" /> --}}
Kokoon Hotels
</span>
</a>

</div>

<ul class="nav navbar-top-links navbar-left hidden-xs">
<li>

{{-- <form role="search" class="app-search hidden-xs">
<i class="icon-magnifier"></i>
<input type="text" placeholder="Search..." class="form-control">
</form> --}}
</li>
</ul>
<ul class="nav navbar-top-links navbar-right pull-right">
<li class="dropdown">
{{-- <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
<i class="icon-speech"></i>
<span class="badge badge-xs badge-danger">6</span>
</a> --}}
<ul class="dropdown-menu mailbox animated bounceInDown">
<li>
<div class="drop-title">You have 4 new messages</div>
</li>
<li>
<div class="message-center">
    <a href="javascript:void(0);">
        <div class="user-img">
            <img src="plugins/images/users/1.jpg" alt="user" class="img-circle">
            <span class="profile-status online pull-right"></span>
        </div>
        <div class="mail-contnet">
            <h5>Pavan kumar</h5>
            <span class="mail-desc">Just see the my admin!</span>
            <span class="time">9:30 AM</span>
        </div>
    </a>
    <a href="javascript:void(0);">
        <div class="user-img">
            <img src="plugins/images/users/2.jpg" alt="user" class="img-circle">
            <span class="profile-status busy pull-right"></span>
        </div>
        <div class="mail-contnet">
            <h5>Sonu Nigam</h5>
            <span class="mail-desc">I've sung a song! See you at</span>
            <span class="time">9:10 AM</span>
        </div>
    </a>
    <a href="javascript:void(0);">
        <div class="user-img">
            <img src="plugins/images/users/3.jpg" alt="user" class="img-circle"><span class="profile-status away pull-right"></span>
        </div>
        <div class="mail-contnet">
            <h5>Arijit Sinh</h5>
            <span class="mail-desc">I am a singer!</span>
            <span class="time">9:08 AM</span>
        </div>
    </a>
    <a href="javascript:void(0);">
        <div class="user-img">
            <img src="plugins/images/users/4.jpg" alt="user" class="img-circle">
            <span class="profile-status offline pull-right"></span>
        </div>
        <div class="mail-contnet">
            <h5>Pavan kumar</h5>
            <span class="mail-desc">Just see the my admin!</span>
            <span class="time">9:02 AM</span>
        </div>
    </a>
</div>
</li>
<li>
<a class="text-center" href="javascript:void(0);">
    <strong>See all notifications</strong>
    <i class="fa fa-angle-right"></i>
</a>
</li>
</ul>
</li>
<li class="dropdown">
{{-- <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
<i class="icon-calender"></i>
<span class="badge badge-xs badge-danger">3</span>
</a> --}}
<ul class="dropdown-menu dropdown-tasks animated slideInUp">
<li>
<a href="javascript:void(0);">
    <div>
        <p>
            <strong>Task 1</strong>
            <span class="pull-right text-muted">40% Complete</span>
        </p>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
    </div>
</a>
</li>
<li class="divider"></li>
<li>
<a href="javascript:void(0);">
    <div>
        <p>
            <strong>Task 2</strong>
            <span class="pull-right text-muted">20% Complete</span>
        </p>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                <span class="sr-only">20% Complete</span>
            </div>
        </div>
    </div>
</a>
</li>
<li class="divider"></li>
<li>
<a href="javascript:void(0);">
    <div>
        <p>
            <strong>Task 3</strong>
            <span class="pull-right text-muted">60% Complete</span>
        </p>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                <span class="sr-only">60% Complete (warning)</span>
            </div>
        </div>
    </div>
</a>
</li>
<li class="divider"></li>
<li>
<a href="javascript:void(0);">
    <div>
        <p>
            <strong>Task 4</strong>
            <span class="pull-right text-muted">80% Complete</span>
        </p>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="sr-only">80% Complete (danger)</span>
            </div>
        </div>
    </div>
</a>
</li>
<li class="divider"></li>
<li>
<a class="text-center" href="javascript:void(0);">
    <strong>See All Tasks</strong>
    <i class="fa fa-angle-right"></i>
</a>
</li>
</ul>
</li>
<li class="right-side-toggle">
{{-- <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="javascript:void(0)">
<i class="icon-settings"></i>
</a> --}}
</li>
</ul>
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
<li>
<a href="#" class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-user"></i> <span class="hide-menu"> Manage Users</span></a>

{{--
<a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-equalizer fa-fw"></i> <span class="hide-menu"> UI Elements</span></a>
<ul aria-expanded="false" class="collapse">
<li><a href="panels-wells.html">Panels and Wells</a></li>
<li><a href="panel-ui-block.html">Panels With BlockUI</a></li>
<li><a href="portlet-draggable.html">Draggable Portlet</a></li>
<li><a href="buttons.html">Buttons</a></li>
<li><a href="tabs.html">Tabs</a></li>
<li><a href="modals.html">Modals</a></li>
<li><a href="progressbars.html">Progress Bars</a></li>
<li><a href="notification.html">Notifications</a></li>
<li><a href="carousel.html">Carousel</a></li>
<li><a href="user-cards.html">User Cards</a></li>
<li><a href="timeline.html">Timeline</a></li>
<li><a href="timeline-horizontal.html">Horizontal Timeline</a></li>
<li><a href="range-slider.html">Range Slider</a></li>
<li><a href="ribbons.html">Ribbons</a></li>
<li><a href="steps.html">Steps</a></li>
<li><a href="session-idle-timeout.html">Session Idle Timeout</a></li>
<li><a href="session-timeout.html">Session Timeout</a></li>
<li><a href="bootstrap.html">Bootstrap UI</a></li>
</ul>--}}

</li>
<li class="two-column">
<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-users"></i> <span class="hide-menu"> Administration Menu</span></a>
<ul aria-expanded="false" class="collapse">

@if($navigations)
@foreach($navigations as $menu)
<li>
<a href="{{ url($menu->url) }}">
    {{ $menu->name }}

</a>
</li>
@endforeach
@endif
</ul>
</li>

{{-- <li>
<a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Forms </span></a>
<ul aria-expanded="false" class="collapse">
<li><a href="form-basic.html">Basic Forms</a></li>
<li><a href="form-layout.html">Form Layout</a></li>
<li><a href="icheck-control.html">Icheck Control</a></li>
<li><a href="form-advanced.html">Form Addons</a></li>
<li><a href="form-upload.html">File Upload</a></li>
<li><a href="form-dropzone.html">File Dropzone</a></li>
<li><a href="form-pickers.html">Form-pickers</a></li>
</ul>
</li> --}}
{{-- <li>
<a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> Tables</span></a>
<ul aria-expanded="false" class="collapse">
<li><a href="basic-table.html">Basic Tables</a></li>
<li><a href="table-layouts.html">Table Layouts</a></li>
<li><a href="data-table.html">Data Table</a></li>
<li><a href="bootstrap-tables.html">Bootstrap Tables</a></li>
<li><a href="responsive-tables.html">Responsive Tables</a></li>
<li><a href="editable-tables.html">Editable Tables</a></li>
</ul>
</li> --}}
{{-- <li>
<a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-layers fa-fw"></i> <span class="hide-menu"> Extra</span></a>
<ul aria-expanded="false" class="collapse">
<li>
    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Inbox </span></a>
    <ul aria-expanded="false" class="collapse">
        <li> <a href="inbox.html">Mail Box</a> </li>
        <li> <a href="inbox-detail.html">Mail Details</a> </li>
        <li> <a href="compose.html">Compose Mail</a> </li>
        <li> <a href="contact.html">Contact</a> </li>
        <li> <a href="contact-detail.html">Contact Detail</a> </li>
    </ul>
</li>
<li>
    <a href="calendar.html" aria-expanded="false"><span class="hide-menu">Calendar</span></a>
</li>
<li>
    <a href="widgets.html" aria-expanded="false"><span class="hide-menu"> Widgets </span></a>
</li>
<li>
    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Charts</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="morris-chart.html">Morris Chart</a></li>
        <li><a href="peity-chart.html">Peity Charts</a></li>
        <li><a href="knob-chart.html">Knob Charts</a></li>
        <li><a href="sparkline-chart.html">Sparkline charts</a></li>
    </ul>
</li>
<li>
    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Icons</span></a>
    <ul aria-expanded="false" class="collapse">
        <li> <a href="simple-line.html">Simple Line</a> </li>
        <li> <a href="fontawesome.html">Fontawesome</a> </li>
    </ul>
</li>
<li>
    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Maps</span></a>
    <ul aria-expanded="false" class="collapse">
        <li> <a href="map-google.html">Google Map</a> </li>
        <li> <a href="map-vector.html">Vector Map</a> </li>
    </ul>
</li>
</ul>
</li> --}}
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
<a class="waves-effect" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
                @if (Session::has('flash_message'))
                <div class="container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
            @endif
<!-- ===== Left-Sidebar-End ===== -->
@yield('content')
<!-- ===== Right-Sidebar ===== -->
<div class="right-sidebar">
<div class="slimscrollright">
<div class="rpanel-title"> Service Panel <span><i class="icon-close right-side-toggler"></i></span> </div>
<div class="r-panel-body">
<ul id="themecolors" class="m-t-20">
<li><b>With Light sidebar</b></li>
<li><a href="javascript:void(0)" data-theme="default" class="default-theme working">1</a></li>
<li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
<li><a href="javascript:void(0)" data-theme="yellow" class="yellow-theme">3</a></li>
<li><a href="javascript:void(0)" data-theme="red" class="red-theme">4</a></li>
<li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
<li><a href="javascript:void(0)" data-theme="black" class="black-theme">6</a></li>
<li class="db"><b>With Dark sidebar</b></li>
<li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
<li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
<li><a href="javascript:void(0)" data-theme="yellow-dark" class="yellow-dark-theme">9</a></li>
<li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">10</a></li>
<li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
<li><a href="javascript:void(0)" data-theme="black-dark" class="black-dark-theme">12</a></li>
</ul>
<ul class="m-t-20 chatonline">
<li><b>Chat option</b></li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
</li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
</li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
</li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
</li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
</li>
<li>
    <a href="javascript:void(0)"><img src="../plugins/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
</li>
</ul>
</div>
</div>
</div>
<!-- ===== Right-Sidebar-End ===== -->
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
                    <td>${quanityName} <input name='quantities[]' value='${quantityValue}' type='hidden' /></td>
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

                // var tableFields = $('.table-fields'),
                //     currentEntry = $(this).parents('.entry:first'),
                //     newEntry = $(currentEntry.clone()).appendTo(tableFields);

                //newEntry.find('option').val('');
                // tableFields.find('.entry:not(:last) .btn-add')
                //     .removeClass('btn-add').addClass('btn-remove')
                //     .removeClass('btn-success').addClass('btn-danger')
                //     .html('<span class="fa fa-minus"></span>');
            // }).on('click', '.btn-remove', function(e) {
            //     $(this).parents('.entry:first').remove();

            //     e.preventDefault();
            //     return false;
             });

        });
    </script>

<script src="{{ asset('plugins/components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>
