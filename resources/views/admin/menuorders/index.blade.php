@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 white-box">
                <div class="card">
    <h2>List of Food Ordered</h2><hr>
                    <div class="card-body">
                        {{-- <a href="{{ url('/admin/menuorders/create') }}" class="btn btn-success btn-sm" title="Add New Menuorder">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> --}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/menuorders', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="text-right">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Food/Drink</th>
                                        <th>Quantity</th>
                                        <th>Guest</th>
                                        <th>Date</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($menuorders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->menu->name }}</td><td>{{ $item->quantity }}</td><td>{{ $item->user->surname }} {{ $item->user->firstname }}</td>
                                        <td>{{ date('m-d-Y h:i:s A', strtotime($item->created_at)) }}</td>
                                        <td>
                                                @if ($item->paid == 1)
                                                <span class="label label-success">paid</span>
                                                @else
                                                <span class="label label-danger">Not paid</span>
                                                @endif
                                            </td>
                                        <td>
                                                @if ($item->status == 1)
                                                <span class="label label-success">Completed</span>
                                                @else
                                                <span class="label label-danger">Pending</span>
                                                @endif
                                            </td>

                                        <td>

                                            @can('view-menuorder')
                                            <a href="{{ url('/admin/menuorders/' . $item->id) }}" title="View Menuorder"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            @can('update-menuorder')
                                            <a href="{{ url('/admin/menuorders/' . $item->id . '/edit') }}" title="Edit Menuorder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan
                                            @can('delete-menuorder')
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
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $menuorders->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
