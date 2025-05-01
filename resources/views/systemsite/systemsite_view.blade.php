@extends('layouts.home')
@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>System Site</h2>
    </div>
    <div class="card-body">

        <form>
            <div class="form-group mt-4">
                <label for="sysid" class="pull-left">System ID:</label>
                <input type="text" class="form-control" placeholder="System ID"
                    value={{ $data->syssiteid ?? "--Not-Found--" }} readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprcd">Operator Code:</label>
                <input type="text" class="form-control " placeholder="Operator Code"
                    value={{ $data->oprcd ?? "--Not-Found--" }} readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprsideid">Operator Site ID :</label>
                <input type="text" class="form-control " value="{{ $data->oprsideid}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprsitename">Operator Site Name :</label>
                <input type="text" class="form-control " value="{{ $data->oprsitename}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="province">Province :</label>
                <input type="text" class="form-control " value="{{ $data->province}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="district">District :</label>
                <input type="text" class="form-control " value="{{ $data->district}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="vdc">VDC :</label>
                <input type="text" class="form-control " value="{{ $data->vdc}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="ward">Ward :</label>
                <input type="text" class="form-control " value="{{ $data->ward}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="lat">Lattitude :</label>
                <input type="text" class="form-control " value="{{ $data->lat}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="long">Longitude :</label>
                <input type="text" class="form-control " value="{{ $data->long}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="anthtmsl">Antenna Height Mean Sea Level :</label>
                <input type="text" class="form-control " value="{{ $data->anthtmsl}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="anthtgl">Antenna Height Above Ground Level :</label>
                <input type="text" class="form-control " value="{{ $data->anthtgl}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antbase">Antenna Base :</label>
                <input type="text" class="form-control " value="{{ $data->antbase}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antloc">Antenna Location :</label>
                <input type="text" class="form-control " value="{{ $data->antloc}}" placeholder="--Not-Found--" readonly>
            </div>
          

            <div class="form-group mt-4" align="center">

                <a type="button" class="btn btn-primary " href="{{ route('systemsite.index') }}"
                    data-dismiss="modal">Back</a>
            </div>
        </form>
    </div>
</div>
@include('empty.space')
@endsection
