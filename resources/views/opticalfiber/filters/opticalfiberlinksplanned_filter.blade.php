<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter data</h5>
    </div>
    <div class="card-body">
        <div class=" form-group d-flex ">
            <select class="form-control ml-3 filter-input" data-column="5" name="cablefilter" id="cablefilter">
                <option value=""> - Select Cable Type -</option>
                @foreach ($cable_laying_type as $cabletype)
                    <option value="{{ $cabletype }}">{{ $cabletype }}</option>
                @endforeach
            </select>
            <input class="form-control ml-3 filter-input" data-column="2" name="linknamefilter" id="linknamefilter"
                   placeholder="Link Name"/>
            <div class="form-control ml-3" style="visibility: hidden"></div>
        </div>
        <div class="d-flex flex-row-reverse">
            <a><button type="button" id="clear-filter-btn" data-toggle="tooltip" data-placement="bottom" title="Remove Applied Filters" class="btn btn-info ml-2" style="color: white">Clear Filter</button></a>
        </div>
    </div>
</div>
