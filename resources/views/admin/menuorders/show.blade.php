@extends('layouts.backend')

@if (request()->has('print') && decrypt(request()->get('print')) == $menuorder[0]->user->id )
@section('content')
<!-- /.row -->
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="white-box printableArea">
<h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
<hr>

<div class="row">
<div class="col-md-12">
    <div class="pull-left">
        <address>
            <h3> &nbsp;<b class="text-danger">{{ config('app.name')}}</b></h3>
            <p class="text-muted m-l-5">
                {{$hotel_address}}
            </p>
        </address>
    </div>
    <div class="pull-right text-right">
        <address>
            <h3>To,</h3>
            <h4 class="font-bold">
                {{ $menuorder[0]->user->surname}}, {{ $menuorder[0]->user->firstname}} {{ $menuorder[0]->user->othername}}
            </h4>
            <p class="text-muted m-l-30">
                {{ $menuorder[0]->user->address}}
                <br />
                {{ $menuorder[0]->user->lga->name}}, {{ $menuorder[0]->user->lga->state->name}}.
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
                    <th class="text-center">S/N</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Date</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total Price</th>
                    
                </tr>
            </thead>
            <tbody>
            
                @if ($transactions)
                 @foreach ($transactions as $order)
                  <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center"> {{ $order->menu->name}} </td>
                <td class="text-center">{{$order->quantity }}</td>
                <td class="text-center"> {{ $order->created_at }} </td>
                <td class="text-right"> {{ $order->menu->price }} </td>
                <td class="text-right"> {{ $order->menu->price * $order->quantity }}.00</td>
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
        <h3><b>Grand Total :</b> {{__('₦') }}{{ $total }}.00</h3> </div>
    <div class="clearfix"></div>
    <hr>
    <div class="text-right action-btn">
        <button style="font-weight: bold" id="print" class="btn btn-danger" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- .row -->
<!-- /.row -->

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
@else
@section('content')
<div class="container">
<div class="row">

@if (Session::has('flash_message'))

@section('scripts')
            <script type="text/javascript">
               swal('Completed', "{{ Session::get('flash_message') }}", 'success');
            </script>
@endsection
@endif
    <div class="col-md-12 white-box">
        <div class="card">
<h3 class="box-title m-b-0">Guest Name: <span class="text-danger">{{ $menuorder[0]->user->firstname }} {{ $menuorder[0]->user->surname }}</span> <span style="margin-left: 100px">Room Name:</span> <span class="text-danger">{{ $menuorder[0]->user->bookings[0]->room->name }}</span> <label class="label label-danger">{{ $menuorder[0]->user->bookings[0]->room->room_number }}</label>
<span style="margin-left: 100px">Added By:</span> <span class="text-danger">{{ $menuorder[0]->staff->firstname }} {{ $menuorder[0]->staff->surname }}</span>
<span style="margin-left: 30px"><a style="font-weight: bold" class="btn btn-danger" href="{{ url('admin/menuorders', ['id' => $menuorder[0]->user->id])}}?print={{encrypt($menuorder[0]->user->id)}}">Generate Invoice</a></span>
</h3>
<br />
            <div class="card-body">

                <a href="{{ url('/admin/menuorders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
<br /><br />

<div class="table-responsive">
    {!! Form::open([
                    'method'=>'PATCH',
                    'url' => ['/admin/menuorders', $menuorder[0]->user_id],
                    'style' => 'display:inline'
                ]) !!}
                <button type="submit" id="confirmorder" class="hidden btn btn-primary">Confirm Order Delivery</button>
<table class="table table-borderless">
    <thead>
        <tr>
            <th>#</th>
            <th>Food / Drink Order </th>
            <th>Date of Order Placement</th>
             <th><span style="margin: 0 45px 0 10px">Status</span>  <input id="item-delivered" type="checkbox"></th>
            <th><span style="margin-right: 2px"> Payment</span>  <input id="item-paid" type="checkbox"></th>


        </tr>
    </thead>
    <tbody>

    @foreach($menuorder as $item)
        <tr>


            <td>{{ $loop->iteration or $item->id }}</td>
            <td> {{ $item->menu->name }}</td>
            <td>{{ date('l jS, F Y h:i:s A', strtotime($item->created_at)) }} <label class="label label-success">{{ $item->created_at->diffForHumans() }}</label></td>

            <td>

                    @if ($item->status == 1)
                    <span class="label label-success">Completed</span>
                    @else
                    <span class="label label-danger">Pending</span>
                    @endif

                    <input required="required" class="menuitems" type="checkbox" name="menuitems[]" value="{{$item->id}}">

                </td>

                <td>
                    @if ($item->paid == 1)
                    <span class="label label-success">paid</span>
                    @else
                    <span class="label label-danger">Not paid</span>
                    @endif
                <input class="itempaid" type="checkbox" name="itempaid[]" value="{{$item->user_id}}">
                </td>



                {{-- @can('view-menuorder')
                <a href="{{ url('/admin/menuorders/' . $item->id) }}" title="View Menuorder"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                {{-- @endcan
                @can('update-menuorder')
                <a href="{{ url('/admin/menuorders/' . $item->id . '/edit') }}" title="Edit Menuorder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                @endcan --}}
                {{-- @can('delete-menuorder')
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['/admin/menuorders', $item->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Menuorder',
                            'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                {!! Form::close() !!}
                @endcan --}}

        </tr>
    @endforeach
    {!! Form::close() !!}
    </tbody>
</table>

</div>

            </div>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    input {

        height: 20px;
        width: 20px;
        position: absolute;

    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $("#item-delivered").on('click', function(){
            if(this.checked) {
                $('.menuitems').each(function(){
                    this.checked = true;
                });
                $('#confirmorder').removeClass('hidden');
                $('#confirmorder').html('Confirm Order Delivery');
            }
            else {
                $(':checkbox').each(function(){
                    this.checked = false;
                });
            $('#confirmorder').addClass('hidden');
            }
        });

        //Menu item paid
        $("#item-paid").on('click', function(){
            if(this.checked) {
                $('.itempaid').each(function(){
                    this.checked = true;
                });
                $('#confirmorder').html('Confirm Order Delivery and Payment');
            }
            else {
                $('.itempaid').each(function(){
                    this.checked = false;
                });
                $('#confirmorder').html('Confirm Order Delivery');
            }
        });
    });
</script>
    
@endif

@endsection
