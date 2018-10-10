@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 white-box">
                <div class="card">
                    @if (request()->has('type') && request()->get('type') == 'guest')
                    <h3 class="box-title m-b-0">Create a new Guest account</h3>
                    @else
                    <h3 class="box-title m-b-0">Create a new Staff Account</h3>
                    @endif
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        {{-- @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
 --}}
                        {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal']) !!}

                        @include ('admin.users.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
