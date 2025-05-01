@extends('layouts.home')
@section('content')

    <div class="card mb-5">
        <div class="card-header">
            {{-- Card Head --}}
            <h2>PSTN</h2>
        </div>
        <div class="card-body">

            <form>
                <div class="form-group mt-4">
                    <label for="exid" class="pull-left">Exchange ID :</label>
                    <input type="text" class="form-control"
                           value={{ $data->exid??"--Not-Found--" }} readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="exname">Exchange Name :</label>
                    <input type="text" class="form-control "
                           value={{ $data->exname??"--Not-Found--" }} readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="extype">Exchange Type :</label>
                    <input type="text" class="form-control " value={{ $data->extype ??"--Not-Found--"}} readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="district">District :</label>
                    <input type="text" class="form-control " value={{ $data->district ??"--Not-Found--"}} readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="lat">Latitude :</label>
                    <input type="text" class="form-control " value={{ $data->lat ??"--Not-Found--"}} readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="long">Longitude :</label>
                    <input type="text" class="form-control " value={{ $data->long ??"--Not-Found--"}} readonly>
                </div>


                <div class="form-group mt-4" align="center">

                    <a type="button" class="btn btn-primary " href="{{ route('pstn.index') }}"
                       data-dismiss="modal">Back</a>
                </div>
            </form>
        </div>
    </div>
    @include('empty.space')
@endsection
