@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
<h3 class="box-title m-b-0">Payment type {{ $paymenttype->id }}</h3>
                    <div class="card-body">

                        <a href="{{ url('/admin/paymenttypes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/paymenttypes/' . $paymenttype->id . '/edit') }}" title="Edit Paymenttype"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/paymenttypes', $paymenttype->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Paymenttype',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $paymenttype->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $paymenttype->name }} </td></tr><tr><th> Description </th><td> {{ $paymenttype->description }} </td></tr><tr><th> Added By </th><td> {{ $paymenttype->added_by }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
