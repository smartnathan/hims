@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 white-box">
                <div class="card">
                       @if (Session::has('error_message'))
        @section('scripts')
 <script type="text/javascript">
            swal('WHOOP!', "{{ Session::get('error_message') }}", 'error');
        </script>
        @endsection
@endif
    <h2 class="">Kitchen Menu Order</h2>
    <hr />
    <div class="card-body">
                        <a href="{{ url('/admin/menuorders') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
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
