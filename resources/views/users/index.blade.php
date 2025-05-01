@extends('layouts.home')


@section('content')
<div class="card mb-5">
    <div class="card-header">
        <h2>User Management</h2>
    </div>
    <div class="card-body">
        @can('user-create')
        <div class="pull-right mt-2 mb-2">
            <a class="btn btn-primary" href="{{ route('users.create') }}">Create A New User</a>
        </div>
        @endcan
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role Title</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
            @if($user->email=="super@admin.com")
            @continue
            @endif
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('users.show',$user->id) }}">Show</a>
                    @can('user-edit')
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @endcan
                    @can('user-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                    $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
{!! $data->render() !!}
@include('success.success')

@include('empty.space')

@endsection
