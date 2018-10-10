@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
<h3 class="box-title m-b-0">Service order {{ $serviceorder->id }}</h3>
                    <div class="card-body">

                        <a href="{{ url('/admin/serviceorders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/serviceorders/' . $serviceorder->id . '/edit') }}" title="Edit Serviceorder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/serviceorders', $serviceorder->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Serviceorder',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $serviceorder->id }}</td>
                                    </tr>
                                    <tr><th> Service Id </th><td> {{ $serviceorder->service_id }} </td></tr><tr><th> Quantity </th><td> {{ $serviceorder->quantity }} </td></tr><tr><th> User Id </th><td> {{ $serviceorder->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
