@extends('layouts.home')
@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Microwave Station Link</h2>
    </div>
    <div class="card-body">

        <form>
            <div class="form-group mt-4">
                <label for="mwlinkid" class="pull-left">Microwave station link ID:</label>
                <input type="text" class="form-control"
                    value="{{ $data->mwlinkid }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprlinkid">Operator Link ID :</label>
                <input type="text" class="form-control " value="{{ $data->oprlinkid }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="linkname">Link Name :</label>
                <input type="text" class="form-control " value="{{ $data->linkname }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprcd">Operator Code:</label>
                <input type="text" class="form-control "
                    value="{{ $data->oprcd}}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="distance">Distance :</label>
                <input type="text" class="form-control " value="{{ $data->distance }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="bdwidth">Bandwidth :</label>
                <input type="text" class="form-control " value="{{ $data->bdwidth }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="polariz">Polariz :</label>
                <input type="text" class="form-control " value="{{ $data->polariz }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="dateapprove">Date Approved :</label>
                <input type="text" class="form-control " value="{{ $data->dateapprove }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="dateoprt">Operation Date :</label>
                <input type="text" class="form-control " value="{{ $data->dateoprt }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="status">Status :</label>
                <input type="text" class="form-control " value="{{ $data->status }}" placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="mwstncodea">Microwave Station Code A :</label>
                <input type="text" class="form-control " value="{{ $data->mwstncodea }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="azimutha">Azimuth in Degree :</label>
                <input type="text" class="form-control " value="{{ $data->azimutha }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="radiomodela">Model of Radios :</label>
                <input type="text" class="form-control " value="{{ $data->radiomodela }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txfrqa">Transmission Frequency in MHz :</label>
                <input type="text" class="form-control " value="{{ $data->txfrqa }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="rxfrqa">Receiving Frequecny in MH :</label>
                <input type="text" class="form-control " value="{{ $data->rxfrqa }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antdiaa">Antenna Diameter in Meter :</label>
                <input type="text" class="form-control " value="{{ $data->antdiaa }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antgaina">Antenna gain( dB ) :</label>
                <input type="text" class="form-control " value="{{ $data->antgaina }}  "placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txpowera">Transmitted Power( dBm ) :</label>
                <input type="text" class="form-control " value="{{ $data->txpowera }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="rxpowera">Receiver Power( dBm ) :</label>
                <input type="text" class="form-control " value="{{ $data->rxpowera }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="anthtgla">Antenna height above the ground Level  [m] :</label>
                <input type="text" class="form-control " value="{{ $data->anthtgla }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="mwstncodeb">Microwave Station Code B :</label>
                <input type="text" class="form-control " value="{{ $data->mwstncodeb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="azimuthb">Azimuth in Degree :</label>
                <input type="text" class="form-control " value="{{ $data->azimuthb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="radiomodelb">Model of Radios :</label>
                <input type="text" class="form-control " value="{{ $data->radiomodelb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txfrqb">Transmission Frequency in MHz :</label>
                <input type="text" class="form-control " value="{{ $data->txfrqb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="rxfrqb">Receiver Frequency in MHz :</label>
                <input type="text" class="form-control " value="{{ $data->rxfrqb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antdiab">Antenna Diameter in Meter :</label>
                <input type="text" class="form-control " value="{{ $data->antdiab }}  "placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="antgainb">Antenna gain( dB ) :</label>
                <input type="text" class="form-control " value="{{ $data->antgainb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="txpowerb">Transmitted Power( dBm ) :</label>
                <input type="text" class="form-control " value="{{ $data->txpowerb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="rxpowerb">Receiver Power( dBm )  :</label>
                <input type="text" class="form-control " value="{{ $data->rxpowerb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="anthtglb">Antenna height above the ground Level  [m] :</label>
                <input type="text" class="form-control " value="{{ $data->anthtglb }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="band_code">Band Code :</label>
                <input type="text" class="form-control " value="{{ $data->band_code }}"  placeholder="--Not-Found--" readonly>
            </div>

            <div class="form-group mt-4" align="center">

                <a type="button" class="btn btn-primary " href="{{ route('microwavestationlink.index') }}"
                    data-dismiss="modal">Back</a>
            </div>
        </form>
    </div>
</div>
@include('empty.space')
@endsection
