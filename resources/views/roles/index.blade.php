@extends('layouts.home')


@section('content')
<div class="card mb-5">
    <div class="card-header">
        <h2>Role Management</h2>
    </div>
    <div class="card-body">
        <div class="pull-right mt-2 mb-2">
            <a class="btn btn-primary" href="{{ route('roles.create') }}">Create A New Role</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Role Title</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($roles as $key => $role)
            <tr>
                @if($role->name=="SuperAdmin")
                @continue
                @endif
                <td>{{ ++$i }}</td>
                <td><label class="badge badge-success text-uppercase">{{ $role->name }} </label></td>
                <td>
                    <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                    $role->id],'style'=>'display:inline'])
                    !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

{!! $roles->render() !!}
@include('success.success')

@include('empty.space')

@endsection
