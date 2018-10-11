@extends('layouts.backend')

@section('content')

<div class="col-sm-12">
<div class="white-box">
@if (Session::has('flash_message'))

                    @section('scripts')
                                <script type="text/javascript">
                                   swal('Completed', "{{ Session::get('flash_message') }}", 'success');
                                </script>
                    @endsection
                @endif
@if (Auth::user()->hasRole('receptionist'))
<h2>Guest Management</h2><hr />
<div class="text-center">
    <a style="margin-right: 20px" href="{{ url('/admin/users/create?type=guest') }}" class="btn btn-success btn-lg" title="Add New User">
<i class="fa fa-user" aria-hidden="true"></i> Add New Guest
</a>
<a href="{{ url('/admin/bookroom') }}" class="btn btn-primary btn-lg" title="Check-in Guest">
<i class="fa fa-sign-in" aria-hidden="true"></i> Check-in Guest
</a>
</div>
@endif

@if (Auth::user()->hasRole('admin'))
<h3 class="box-title">Users Managament</h3>
<a href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-sm" title="Add New User">
<i class="fa fa-plus" aria-hidden="true"></i> Add New Staff
</a>
@endif

{!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
<div class="text-right">
<div class="input-group">
<input type="text" class="form-control" name="search" placeholder="Surname, email or mobile number">
<span class="input-group-btn">
<button class="btn btn-secondary" type="submit">
    <i class="fa fa-search"></i>
</button>
</span>
</div>
</div>
{!! Form::close() !!}
<br />
<div class="table-responsive">
<table class="table color-table red-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Mobile Number</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (Auth::user()->hasRole('admin'))
        @foreach($users as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ url('/admin/users', $item->id) }}">{{ $item->surname }}, {{ $item->firstname }} {{ $item->othername }}</a></td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->mobile_number }}</td>
        <td>
            @if ($item->roles[0]->name == 'guest')
            <span class="label label-danger">
                {{ $item->roles[0]->label }}
            </span>
            @elseif ($item->roles[0]->name == 'gmanager')
            <span class="label label-success">
                {{ $item->roles[0]->label }}
            </span>
            @else
            <span class="label label-info">
                {{ $item->roles[0]->label }}
            </span>
            @endif
        </td>
        <td>
            @can('view-user')
            <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
            @endcan
            @can('update-user')
            @if ($item->roles[0]->name == 'guest')
            <a href="{{ url('/admin/users/' . $item->id . '/edit?type=guest') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            @else
            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            @endif
            @endcan
            @can('delete-user')
            {!! Form::open([
                'method' => 'DELETE',
                'url' => ['/admin/users', $item->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                )) !!}
            {!! Form::close() !!}
            @endcan
        </td>
    </tr>
@endforeach

@else

@foreach($guests[0]->users as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ url('/admin/users', $item->id) }}">{{ $item->surname }}, {{ $item->firstname }} {{ $item->othername }}</a></td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->mobile_number }}</td>
        <td>
            <span class="label label-danger">
                {{ $item->roles[0]->label }}
            </span>
        </td>
        <td>
            @can('view-user')
            <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
            @endcan
            @can('update-user')
            <a href="{{ url('/admin/users/' . $item->id . '/edit?type=guest') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            @endcan
            @can('delete-user')
            {!! Form::open([
                'method' => 'DELETE',
                'url' => ['/admin/users', $item->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                )) !!}
            {!! Form::close() !!}
            @endcan
        </td>
    </tr>
@endforeach
@endif
    </tbody>
</table>
<div class="pagination"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
</div>
</div>
</div>

@endsection
