{{-- Print data in pdf modal --}}
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Generate Report By Administrative Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="btn-group d-flex my-4" role="group" aria-label="Basic example" width="100%">
                    <a href="#" role="button" class="btn btn-primary px-5 disabled" id="label-btn"  aria-disabled="true">Generate Report By
                            Country </a>
                    <a id="print_country" href="{{ route('print_country') }}"> <button type="button"
                            class="btn  btn-primary btn-block pull-right" role="group">pdf</button></a>
                    <a id="print_country" href="{{ route('exportCSV_country') }}"> <button type="button"
                            class="btn  btn-info btn-block pull-right" role="group">csv</button></a>
                </div>

                <div class="btn-group d-flex my-4" role="group" aria-label="Basic example">
                    <a href="#" role="button" class="btn btn-primary px-5 disabled" id="label-btn"  aria-disabled="true">Generate Report By
                            Province</a>
                    <a id="print_country" href="{{ route('print_province') }}"> <button type="button"
                            class="btn  btn-primary btn-block pull-right">pdf</button></a>
                    <a id="print_country" href="{{ route('exportCSV_province') }}"> <button type="button"
                            class="btn  btn-info btn-block pull-right">csv</button></a>
                </div>

                <div class="btn-group d-flex my-4" role="group" aria-label="Basic example">
                    <a href="#" role="button" class="btn btn-primary px-5 disabled" id="label-btn"  aria-disabled="true">Generate Report By
                            District</a>
                    <a id="print_country" href="{{ route('print_district') }}"> <button type="button"
                            class="btn  btn-primary btn-block pull-right">pdf</button></a>
                    <a id="print_country" href="{{ route('exportCSV_district') }}"> <button type="button"
                            class="btn  btn-info btn-block pull-right">csv</button></a>
                </div>

                <div class="btn-group d-flex my-4" role="group" aria-label="Basic example">
                    <a href="#" role="button" class="btn btn-primary px-5 disabled" id="label-btn"  aria-disabled="true">Generate Report By
                            VDC</a>
                    <a id="print_country" href="{{ route('print_vdc') }}"> <button type="button"
                            class="btn  btn-primary btn-block pull-right">pdf</button></a>
                    <a id="print_country" href="{{ route('exportCSV_vdc') }}"> <button type="button"
                            class="btn  btn-info btn-block pull-right">csv</button></a>
                </div>
                
                <!-- <div class="d-flex my-4" aria-label="Export Comment">
                    <label class="required">Comment</label>
                    <input type="text" class="form-control" id="export_comment" placeholder="Comments goes here.."> 
                </div> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Coverage data by province for different technology --}}
<div class="modal fade " id="viewcoverageModal" tabindex="-1" role="dialog" aria-labelledby="viewcoverageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewcoverageModalLabel">Coverage Data of province in area(km²)</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <canvas id="coverage_data_province" width="500" height="500"></canvas>

            </div>
            <div class="modal-footer">
                <div class=" mr-auto">
                    <select id="databyoprcd_type">
                        <option value="ncell2g" selected="selected">NCELL(2G)</option>
                        <option value="ncell3g">NCELL(3G)</option>
                        <option value="ncell4g">NCELL(4G)</option>
                        <option value="ndcl2g">NDCL(2G)</option>
                        <option value="ndcl3g">NDCL(3G)</option>
                        <option value="smart2g">Smart(2G)</option>
                    </select><br />
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

{{-- Export data by administrative unit  --}}
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Data Export Tool</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Choose Administrative Unit</h6><br/>
                <select class="form-control filter-export" name="ex_province" id="ex_province">
                    <option value="">- Select Province -</option>
                    @foreach ($provinces as $key=>$value)
                    <option title="{{$value}}" value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                </br>
                <select class="form-control filter-export" name="ex_district" id="ex_district">
                    <option value=""> - Select District -</option>
                    @foreach ($districts as $key=>$value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                </br>

                <select class="form-control filter-export" name="ex_vdc" id="ex_vdc">
                    <option value="">- Select VDC -</option>
                    @foreach ($vdcs as $key=>$value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                </br>

                <select class="form-control filter-export" name="ex_ward" id="ex_ward">
                    <option value="">- Select Ward -</option>

                </select>
                </br>
                <select class="form-control" name="ex_layer" id="ex_layer">
                    <option value="">- Select layer -</option>
                    <option value="microwaves">Microwave Node</option>
                    <option value="microwavestations">Microwave Link</option>
                    <option value="opticalfibers_new">OpticalFiber Node</option>
                    <option value="vsats">VSAT</option>
                    <option value="bts">System(BTS)</option>

                </select>
            </div>
            <div class="modal-footer">

                <a id="export_attr_shape" href=""> <button type="button" class="btn btn-primary"
                        id="exportdata_as_shape">Export(.shp)</button></a>
                <a id="export_attr_csv" href=""> <button type="button" class="btn btn-primary"
                        id="exportdata_as_csv">Export(.csv)</button></a>
                <a id="export_attr_kml" href=""> <button type="button" class="btn btn-primary"
                        id="exportdata_as_kml">Export(.kml)</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- Added after AMC --}}

<div class="modal fade" id="wmsModal" tabindex="-1" role="dialog" aria-labelledby="wmsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wmsModalLabel">Please Enter URL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mt-3" id="wmsAddress">
                </input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="wmsURL">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="getLayerModal" tabindex="-1" role="dialog" aria-labelledby="getLayerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getLayerModalLabel">Select a layer to be displayed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control mt-3" id="mapLayer">
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DEMModal" tabindex="-1" role="dialog" aria-labelledby="DEMModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DEMModalLabel">Elevation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <canvas id="DEMChart" width="100" height="100"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="map_print_modal" tabindex="-1" role="dialog" aria-labelledby="map_print_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="map_print_modalLabel">Print Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="required">Map Title<span class="required" style="color:red;">*</span></label>
                <input type="text" class="form-control" id="print_map_title"> 
                <label>Map Comment</label>
                <textarea type="text" class="form-control" id="print_map_comment"></textarea>
                <label>Map Description</label>
                <textarea type="text" class="form-control" id="print_map_description"></textarea>
                <label>Scale</label>
                <select class="form-control " id="print_scale">
                    <option value="500">1:500</option>
                    <option value="1000">1:1000</option>
                    <option value="2000">1:2000</option>
                    <option value="5000">1:5000</option>
                    <option value="10000">1:10000</option>
                    <option value="20000">1:20000</option>
                    <option value="25000" selected>1:25,000</option>
                    <option value="50000" >1:50,000</option>
                    <option value="100000" >1:100,000</option>
                    <option value="200000" >1:200,000</option>
                    <option value="500000" >1:500,000</option>
                    <option value="1000000" >1:1000,000</option>
                    <option value="1000000" >1:2000,000</option>
                    <option value="3000000" >1:3000,000</option>
                    <option value="4000000" >1:4000,000</option>
                    <option value="5000000" >1:5000,000</option>
                </select>
                <label>Paper Size</label>
                <select class="form-control " id="print_paper_size">
                    <option value="A4" selected>A4</option>
                </select>
                <label>DPI</label>
                <select class="form-control " id="print_dpi">
                    <option value="75" >75</option>
                    <option value="150" selected>150</option>
                    <option value="300" >300</option>
                </select>
                <input type="hidden" id="map-print-polygon-center" name="polygon_center" value="" />
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="print_map_fish">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="map_tools_modal" tabindex="-1" role="dialog" aria-labelledby="map_tools_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="map_tools_modalLabel">Map Tools</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" data-toggle="modal" data-target="#printModal" onclick=closeToolsModal()>
                                <i class="fa fa-file-text-o"></i>&nbsp; Report Generation Tool
                            </a>
                        </div>
                        <div class="col-sm">
                            <a onclick=closeToolsModal() class="btn btn-outline-primary btn-block m-1" id="map_print">
                                <i class="fa fa-print"
                                    aria-hidden="true" style="color:#01a9b4;"></i>&nbsp; Print map</a>
                        </div>
                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" data-toggle="modal" data-target="#exportModal" onclick=closeToolsModal()>
                                <i class="fas fa-file-download" style="color:#1da5de;"></i>&nbsp; Data Export Tool
                            </a>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" id="draw_for_export"><i class="fa fa-map-o"
                                    style="color:#ffcc80;"></i>&nbsp; Custom boundary export
                            </a>
                        </div>
                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" id="wms_layer" data-toggle="modal" data-target="#wmsModal" onclick=closeToolsModal()><i
                                    class="fas fa-layer-group"></i>&nbsp; Import from WMS
                            </a>
                        </div>
                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" id="dem_profile" onclick=closeToolsModal()><i class="fas fa-chart-line"></i>&nbsp; Show DEM profile</a> </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        {{--  <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" data-toggle="modal" data-target="#viewcoverageModal" onclick=closeToolsModal()>
                                <i class="fas fa-chart-bar"></i>&nbsp; View coverage chart
                            </a>
                        </div> --}}

                        <div class="col-sm">
                            <a class="btn btn-outline-primary btn-block m-1" id="draw_for_length"><i class="fa fa-arrows-h"
                                    style="color:#ffcc80;"></i>&nbsp; Optical Fiber Length
                            </a>
                        </div>
                        <div class="col-sm">
                            <a onclick=closeToolsModal() id="population_penetration" class="btn btn-outline-primary btn-block m-1" data-toggle="modal" data-target="#populationpenetrationModal">
                                <i class="fas fa-chart-bar"></i>&nbsp; Population penetration
                            </a>
                        </div>
                        <div class="col-sm">
                            <a onclick=closeToolsModal() id="geographic_penetration" class="btn btn-outline-primary btn-block m-1" data-toggle="modal" data-target="#geographicpenetrationModal" >
                                <i class="fas fa-chart-bar"></i>&nbsp; Geographic coverage
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a onclick=closeToolsModal() class="btn btn-outline-primary btn-block m-1" id="map_print"><i class="fa fa-print"
                                    aria-hidden="true" style="color:#01a9b4;"></i>&nbsp; Print map</a>
                        </div>
                    </div>
                </div>
                --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include('map.mapModals.geographical_penetration')
@include('map.mapModals.population_penetration')

<script>
    function closeToolsModal(){
        $("#map_tools_modal").modal('hide');
    }
</script>
