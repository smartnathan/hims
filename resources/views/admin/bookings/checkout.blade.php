@extends('layouts.backend')

@section('content')
<div class="col-md-12 white-box">
<div class="card">
<h2 class="m-b-0">Guest Management [Checkout] </h2><hr >
<div class="card-body">

{!! Form::open(['method' => 'GET', 'url' => '/admin/checkout', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
            <td>
                   @if ( $item->duration == 1)
                   {{ $item->duration }} day
                   @else
                   {{ $item->duration }} days
                   @endif
            </td>
            <td>

            @if ($item->user->transactionHistories[0]->status == "debit")

            <a href="{{ url('/admin/' . $item->user_id . '/invoice') }}" title="View Booking"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</button></a>

            @else

        <a onclick='swal({
        title: "Are you sure?",
        text: "You will not be able to reverse this process after confirmation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        closeOnConfirm: false,
    },
    function(){
    swal("Completed!", "Guest has been checked out", "success");
    setTimeout(function(){
        window.location.href="{{ url('admin/' . $item->user_id .'/checkout') }}";
    }, 2000);
    }
    );' href="javascript:;" title="View Booking"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-sign-out fa-1x" aria-hidden="true"></i> Check-out</button></a>
            @endif
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

