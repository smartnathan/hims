@extends('layouts.backend')
@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="white-box">
            <h2>Room Report Sheet</h2><hr />
            {!! Form::open(['method' => 'GET', 'url' => '/admin/room-reports', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="text-right">
                <div class="input-group">
                    <select class="form-control" name="search" id="report-type">
                        <option value="">--Report Type--</option>
                        <option {{(request('search') == 'today') ? 'selected' : ''}} value="today">Today</option>
                        <option {{(request('search') == 'yesterday') ? 'selected' : ''}} value="yesterday">Yesterday</option>
                        <option {{(request('search') == 'thisweek') ? 'selected' : ''}} value="thisweek">This Week</option>
                        <option {{(request('search') == 'lastweek') ? 'selected' : ''}} value="lastweek">Last Week</option>
                        <option {{(request('search') == 'thismonth') ? 'selected' : ''}} value="thismonth">This Month</option>
                        <option {{(request('search') == 'lastmonth') ? 'selected' : ''}} value="lastmonth">Last Month</option>
                        <option {{(request('search') == 'thisyear') ? 'selected' : ''}} value="thisyear">This Year</option>
                        <option {{(request('search') == 'lastyear') ? 'selected' : ''}} value="lastyear">Last Year</option>
                    </select>
                    <span class="input-group-btn"><button class="btn btn-secondary" type="submit">Filter</button></span>
                </div>
            </div>
            {!! Form::close() !!}
            <br />

            <div class="table-responsive">
                @if ($reports && $reports->count() == 0)
                    <div class="alert alert-danger">No data was found!</div>

                @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Guest Full Name</th>
                        <th>Room Checked-in</th>
                        <th>Days Spent</th>
                        <th>Date Checked-In</th>
                        <th>Payment Status</th>
                        <th>Actual Price (₦)</th>
                        <th>Total Amount (₦)</th>

                    </tr>
                    </thead>
                    <tbody>

                        @foreach($reports as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->user->full_name}}</td>
                        <td>{{$item->room->name}}</td>
                        <td><span class="label label-danger">{{$item->duration}}</span></td>
                        <td>{{date('F d, Y h:i:s', strtotime($item->created_at))}}</td>
                        <td>@if($item->paid == 0) <span class="label label-danger">Not Paid</span>@else <span class="label label-success">Paid</span> @endif</td>
                        <td>{{$item->room->price }}</td>
                        @php
                        $product = $item->room->price * $item->duration;
                        $total += $product;
                        @endphp
                        <td>{{$product}}.00</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                <hr />
                @if(empty(request('search')))
                    {{$reports->links()}}
                    @endif
                    <div class="text-right lead">
                        <strong>Grand Total: </strong> <span style="font-weight: bold">₦{{$total}}.00</span>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection