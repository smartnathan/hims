@extends('layouts.backend')

@section('content')
            <div class="col-md-12 white-box">
                <div class="card">
                    <h2>Check-in Guests & Rooms Summary</h2><hr >
                    <div class="card-body">
                @if (Session::has('flash_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed!', "{{ Session::get('flash_message') }}", 'success');
                                </script>
                    @endsection
                @endif


                        {{-- <a href="{{ url('/admin/bookings/create') }}" class="btn btn-success btn-sm" title="Add New Booking">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
 --}}
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/bookings/room-transfer', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="text-right">
                            <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room Name</th>
                                        <th>Guest Name</th>
                                        <th>Arrival Date</th>
                                        <th>Departure Date</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->room->name }}</td>
                                        <td><a href="#">
                                            {{ $item->user->surname}}, {{ $item->user->firstname}}
                                        </a></td>
                                        <td>{{ $item->arrival_date }}</td>
                                        <td>{{ $item->departure_date }}</td>
                                        <td>
                                               @if ( $item->duration == 1)
                                               {{ $item->duration }} day
                                               @else
                                               {{ $item->duration }} days
                                               @endif
                                        </td>
                                        <td>

                                            @can('view-booking')
                                            {{-- <a href="{{ url('/admin/bookings/' . $item->id) }}" title="View Booking"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                            <a href="{{ url('/admin/users/' . $item->user_id) }}" title="View Booking"><button style="font-weight: bolder" class="btn btn-danger btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i> Transfer</button></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $bookings->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>

@endsection
