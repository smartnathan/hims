@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 white-box">
                <div class="card">
                    <h2 class=" m-b-0">Booking </h2>
                    <div class="card-body">

                        <a href="{{ url('/admin/bookings') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
<br />
<br />
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $booking->id }}</td>
                                    </tr>
                                    <tr><th> Room Id </th><td> {{ $booking->room_id }} </td></tr><tr><th> Arrival Date </th><td> {{ $booking->arrival_date }} </td></tr><tr><th> Departure Date </th><td> {{ $booking->departure_date }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
