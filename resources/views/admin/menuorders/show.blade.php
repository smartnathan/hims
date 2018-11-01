@extends('layouts.backend')

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
<h3 class="box-title m-b-0">Guest Name: <span class="text-danger">{{ $menuorder[0]->user->firstname }} {{ $menuorder[0]->user->surname }}</span> <span style="margin-left: 100px">Room Name:</span> <span class="text-danger">{{ $menuorder[0]->user->bookings->room->name }}</span> <label class="label label-danger">{{ $menuorder[0]->user->bookings->room->room_number }}</label>
<span style="margin-left: 100px">Added By:</span> <span class="text-danger">{{ $menuorder[0]->staff->firstname }} {{ $menuorder[0]->staff->surname }}</span>
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
            <td>{{ date('m-d-Y h:i:s A', strtotime($item->created_at)) }} <label class="label label-success">{{ $item->created_at->diffForHumans() }}</label></td>

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
@endsection
