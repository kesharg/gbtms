<div id="navbar_map" class="d-flex">

    <button type="button" class="btn btn-light border " data-toggle="tooltip" data-placement="bottom"
        title="Draw Shapes" >
        <i class="fa fa-hand-pointer-o" aria-hidden="true" style="color:#32e0c4;"></i>
        <select id="interactionDraw">
            <option value="None">None</option>
            <option value="Point">Point</option>
            <option value="LineString">Line</option>
            <option value="Polygon">Polygon</option>
            <option value="Circle">Circle</option>
        </select>
    </button>
    <button type="button" class="btn btn-light border ml-1" data-toggle="tooltip" data-placement="bottom"
        title="Measure Area and Length">
        <i class="fa fa-area-chart" aria-hidden="true" style="color:#436f8a;"></i>
        <select id="measurement">
            <option value="None">None</option>
            <option value="length">Length</option>
            <option value="area">Area</option>
        </select>
    </button>


    <button type="button" class=" ml-1 btn btn-light border" id="original_extent" data-toggle="tooltip"
        data-placement="bottom" title="Original Extent"><i class="fa fa-globe" aria-hidden="true"
            style="color:#4747ff;"></i></button>
    <button type="button" class="btn btn-light border ml-1" id="coordinate_info" data-toggle="tooltip"
        data-placement="bottom" title="Co-ordinate Information"><i style="color:#3b6978;" class="fa fa-map-pin"
            aria-hidden="true"></i>
    </button>

    @can('map-tools')
    <button type="button" class=" ml-1 btn btn-light border" id="map_tools" data-toggle="tooltip"
        data-placement="bottom" title="Map Tools">    <i class="fas fa-toolbox" style="color:#9ecd63;"></i>
    </button>
    @endcan
    
    {{-- <button type="button" class="btn btn-light border ml-1" id="print_map" data-toggle="tooltip" data-placement="bottom"
        title="Print Map"><i class="fa fa-print" aria-hidden="true" style="color:#01a9b4;"></i></button> --}}

    <button type="button" class="btn btn-light border ml-1" id="clear" data-toggle="tooltip" data-placement="bottom"
        title="Clear"><i class="fa fa-trash" aria-hidden="true" style="color:#e31c1e;"></i>
    </button>

</button>

    <!-- Button trigger modal -->

    <select class="ml-5" name="province" id="province">
        <option value="">- Select Province -</option>
        @foreach ($provinces as $key=>$value)
        <option title="{{$value}}" value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
    <select class="ml-1" style="width:10vw;" name="district" id="district">
        <option value=""> - Select District -</option>
        @foreach ($districts as $key=>$value)
        <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
    <select class="ml-1" style="width:8vw;" name="vdc" id="vdc">
        <option value="">- Select VDC -</option>
        @foreach ($vdcs as $key=>$value)
        <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
    <select class="ml-1" style="width:9vw;" name="ward" id="ward">
        <option value="">- Select Ward -</option>

    </select>



    <div class="d-flex ml-auto align-self-center" ondblclick="triggerdblSelectclick()" onclick="triggerSelectclick()">
        <i class="fa fa-info-circle fa-2x mr-1 mt-1" style="color:#4fc3f7;" aria-hidden="true"></i>
        <select style="display:none;" name="info" id="info">
            <option value="">-Get Information-</option>
            <option value="provinceInfo">Province</option>
            <option value="districtInfo">District</option>
            <option value="vdcInfo">VDC</option>
            <option value="roadInfo">Road</option>
            <option value="riverInfo">River</option>
            <option value="BTSInfo">BTS</option>
            <option value="microwavenodeInfo">Microwave Station</option>
            <option value="microwavelinkInfo">Microwave Link</option>
            <option value="vsatInfo">VSAT Station</option>
            <option value="opticalfiberInfo">OF Node</option>
            <option value="opticalfiberlinkInfo">OF Link</option>
            <option value="opticalfiberplannedInfo">Highway OF Node</option>
            <option value="opticalfiberlinkplannedInfo">Highway OF Link</option>
            
        </select>
    </div>
</div>
