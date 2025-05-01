<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter data</h5>
    </div>
    <div class="card-body">
        <div class=" form-group d-flex ">
            <select class="form-control ml-3 filter-input" data-column="3" name="provincefilter" id="provincefilter">
                <option value=""> - Select Province -</option>
                @foreach ($provinces as $key=>$value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <select class="form-control ml-3 filter-input" data-column="4" name="districtfilter" id="districtfilter">
                <option value=""> - Select District -</option>
                @foreach ($districts as $key=>$value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <select class="form-control ml-3 filter-input" data-column="5" name="vdcfilter" id="vdcfilter">
                <option value="">- Select VDC -</option>
                @foreach ($vdcs as $key=>$value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <select class="form-control ml-3 filter-input" data-column="6" name="wardfilter" id="wardfilter">
                <option value="">- Select Ward -</option>
            </select>
        </div>
        <div class=" form-group d-flex ">
        <select class="form-control ml-3 filter-input" data-column="1" name="oprcdfilter" id="oprcdfilter">
            <option value=""> - Select Operator -</option>
            @foreach ($operators as $key=>$value)
                <option value="{{ $key }}">{{ $key }}</option>
            @endforeach
        </select>
            <input class="form-control ml-3 filter-input" data-column="2" name="oprsitenamefilter" id="oprsitenamefilter"
                   placeholder=" - Site Name - ">
            <select class="form-control ml-3 filter-input" data-column="7" name="antbasefilter" id="antbasefilter">
                <option value=""> - Select Antenna Base -</option>
                    <option value="Ground">Ground</option>
                    <option value="Rooftop">Rooftop</option>
                    <option value="Others">Others</option>
            </select>
            <select class="form-control ml-3 filter-input" data-column="8" name="antlocfilter" id="antlocfilter">
                <option value=""> - Select Antenna Location -</option>
                <option value="Rural">Rural</option>
                <option value="Urban">Urban</option>
                <option value="Suburban">Suburban</option>
            </select>
        </div>
        <div class="d-flex flex-row-reverse">
            <a><button type="button" id="clear-filter-btn" data-toggle="tooltip" data-placement="bottom" title="Remove Applied Filters" class="btn btn-info ml-2" style="color: white">Clear Filter</button></a>
        </div>
    </div>
</div>
