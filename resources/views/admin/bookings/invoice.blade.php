@extends('layouts.backend')
@section('content')
<!-- /.row -->
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="white-box printableArea">
<h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
<hr>
@if (Session::has('booked_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed', "{{ Session::get('booked_message') }}", 'success');
                                </script>
                    @endsection
                @endif
<div class="row">
<div class="col-md-12">
    <div class="pull-left">
        <address>
            <h3> &nbsp;<b class="text-danger">{{ config('app.name')}}</b></h3>
            <p class="text-muted m-l-5">
                {{ $user->address}}
                <br />
                {{ $user->lga->name}}, {{ $user->lga->state->name}}.
            </p>
        </address>
    </div>
    <div class="pull-right text-right">
        <address>
            <h3>To,</h3>
            <h4 class="font-bold">
                {{ $user->surname}}, {{ $user->firstname}} {{ $user->othername}}
            </h4>
            <p class="text-muted m-l-30">
                {{ $user->address}}
                <br />
                {{ $user->lga->name}}, {{ $user->lga->state->name}}.
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
                    <th>Type</th>
                    <th class="text-right">Description</th>
                    <th class="text-right">Date</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @if ($transactions)
                 @foreach ($transactions as $order)
                  <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{$order->type }}</td>
                <td class="text-right"> {{ $order->description}} </td>
                <td class="text-right"> {{ $order->created_at }} </td>
                <td class="text-right"> {{ $order->price }} </td>
                @php $total += $order->price @endphp
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
        @if (!request()->has('paid'))
        <a onclick="confirmAlert();" class="btn btn-danger" href="javascript:;">Confirm Payment</a>
        @endif
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

    function confirmAlert(){
    swal({
        title: "Are you sure?",
        text: "You will not be able to reverse this process after confirmation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        closeOnConfirm: false,
    },
    function(){
    swal('Completed!', 'Payment was successful', 'success');
    setTimeout(function(){
        window.location.href="{{ url('admin/' . $user->id .'/updateuserorder') }}";
    }, 2000);

    }
    );
}
//end of function
    </script>

@endsection
