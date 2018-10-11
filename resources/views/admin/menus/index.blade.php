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
                    <h2 class="m-b-0">List of Available Food and Drinks</h2><hr />
                    <div class="card-body">
                        <a href="{{ url('/admin/menus/create') }}" class="btn btn-success btn-sm" title="Add New Menu">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Food or Drink
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/menus', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>Name</th>
                                        <th>Menu type</th>
                                        <th>Price</th>
                                        <th>Added By</th>
                                        <th>Date Added</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->menutype->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
            @if ($item->user->roles[0]->name == 'admin')
            <span class="label label-success">
                {{ $item->user->roles[0]->label }}
            </span>
            @elseif ($item->user->roles[0]->name == 'staff')
            <span class="label label-info">
                {{ $item->user->roles[0]->label }}
            </span>
            @else
            <span class="label label-danger">
                {{ $item->user->roles[0]->label }}
            </span>
            @endif
                                        </td>
                                        <td>
                                        {{ $item->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                        {{ $item->updated_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/menus/' . $item->id) }}" title="View Menu"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/menus/' . $item->id . '/edit') }}" title="Edit Menu"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/menus', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Menu',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $menus->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
