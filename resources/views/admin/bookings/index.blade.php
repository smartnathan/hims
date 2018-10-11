@extends('layouts.backend')

@section('content')
            <div class="col-md-12 white-box">
                <div class="card">
                    <h2>Check-in Rooms Listing</h2><hr >
                    <div class="card-body">
                @if (Session::has('booked_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed', "{{ Session::get('booked_message') }}", 'success');
                                </script>
                    @endsection
                @endif

                @if (Session::has('transfer_message') && Session::has('match'))

                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('transfer_message') }}
                </div>

                @endif
                @if (Session::has('transfer_message') && Session::has('debit'))

                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('transfer_message') }} and an additional cost of  <strong style="color: red">₦{{ Session::get('debit') }}.00</strong> has to be paid.
            </div>

                @endif

                @if (Session::has('transfer_message') && Session::has('credit'))

                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('transfer_message') }} and the sum of <strong style="color: red">₦{{ Session::get('credit') }}.00</strong> has to be refunded to the guest.
            </div>

                @endif

                        {{-- <a href="{{ url('/admin/bookings/create') }}" class="btn btn-success btn-sm" title="Add New Booking">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
 --}}
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/bookings', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>Actions</th>
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
                                            <a href="{{ url('/admin/users/' . $item->user_id) }}" title="View Booking"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            @can('update-booking')
                                            <a href="{{ url('/admin/bookings/' . $item->id . '/edit') }}" title="Edit Booking"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan
                                            @can('delete-booking')
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/bookings', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Booking',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
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
