<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Upload Coverage Data</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('coveragedata.store') }}" method="POST">
            @csrf
            <div class=" form-group d-flex ">
                <select class="form-control ml-3" data-column="5" name="operator_name" id="operator_name">
                    <option value=""> - Select Operator -</option>
                    @foreach ($operators as $key=>$value)
                    <option value="{{ $key }}">{{ $key }}</option>
                    @endforeach
                </select>
                <select class="form-control ml-3" data-column="4" name="generation_type" id="generation_type">
                    <option value="">- Select Generation Type -</option>
                    <option value="2G">2G</option>
                    <option value="3G">3G</option>
                    <option value="4G">4G</option>
                </select>
            </div>
            <div class=" form-group d-flex ">
                <input class="form-control ml-3" type="file" id="tab_file" name="tab_file">
            </div>
            <div class="form-group d-flex">
                <button type="submit" data-toggle="tooltip" data-placement="bottom"
                title="Upload MapInfo File To Server"
                class="btn btn-success ml-2">Upload File
            </button>            </div>
        </form>
    </div>
</div>
