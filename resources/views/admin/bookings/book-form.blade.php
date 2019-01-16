@extends('layouts.backend')

@section('content')

<div class="col-lg-9 col-sm-9">
    <div class="panel panel-danger">
        <div class="panel-heading"> Book a Room

        </div>

        @if (Session::has('error_message'))
        @section('scripts')
 <script type="text/javascript">
            swal('WHOOP!', "{{ Session::get('error_message') }}", 'error');
        </script>
        @endsection
@endif


        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <h4>Enter the guest mobile number or email</h4>
{!! Form::open(['method' => 'GET', 'url' => '/admin/bookroom', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
<div class="">
<div class="input-group">
<input type="text" class="form-control" name="search" placeholder="Search...">
<span class="input-group-btn">
<button class="btn btn-secondary" type="submit">
<i class="fa fa-search"></i>
</button>
</span>
</div>
</div>
{!! Form::close() !!}
<hr />

@if (isset($user) && count($user) > 0)
<div class="table-responsive">
{!! Form::open(['url' => '/admin/bookroom', 'class' => 'form-horizontal', 'files' => true]) !!}                                <table class="table">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Role</th>
                        <th>Date Registered</th>
                        <th>Available Rooms<span class="text-danger"> *</span></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ( $user as $guest)
                    <tr>

                        <td>{{ $guest->surname }}, {{ $guest->firstname }} {{ $guest->othername }}</td>
                        <td>{{ $guest->mobile_number }}</td>
                        <td>
                             @if ($guest->roles[0]->name == 'admin')
<span class="label label-success">
{{ $guest->roles[0]->label }}
</span>
@elseif ($guest->roles[0]->name == 'staff')
<span class="label label-info">
{{ $guest->roles[0]->label }}
</span>
@else
<span class="label label-danger">
{{ $guest->roles[0]->label }}
</span>
@endif
                        </td>
                        <td>{{ $guest->created_at->diffForHumans()}}</td>
                        <td>
                            <div class="">
                                <select required="required" name="room" class="form-control select2">
                                    <option value="">--Select--</option>
                                @foreach ( $rooms as $room )
                                <option value="{{ $room->id }}">
                                    {{ $room->name}} - N{{ $room->price}}
                                </option>
                                @endforeach

                            </select>
                            </div>
                        </td>
                        <input type="hidden" name="user_id" value="{{$guest->id}}">
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <h4>Additional checking-in Information</h4>
               <div class="row">
                   <div class="col-md-8 col-md-offset">
                          <div class="form-group">
                                    <label for="duration" class="col-sm-3 control-label">Number of Days<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input required="required" type="number" class="form-control" id="duration" name="duration" placeholder="Enter the number of day(s)"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="paid" class="col-sm-3 control-label">Paid<span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                <div class="radio radio-danger">
                                            <input required="" id="paid" type="radio" name="paid" id="radio1" value="0">
                                            <label for="radio1"> No </label>
                                            &nbsp; &nbsp; &nbsp; &nbsp;
                                            <input required="" id="paid" type="radio" name="paid" id="radio2" value="1">
                                            <label for="radio2"> Yes </label>
                                        </div>

                                    </div>
                                </div>
                                <div id="paymenttype" class="form-group" style="display: none;">
                                    <label for="paymenttype" class="col-sm-3 control-label">Payment Type<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                         <select name="paymenttype" class="form-control select2">
                                    <option value="">--Select--</option>
                                @foreach ( $paymenttype as $type )
                                <option value="{{ $type->id }}">
                                    {{ $type->name}}
                                </option>
                                @endforeach

                            </select>
                                    </div>
                                </div>
<div class="form-group">
    <div class="col-sm-3 pull-right">
    <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-sign-in"></i> Check In</button>
    </div>
</div>

                   </div>
               </div>
        {!! Form::close() !!}
        </div>

@elseif (isset($user) && count($user) == 0)
<div class="alert alert-danger"><span style="font-weight: bolder;">Sorry!</span> No matching record was found.</div>

@endif
            </div>
        </div>
    </div>
</div>

<!-- /.col-lg-4 -->
<div class="col-lg-3 col-sm-3">
    <div class="panel panel-danger">
        <div class="panel-heading"> Available Rooms
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <p>
                    @if (count($rooms) > 0)

                    <table class="table table-responsive table-hover">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Price (₦)</th>
                        </thead>
                        <tbody>
                        @foreach ( $rooms as $room)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td><a target="_blank" href="{{ url('/admin/rooms/' . $room->id) }}"> {{ $room->name }}</a></td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    @else
                    <div class="text text-danger lead">Sorry! No room is available for booking.</div>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('input', '#paid', function(e){
            e.preventDefault();
            var paymenttype = $('#paymenttype').hide();
            if($(this).val() == 1) {
                paymenttype.show();
            }
        });
    });
</script>
@endsection
