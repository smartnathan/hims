@extends('layouts.backend')

@section('content')
{{-- <div class="container">
<div class="row">

<div class="col-md-12 white-box">
<div class="card">
<h3 class="card-header">User</h3>
<div class="card-body">

    <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
    {!! Form::open([
        'method' => 'DELETE',
        'url' => ['/admin/users', $user->id],
        'style' => 'display:inline'
    ]) !!}
        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm',
                'title' => 'Delete User',
                'onclick'=>'return confirm("Confirm delete?")'
        ))!!}
    {!! Form::close() !!}
    <br/>
    <br/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td> <td> {{ $user->surname }}, {{ $user->firstname }} {{ $user->othername }}</td><td> {{ $user->email }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</div>
</div>
</div>
</div>
 --}}


<!-- .row -->
<div class="row">
<div class="col-md-4 col-xs-12">
    <div class="white-box">
        <div class="user-bg"> <img width="100%" alt="Guest avatar" src="{{ asset('plugins/images/large/img1.jpg')}}">
            <div class="overlay-box">
                <div class="user-content">
                    @if ($user->gender == 'Male')
                    <a href="javascript:void(0)"><img src="{{ asset('plugins/images/users/male.jpg') }}" class="thumb-lg img-circle" alt="img"></a>
                    @else
                    <a href="javascript:void(0)"><img src="{{ asset('plugins/images/users/female.jpg') }}" class="thumb-lg img-circle" alt="img"></a>
                    @endif
                    <h4 class="text-white">{{ $user->surname }} {{ $user->firstname }}</h4>
                    <h5 class="text-white">{{ $user->email }}</h5> </div>
            </div>
        </div>
        <div class="user-btm-box">
            <div class="col-md-12 col-sm-12 text-center">
                <p class="text-purple">Number of visits</p>
                <h1>{{ count($user->bookings) }}</h1> </div>
                <div class="text-center">
                @can('view-user')
                <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                @endcan

                @can('update-user')
    <a href="{{ url('/admin/users/' . $user->id . '/edit?type=guest') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
    @endcan
    @can('delete-user')
    {!! Form::open([
        'method' => 'DELETE',
        'url' => ['/admin/users', $user->id],
        'style' => 'display:inline'
    ]) !!}
        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm',
                'title' => 'Delete User',
                'onclick'=>'return confirm("Confirm delete?")'
        ))!!}
    {!! Form::close() !!}
    @endcan
                </div>
        </div>
    </div>
</div>
<div class="col-md-8 col-xs-12">
    <div class="white-box">
        <ul class="nav nav-tabs tabs customtab">

            <li class="active tab">
                <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
            </li>

            <li class="tab">
                <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Recent Bookings History ({{ (isset($user->bookings))? count($user->bookings): "" }})</span> </a>
            </li>

            <li class="tab">
                <a href="#messages" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Outstading Payment Food/Drink Orders</span> </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="profile">
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                        <br>
                        <p class="text-muted">{{ $user->surname }} {{ $user->firstname }} {{ $user->othername }}</p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                        <br>
                        <p class="text-muted">{{ $user->mobile_number }}</p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Occupation</strong>
                        <br>
                        <p class="text-muted">{{ $user->occupation->name }}</p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Address</strong>
                        <br>
                        <p class="text-muted">{{ $user->address }}</p>
                    </div>
                </div>
                <hr>
                <p class="m-t-30">
                    <strong>Date Created</strong><br />
                    <p class="text-muted"> {{ date('F d, Y', strtotime($user->created_at))}} about {{ $user->created_at->diffForHumans()}}.</p>

                </p>
                @if(isset($user->bookings[0]) && $user->bookings[0]->departure_date == null)
               <div class="page-header">
                   <h2 class="head">Room Transfer </h2>
                   <p class="text-danger"><strong>Note:</strong> Room transfer can only be done within 24hours of checking-in.</p>
               </div>
               <div>
{!! Form::open(['url' => '/admin/bookings/'.$user->bookings[0]->id, 'class' => 'form-inline', 'files' => true, 'method' => 'PATCH', 'role' => 'form']) !!}
  <div class="form-group">
    <label for="room">Transfer to:</label>
<select id="room" style="width: 250px" required="required" name="room_id" class="form-control select2">
    <option value="">--SELECT--</option>
    @foreach ( $rooms as $room )
    <option value="{{ $room->id }}">
        {{ $room->name}} - N{{ $room->price}}
    </option>
    @endforeach
</select>

  </div>

<div style="margin: 0 30px 0 50px" class="form-group">
<label for="paid" class="control-labe">Paid Transfer Charges</label>

<div class="radio radio-primary">
            <input type="radio" name="paid" id="radio1" value="0">
            <label for="radio1"> No </label>
            &nbsp; &nbsp;
            <input type="radio" name="paid" id="radio2" value="1">
            <label for="radio2"> Yes </label>
</div>
</div>

  <input type="hidden" name="old_room_price" value="{{$user->bookings[0]->room->price}}">
  <input type="hidden" name="transfer_id" value="trans1920">
  <button type="submit" class="btn btn-primary">Transfer</button>
</form>
               </div>
                @endif


            </div>
            <div class="tab-pane" id="home">
                <div class="steamline">
                    @if (count($user->bookings) > 0)
                    @foreach ($user->bookings as $user_booking)
                    @break($loop->iteration >5)
                    <div class="sl-item">
                        <div class="sl-left"> <img src="{{ asset('plugins/images/cloud.jpg')}}" alt="user" class="img-circle" /> </div>
                        <div class="sl-right">
                            <div class="m-l-40">
                                <span>{{ $user_booking->created_at->diffForHumans()}}</span><br />

                                <strong>Room Name: </strong><a href="{{ url('/admin/rooms/' . $user_booking->room_id)}}" class="text-info">{{ $user_booking->room->name}}</a>
                                 &nbsp; &nbsp; &nbsp; &nbsp;<strong>Room Price: </strong><span>{{ $user_booking->room->price}}</span>
                                 &nbsp; &nbsp; &nbsp; &nbsp;<strong>Room Number: </strong><span>N{{ $user_booking->room->room_number}}</span>
                                <br />

                                <strong>Date Checked: </strong> <span>{{ date('F d, Y', strtotime($user_booking->arrival_date))}} by
                                    {{ date('h:i:s A', strtotime($user_booking->arrival_date))}}
                                 </span>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <strong>Checked-in by: </strong> <span>{{ $user_booking->staff->surname}} {{ $user_booking->staff->firstname}}</span>
                                @if ($user_booking->departure_date)
                                <br />

                                <strong>Date Checkout: </strong> <span>{{ date('F d, Y', strtotime($user_booking->created_at))}} by
                                    {{ date('h:i:s A', strtotime($user_booking->created_at))}}
                                 </span>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <strong>Checked-out by: </strong> <span>{{ $user_booking->staff->surname}} {{ $user_booking->staff->firstname}}</span>
                                @endif
                                <div class="m-t-20 row">
                                    <strong>Payment status: </strong>
                                    @if ($user_booking->paid == 1)
                    <span class="label label-success">
                        Paid
                            </span>
                                    @else
                        <span class="label label-danger">
                        Not Paid
                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <div class="alert alert-danger">
                    Guest has not been checked-in before.
                    </div>
                    @endif

                </div>
            </div>
            <div class="tab-pane" id="messages">
                <div class="steamline">
                    @if (isset($user->menuorders) && count($user->menuorders) > 0)

                    <div class="sl-item">
                    </div>

                    @else
<div class="alert alert-danger">
    Guest does not have any outstanding payment.
</div>
                    @endif


                </div>
            </div>
            <div class="tab-pane" id="settings">
                <form class="form-horizontal form-material">
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Password</label>
                        <div class="col-md-12">
                            <input type="password" value="password" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Phone No</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Message</label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control form-control-line"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Select Country</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line">
                                <option>London</option>
                                <option>India</option>
                                <option>Usa</option>
                                <option>Canada</option>
                                <option>Thailand</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.row -->
@endsection
