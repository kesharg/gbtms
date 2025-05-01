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
            <select class="form-control ml-3 filter-input" data-column="2" name="oprcdfilter" id="oprcdfilter">
                <option value=""> - Select Operator -</option>
                @foreach ($operators as $operator)
                    <option value="{{ $operator }}">{{ $operator }}</option>
                @endforeach
            </select>
            <input class="form-control ml-3 filter-input" data-column="1" name="locationfilter" id="locationfilter"
                   placeholder="Location Name"/>
            <div class="form-control ml-3" style="visibility: hidden"></div>
            <div class="form-control ml-3" style="visibility: hidden"></div>
        </div>
        <div class="d-flex flex-row-reverse">
            <a><button type="button" id="clear-filter-btn" data-toggle="tooltip" data-placement="bottom" title="Remove Applied Filters" class="btn btn-info ml-2" style="color: white">Clear Filter</button></a>
        </div>
    </div>
</div>
