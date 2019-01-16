@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
                    <h2 class="card-header">Item Group {{ $itemgroup->id }}</h2><hr />
                    <div class="card-body">

                        <a href="{{ url('/admin/item-groups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/item-groups/' . $itemgroup->id . '/edit') }}" title="Edit ItemGroup"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/itemgroups', $itemgroup->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ItemGroup',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr><th> Code </th><td> {{ $itemgroup->code }} </td></tr><tr><th> Name </th><td> {{ $itemgroup->name }} </td></tr><tr><th> Added By </th><td> {{ $itemgroup->user->firstname }} {{ $itemgroup->user->surname }} <label class="label label-danger">{{ $itemgroup->user->roles[0]->label }}</label></td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
