@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
<h3 class="box-title m-b-0">Food & Drink Request by {{ $menuorder->user->firstname }} {{ $menuorder->user->surname }}</h3>
                    <div class="card-body">

                        <a href="{{ url('/admin/menuorders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/menuorders/' . $menuorder->id . '/edit') }}" title="Edit Menuorder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {{-- {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/menuorders', $menuorder->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Menuorder',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} --}}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Food/Drink</th><td>{{ $menuorder->menu->name }}</td>
                                    </tr>
                                    <tr><th> Quantity </th><td> {{ $menuorder->quantity }} </td></tr>
                                    <tr><th> Price </th><td> ₦{{$menuorder->quantity * $menuorder->menu->price }}.00</td></tr>
                                    <tr><th> Date Requested </th><td> {{ date('F d, Y h:i:s A', strtotime($menuorder->created_at))  }} about {{  $menuorder->created_at->diffForHumans() }}</td></tr>
                                    <tr><th> Payment status </th><td>

                                                @if ($menuorder->paid == 1)
                                                <span class="label label-success">paid</span>
                                                @else
                                                <span class="label label-danger">Not paid</span>
                                                @endif
                                    </td></tr>
                                    <tr><th> Progress Status </th><td>

                                                @if ($menuorder->status == 1)
                                                <span class="label label-success">Completed</span>
                                                @else
                                                <span class="label label-danger">Pending</span> &nbsp; &nbsp; &nbsp;
                                                {!! Form::open([
                            'method'=>'PATCH',
                            'url' => ['admin/menuorders', $menuorder->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <input type="hidden" name="status" value="1">
                            {!! Form::button('<i class="fa  fa-check-square-o" aria-hidden="true"></i> Task Completed', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-success btn-sm',
                                    'title' => 'Task Completed',

                            ))!!}
                        {!! Form::close() !!}
                                                @endif
                                    </td></tr>
                                    <tr><th> Added By </th><td>
                                        <strong>{{ $menuorder->staff->firstname }} {{ $menuorder->staff->surname }}</strong>
                                    </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

