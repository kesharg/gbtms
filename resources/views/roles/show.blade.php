@extends('layouts.home')


@section('content')


<div class="card mb-5">
    <div class="card-header">
        <h2>Role Information</h2>
    </div>
    <div class="card-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role Title:</strong>
                <label class="badge badge-success">{{ $role->name }}</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission allowed:</strong>
                @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                <label class="badge badge-info">{{ $v->name }}&nbsp;&nbsp;</label>
                @endforeach
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> &nbsp; Back &nbsp;</a>
        </div>
    </div>
</div>
@include('empty.space')
@endsection
