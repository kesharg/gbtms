@extends('layouts.home')
@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Microwave Node</h2>
    </div>
    <div class="card-body">

        <form>
            <div class="form-group mt-4">
                <label for="mwstncode" class="pull-left">Microwave station code:</label>
                <input type="text" class="form-control"
                    value="{{ $data->mwstncode }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="mwstncdopr" class="pull-left">Microwave Station Code Assigned By Operator:</label>
                <input type="text" class="form-control"
                    value="{{ $data->mwstncdopr }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="oprcd">Operator Code:</label>
                <input type="text" class="form-control "
                    value="{{ $data->oprcd }}"  placeholder="--Not-Found--" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="mwstnname">Microwave Station Name :</label>
                <input type="text" class="form-control " value="{{ $data->mwstnname }}"  placeholder="--Not-Found--" readonly>
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


            <div class="form-group mt-4" align="center">

                <a type="button" class="btn btn-primary " href="{{ route('microwavenode.index') }}"
                    data-dismiss="modal">Back</a>
            </div>
        </form>
    </div>
</div>
@include('empty.space')
@endsection
