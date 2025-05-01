@extends('layouts.home')
@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Vsat Node</h2>
    </div>
    <div class="card-body">

        <form>
            <div class="form-group mt-4">
                <label for="vsatid" class="pull-left">VSAT Station ID assigned by NTA:</label>
                <input type="text" class="form-control"
                    value="{{ $data->vsatid}}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprvsatid">VSAT Station ID assigned by Operator:</label>
                <input type="text" class="form-control "
                    value={{ $data->oprvsatid??"--Not-Found--" }} readonly>
            </div>
            <div class="form-group mt-4">
                <label for="vsatstnname">Vsat Station Name :</label>
                <input type="text" class="form-control " value="{{ $data->vsatstnname }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprcd">Operator Code:</label>
                <input type="text" class="form-control "
                    value={{ $data->oprcd??"--Not-Found--" }} readonly>
            </div>
            <div class="form-group mt-4">
                <label for="province">Province :</label>
                <input type="text" class="form-control " value="{{ $data->province }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="district">District :</label>
                <input type="text" class="form-control " value="{{ $data->district }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="vdc">VDC :</label>
                <input type="text" class="form-control " value="{{ $data->vdc }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="ward">Ward :</label>
                <input type="text" class="form-control " value="{{ $data->ward }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="lat">Lattitude :</label>
                <input type="text" class="form-control " value="{{ $data->lat }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="long">Longitude :</label>
                <input type="text" class="form-control " value="{{ $data->long }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprfrom">Operated from :</label>
                <input type="text" class="form-control " value="{{ $data->oprfrom }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprto">Operated to :</label>
                <input type="text" class="form-control " value="{{ $data->oprto }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="purpose">Purpose of Operation :</label>
                <input type="text" class="form-control " value="{{ $data->purpose }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="uplink">Transmission Frequency in MHz :</label>
                <input type="text" class="form-control " value="{{ $data->uplink }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="downlink">Receiving Frequecny in MHz :</label>
                <input type="text" class="form-control " value="{{ $data->downlink }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="modtechq">Modulation Technique :</label>
                <input type="text" class="form-control " value="{{ $data->modtechq }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="stationtype">VSAT / EARTH STATION :</label>
                <input type="text" class="form-control " value="{{ $data->stationtype }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="updatart">Uplink Data Rate :</label>
                <input type="text" class="form-control " value="{{ $data->updatart }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="dwndatart">Down Link Data Rate :</label>
                <input type="text" class="form-control " value="{{ $data->dwndatart }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="radiomodel">Radio Model :</label>
                <input type="text" class="form-control " value="{{ $data->radiomodel }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antdia">Antenna Diameter :</label>
                <input type="text" class="form-control " value="{{ $data->antdia }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="status">Status :</label>
                <input type="text" class="form-control " value="{{ $data->status }}"  placeholder="--Not-Found--" readonly>
            </div>

            <div class="form-group mt-4" align="center">

                <a type="button" class="btn btn-primary " href="{{ route('vsat.index') }}"
                    data-dismiss="modal">Back</a>
            </div>
        </form>
    </div>
</div>
@include('empty.space')
@endsection
