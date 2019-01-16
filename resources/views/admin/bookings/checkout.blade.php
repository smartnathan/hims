@extends('layouts.backend')

@section('content')
<style>
.not-paid {
    background-color: #ff1a1a;
    color: #fff;
    font-weight: bolder;
}
.not-paid-link {
    color: #fff;
}
.tooltip-inner {
    font-size: 20px;
    font-weight: bolder;
}
</style>
<div class="col-md-12 white-box">
<div class="card">
<h2 class="m-b-0">Guest Management & Room Checked-in</h2><hr >
<div class="card-body">
<div class="float-left">
    <span><a style="font-weight: bolder;" class="btn btn-danger" href="{{ url('/admin') }}"><i class="fa fa-arrow-left"></i> Back</a></span>
</div>
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
            <th>Room Name or Number</th>
            <th>Guest Name</th>
            <th>Arrival Date</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookings as $item)
        <tr class="{{ (count($item->user->transactionDebt) > 0) ? 'not-paid' : '' }}">
            <td>{{ $loop->iteration or $item->id }}</td>
             <td>{{ $item->room->name  }} <span class="badge badge-pill badge-secondary"><strong>{{ $item->room->room_number  }}</strong></span></td>
            <td>
            <a  class="{{ (count($item->user->transactionDebt) > 0) ? 'not-paid-link' : '' }}" href="#" data-toggle="tooltip" data-placement="top" title="₦{{ $item->user->transactionDebt->sum('price') }}.00">{{ $item->user->surname}} {{ $item->user->firstname}}</a>
            </td>
            <td>{{ $item->arrival_date }} <span style="font-weight: bolder" class="badge badge-pill badge-secondary">{{ $item->created_at->diffForHumans() }}</span></td>
            <td>
                   @if ( $item->duration == 1)
                   {{ $item->duration }} day
                   @else
                   {{ $item->duration }} days
                   @endif
            </td>
            <td>

            @if (isset($item->user->transactionHistories) && count($item->user->transactionHistories) > 0)

            @foreach ($item->user->transactionHistories as $history)
            @if ( $history->status == 'debit')
            <a href="{{ url('/admin/' . $item->user_id . '/invoice') }}" title="View Booking"><button style="font-weight: bolder" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</button></a>
            @break

            @else
                @if ($loop->last && $history->status == 'credit')
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
    );' href="javascript:;" title="View Booking"><button style="font-weight: bolder" type="button" class="btn btn-default btn-sm"><i class="fa fa-sign-out fa-1x" aria-hidden="true"></i> Check-out</button></a>
                @endif
            @endif
            @endforeach
            @else
            <span style="font-weight: bolder" class="badge badge-pill badge-secondary">No Record Found!</span>
            @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{-- <div class="pagination-wrapper"> {!! $bookings->appends(['search' => Request::get('search')])->render() !!} </div>
 --}}</div>

</div>
</div>
</div>

@endsection


