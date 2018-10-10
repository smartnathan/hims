@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 white-box">
                <div class="card">
    <h2 class="">Kitchen Menu Order</h2>
    <hr />
    <h3 class="box-title m-b-0 text-center">Add a New Food & Drink Order</h3>
                    <div class="card-body">
                        <a href="{{ url('/admin/menuorders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/menuorders', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.menuorders.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
