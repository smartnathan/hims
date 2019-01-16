@extends('layouts.backend')
@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="white-box">
            <h2>Room Report Sheet</h2><hr />
            {!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="text-right">
                <div class="input-group">
                    <select class="form-control" name="report-type" id="report-type">
                        <option value="">--Report Type--</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="annually">Annually</option>
                    </select>

                </div>
            </div>
            {!! Form::close() !!}
            <br />
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Guest Full Name</th>
                        <th>Room Checked-in</th>
                        <th>Days Spent</th>
                        <th>Date Checked-In</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if ($reports)
                        @foreach($reports as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->full_name}}</td>
                                <td>{{$item->room->name}}</td>
                                <td>{{$item->duration}}</td>
                                <td>{{date('F d, Y h:i:s', strtotime($item->created_at))}}</td>
                                <td>@if($item->paid == 0) <span class="label label-danger">Not Paid</span>@else <span class="label label-success">Paid</span> @endif</td>
                                <td>{{$item->room->price * $item->duration}}.00</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection