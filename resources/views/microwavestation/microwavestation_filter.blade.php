<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter Data</h5>
    </div>
    <div class="card-body">
        <div class=" form-group d-flex ">

            <input class="form-control ml-3 filter-input" data-column="0" name="linkidfilter" id="linkidfilter"
                placeholder="Link ID">

            <input class="form-control ml-3 filter-input" data-column="1" name="linknamefilter" id="linknamefilter"
                placeholder="Link Name">

            <input class="form-control ml-3 filter-input" data-column="6" name="mscodeafilter" id="mscodeafilter"
                placeholder="MSCODEA(Microwave Station code A)">

            <input class="form-control ml-3 filter-input" data-column="7" name="mscodebfilter" id="mscodebfilter"
                placeholder="MSCODEB(Microwave Station code B)">
            </input>
        </div>
        <div class=" form-group d-flex ">

            <input class="form-control ml-3 filter-input" data-column="3" name="bandwidth" id="bandwidth" placeholder="Bandwidth (MHz)">

            <input class="form-control ml-3 filter-input" data-column="4" name="polariz" id="polariz" placeholder="Polarization">

            <input type="number" class="form-control ml-3 filter-input" data-column="2" name="distance" id="distance" placeholder="Distance (>=)">

            <select class="form-control ml-3 filter-input" data-column="5" name="status" id="status">
                <option value=""> - Select Status -</option>
                <option value="Operation">Operation</option>
                <option value="Under Process">Under Process</option>
            </select>
        </div>
        <div class="d-flex flex-row-reverse">
            <a><button type="button" id="clear-filter-btn" data-toggle="tooltip" data-placement="bottom" title="Remove Applied Filters" class="btn btn-info ml-2" style="color: white">Clear Filter</button></a>
        </div>
    </div>
</div>
