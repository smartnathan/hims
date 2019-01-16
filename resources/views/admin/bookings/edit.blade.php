@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 white-box">
                <div class="card">
                    <h3>Edit Booking Duration  #{{ $booking->user->full_name }}</h3>
                    <hr />
                    <div class="card-body">
                        <a href="{{ url('/admin/bookings') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($booking, [
                            'method' => 'PATCH',
                            'url' => ['/admin/bookings', $booking->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.bookings.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('input', '#paid', function(e){
                e.preventDefault();
                var paymenttype = $('#paymenttype').hide();
                if($(this).val() == 1) {
                    paymenttype.show();
                }
            });
        });
    </script>
@endsection