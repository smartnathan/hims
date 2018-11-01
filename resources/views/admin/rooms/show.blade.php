@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


 <div class="col-md-12 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="/plugins/images/rooms/roombanner.jpg">
                            </div>

                            <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Name</strong>
                                        <p>{{ $room->name }}</p>
                                    </div>

                                    <div class="col-md-6"><strong>Category</strong>
                                        <p>{{ $room->roomtype->name }}</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Room Number</strong>
                                        <p>{{ $room->room_number }}</p>
                                    </div>
                                    <div class="col-md-6"><strong>Price</strong>
                                        <p><label style="font-size: 13px; font-weight: bolder" class="label label-success">₦{{ $room->price }}</label></p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Description</strong>
                                        <p>{{ $room->description }}</p>
                                    </div>
                                </div>
                                <hr>
                                <!-- /.row -->
                                <div class="col-md-4 col-sm-4">
                                <strong>Room Utilities</strong>
                                    @if (isset($room->utilities) && count($room->utilities) > 0)
                                    <ul style="list-style: none">
                                    @foreach ($room->utilities as $utility)
                                    <li><span class="fa fa-arrow-circle-right"></span> {{ $utility->name }}</li>
                                    @endforeach
                                    </ul>
                                    @endif
                                 </div>
                                <div class="col-md-4 col-sm-4">

                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                 <a href="{{ url('/admin/rooms') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    @if(Auth::check() && Auth::user()->hasRole('admin'))
                        <a href="{{ url('/admin/rooms/' . $room->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/rooms', $room->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Room',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        @endif
                                 </div>
                            </div>
                        </div>
                    </div>

@endsection
