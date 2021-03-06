@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 white-box">
                <div class="card">
                    @if (Session::has('flash_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed!', "{{ Session::get('flash_message') }}", 'success');
                                </script>
                    @endsection
                @endif
                    <h2>Item groups</h2><hr />
                    <div class="card-body">
                        <a href="{{ url('/admin/item-groups/create') }}" class="btn btn-success btn-sm" title="Add New Item Group">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/item-groups', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                        <th>#</th><th>Code</th><th>Name</th><th>Added By</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($itemgroups as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->code }}</td><td>{{ $item->name }}</td><td>{{ $item->user->firstname }} {{ $item->user->surname }} <label class="label label-danger">{{ $item->user->roles[0]->label }}</label></td>
                                        <td>
                                            <a href="{{ url('/admin/item-groups/' . $item->id) }}" title="View ItemGroup"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/item-groups/' . $item->id . '/edit') }}" title="Edit ItemGroup"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/item-groups', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete ItemGroup',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $itemgroups->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
