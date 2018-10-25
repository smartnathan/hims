@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ItemPurchaseOrder {{ $itempurchaseorder->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/item-purchase-orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/item-purchase-orders/' . $itempurchaseorder->id . '/edit') }}" title="Edit ItemPurchaseOrder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/itempurchaseorders', $itempurchaseorder->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete ItemPurchaseOrder',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $itempurchaseorder->id }}</td>
                                    </tr>
                                    <tr><th> Item Supplier Id </th><td> {{ $itempurchaseorder->item_supplier_id }} </td></tr><tr><th> Purchase Date </th><td> {{ $itempurchaseorder->purchase_date }} </td></tr><tr><th> Total Amount </th><td> {{ $itempurchaseorder->total_amount }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
