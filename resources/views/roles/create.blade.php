@extends('layouts.home')


@section('content')

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="card mb-5">
    <div class="card-header">
        <h2>Create A New Role</h2>
    </div>
    @include('errors.error')
    <div class="card-body">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role Title:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Role Title','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission allowed:</strong>
                <br />
                <div class="row">
                    @foreach($permission as $value)
                    <div class="col-md-3">
                        <label>
                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label> </div>

                    @if($loop->iteration%4==0) </div>
                <div class="row"> @endif
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> &nbsp; Back &nbsp;</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @include('empty.space')

    @endsection
