@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
                    <h2 class="card-header">Create New Item Group</h2><hr />
                    <div class="card-body">
                        <a href="{{ url('/admin/item-groups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/item-groups', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.item-groups.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
