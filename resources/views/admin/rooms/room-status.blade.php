@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row colorbox-group-widget">
            <div class="col-md-3 col-md-offset-3 col-sm-6 info-color-box">
                <div class="white-box">
                    <div class="media bg-primary">
                        <div class="media-body">
                            <h3 class="info-count">
                                {{$booked_rooms}}
                                <span class="pull-right"><i class="mdi mdi-account-star"></i></span></h3>
                            <p class="info-text font-12">Occupied Rooms</p>
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
                            {{$free_rooms}}
                                <span class="pull-right"><i class="mdi mdi-home"></i></span></h3>
                            <p class="info-text font-12">Available Rooms</p>
                            {{-- <p class="info-ot font-15">Today's Date<span class="label label-rounded">{{ date('F d, Y') }}</span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12 white-box">
                <div class="card">
                    <h2>Rooms Status</h2><hr />
                    <div class="card-body">

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless color-table red-table">
                                <thead>
                                <tr>
                                    <th>#</th><th>Name</th><th>Room Category</th><th>Description</th>
                                    <th>Price</th>
                                    <th>Date Checked In</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->roomtype->name }}</td><td>{{ $item->description }}</td>
                                        </td><td>₦{{ $item->price }}</td>
                                        <td>{{ $item->updated_at->diffForHumans()}}</td>
                                        <td>@if($item->is_booked == 0) <span class="label label-success">Available</span> @else <span class="label label-danger">Occupied</span> @endif</td>
                                        <td>
                                            {!! Form::open([
                                                'method'=>'PATCH',
                                                'url' => ['/admin/rooms-update-status', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                            <button class="btn btn-default" type="submit">Change Status</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection