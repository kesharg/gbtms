@extends('layouts.maplayout')
@section('header')
<!-- script from ol map css -->
<link rel="stylesheet" href="./libs/v6.3.1-dist/ol.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/downloadjs/1.4.8/download.min.js"></script>
<!-- our own style css file -->
<link rel="stylesheet" href="css/mapstyle.css" />
<style>
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open>.dropdown-toggle.btn-primary {
        color: #fff;
        background-color: #00b3db;
        border-color: #285e8e;
    }

    .btn-light:hover,
    .btn-primary:focus,
    .btn-light:active,
    .btn-light.active,
    .open>.dropdown-toggle.btn-light {
        color: #fff;
        cursor: pointer;
        background-color: #8a949c;
        border-color: #000000;


    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus,
    .btn-outline-primary:active,
    .btn-outline-primary.active,
    .open>.dropdown-toggle.btn-outline-primary {
        color: #fff;
        background-color: #00b3db;
        border-color: #285e8e;
    }
    .modal.required .control-label:after {
        content:"*";
        color:red;
    }
    span .required{
        content:"*";
        color:red;
        margin-left: 4px;
    }

    #map_print_modal{
        position: relative;
    }

    #map_print_modal .modal-dialog {
        position: fixed;
        width: 100%;
        margin: 0;
        padding: 10px;
    }

    #map_tools_modal {
        position: relative;
    }

    #map_tools_modal .modal-dialog {
        position: fixed;
        width: 100%;
        margin: 0;
        padding: 10px;
    }
    
</style>
<link rel="stylesheet" href="css/loading.css" />
@endsection
@section('content')

<div class="grid-container">
    <div class="grid-1">
        @include('layouts.navbar')
    </div>
    <div class="grid-2">
        @include('map.map_navbar')
        @include('map.modal')
    </div>
    <div class="grid-3">
        <!-- For custom boundary popups -->
        <div id="export-popup" class="ol-popup" style="display:block;">
            <a href="#" id="export-popup-closer" class="ol-popup-closer"></a>
            <div id="export-popup-content">
                <label>Select A Layer</label>
                <select class="form-control " id="export_overlay">
                    <option value="">None</option>
                    <option value="bts">System(BTS)
                    </option>
                    <option value="vsats">VSAT
                    </option>
                    <option value="opticalfiberlink">Opticalfiber Link
                    </option>
                    <option value="microwaves">Microwave Node
                    </option>
                </select>
                <div>Export to:</div>
                <div class="btn-group">
                    <button id="export-csv-btn" class="btn btn-default">CSV</button>
                    <button id="export-kml-btn" class="btn btn-default">KML</button>
                    <button id="export-shape-btn" class="btn btn-default">Shape File</button>
                </div>
            </div>
        </div>

        <!-- For length viewing popups -->
        <div id="length-popup" class="ol-popup" style="display:block;">
            <a href="#" id="length-popup-closer" class="ol-popup-closer"></a>
            <div id="length-popup-content">
                <label>Select A Layer</label>
                <select class="form-control " id="length_overlay">
                    <option value="none">None</option>
                    <option value="opticalfiberlinks">Opticalfiber Link Length
                    </option>
                    <option value="opticalfiberlinkplans">Opticalfiber Link Length Planned 
                    </option>
                </select><br/>
                <div id="calculatedlength"></div><br/>
                <div class="btn-group">
                    <button id="length-calculate" class="btn btn-primary mr-0">Calculate</button>
                </div>
            </div>
        </div>

        {{-- Loading overlay --}}
        <div id="loading-overlay">
            <div class="loading-icon"></div>
        </div>
        {{-- popup for everything --}}
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content">
            </div>
        </div>

        {{-- <div id="informationPopup"></div> --}}

        <button id="closeRightMenu" class="button-map" onclick="closeRightMenu()" style="opacity: 0;">
            &#10007;
        </button>

        <button id="openRightMenu" class="button-map" onclick="openRightMenu()">
            &#9776;
        </button>

        <div id="js-map" class="map">
        </div>
        @include('map.sidebar')
    </div>

</div>
<!-- js library from ol -->
@include('map.script')
<script src="./libs/v6.3.1-dist/ol.js"></script>

@endsection
