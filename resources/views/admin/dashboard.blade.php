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
                                    <p class="info-text font-12">Total Food & Drinks Order Today</p>
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
                                    <p class="info-text font-12">Total Income Today</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CALL TO ACTION BUTTONS --}}
            @if (Auth::user()->hasRole('receptionist'))
                <div class="text-center" style="margin-bottom: 10px">
                        <a style="margin-right: 10px; font-weight: bolder;" class="btn btn-primary btn-lg" href="{{ url('/admin/users/create?type=guest') }}"><i class="fa fa-user-plus"></i> Register a Guest</a>

                        <a style="margin-right: 10px; font-weight: bolder;" class="btn btn-success btn-lg" href="{{ url('/admin/bookroom') }}"><i class="fa fa-sign-in"></i> Check-in Guest</a>
                        <a style=" margin-right: 10px; font-weight: bolder;" class="btn btn-danger btn-lg" href="{{ url('/admin/bookings/room-transfer') }}"><i class="fa fa-upload"></i> Room Transfer</a>
                        <a style="font-weight: bolder;" class="btn btn-primary btn-lg" href="{{ url('/admin/checkout') }}"><i class="fa fa-sign-out"></i> Check-out Guest</a>
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


@if (Auth::user()->hasRole('chef'))
<div class="col-sm-6">
                                    <h4 class="box-title">Available Food & Drinks for Guest</h4>
                                </div>

                                {!! Form::open(['method' => 'GET', 'url' => '/admin', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
<div class="text-right">
    @if(request()->has('search'))
    <a style="margin-right: 40px; font-weight: bolder" href="{{ url('/admin')}}">Show all Available Food & Drinks</a>
    @endif
<div class="input-group">
<input style="height: 45px; font-size: 18px" type="text" class="form-control" name="search" placeholder="Food or Drink">
<span class="input-group-btn">
<button class="btn btn-primary" type="submit">
    <i class="fa fa-search"></i>
</button>
</span>
</div>
</div>
{!! Form::close() !!}
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                             S/N
                                            </th>
                                            <th>Food & Drink</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Date Added</th>
                                            <th>Added by</th>
                                            <th>Date Updated</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($food_drinks) > 0)
                                        @foreach ($food_drinks as $item)
                                        <tr>
                                            <td>
                                            {{ $loop->iteration }}
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                @if (strtolower($item->menutype->name) == 'drink')
                                                <span class="label label-danger">
                                            {{ $item->menutype->name }}
                                        </span>
                                                @elseif(strtolower($item->menutype->name) == 'food')
                                                <span class="label label-success">
                                            {{ $item->menutype->name }}
                                        </span>
                                                @else
                                                <span class="label label-primary">
                                            {{ $item->menutype->name }}
                                        </span>
                                                @endif
                                                </td>
                                            <td>
                                        <span style="font-weight: bolder" class="label label-danger">
                                            ₦{{$item->price}}
                                        </span>
                                            </td>
                                            <td>
                                        {{ date('F d, Y g:i A', strtotime($item->created_at))}}
                                            </td>
                                            <td>
                                       {{ $item->user->surname }} {{ $item->user->firstname }}
                                            </td>
                                <td>
                                       {{ $item->updated_at }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger">Sorry! No Food or Drink has been added to the system.</div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination">
                            {{ $food_drinks->links() }}
                            </ul>
@else




<div class="col-sm-6">
                                    <h4 class="box-title">Recently Checked-In Guest Log<span><a style="margin-left: 30px;font-weight: bolder;" class="" href="{{ url('/admin/checkout') }}"><i class="fa fa-users"></i> All Checked-in Guests</a></span></h4>
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
                                            <th>Guest Full Name</th>
                                            <th>Room</th>
                                            <th>Room No.</th>
                                            <th>Role</th>
                                            <th>Date Checked-In</th>
                                            <th>Checked-In By</th>
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
                                            <td>{{ $book->room->room_number }}</td>
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
                                            <td colspan="9">
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
@endif
                        </div>
                    </div>
                </div>
@endsection
