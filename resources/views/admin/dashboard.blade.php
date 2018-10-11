@extends('layouts.backend')

@section('content')
     <!-- Page Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row colorbox-group-widget">
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-primary">
                                <div class="media-body">
                                    <h3 class="info-count">
                                @if (isset($bookings_today))
                                {{ count($bookings_today) }}
                                @endif
                                        <span class="pull-right"><i class="mdi mdi-account-star"></i></span></h3>
                                    <p class="info-text font-12">Bookings Today</p>
                                    {{-- <p class="info-ot font-15">Today's Date<span class="label label-rounded">{{ date('F d, Y') }}</span></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-success">
                                <div class="media-body">
                                    <h3 class="info-count">
                            @if (isset($rooms))
                            {{ count($rooms) }}
                            @endif
                                        <span class="pull-right"><i class="mdi mdi-home"></i></span></h3>
                                    <p class="info-text font-12">Available Rooms</p>
                                    {{-- <p class="info-ot font-15">Today's Date<span class="label label-rounded">{{ date('F d, Y') }}</span></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-danger">
                                <div class="media-body">
                                    <h3 class="info-count">
                                @if (isset($menuorders))
                            {{ count($menuorders) }}
                            @endif
                                     <span class="pull-right"><i class="mdi mdi-food"></i></span></h3>
                                    <p class="info-text font-12">Total Food&Drinks Order Today</p>
                                    {{-- <p class="info-ot font-15">Today's Date<span class="label label-rounded">{{ date('F d, Y') }}</span></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-warning">
                                <div class="media-body">
                                    <h3 class="info-count">₦{{ $total_income}}.00<span class="pull-right"><i class="mdi mdi-cash"></i></span></h3>
                                    <p class="info-text font-12">Income Today</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CALL TO ACTION BUTTONS --}}
            @if (Auth::user()->hasRole('receptionist'))
                <div class="text-center" style="margin-bottom: 10px">
                        <a style="margin-right: 10px; font-weight: bolder;" class="btn btn-primary btn-lg" href="{{ url('/admin/users/create?type=guest') }}">Register a Guest</a>

                        <a style="margin-right: 10px; font-weight: bolder;" class="btn btn-success btn-lg" href="{{ url('/admin/bookroom') }}">Check-in Guest</a>
                        <a style=" margin-right: 10px; font-weight: bolder;" class="btn btn-danger btn-lg" href="{{ url('/admin/bookings') }}">Room Transfer</a>
                        <a style="font-weight: bolder;" class="btn btn-primary btn-lg" href="{{ url('/admin/checkout') }}">Check-out Guest</a>
                    </div>
@endif
        {{-- Recent added guest comes in here --}}
         <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box user-table">
                            <div class="row">

                @if (Session::has('booked_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed', "{{ Session::get('booked_message') }}", 'success');
                                </script>
                    @endsection
                @endif
                                <div class="col-sm-6">
                                    <h4 class="box-title">Recently Checked-In Guest Log</h4>
                                </div>
                                <div class="col-sm-6">
                        @if(Auth::user()->hasRole('receptionist'))
                                    <ul class="list-inline">
                                        <li>

                                        <a title="New Booking" href="{{ url('admin/bookroom')}}" class="btn btn-success pull-right m-t-10 font-20">+</a>
                                        &nbsp; &nbsp;
                                        <a title="New Guest" href="{{ url('/admin/users/create?type=guest') }}" class="btn btn-success pull-right m-t-10 font-20"><span class="fa fa-user"></span></a>
                                        </li>

                                    </ul>
@endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                             S/N
                                            </th>
                                            <th>Name</th>
                                            <th>Room Name</th>
                                            <th>Role</th>
                                            <th>Date Checked-In</th>
                                            <th>Checkeded-In By</th>
                                            <th>Date Checked-out</th>
                                            @if(Auth::user()->hasRole('receptionist'))
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($bookings) > 0)
                                        @foreach ($bookings as $book)
                                        <tr>
                                            <td>
                                            {{ $loop->iteration }}
                                            </td>
                                            <td><a href="{{ url('/admin/users/'.$book->user->id) }}">{{ $book->user->surname }}, {{ $book->user->firstname }} {{ $book->user->othername }} </a></td>
                                            <td>{{ $book->room->name }}</td>
                                            <td>
                                        <span class="label label-danger">
                                            {{ $book->user->roles[0]->label}}
                                        </span>
                                            </td>
                                            <td>
                                        {{ date('F d, Y g:i A', strtotime($book->arrival_date))}}
                                            </td>
                                            <td>
                                       {{ $book->staff->surname }} {{ $book->staff->firstname }}
                                            </td>
                                <td>
                                       {{ $book->departure_date }}
                                            </td>
                                            @if(Auth::user()->hasRole('receptionist'))
                                            <td>
            <a class="btn btn-primary" href="{{ url('/admin/checkout') }}" title="Checkout"><i class="fa fa-sign-out fa-2x"></i></a>

                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger">Sorry! No room has been checked into today</div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination">
                            {{ $bookings->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
@endsection
