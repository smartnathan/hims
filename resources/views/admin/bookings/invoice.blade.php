@extends('layouts.backend')
@section('content')
<!-- /.row -->
<div class="row">
<div class="col-md-12">
<div class="white-box printableArea">
<h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
<hr>
<div class="row">
<div class="col-md-12">
    <div class="pull-left">
        <address>
            <h3> &nbsp;<b class="text-danger">{{ config('app.name')}}</b></h3>
            <p class="text-muted m-l-5">
                {{ $bookings->user->address}}
                <br />
                {{ $bookings->user->lga->name}}, {{ $bookings->user->lga->state->name}}.
            </p>
        </address>
    </div>
    <div class="pull-right text-right">
        <address>
            <h3>To,</h3>
            <h4 class="font-bold">
                {{ $bookings->user->surname}}, {{ $bookings->user->firstname}} {{ $bookings->user->othername}}
            </h4>
            <p class="text-muted m-l-30">
                {{ $bookings->user->address}}
                <br />
                {{ $bookings->user->lga->name}}, {{ $bookings->user->lga->state->name}}.
            </p>
            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 23rd Jan 2017
                {{ date('d F Y', time())}}

            </p>
            <p><b>Due Date :</b> <i class="fa fa-calendar"></i> 25th Jan 2017</p>
        </address>
    </div>
</div>
<div class="col-md-12">
   {{--  <strong>Number of days: </strong><span>{{ $bookings->duration}}</span> --}}
    <div class="table-responsive m-t-40" style="clear: both;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Description</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Cost</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @if ($menuorders)
                 @foreach ($menuorders as $order)
                  <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{$order->menu->name }}</td>
                <td class="text-right"> {{ $order->quantity }} </td>
                <td class="text-right"> {{ $order->menu->price }} </td>
                <td class="text-right"> {{ $order->menu->price * $order->quantity }} </td>
                @php $total += $order->menu->price * $order->quantity @endphp
                </tr>
                @endforeach

                @endif


            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="pull-right m-t-30 text-right">
       {{--  <p>Sub - Total amount: $13,848</p>
        <p>vat (10%) : $138 </p> --}}
        <hr>
        <h3><b>Total :</b> {{__('₦') }}{{$total }}.00</h3> </div>
    <div class="clearfix"></div>
    <hr>
    <div class="text-right action-btn">
        <a class="btn btn-danger" href="{{ url('admin/' . $bookings->user_id .'/updateuserorder') }}">Confirm Payment</a>
        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- .row -->
<!-- /.row -->
@endsection

@section('scripts')
 <script src="{{ asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>
    <script>
    $(function() {
        $("#print").on("click", function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $(".action-btn").hide();
            $("div.printableArea").printArea(options);

        });

    });
    </script>

@endsection
