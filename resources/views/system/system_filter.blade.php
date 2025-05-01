<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter Data</h5>
    </div>
    <div class="card-body">
        <div class=" form-group d-flex ">
            <input class="form-control ml-3 filter-input" data-column="0" name="syssiteidfilter" id="syssiteidfilter" placeholder="System ID">

            <select class="form-control ml-3 filter-input" data-column="1" name="oprcdfilter" id="oprcdfilter">
                <option value=""> - Select Operator -</option>
                @foreach ($operators as $key=>$value)
                <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
            </select>

            <input class="form-control ml-3 filter-input" data-column="2" name="deviceidfilter" id="deviceidfilter" placeholder="Device ID">

            <select class="form-control ml-3 filter-input" data-column="9" name="statusfilter" id="statusfilter">
                <option value=""> - Select Status -</option>
                    <option value="Operation">Operation</option>
                    <option value="Under Process">Under Process</option>
            </select>
        </div>
        <div class=" form-group d-flex ">
            <select class="form-control ml-3 filter-input" data-column="10" name="typefilter" id="typefilter">
                <option value=""> - Select Type -</option>
                <option value="2G">2G</option>
                <option value="3G">3G</option>
                <option value="4G">4G</option>
            </select>

            <input class="form-control ml-3 filter-input" data-column="8" name="polarizfilter" id="polarizfilter" placeholder="Polarization">
            <div class="form-control ml-3" style="visibility: hidden"></div>
            <div class="form-control ml-3" style="visibility: hidden"></div>

{{--            <input type="text" class="form-control ml-3 filter-input" name="date_from" id="date_from" placeholder="Date : From">--}}
{{--            <input type="text" class="form-control ml-3 filter-input" name="date_to" id="date_to" placeholder="Date : To">--}}

        </div>
        <div class="d-flex flex-row-reverse">
            <a><button type="button" id="clear-filter-btn" data-toggle="tooltip" data-placement="bottom" title="Remove Applied Filters" class="btn btn-info ml-2" style="color: white">Clear Filter</button></a>
        </div>
    </div>
</div>


