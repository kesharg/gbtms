@extends('layouts.home')
@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>System Station</h2>
    </div>
    <div class="card-body">

        <form>
            <div class="form-group mt-4">
                <label for="sysid" class="pull-left">System ID:</label>
                <input type="text" class="form-control" placeholder="System ID"
                    value="{{ $data->syssiteid}}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprcd">Operator Code:</label>
                <input type="text" class="form-control " placeholder="Operator Code"
                    value="{{ $data->oprcd}}" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="deviceid">Device ID :</label>
                <input type="text" class="form-control " value="{{ $data->deviceid}}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="azimuth">Azimuth :</label>
                <input type="text" class="form-control " value="{{ $data->azimuth }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="tilt">Tilt :</label>
                <input type="text" class="form-control " value="{{ $data->tilt }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antgain">Antenna Gain( db ) :</label>
                <input type="text" class="form-control " value="{{ $data->antgain }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="transpwr">Transmitted Power( dBm ):</label>
                <input type="text" class="form-control " value="{{ $data->transpwr }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="sector">Sector :</label>
                <input type="text" class="form-control " value="{{ $data->sector }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txchanls">Channel Number ( Tx ) :</label>
                <input type="text" class="form-control " value="{{ $data->txchanls }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txchanls">Channel Number ( Rx ) :</label>
                <input type="text" class="form-control " value="{{ $data->txchanls }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="carbdwidth">Carrier BandWidth(Mhz) :</label>
                <input type="text" class="form-control " value="{{ $data->carbdwidth }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="radio_model">Radio Model :</label>
                <input type="text" class="form-control " value="{{ $data->radio_model }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprdate">Operator Date :</label>
                <input type="text" class="form-control " value="{{ $data->oprdate }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="polariz">Polariz :</label>
                <input type="text" class="form-control " value="{{ $data->polariz }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="status">Status :</label>
                <input type="text" class="form-control " value="{{ $data->status }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="polariz">Type :</label>
                <input type="text" class="form-control " value="{{ $data->type }}"  placeholder="--Not-Found--" readonly>
            </div>


            <div class="form-group mt-4" align="center">

                <a type="button" class="btn btn-primary " href="{{ route('system.index') }}"
                    data-dismiss="modal">Back</a>
            </div>
        </form>
    </div>
</div>
@include('empty.space')
@endsection
