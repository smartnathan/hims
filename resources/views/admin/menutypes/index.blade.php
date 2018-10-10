@extends('layouts.backend')

@section('content')
<div class="container">
<div class="row">

<div class="col-md-12 white-box">
<h2 class="m-b-0">Menu Category</h2><hr />
    <a href="{{ url('/admin/menutypes/create') }}" class="btn btn-success btn-sm" title="Add New Menutype">
        <i class="fa fa-plus" aria-hidden="true"></i> Add a New Menu Category
    </a>

    {!! Form::open(['method' => 'GET', 'url' => '/admin/menutypes', 'class' => 'form-inline my-2 my-lg-0 float-right'])  !!}
    <div class="text-right">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
    {!! Form::close() !!}
</div>



    <div class="table-responsive">
        <table width="" class="table table-borderless">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($menutypes as $item)
                <tr>
                    <td>{{ $loop->iteration or $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td><span class="label label-success">
                        {{ $item->user->roles[0]->label }}
                    </span></td>
                    <td>
                        <a href="{{ url('/admin/menutypes/' . $item->id) }}" title="View Menutype"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/admin/menutypes/' . $item->id . '/edit') }}" title="Edit Menutype"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/menutypes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Menutype',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $menutypes->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

</div>
</div>
</div>
</div>
</div>
@endsection
