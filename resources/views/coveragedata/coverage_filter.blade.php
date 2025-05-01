<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter data</h5>
    </div>
    <div class="card-body">
        <div class=" form-group d-flex ">
            <select class="form-control ml-3" data-column="0" name="oprcdfilter" id="oprcdfilter">
                <option value=""> - Select Operator -</option>
                @foreach ($operators as $key=>$value)
                    <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
            </select>
            <select class="form-control ml-3" data-column="1" name="generation_type_filter" id="generation_type_filter">
                <option value="">- Select Generation Type -</option>
                <option value="2G">2G</option>
                <option value="3G">3G</option>
                <option value="4G">4G</option>
            </select>
            <div class="form-control ml-3" style="visibility: hidden"></div>
            <div class="form-control ml-3" style="visibility: hidden"></div>
        </div>
    </div>
</div>
