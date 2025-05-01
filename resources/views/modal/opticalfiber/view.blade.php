@extends('layouts.home')
@section('content')

    <div class="card mb-5">
        <div class="card-header">
            {{-- Card Head --}}
            <h2>Optical Fiber Node</h2>
        </div>
        <div class="card-body">

            <form>
                <div class="form-group mt-4">
                    <label for="nodeid" class="pull-left">Code by NTA :</label>
                    <input type="text" class="form-control"
                           value="{{ $data->nodeid   }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="nodename">Location :</label>
                    <input type="text" class="form-control "
                           value="{{ $data->nodename   }} "  placeholder="--Not-Found--" readonly>
                </div>
                <!-- <div class="form-group mt-4">
                    <label for="oprcd">Operator Code :</label>
                    <input type="text" class="form-control " value="{{ $data->oprcd  }}"   placeholder="--Not-Found--" readonly>
                </div> -->
                <div class="form-group mt-4">
                    <label for="lat">Latitude :</label>
                    <input type="text" class="form-control "
                           value="{{ $data->lat   }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="long">Longitude :</label>
                    <input type="text" class="form-control "
                           value="{{ $data->long   }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="province">Province :</label>
                    <input type="text" class="form-control " value="{{ $data->province  }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="district">District :</label>
                    <input type="text" class="form-control " value="{{ $data->district  }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="vdc">VDC :</label>
                    <input type="text" class="form-control " value="{{ $data->vdc  }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="ward">Ward :</label>
                    <input type="text" class="form-control " value="{{ $data->ward  }}"   placeholder="--Not-Found--" readonly>
                </div>
                <div class="form-group mt-4">
                    <label for="strtname">Street :</label>
                    <input type="text" class="form-control " value="{{ $data->strtname  }}"   placeholder="--Not-Found--" readonly>
                </div>


                <div class="form-group mt-4" align="center">

                    <a type="button" class="btn btn-primary " href="{{ route('opticalfiber.index') }}"
                       data-dismiss="modal">Back</a>
                </div>
            </form>
        </div>
    </div>
    @include('empty.space')
@endsection
