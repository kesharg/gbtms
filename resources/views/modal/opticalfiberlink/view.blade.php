@extends('layouts.home')
@section('content')

    <div class="card mb-5">
        <div class="card-header">
            {{-- Card Head --}}
            <h2>Optical Fiber Link</h2>
        </div>
        <div class="card-body">

            <form>
                <div class="form-group mt-4">
                    <label for="oflinkid" class="pull-left">Code by NTA :</label>
                    <input type="text" class="form-control"
                           value="{{ $data->oflinkid}}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="oprlinkid">Link ID by Operator :</label>
                    <input type="text" class="form-control "
                           value="{{ $data->oprlinkid}}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="linkname">Link Name :</label>
                    <input type="text" class="form-control " value="{{ $data->linkname  }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="oprcd">Operator Code :</label>
                    <input type="text" class="form-control " value="{{ $data->oprcd  }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="length">Segment Length :</label>
                    <input type="text" class="form-control " value="{{ $data->length  }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="orgnodeid">Origin Node ID :</label>
                    <input type="text" class="form-control " value="{{ $data->orgnodeid  }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="endnodeid">End Node ID :</label>
                    <input type="text" class="form-control " value="{{ $data->endnodeid  }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="cabletype">Cable Laying Type :</label>
                    <input type="text" class="form-control " value="{{ $data->cabletype }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="fibers">No Of Fibers :</label>
                    <input type="text" class="form-control " value="{{ $data->fibers }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="capacity">Capacity(dB) :</label>
                    <input type="text" class="form-control " value="{{ $data->capacity }}"  placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="status">Link Status :</label>
                    <input type="text" class="form-control " value="{{ $data->status }}"  placeholder="--Not-Found--" readonly>
                </div>


                <div class="form-group mt-4" align="center">

                    <a type="button" class="btn btn-primary " href="{{ route('opticalfiberlink.index') }}"
                       data-dismiss="modal">Back</a>
                </div>
            </form>
        </div>
    </div>
    @include('empty.space')
@endsection
