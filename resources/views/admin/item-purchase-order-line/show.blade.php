@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ItemPurchaseOrderLine {{ $itempurchaseorderline->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/item-purchase-order-line') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/item-purchase-order-line/' . $itempurchaseorderline->id . '/edit') }}" title="Edit ItemPurchaseOrderLine"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/itempurchaseorderline', $itempurchaseorderline->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ItemPurchaseOrderLine',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $itempurchaseorderline->id }}</td>
                                    </tr>
                                    <tr><th> Item Purchase Order Id </th><td> {{ $itempurchaseorderline->item_purchase_order_id }} </td></tr><tr><th> Item Id </th><td> {{ $itempurchaseorderline->item_id }} </td></tr><tr><th> Unit Price </th><td> {{ $itempurchaseorderline->unit_price }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
