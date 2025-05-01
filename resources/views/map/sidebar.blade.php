
<div class="sideba map_scroll" style="display: none;" id="rightMenu">
    <h4 class="mt-2">Base Layers</h4>
    <select class="mt-2" id="base_layer">
        <option value="NoLayer">No Layer</option>
        <option value="OSMStandard">OSM Standard</option>
        <option value="OSMHumanitarian">OSM Humanitarian</option>
        <option value="BingMaps">Bing Maps</option>
        <option value="CartoDarkAll">Carto Dark All</option>
        <option value="StamenTerrainWithLabels">Only Labels</option>
        <option value="StamenTerrain">Stamen Terrain</option>
        <option value="gmap">Google Map</option>
        <option value="gsatmap">Google Satellite Map</option>
    </select>

    <div class="layer_slidecontainer">
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="base_map_slider">
    </div>
    <hr>
    {{-- Upper Layer ( RASTER LAYER) --}}
    <h4 class="mt-2">Layers</h4>

    {{-- Border Layer --}}
    <input class="layer mt-2 mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="maps_nepal" checked />Nepal
    Border<br />
    <div id="nepalborderDIV">
        <img id="maps_nepalLegend" />
        <br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="border_slider">

    </div>

    {{-- Province Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="maps_province"
        id="provincelayerCheckbox" />Province<br />
    <div id="nepalprovinceDIV">
        <img id="maps_provinceLegend" /><br />
        <select id="provinceLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_nepal_province">None</option>
            <option value="fill_stroke_nepal_province_mwCount">No. Of Microwave Station</option>
            <option value="fill_stroke_nepal_province_ofLength">Length Of OpticalFiber Node</option>
            <option value="fill_stroke_nepal_province_btsCount">No. Of SystemSites</option>
            <option value="fill_stroke_nepal_province_pstnCount">No. Of PSTN</option>
            <option value="fill_stroke_nepal_province_vsatCount">No. Of VSAT</option>
            <option value="fill_stroke_nepal_province_wirelessCount">No. Of Wireless Sites</option>

        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="province_slider">
    </div>

    {{-- District Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="maps_district"
        id="districtlayerCheckbox" />District<br />
    <div id="nepaldistrictDIV">
        <img id="maps_districtLegend" /><br />
        <select id="districtLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_nepal_district">None</option>
            <option value="fill_stroke_nepal_district_mwCount">No. Of Microwave Station</option>
            <option value="fill_stroke_nepal_district_ofLength">Length Of OpticalFiber Node</option>
            <option value="fill_stroke_nepal_district_btsCount">No. Of SystemSites</option>
            <option value="fill_stroke_nepal_district_pstnCount">No. Of PSTN</option>
            <option value="fill_stroke_nepal_district_vsatCount">No. Of VSAT</option>
            <option value="fill_stroke_nepal_district_wirelessCount">No. Of Wireless Sites</option>

        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="district_slider">
    </div>

    {{-- VDC Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="maps_vdc"
        id="vdclayerCheckbox" />VDC<br />
    <div id="nepalvdcDIV">
        <img id="maps_vdcLegend" /><br />
        <select id="vdcLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_nepal_vdc">None</option>
            <option value="fill_stroke_nepal_vdc_mwCount">No. Of Microwave Station</option>
            <option value="fill_stroke_nepal_vdc_ofLength">Length Of OpticalFiber Node</option>
            <option value="fill_stroke_nepal_vdc_btsCount">No. Of SystemSites</option>
            <option value="fill_stroke_nepal_vdc_pstnCount">No. Of PSTN</option>
            <option value="fill_stroke_nepal_vdc_vsatCount">No. Of VSAT</option>
            <option value="fill_stroke_nepal_vdc_wirelessCount">No. Of Wireless Sites</option>

        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="vdc_slider">
    </div>

    {{-- Ward LAyer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="maps_ward"
        id="wardlayerCheckbox" />Ward<br />
    <div id="nepalwardDIV">
        <img id="maps_wardLegend" /><br />
        <select id="wardLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_nepal_ward">None</option>
            <option value="fill_stroke_nepal_ward_mwCount">No. Of Microwave Station</option>
            <option value="fill_stroke_nepal_ward_ofLength">Length Of OpticalFiber Node</option>
            <option value="fill_stroke_nepal_ward_btsCount">No. Of SystemSites</option>
            {{-- <option value="fill_stroke_nepal_ward_pstnCount">No. Of PSTN</option> --}}
            <option value="fill_stroke_nepal_ward_vsatCount">No. Of VSAT</option>
            <option value="fill_stroke_nepal_ward_wirelessCount">No. Of Wireless Sites</option>

        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="ward_slider">
    </div>
    <hr>

    {{-- Indicators on map --}}
    <input class="layer mt-2  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="road" id="roadlayerCheckbox"/>Road<br />
    <div id="roadDIV">
        <img id="roadLegend" />
        <br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="road_slider">
    </div>
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="river"  id="riverlayerCheckbox"/>River<br />
    <div id="riverDIV">
        <img id="riverLegend" />
        <br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="river_slider">
    </div>
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="settlement" />Settlement<br />
    <div id="settlementDIV">
        <img id="settlementLegend" />
        <br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="settlement_slider">
    </div>
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="imp_places" />Important
    Places<br />
    <div id="imp_placesDIV">
        <img id="imp_placesLegend" />
        <br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="imp_places_slider">
    </div>
    <input class="layer  mr-2" type="checkbox" name="elevation" value="elevation" />Elevation<br />
    <div id="elevationDIV">
        <img id="elevationLegend" />
        <br />
    </div>
    {{-- <input class="layer  mr-2" type="checkbox" name="population" value="population" />Population<br />
    <div id="populationDIV">
        <img id="populationLegend" />
        <br />
    </div> --}}
    <hr>

@role('SuperAdmin|admin|Admin|map_only')
    {{-- Infrastructure Layer --}}
    {{-- MicrowaveStation Layer --}}
    <input class="layer mt-2  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="microwaves"
        id="microwavelayerCheckbox" />Microwave
    Stations<br />
    <div id="microwavestationDIV">
        <img id="microwavestationLegend" />
        <br />
        <select id="microwavestationLayerFilter" style="margin: 5px;">
            <option value="mark_microwaveStation">None</option>
            <option value="mark_microwaveStation_ndcl">NDCL</option>
            <option value="mark_microwaveStation_ncell">NCELL</option>
            <option value="mark_microwaveStation_smart">SMART</option>
            {{-- <option value="mark_microwaveStation_utl">UTL</option>
            <option value="mark_microwaveStation_nstpl">NSTPL</option>
            <option value="mark_microwaveStation_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="microwavestation_slider">
    </div>

    {{-- MicrowaveStationLink Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="microwavestations"
        id="microwavestationlinklayerCheckbox" />Microwave
    Stations Link<br />
    <div id="microwavestationlinkDIV">
        <img id="microwavestationlinkLegend" />
        <br />
        <select id="microwavestationlinkLayerFilter" style="margin: 5px;">
            <option value="mark_microwaveStation_link">None</option>
            <option value="mark_microwaveStation_link_distance">Distance</option>
            <option value="mark_microwaveStation_link_polariz">Polariz</option>
            <option value="mark_microwaveStation_link_bandwidth">Bandwidth</option>
            <option value="mark_microwaveStation_link_ndcl">NDCL</option>
            <option value="mark_microwaveStation_link_ncell">NCELL</option>
            <option value="mark_microwaveStation_link_smart">SMART</option>
            {{-- <option value="mark_microwaveStation_link_utl">UTL</option>
            <option value="mark_microwaveStation_link_nstpl">NSTPL</option>
            <option value="mark_microwaveStation_link_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="microwavestationlink_slider">
    </div>

    {{-- Vsat Layer --}}
    <input class="layer mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="vsats"
        id="vsatlayerCheckbox" />Vsat Station<br />
    <div id="vsatDIV">
        <img id="vsatLegend" />
        <br />
        <select id="vsatLayerFilter" style="margin: 5px;">
            <option value="mark_vsat">None</option>
            <option value="mark_vsat_stationtype">Station Type</option>
            <option value="mark_vsat_status">Status</option>
            <option value="mark_vsat_purpose">Purpose</option>
            <option value="mark_vsat_ndcl">NDCL</option>
            <option value="mark_vsat_ncell">NCELL</option>
            <option value="mark_vsat_smart">SMART</option>
            {{-- <option value="mark_vsat_utl">UTL</option>
            <option value="mark_vsat_nstpl">NSTPL</option>
            <option value="mark_vsat_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="vsat_slider">
    </div>

    {{-- Optical Fiber Node Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="opticalfibers_new" id="opticalfiberlayerCheckbox"/>Optical
    Fiber Nodes<br />
    <div id="opticalfiberDIV">
        <img id="opticalfiberLegend" />
        <br />
        <select id="opticalfiberLayerFilter" style="margin: 5px;">
            <option value="mark_opticalfiber">None</option>
            <option value="mark_opticalfiber_ndcl">NDCL</option>
            <option value="mark_opticalfiber_ncell">NCELL</option>
            <option value="mark_opticalfiber_smart">SMART</option>
            {{-- <option value="mark_opticalfiber_nea">NEA</option>
            <option value="mark_opticalfiber_ntc">NTC</option>
            <option value="mark_opticalfiber_utl">UTL</option>
            <option value="mark_opticalfiber_nstpl">NSTPL</option>
            <option value="mark_opticalfiber_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="opticalfiber_slider">
    </div>

    {{-- Optical Fiber Link Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="opticalfiberlinks_new" id="opticalfiberlinklayerCheckbox"/>Optical
    Fiber Link<br />
    <div id="opticalfiberlinkDIV">
        <img id="opticalfiberlinkLegend" />
        <br />
        <select id="opticalfiberlinkLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_opticalfiberlink">None</option>
            <option value="fill_stroke_opticalfiberlink_length">Length</option>
            <option value="fill_stroke_opticalfiberlink_fiber">Fiber</option>
            <option value="fill_stroke_opticalfiberlink_cable">Cable type</option>
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="opticalfiberlink_slider">
    </div>

    {{-- Planned Optical Fiber Node Layer--}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="opticalfiberplans_new" id="opticalfiberplannedlayerCheckbox"/>Optical
    Fiber Nodes Planned<br />
    <div id="opticalfiberplannedDIV">
        <img id="opticalfiberplannedLegend" />
        <br />
        <select id="opticalfiberplannedLayerFilter" style="margin: 5px;">
            <option value="mark_opticalfiberplan">None</option>
            <option value="mark_opticalfiberplan_ndcl">NDCL</option>
            <option value="mark_opticalfiberplan_ncell">Ncell</option>
            <option value="mark_opticalfiberplan_smart">SMART</option>
            {{-- <option value="mark_opticalfiberplan_nea">NEA</option>
            <option value="mark_opticalfiberplan_ntc">NTC</option>
            <option value="mark_opticalfiberplan_utl">UTL</option>
            <option value="mark_opticalfiberplan_nstpl">NSTPL</option>
            <option value="mark_opticalfiberplan_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="opticalfiberplanned_slider">
    </div>
    
    {{-- Planned Optical Fiber Link Layer --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="opticalfiberlinkplans_new" id="opticalfiberlinkplannedlayerCheckbox"/>Optical
    Fiber Link Planned<br />
    <div id="opticalfiberlinkplannedDIV">
        <img id="opticalfiberlinkplannedLegend" />
        <br />
        <select id="opticalfiberlinkplannedLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_opticalfiberlinkplan">None</option>
            <option value="fill_stroke_opticalfiberlinkplan_length">Length</option>
            <option value="fill_stroke_opticalfiberlinkplan_fiber">Fiber</option>
            <option value="fill_stroke_opticalfiberlinkplan_cable">Cable type</option>
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="opticalfiberlinkplanned_slider">
    </div>

    {{-- Planned Optical Fiber Layer --}}
    <!-- <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="opticalfiberplanned" />OF
    Information Super-Highways<br />
    <div id="opticalfiberplannedDIV">
        <img id="opticalfiberplannedLegend" />
        <br />
        <select id="opticalfiberplannedLayerFilter" style="margin: 5px;">
            <option value="fill_stroke_nepal_ward">None</option>
            <option value="fill_stroke_nepal_ward_mwCount">Length</option>
            <option value="	fill_stroke_nepal_ward_ofCount">Fiber</option>
            <option value="fill_stroke_nepal_ward_btsCount">Cable type</option>
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="opticalfiberplanned_slider">
    </div> -->

    {{-- Base Station --}}
    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="bts" id="btslayerCheckbox" />Base Transceiver
    Station<br />
    <div id="btsDIV">
        <img id="btsLegend" />
        <br />
        <select id="btsLayerFilter" style="margin: 5px;">
            <option value="bts_mark">None</option>
            <option value="fill_stroke_nepal_ward_mwCount">Antenna Height</option>
            <option value="fill_stroke_nepal_ward_ofCount">Antenna Base</option>
            <option value="fill_stroke_nepal_ward_btsCount">Antenna Location</option>
            <option value="bts_mark_ndcl">NDCL</option>
            <option value="bts_mark_ncell">NCELL</option>
            <option value="bts_mark_smart">SMART</option>
            {{-- <option value="bts_mark_utl">UTL</option>
            <option value="bts_mark_nstpl">NSTPL</option>
            <option value="bts_mark_ndcl">NDCL</option>
            <option value="bts_mark_stm">STM</option> --}}
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="bts_slider">
    </div>



    <input class="layer  mr-2" type="checkbox" name="rasterTileLayerCheckbox" value="coverage_data" />Coverage
    Data<br />
    <div id="coveragedataDIV">
        <img id="coveragedataLegend" />
        <br />
        <select id="coveragedataLayerFilter" style="margin: 5px;">
            <option value="coverage_2g" selected>2G Coverage Data</option>
            <option value="coverage_3g">3G Coverage Data</option>
            <option value="coverage_4g">4G Coverage Data</option>
            <option value="coverage_ncell">NCELL Coverage Data</option>
            <option value="coverage_ndcl">NDCL Coverage Data</option>
            <option value="coverage_smart">SMART Coverage Data</option>
            <option value="ncell_coverage_2g">NCELL(2G) Coverage Data</option>
            <option value="ncell_coverage_3g">NCELL(3G) Coverage Data</option>
            <option value="ncell_coverage_4g">NCELL(4G) Coverage Data</option>
            <option value="ndcl_coverage_2g">NDCL(2G) Coverage Data</option>
            <option value="ndcl_coverage_3g">NDCL(3G) Coverage Data</option>
            <option value="ndcl_coverage_4g">NDCL(4G) Coverage Data</option>
            <option value="smart_coverage_2g">SMART(2G) Coverage Data</option>
            <option value="smart_coverage_3g">SMART(3G) Coverage Data</option>
            <option value="smart_coverage_4g">SMART(4G) Coverage Data</option>
        </select><br />
        <input type="range" min="1" max="100" value="50" class="layer_slider" id="coveragedata_slider">
    </div>

    <input class="layer  mr-2" type="checkbox" name="heatmaplayer" value="heatmaplayer" />Heat Map BTS<br />

@endrole
</div>
