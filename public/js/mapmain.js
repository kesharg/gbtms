import * as baselayer from "./base_layer.js";
import * as administrativelayer from "./administrative_layer.js";
import * as informationlayer from "./information_layer.js";
import * as loading from "./loading.js";
import * as maptools from "./map_tools.js";
import * as coremap from "./core_map.js";
import * as mapinteraction from "./map_controls_interaction.js";
import * as layeropacityslider from "./layer_opacity_slider.js";
import * as infotable from "./infotable.js";
// **************************************************************************************************************************
const ip_address = "103.69.124.234";


//Defined for safety
var cordinfo;

//URL for geoserver
const geoserverUrl = {
    wms: function(GEO_URL) {
        return GEO_URL + "/nepal_map/wms";
    },
    ows: function(GEO_URL) {
        return GEO_URL + "/nepal_map/ows";
    }
};
var gurl = geoserverUrl.wms(GEO_URL);
const gurl_ows = geoserverUrl.ows(GEO_URL);


// **************************************************************************************************************************
//Layers
//Drawing Layer
//Vector Layer::Donot touch this,it is for drawing
var vectorSource = new ol.source.Vector({
    crossOrigin: "anonymous",
    features: [],
    wrapX: false
});
var vector = new ol.layer.Vector({
    source: vectorSource,
    visible: true,
    zIndex: 99
});

//Actual Data Layer
var sourceMicrowaveStation = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:microwaves",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var microwaveStation = new ol.layer.Tile({
    source: sourceMicrowaveStation,
    title: "microwaves",
    visible: false
});

var sourceMicrowaveStationLink = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:microwavestations",
        TILED: true,
        STYLES: '',
        authkey: GEO_AUTHKEY
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var microwaveStationLink = new ol.layer.Image({
    source: sourceMicrowaveStationLink,
    title: "microwavestations",
    visible: false
});

var sourceVsat = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:vsats",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var vsats = new ol.layer.Image({
    source: sourceVsat,
    title: "vsats",
    visible: false
});

var sourceOpticalfiber = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:opticalfibers_new",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var opticalFiber = new ol.layer.Image({
    source: sourceOpticalfiber,
    title: "opticalfibers_new",
    visible: false
});

var sourceOpticalfiberlink = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:opticalfiberlinks_new",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var opticalFiberLink = new ol.layer.Image({
    source: sourceOpticalfiberlink,
    title: "opticalfiberlinks_new",
    visible: false
});

var sourceOpticalfiberplanned = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:opticalfiberplans_new",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var opticalFiberPlanned = new ol.layer.Image({
    source: sourceOpticalfiberplanned,
    title: "opticalfiberplans_new",
    visible: false
});

var sourceOpticalfiberlinkplanned = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:opticalfiberlinkplans_new",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var opticalFiberLinkPlanned = new ol.layer.Image({
    source: sourceOpticalfiberlinkplanned,
    title: "opticalfiberlinkplans_new",
    visible: false
});

var sourceBts = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:bts",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var bts = new ol.layer.Image({
    source: sourceBts,
    title: "bts",
    visible: false
});

var sourceCoveragedata = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:coverage_data",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

var coveragedata = new ol.layer.Image({
    source: sourceCoveragedata,
    title: "coverage_data",
    visible: false
});
var heatmaplayer = new ol.layer.Heatmap({
    source: new ol.source.Vector({
        url:
            gurl_ows +
            "?service=WFS&version=1.0.0&request=GetFeature&typeName=nepal_map%3Abts&outputFormat=kml&authkey="+ GEO_AUTHKEY,
        format: new ol.format.KML({
            extractStyles: false
        })
    }),
    blur: parseInt(10, 10),
    title: "heatmaplayer",
    visible: false,
    radius: parseInt(5, 10),
    weight: function(feature) {
        var name = feature.get("no_of_system");
        return name;
    }
});

// **************************************************************************************************************************

// Layer Group

//Base Layer
const baseLayerGroup = new ol.layer.Group({
    layers: [
        vector,
        baselayer.base_no_layer,
        baselayer.base_osm_standardmap,
        baselayer.base_osm_humanitarianmap,
        baselayer.base_bing_map,
        baselayer.base_cartoDB_map,
        baselayer.base_stamenwithlabel_map,
        baselayer.base_stamen_map,
        baselayer.base_gmap,
        baselayer.base_gsatmap
    ]
});

// Raster Tile Layer Group
const rasterTileLayerGroup = new ol.layer.Group({
    layers: [
        administrativelayer.maps_nepal,
        administrativelayer.maps_province,
        administrativelayer.maps_district,
        administrativelayer.maps_vdc,
        administrativelayer.maps_ward,

        informationlayer.road,
        informationlayer.river,
        informationlayer.settlement,
        informationlayer.imp_places,
        informationlayer.elevation,
        informationlayer.population,

        microwaveStation,
        microwaveStationLink,
        coveragedata,
        vsats,
        opticalFiber,
        opticalFiberPlanned,
        opticalFiberLink,
        opticalFiberLinkPlanned,
        bts,
        heatmaplayer
    ]
});

coremap.map.addLayer(baseLayerGroup);
coremap.map.addLayer(rasterTileLayerGroup);
// **************************************************************************************************************************

//Added Interaction
coremap.map.addInteraction(mapinteraction.dragRotateInteraction);

// **************************************************************************************************************************

// LayerSwitcher

//LayerSwitcher Logic
const baseLayerElements = document.querySelectorAll(
    ".sideba>select[id=base_layer]"
);
for (let baseLayerElement of baseLayerElements) {
    baseLayerElement.addEventListener("change", function() {
        let baseLayerElementValue = this.value;
        baseLayerGroup.getLayers().forEach(function(element, index, array) {
            let baseLayerName = element.get("title");
            element.setVisible(baseLayerName === baseLayerElementValue);
            //Setting vector layer to true for drawing
            vector.setVisible("true");
        });
    });
}

// Layer Switcher Logic for Raster Tile Layers
const tileRasterLayerElements = document.querySelectorAll(
    ".sideba > input[type=checkbox]"
);
for (let tileRasterLayerElement of tileRasterLayerElements) {
    tileRasterLayerElement.addEventListener("change", function() {
        let tileRasterLayerElementValue = this.value;
        let tileRasterLayer;

        rasterTileLayerGroup
            .getLayers()
            .forEach(function(element, index, array) {
                if (tileRasterLayerElementValue === element.get("title")) {
                    tileRasterLayer = element;
                }
            });
        this.checked
            ? tileRasterLayer.setVisible(true)
            : tileRasterLayer.setVisible(false);
    });
}

// **************************************************************************************************************************

//*********************************************************************************************************

//Legend
var resolution = coremap.map.getView().getResolution();

//Border
//Border Legend
borderLegend();
var borderLayerFilter = document.getElementById("borderLayerFilter");

function borderLegend(value) {
    var bordergraphicUrl = administrativelayer.maps_nepal.getSource().getLegendUrl(
        resolution,
        {
            LAYER: "maps_nepal",
            authkey: GEO_AUTHKEY,
        }
    );
    var nepalBorderLegendImg = document.getElementById("maps_nepalLegend");
    nepalBorderLegendImg.src = bordergraphicUrl;
}

//District
//District Legend

districtLegend();
var districtLayerFilter = document.getElementById("districtLayerFilter");
districtLayerFilter.addEventListener("change", function() {
    administrativelayer.maps_district.getSource().updateParams({
        STYLES: districtLayerFilter.value
    });
    districtLegend(districtLayerFilter.value);
});

function districtLegend(value) {
    var districtgraphicUrl = administrativelayer.maps_district.getSource().getLegendUrl(
        resolution,
        {
            LAYER: "maps_district",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var nepalDistrictLegendImg = document.getElementById("maps_districtLegend");
    nepalDistrictLegendImg.src = districtgraphicUrl;
}

//Province
//Province Legend
provinceLegend();
var provinceLayerFilter = document.getElementById("provinceLayerFilter");
provinceLayerFilter.addEventListener("change", function() {
    administrativelayer.maps_province.getSource().updateParams({
        STYLES: provinceLayerFilter.value
    });
    provinceLegend(provinceLayerFilter.value);
});

function provinceLegend(value) {
    var provincegraphicUrl = administrativelayer.maps_province.getSource().getLegendUrl(
        resolution,
        {
            LAYER: "maps_province",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var nepalProvinceLegendImg = document.getElementById("maps_provinceLegend");
    nepalProvinceLegendImg.src = provincegraphicUrl;
}

//VDC
//VDC Legend
vdcLegend();
var vdcLayerFilter = document.getElementById("vdcLayerFilter");
vdcLayerFilter.addEventListener("change", function() {
    administrativelayer.maps_vdc.getSource().updateParams({
        STYLES: vdcLayerFilter.value
    });
    vdcLegend(vdcLayerFilter.value);
});

function vdcLegend(value) {
    var vdcgraphicUrl = administrativelayer.maps_vdc.getSource().getLegendUrl(
        resolution,
        {
            LAYER: "maps_vdc",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var nepalVdcLegendImg = document.getElementById("maps_vdcLegend");
    nepalVdcLegendImg.src = vdcgraphicUrl;
}

//Ward
//Ward Legend
wardLegend();
var wardLayerFilter = document.getElementById("wardLayerFilter");
wardLayerFilter.addEventListener("change", function() {
    administrativelayer.maps_ward.getSource().updateParams({
        STYLES: wardLayerFilter.value
    });
    wardLegend(wardLayerFilter.value);
});

function wardLegend(value) {
    var wardgraphicUrl = administrativelayer.maps_ward.getSource().getLegendUrl(
        resolution,
        {
            LAYER: "maps_ward",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var nepalWardLegendImg = document.getElementById("maps_wardLegend");
    nepalWardLegendImg.src = wardgraphicUrl;
}

//coveragedata Legend
coveragedataLegend();
var coveragedataLayerFilter = document.getElementById(
    "coveragedataLayerFilter"
);
coveragedataLayerFilter.addEventListener("change", function() {
    sourceCoveragedata.updateParams({
        STYLES: coveragedataLayerFilter.value
    });
    coveragedataLegend(coveragedataLayerFilter.value);
});

function coveragedataLegend(value) {
    var coveragedatagraphicUrl = sourceCoveragedata.getLegendUrl(resolution, {
        LAYER: "coverage_data",
        authkey: GEO_AUTHKEY,
            STYLE: value
    });
    var coveragedataLegendImg = document.getElementById("coveragedataLegend");
    coveragedataLegendImg.src = coveragedatagraphicUrl;
}

//Microwave Legend
microwavestationLegend();
var microwavestationLayerFilter = document.getElementById(
    "microwavestationLayerFilter"
);
microwavestationLayerFilter.addEventListener("change", function() {
    sourceMicrowaveStation.updateParams({
        STYLES: microwavestationLayerFilter.value
    });
    microwavestationLegend(microwavestationLayerFilter.value);
});

function microwavestationLegend(value) {
    var microwavestationgraphicUrl = sourceMicrowaveStation.getLegendUrl(
        resolution,
        {
            LAYER: "microwaves",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );

    var microwavestationLegendImg = document.getElementById(
        "microwavestationLegend"
    );
    microwavestationLegendImg.src = microwavestationgraphicUrl;
}

//Microwave Legend Link
microwavestationlinkLegend();
var microwavestationlinkLayerFilter = document.getElementById(
    "microwavestationlinkLayerFilter"
);
microwavestationlinkLayerFilter.addEventListener("change", function() {
    sourceMicrowaveStationLink.updateParams({
        STYLES: microwavestationlinkLayerFilter.value
    });
    microwavestationlinkLegend(microwavestationlinkLayerFilter.value);
});

function microwavestationlinkLegend(value) {
    var microwavestationlinkgraphicUrl = sourceMicrowaveStationLink.getLegendUrl(
        resolution,
        {
            LAYER: "microwavestations",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var microwavestationlinkLegendImg = document.getElementById(
        "microwavestationlinkLegend"
    );
    microwavestationlinkLegendImg.src = microwavestationlinkgraphicUrl;
}

//Vsat Legend
vsatLegend();
var vsatLayerFilter = document.getElementById("vsatLayerFilter");
vsatLayerFilter.addEventListener("change", function() {
    sourceVsat.updateParams({
        STYLES: vsatLayerFilter.value
    });
    vsatLegend(vsatLayerFilter.value);
});

function vsatLegend(value) {
    var vsatgraphicUrl = sourceVsat.getLegendUrl(resolution, {
        LAYER: "vsats",
        authkey: GEO_AUTHKEY,
        STYLE: value
    });

    var vsatLegendImg = document.getElementById("vsatLegend");
    vsatLegendImg.src = vsatgraphicUrl;
}

//BTS Legend
btsLegend();
var btsLayerFilter = document.getElementById("btsLayerFilter");
btsLayerFilter.addEventListener("change", function() {
    sourceBts.updateParams({
        STYLES: btsLayerFilter.value
    });
    btsLegend(btsLayerFilter.value);
});

function btsLegend(value) {
    var btsgraphicUrl = sourceBts.getLegendUrl(resolution, {
        LAYER: "bts",
        authkey: GEO_AUTHKEY,
        STYLE: value
    });

    var btsLegendImg = document.getElementById("btsLegend");
    btsLegendImg.src = btsgraphicUrl;
}

//Elevation Legend
var elevationgraphicUrl = informationlayer.elevation
    .getSource()
    .getLegendUrl(resolution, {
        LAYER: "elevation_nepal",
        authkey: GEO_AUTHKEY,
        STYLE: "nepal_elevation_style"
    });

var elevationLegendImg = document.getElementById("elevationLegend");
elevationLegendImg.src = elevationgraphicUrl;

//populationlegend
//Elevation Legend
var populationgraphicUrl = informationlayer.population
    .getSource()
    .getLegendUrl(resolution, {
        LAYER: "population_nepal",
        authkey: GEO_AUTHKEY,
        STYLE: "nepal_population_style"
    });

// var populationLegendImg = document.getElementById("populationLegend");
// populationLegendImg.src = populationgraphicUrl;

//OpticalFiberPlanned Legend
opticalfiberLegend();
var opticalfiberLayerFilter = document.getElementById(
    "opticalfiberLayerFilter"
);
opticalfiberLayerFilter.addEventListener("change", function() {
    sourceOpticalfiber.updateParams({
        STYLES: opticalfiberLayerFilter.value
    });
    opticalfiberLegend(opticalfiberLayerFilter.value);
});

function opticalfiberLegend(value) {
    var opticalfibergraphicUrl = sourceOpticalfiber.getLegendUrl(
        resolution,
        {
            LAYER: "opticalfibers_new",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var opticalfiberLegendImg = document.getElementById(
        "opticalfiberLegend"
    );
    opticalfiberLegendImg.src = opticalfibergraphicUrl;
}

//OpticalFiberPlanned Legend
opticalfiberplannedLegend();
var opticalfiberplannedLayerFilter = document.getElementById(
    "opticalfiberplannedLayerFilter"
);
opticalfiberplannedLayerFilter.addEventListener("change", function() {
    sourceOpticalfiberplanned.updateParams({
        STYLES: opticalfiberplannedLayerFilter.value
    });
    opticalfiberplannedLegend(opticalfiberplannedLayerFilter.value);
});

function opticalfiberplannedLegend(value) {
    var opticalfiberplannedgraphicUrl = sourceOpticalfiberplanned.getLegendUrl(
        resolution,
        {
            LAYER: "opticalfiberplans_new",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var opticalfiberplannedLegendImg = document.getElementById(
        "opticalfiberplannedLegend"
    );
    opticalfiberplannedLegendImg.src = opticalfiberplannedgraphicUrl;
}

//Opticalfiberlink Legend
opticalfiberlinkLegend();
var opticalfiberlinkLayerFilter = document.getElementById(
    "opticalfiberlinkLayerFilter"
);
opticalfiberlinkLayerFilter.addEventListener("change", function() {
    sourceOpticalfiberlink.updateParams({
        STYLES: opticalfiberlinkLayerFilter.value
    });
    opticalfiberlinkLegend(opticalfiberlinkLayerFilter.value);
});

function opticalfiberlinkLegend(value) {
    var opticalfiberlinkgraphicUrl = sourceOpticalfiberlink.getLegendUrl(
        resolution,
        {
            LAYER: "opticalfiberlinks_new",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var opticalfiberlinkLegendImg = document.getElementById(
        "opticalfiberlinkLegend"
    );
    opticalfiberlinkLegendImg.src = opticalfiberlinkgraphicUrl;
}

//Opticalfiberlinkplanned Legend
opticalfiberlinkplannedLegend();
var opticalfiberlinkplannedLayerFilter = document.getElementById(
    "opticalfiberlinkplannedLayerFilter"
);
opticalfiberlinkplannedLayerFilter.addEventListener("change", function() {
    sourceOpticalfiberlinkplanned.updateParams({
        STYLES: opticalfiberlinkplannedLayerFilter.value
    });
    opticalfiberlinkplannedLegend(opticalfiberlinkplannedLayerFilter.value);
});

function opticalfiberlinkplannedLegend(value) {
    var opticalfiberlinkplannedgraphicUrl = sourceOpticalfiberlinkplanned.getLegendUrl(
        resolution,
        {
            LAYER: "opticalfiberlinkplans_new",
            authkey: GEO_AUTHKEY,
            STYLE: value
        }
    );
    var opticalfiberlinkplannedLegendImg = document.getElementById(
        "opticalfiberlinkplannedLegend"
    );
    opticalfiberlinkplannedLegendImg.src = opticalfiberlinkplannedgraphicUrl;
}

//Road Legend
var roadgraphicUrl = sourceOpticalfiberlink.getLegendUrl(resolution, {
    LAYER: "road",
    authkey: GEO_AUTHKEY
});
var roadLegendImg = document.getElementById("roadLegend");
roadLegendImg.src = roadgraphicUrl;

//River Legend
var rivergraphicUrl = informationlayer.river
    .getSource()
    .getLegendUrl(resolution, {
        LAYER: "river",
        authkey: GEO_AUTHKEY
    });
var riverLegendImg = document.getElementById("riverLegend");
riverLegendImg.src = rivergraphicUrl;

//Settlement Legend
var settlementgraphicUrl = informationlayer.river
    .getSource()
    .getLegendUrl(resolution, {
        LAYER: "settlement",
        authkey: GEO_AUTHKEY
    });
$("#settlementLegend").attr("src", settlementgraphicUrl);

//Imp Places Legend
var imp_placesgraphicUrl = informationlayer.imp_places
    .getSource()
    .getLegendUrl(resolution, {
        LAYER: "imp_places",
        authkey: GEO_AUTHKEY
    });
$("#imp_placesLegend").attr("src", imp_placesgraphicUrl);

//Div of all layers

var nepalborderDIV = document.getElementById("nepalborderDIV");
var nepaldistrictDIV = document.getElementById("nepaldistrictDIV");
var nepalprovinceDIV = document.getElementById("nepalprovinceDIV");
var nepalvdcDIV = document.getElementById("nepalvdcDIV");
var microwavestationDIV = document.getElementById("microwavestationDIV");
var microwavestationlinkDIV = document.getElementById(
    "microwavestationlinkDIV"
);
var vsatDIV = document.getElementById("vsatDIV");
var opticalfiberDIV = document.getElementById("opticalfiberDIV");
var opticalfiberlinkDIV = document.getElementById("opticalfiberlinkDIV");
var opticalfiberplannedDIV = document.getElementById("opticalfiberplannedDIV");
var opticalfiberlinkplannedDIV = document.getElementById("opticalfiberlinkplannedDIV");
var coveragedataDIV = document.getElementById("coveragedataDIV");
var btsDIV = document.getElementById("btsDIV");
var roadDIV = document.getElementById("roadDIV");
var riverDIV = document.getElementById("riverDIV");
var settlementDIV = document.getElementById("settlementDIV");
var imp_placesDIV = document.getElementById("imp_placesDIV");
var nepalwardDIV = document.getElementById("nepalwardDIV");
var elevationDIV = document.getElementById("elevationDIV");
// var populationDIV = document.getElementById("populationDIV");

//Setting entire div to visible none
$("#nepalprovinceDIV").css("display", "none");
nepaldistrictDIV.style.display = "none";
nepalvdcDIV.style.display = "none";
microwavestationDIV.style.display = "none";
microwavestationlinkDIV.style.display = "none";
vsatDIV.style.display = "none";
opticalfiberDIV.style.display = "none";
opticalfiberlinkDIV.style.display = "none";
opticalfiberplannedDIV.style.display = "none";
opticalfiberlinkplannedDIV.style.display = "none";
coveragedataDIV.style.display = "none";
btsDIV.style.display = "none";
roadDIV.style.display = "none";
riverDIV.style.display = "none";
settlementDIV.style.display = "none";
imp_placesDIV.style.display = "none";
nepalwardDIV.style.display = "none";
elevationDIV.style.display = "none";
// populationDIV.style.display = "none";

//Display for div
for (let showSlider of tileRasterLayerElements) {
    showSlider.addEventListener("change", function() {
        let showSliderValue = this.value;
        if (this.checked == true) {
            switch (showSliderValue) {
                case "maps_nepal":
                    nepalborderDIV.style.display = "initial";
                    break;
                case "maps_province":
                    nepalprovinceDIV.style.display = "initial";
                    administrativelayer.maps_province.getSource().updateParams({
                        cql_filter: "province LIKE '%'"
                    });
                    break;
                case "maps_district":
                    nepaldistrictDIV.style.display = "initial";
                    administrativelayer.maps_district.getSource().updateParams({
                        cql_filter: "district LIKE '%'"
                    });
                    break;
                case "maps_vdc":
                    nepalvdcDIV.style.display = "initial";
                    administrativelayer.maps_vdc.getSource().updateParams({
                        cql_filter: "gapa_napa LIKE '%'"
                    });
                    break;
                case "maps_ward":
                    nepalwardDIV.style.display = "initial";
                    administrativelayer.maps_ward.getSource().updateParams({
                        cql_filter: "gapa_napa LIKE '%'"
                    });
                    break;
                case "microwaves":
                    microwavestationDIV.style.display = "initial";

                    break;
                case "microwavestations":
                    microwavestationlinkDIV.style.display = "initial";

                    break;
                case "vsats":
                    vsatDIV.style.display = "initial";

                    break;
                case "bts":
                    btsDIV.style.display = "initial";

                    break;
                case "opticalfibers_new":
                    opticalfiberDIV.style.display = "initial";

                    break;
                case "opticalfiberlinks_new":
                    opticalfiberlinkDIV.style.display = "initial";

                    break;
                case "opticalfiberplans_new":
                    opticalfiberplannedDIV.style.display = "initial";

                    break;
                case "opticalfiberlinkplans_new":
                    opticalfiberlinkplannedDIV.style.display = "initial";

                    break;
                case "coverage_data":
                    coveragedataDIV.style.display = "initial";
                    break;
                case "road":
                    roadDIV.style.display = "initial";
                    break;
                case "river":
                    riverDIV.style.display = "initial";
                    break;
                case "settlement":
                    settlementDIV.style.display = "initial";
                    break;
                case "imp_places":
                    imp_placesDIV.style.display = "initial";
                    break;
                case "elevation":
                    elevationDIV.style.display = "initial";
                    break;
                // case "population":
                //     populationDIV.style.display = "initial";
                //     break;
            }
        }
        if (this.checked == false) {
            switch (showSliderValue) {
                case "maps_nepal":
                    nepalborderDIV.style.display = "none";
                    break;
                case "maps_province":
                    nepalprovinceDIV.style.display = "none";
                    administrativelayer.maps_province.getSource().updateParams({
                        cql_filter: "province LIKE '%'"
                    });
                    break;
                case "maps_district":
                    nepaldistrictDIV.style.display = "none";
                    administrativelayer.maps_district.getSource().updateParams({
                        cql_filter: "district LIKE '%'"
                    });
                    break;
                case "maps_vdc":
                    nepalvdcDIV.style.display = "none";
                    administrativelayer.maps_vdc.getSource().updateParams({
                        cql_filter: "gapa_napa LIKE '%'"
                    });
                    break;
                case "maps_ward":
                    nepalwardDIV.style.display = "none";
                    break;

                case "microwaves":
                    microwavestationDIV.style.display = "none";
                    break;

                case "microwavestations":
                    microwavestationlinkDIV.style.display = "none";
                    break;
                case "vsats":
                    vsatDIV.style.display = "none";

                    break;
                case "bts":
                    btsDIV.style.display = "none";

                    break;
                case "opticalfibers_new":
                    opticalfiberDIV.style.display = "none";

                    break;
                case "opticalfiberlinks_new":
                    opticalfiberlinkDIV.style.display = "none";
                    break;
                case "opticalfiberplans_new":
                    opticalfiberplannedDIV.style.display = "none";

                    break;
                case "opticalfiberlinkplans_new":
                    opticalfiberlinkplannedDIV.style.display = "none";
                    break;
                case "coverage_data":
                    coveragedataDIV.style.display = "none";
                    break;
                case "road":
                    roadDIV.style.display = "none";
                    break;
                case "river":
                    riverDIV.style.display = "none";
                    break;
                case "settlement":
                    settlementDIV.style.display = "none";
                    break;
                case "imp_places":
                    imp_placesDIV.style.display = "none";
                    break;
                case "elevation":
                    elevationDIV.style.display = "none";
                    break;
                // case "population":
                //     populationDIV.style.display = "none";
                //     break;
            }
        }
    });
}
//**************************************************************************************************************************
//Export Popup
/**
 * Elements that make up the popup for export.
 */
var exportPopupContainer = document.getElementById("export-popup");
var exportPopupCloser = document.getElementById("export-popup-closer");
/**
 * Create an overlay to anchor the popup to the coremap.map.
 */
var exportPopupOverlay = new ol.Overlay(
    /** @type {olx.OverlayOptions} */
    ({
        element: exportPopupContainer,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    })
);
coremap.map.addOverlay(exportPopupOverlay);

exportPopupCloser.onclick = function() {
    exportPopupOverlay.setPosition(undefined);
    exportPopupCloser.blur();
    return false;
};

//Add Interaction
var interactionDraw = document.getElementById("interactionDraw");

var draw; // global so we can remove it later
function addInteraction() {
    var value = interactionDraw.value;
    if (value !== "None") {
        draw = new ol.interaction.Draw({
            source: vectorSource,
            type: interactionDraw.value
        });
        coremap.map.addInteraction(draw);
    }
}
/**
 * Handle change event.
 */
interactionDraw.onchange = function() {
    coremap.map.un("singleclick", cordinfo);
    coremap.map.removeInteraction(draw);
    addInteraction();
};

addInteraction();

//Export Data
var draw_for_export = document.getElementById("draw_for_export");

var drawForExport; // global so we can remove it later
function remove_popup_overlay() {
    exportPopupOverlay.setPosition(undefined);
    vectorSource.clear();
}

function addInteractionForExport() {
    drawForExport = new ol.interaction.Draw({
        source: vectorSource,
        type: "Polygon"
    });
    drawForExport.on("drawend", function(evt) {
        coremap.map.removeInteraction(drawForExport);
        let geometry = evt.feature.getGeometry();

        exportPopupOverlay.setPosition(
            geometry.getInteriorPoint().getCoordinates()
        );
        $("#export-csv-btn, #export-kml-btn, #export-shape-btn").off("click");

        $("#export-csv-btn").on("click", function() {
            openExportLink(geometry, "CSV");
            remove_popup_overlay();
        });

        $("#export-kml-btn").on("click", function() {
            openExportLink(geometry, "KML");
            remove_popup_overlay();
        });

        $("#export-shape-btn").on("click", function() {
            openExportLink(geometry, "SHAPE-ZIP");
            remove_popup_overlay();
        });
    });
    coremap.map.addInteraction(drawForExport);
}

/**
 * Handle change event.
 */
draw_for_export.onclick = function() {
    $("#map_tools_modal").modal("hide");

    coremap.map.removeInteraction(drawForExport);
    addInteractionForExport();
};

function openExportLink(geometry, outputFormat) {
    var selectedLayer = $("#export_overlay").val();

    if (!selectedLayer) {
        alert("Please select an overlay.");
        return;
    }

    var format = new ol.format.WKT();
    var geom = format.writeGeometry(
        geometry.clone().transform("EPSG:3857", "EPSG:4326")
    );
    var exportLink =
        gurl_ows +
        "?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:" +
        selectedLayer +
        "&CQL_FILTER=WITHIN(geom, " +
        geom +
        ")&outputFormat=" +
        outputFormat +
        "&authkey="+ GEO_AUTHKEY;
    if (outputFormat == "SHAPE-ZIP") {
        exportLink +=
            "&format_options=filename:" +
            "export_imis_" +
            moment().format("YYYYMMDD_HHmmss") +
            ".zip";
    }
    window.open(exportLink);
}



//**************************************************************************************************************************
//Calculate Length of Link
/**
 * Elements that make up the popup for Length viewing Tool.
 */

var lengthPopupContainer = document.getElementById("length-popup");
var lengthPopupCloser = document.getElementById("length-popup-closer");
/**
 * Create an overlay to anchor the popup to the coremap.map.
 */
var lengthPopupOverlay = new ol.Overlay(
    /** @type {olx.OverlayOptions} */
    ({
        element: lengthPopupContainer,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    })
);
coremap.map.addOverlay(lengthPopupOverlay);

lengthPopupCloser.onclick = function() {
    lengthPopupOverlay.setPosition(undefined);
    vectorSource.clear();
    lengthPopupCloser.blur();
    remove_popuplength_overlay()
    return false;
};

 /**
  * Handle change event.
  */
interactionDraw.onchange = function() {
    coremap.map.un("singleclick", cordinfo);
    coremap.map.removeInteraction(draw);
    addInteraction();
};

addInteraction();
var draw_for_length = document.getElementById("draw_for_length");

var drawForLength; // global so we can remove it later
function remove_popuplength_overlay() {
    lengthPopupOverlay.setPosition(undefined);
    document.getElementById("length_overlay").value = 'none';
    document.getElementById("calculatedlength").innerHTML = "";
    vectorSource.clear();
}
function addInteractionForLength() {
    drawForLength = new ol.interaction.Draw({
        source: vectorSource,
        type: "Polygon"
    });
    drawForLength.on("drawend", function(evt) {
        coremap.map.removeInteraction(drawForLength);
        let geometry = evt.feature.getGeometry();

        lengthPopupOverlay.setPosition(
            geometry.getInteriorPoint().getCoordinates()
        );
        $("#length-calculate").off("click");

        $("#length-calculate").on("click", function() {
            calculateLinkLength(geometry);

        });
    });
    coremap.map.addInteraction(drawForLength);
}
/** Handle change event. **/
draw_for_length.onclick = function() {
    $("#map_tools_modal").modal("hide");

    coremap.map.removeInteraction(drawForLength);
    addInteractionForLength();
    remove_popuplength_overlay();
};
function calculateLinkLength(geometry) {
    var selectedLink = $("#length_overlay").val();

    var format = new ol.format.WKT();
    var geom = format.writeGeometry(
        geometry.clone().transform("EPSG:3857", "EPSG:4326")
    );
    var xhttp;

    if (!selectedLink) {
        alert("Please select an overlay.");
        document.getElementById("calculatedlength").innerHTML = "";
        return;
    }

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                var jsonResponse = JSON.parse(this.responseText);
                var value = jsonResponse[0].totallength;

                document.getElementById("calculatedlength").innerHTML = "The total " + selectedLink + " within this custom boundary is " + value + " km";
        }
    };
    xhttp.open("GET", "map/"+selectedLink+"/"+geom+"", true);
    xhttp.send();
}



//Measurement
var measurement = document.getElementById("measurement");

var sketch;

var helpTooltipElement;

var helpTooltip;

var measureTooltipElement;

var measureTooltip;

var continuePolygonMsg = "Click to continue drawing the polygon";

var continueLineMsg = "Click to continue drawing the line";

var pointerMoveHandler = function(evt) {
    if (evt.dragging) {
        return;
    }
    var helpMsg = "Click to start drawing";

    if (sketch) {
        var geom = sketch.getGeometry();
        if (geom instanceof ol.geom.Polygon) {
            helpMsg = continuePolygonMsg;
        } else if (geom instanceof ol.geom.LineString) {
            helpMsg = continueLineMsg;
        }
    }

    helpTooltipElement.innerHTML = helpMsg;
    helpTooltip.setPosition(evt.coordinate);

    helpTooltipElement.classList.remove("hidden");
};

var draw;

var formatLength = function(line) {
    var length = ol.sphere.getLength(line);
    var output;
    if (length > 100) {
        output = Math.round((length / 1000) * 100) / 100 + " " + "km";
    } else {
        output = Math.round(length * 100) / 100 + " " + "m";
    }
    return output;
};

var formatArea = function(polygon) {
    var area = ol.sphere.getArea(polygon);
    var output;
    if (area > 10000) {
        output =
            Math.round((area / 1000000) * 100) / 100 + " " + "km<sup>2</sup>";
    } else {
        output = Math.round(area * 100) / 100 + " " + "m<sup>2</sup>";
    }
    return output;
};

function measurementAddInteraction() {
    if (measurement.value !== "None") {
        coremap.map.on("pointermove", pointerMoveHandler);

        coremap.map.getViewport().addEventListener("mouseout", function() {
            helpTooltipElement.classList.add("hidden");
        });
    }
    var type = measurement.value == "area" ? "Polygon" : "LineString";
    draw = new ol.interaction.Draw({
        source: vectorSource,
        type: type,
        style: new ol.style.Style({
            fill: new ol.style.Fill({
                color: "rgba(255, 255, 255, 0.2)"
            }),
            stroke: new ol.style.Stroke({
                color: "rgba(0, 0, 0, 0.5)",
                lineDash: [10, 10],
                width: 2
            }),
            image: new ol.style.Circle({
                radius: 5,
                stroke: new ol.style.Stroke({
                    color: "rgba(0, 0, 0, 0.7)"
                }),
                fill: new ol.style.Fill({
                    color: "rgba(255, 255, 255, 0.2)"
                })
            })
        })
    });
    if (measurement.value !== "None") {
        coremap.map.addInteraction(draw);

        createMeasureTooltip();
        createHelpTooltip();
    }
    var listener;
    draw.on("drawstart", function(evt) {
        // set sketch
        sketch = evt.feature;
        var tooltipCoord = evt.coordinate;

        listener = sketch.getGeometry().on("change", function(evt) {
            var geom = evt.target;
            var output;
            if (geom instanceof ol.geom.Polygon) {
                output = formatArea(geom);
                tooltipCoord = geom.getInteriorPoint().getCoordinates();
            } else if (geom instanceof ol.geom.LineString) {
                output = formatLength(geom);
                tooltipCoord = geom.getLastCoordinate();
            }
            measureTooltipElement.innerHTML = output;
            measureTooltip.setPosition(tooltipCoord);
        });
    });

    draw.on("drawend", function() {
        measureTooltipElement.className = "ol-tooltip ol-tooltip-static";
        measureTooltip.setOffset([0, -7]);
        // unset sketch
        sketch = null;
        // unset tooltip so that a new one can be created
        measureTooltipElement = null;
        createMeasureTooltip();
        ol.Observable.unByKey(listener);
    });
}

/**
 * Creates a new help tooltip
 */
function createHelpTooltip() {
    if (helpTooltipElement) {
        helpTooltipElement.parentNode.removeChild(helpTooltipElement);
    }
    helpTooltipElement = document.createElement("div");
    helpTooltipElement.className = "ol-tooltip hidden";
    helpTooltip = new ol.Overlay({
        element: helpTooltipElement,
        offset: [15, 0],
        positioning: "center-left"
    });
    coremap.map.addOverlay(helpTooltip);
}

/**
 * Creates a new measure tooltip
 */
function createMeasureTooltip() {
    if (measureTooltipElement) {
        measureTooltipElement.parentNode.removeChild(measureTooltipElement);
    }
    measureTooltipElement = document.createElement("div");
    measureTooltipElement.className = "ol-tooltip ol-tooltip-measure";
    measureTooltip = new ol.Overlay({
        element: measureTooltipElement,
        offset: [0, -15],
        positioning: "bottom-center"
    });
    coremap.map.addOverlay(measureTooltip);
}

/**
 * Let user change the geometry type.
 */
measurement.onchange = function() {
    coremap.map.removeInteraction(draw);
    coremap.map.removeOverlay(measureTooltip);
    coremap.map.removeOverlay(helpTooltip);
    measureTooltipElement = null;

    if (measurement.value !== "None") {
        measurementAddInteraction();
    }
};

measurementAddInteraction();

var clear = document.getElementById("clear");
clear.addEventListener("click", function() {
    vectorSource.clear();
    $(".ol-tooltip-static").remove();
    coremap.map.removeInteraction(drawForExport);

    coremap.map.removeInteraction(draw);
    popupOverlay.setPosition(undefined);
    exportPopupOverlay.setPosition(undefined);
    lengthPopupOverlay.setPosition(undefined);
    $("#coordinate_info").off("click");
    coremap.map.un("singleclick", cordinfo);
    coremap.map.un("singleclick", getInfo);
});
//**************************************************************************************************************************
//Tool Bar filter

var provinceFilter = document.getElementById("province");
provinceFilter.addEventListener("change", function() {
    if (!document.getElementById("provincelayerCheckbox").checked) {
        document.getElementById("provincelayerCheckbox").click();
    }
        // console.log(coremap.map.getView().calculateExtent());
        // console.log(administrativelayer.maps_province.getSource().getParams());
        if (provinceFilter.value.length<1){
            administrativelayer.maps_province.getSource().updateParams({
                cql_filter: "province LIKE ''"
            });
            administrativelayer.maps_district.getSource().updateParams({
                cql_filter: "district LIKE ''"
            });
            administrativelayer.maps_vdc.getSource().updateParams({
                cql_filter: "gapa_napa LIKE ''"
            });
            administrativelayer.maps_ward.getSource().updateParams({
                cql_filter:
                    "new_ward_n = ''" +
                    "AND gapa_napa LIKE''"
            });
        }else {
            administrativelayer.maps_province.getSource().updateParams({
                cql_filter: "province LIKE '" + provinceFilter.value + "'"
            });
            // console.log(provinceFilter.value);
            $.ajax({
                url: "map/get_province_extent/" + provinceFilter.value,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    coremap.map.getView().fit(data, {
                        size: coremap.map.getSize(),
                        padding: [150, 150, 150, 150]
                    });
                }
            });
        }

    //coremap.map.getView().fit([], coremap.map.getSize());
    // console.log(coremap.map.getView().getProjection());
});

var dictrictFilter = document.getElementById("district");

dictrictFilter.addEventListener("change", function() {

    if (!document.getElementById("districtlayerCheckbox").checked) {
        document.getElementById("districtlayerCheckbox").click();
    }
    if (this.value.length<1){
        administrativelayer.maps_district.getSource().updateParams({
            cql_filter: "district LIKE ''"
        });
        administrativelayer.maps_vdc.getSource().updateParams({
            cql_filter: "gapa_napa LIKE ''"
        });
        administrativelayer.maps_ward.getSource().updateParams({
            cql_filter:
                "new_ward_n = ''" +
                "AND gapa_napa LIKE '1'"
        });
    }else {
        administrativelayer.maps_district.getSource().updateParams({
            cql_filter: "district LIKE '" + dictrictFilter.value + "'"
        });
        $.ajax({
            url: "map/get_district_extent/" + dictrictFilter.value,
            type: "GET",
            dataType: "json",
            success: function (data) {
                coremap.map.getView().fit(data, {
                    size: coremap.map.getSize(),
                    padding: [150, 150, 150, 150]
                });
            }
        });
    }
});

var vdcFilter = document.getElementById("vdc");

vdcFilter.addEventListener("change", function() {

    if (!document.getElementById("vdclayerCheckbox").checked) {
        document.getElementById("vdclayerCheckbox").click();
    }
    if (vdcFilter.value.length<1){
        administrativelayer.maps_vdc.getSource().updateParams({
            cql_filter: "gapa_napa LIKE ''"
        });
        administrativelayer.maps_ward.getSource().updateParams({
            cql_filter:
                "new_ward_n = ''" +
                "AND gapa_napa LIKE '1'"
        });
    }else {
        administrativelayer.maps_vdc.getSource().updateParams({
            cql_filter: "gapa_napa LIKE '" + vdcFilter.value + "'"
        });
        $.ajax({
            url: "map/get_vdc_extent/" + vdcFilter.value,
            type: "GET",
            dataType: "json",
            success: function (data) {
                coremap.map.getView().fit(data, {
                    size: coremap.map.getSize(),
                    padding: [150, 150, 150, 150]
                });
            }
        });
    }
});

var wardFilter = document.getElementById("ward");

wardFilter.addEventListener("change", function() {

    if (!document.getElementById("wardlayerCheckbox").checked) {
        document.getElementById("wardlayerCheckbox").click();
    }
    if (wardFilter.value.length<1){
        administrativelayer.maps_ward.getSource().updateParams({
            cql_filter:
                "new_ward_n = ''" +
                "AND gapa_napa LIKE '1'"
        });
    }else {
        administrativelayer.maps_ward.getSource().updateParams({
            cql_filter:
                "new_ward_n = '" +
                wardFilter.value +
                "'" +
                "AND gapa_napa LIKE'" +
                vdcFilter.value +
                "'"
        });
    }
});

function checkLayerIfUnchecked(layerCheckbox) {
    if (!$(layerCheckbox).is(":checked")) {
        $(layerCheckbox).trigger("click");
    }
}

//Get Info from various layers
//When single clicked on map
var getInfo = function(evt) {};
coremap.map.on("singleclick", getInfo);

$("#info").on("change", function() {
    popupOverlay.setPosition(undefined);
    coremap.map.un("singleclick", cordinfo);
    coremap.map.un("singleclick", getInfo);
    // console.log(this.value);
    switch (this.value) {
        case "provinceInfo":
            checkLayerIfUnchecked("#provincelayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = administrativelayer.maps_province.getSource().getFeatureInfoUrl(
                        evt.coordinate,
                        viewResolution,
                        projection,
                        {
                            INFO_FORMAT: "application/json",
                            QUERY_LAYERS: "maps_province"
                        }
                    );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createProvinceTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "districtInfo":
            checkLayerIfUnchecked("#districtlayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = administrativelayer.maps_district.getSource().getFeatureInfoUrl(
                        evt.coordinate,
                        viewResolution,
                        projection,
                        {
                            INFO_FORMAT: "application/json",
                            QUERY_LAYERS: "maps_district"
                        }
                    );

                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createDistrictTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "vdcInfo":
            checkLayerIfUnchecked("#vdclayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = administrativelayer.maps_vdc.getSource().getFeatureInfoUrl(
                        evt.coordinate,
                        viewResolution,
                        projection,
                        {
                            INFO_FORMAT: "application/json",
                            QUERY_LAYERS: "maps_vdc"
                        }
                    );

                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createVdcTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "roadInfo":
                checkLayerIfUnchecked("#roadlayerCheckbox");
                coremap.map.on(
                    "singleclick",
                    (getInfo = function(evt) {
                        var currentView = coremap.map.getView();
                        var viewResolution = currentView.getResolution();
                        var projection = currentView.getProjection();
                        var url = informationlayer.road
                            .getSource()
                            .getFeatureInfoUrl(
                                evt.coordinate,
                                viewResolution,
                                projection,
                                {
                                    INFO_FORMAT: "application/json",
                                    QUERY_LAYERS: "road"
                                }
                            );

                        if (url) {
                            fetch(url)
                                .then(function(response) {
                                    return response.text();
                                })
                                .then(function(json) {
                                    var jsonData = JSON.parse(json);
                                    try {
                                        var table = infotable.createRoadTable(
                                            jsonData
                                        );
                                        popupContent.innerHTML = table;
                                        popupOverlay.setPosition(undefined);
                                        popupOverlay.setPosition(evt.coordinate);
                                    } catch (error) {
                                        popupOverlay.setPosition(undefined);
                                        return;
                                    }
                                });
                        }
                    })
                );
                break;
        case "riverInfo":
                checkLayerIfUnchecked("#riverlayerCheckbox");
                coremap.map.on(
                    "singleclick",
                    (getInfo = function(evt) {
                        var currentView = coremap.map.getView();
                        var viewResolution = currentView.getResolution();
                        var projection = currentView.getProjection();
                        var url = informationlayer.river
                            .getSource()
                            .getFeatureInfoUrl(
                                evt.coordinate,
                                viewResolution,
                                projection,
                                {
                                    INFO_FORMAT: "application/json",
                                    QUERY_LAYERS: "river"
                                }
                            );

                        if (url) {
                            fetch(url)
                                .then(function(response) {
                                    return response.text();
                                })
                                .then(function(json) {
                                    var jsonData = JSON.parse(json);
                                    try {
                                        var table = infotable.createRiverTable(
                                            jsonData
                                        );
                                        popupContent.innerHTML = table;
                                        popupOverlay.setPosition(undefined);
                                        popupOverlay.setPosition(evt.coordinate);
                                    } catch (error) {
                                        popupOverlay.setPosition(undefined);
                                        return;
                                    }
                                });
                        }
                    })
                );
                break;
        case "BTSInfo":
                    checkLayerIfUnchecked("#btslayerCheckbox");
                    coremap.map.on(
                        "singleclick",
                        (getInfo = function(evt) {
                            var currentView = coremap.map.getView();
                            var viewResolution = currentView.getResolution();
                            var projection = currentView.getProjection();
                            var url = bts
                                .getSource()
                                .getFeatureInfoUrl(
                                    evt.coordinate,
                                    viewResolution,
                                    projection,
                                    {
                                        INFO_FORMAT: "application/json",
                                        QUERY_LAYERS: "bts"
                                    }
                                );

                            if (url) {
                                fetch(url)
                                    .then(function(response) {
                                        return response.text();
                                    })
                                    .then(function(json) {
                                        var jsonData = JSON.parse(json);
                                        try {
                                            var table = infotable.createBtsTable(
                                                jsonData
                                            );
                                            popupContent.innerHTML = table;

                                            var systemsiteid = jsonData.features[0].properties.syssiteid;

                                            $("#export-btsinfo").off("click");
                                        
                                            $("#export-btsinfo").on("click", function() {
                                                openExportBtsInfo(systemsiteid, "CSV");
                                            });

                                            popupOverlay.setPosition(undefined);
                                            popupOverlay.setPosition(evt.coordinate);
                                        } catch (error) {
                                            popupOverlay.setPosition(undefined);
                                            return;
                                        }
                                    });
                            }

                        })

                    );
                    break;
        case "microwavenodeInfo":
            checkLayerIfUnchecked("#microwavelayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = microwaveStation
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "microwaves"
                            }
                        );

                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createMicrowavenodeTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "microwavelinkInfo":
            checkLayerIfUnchecked("#microwavestationlinklayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = microwaveStationLink
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "microwavestations"
                            }
                        );

                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createMicrowavelinkTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "vsatInfo":
            checkLayerIfUnchecked("#vsatlayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = vsats
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "vsats"
                            }
                        );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createVsatTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "opticalfiberInfo":
            checkLayerIfUnchecked("#opticalfiberlayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = opticalFiber
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "opticalfibers_new"
                            }
                        );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createOpticalfiberTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "opticalfiberlinkInfo":
            checkLayerIfUnchecked("#opticalfiberlinklayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = opticalFiberLink
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "opticalfiberlinks_new"
                            }
                        );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createOpticalfiberlinkTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "opticalfiberplannedInfo":
            checkLayerIfUnchecked("#opticalfiberplannedlayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = opticalFiberPlanned
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "opticalfiberplans_new"
                            }
                        );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createOpticalfiberplannedTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        case "opticalfiberlinkplannedInfo":
            checkLayerIfUnchecked("#opticalfiberlinkplannedlayerCheckbox");
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = opticalFiberLinkPlanned
                        .getSource()
                        .getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "opticalfiberlinkplans_new"
                            }
                        );
                    if (url) {
                        fetch(url)
                            .then(function(response) {
                                return response.text();
                            })
                            .then(function(json) {
                                var jsonData = JSON.parse(json);
                                try {
                                    var table = infotable.createOpticalfiberlinkplannedTable(
                                        jsonData
                                    );
                                    popupContent.innerHTML = table;
                                    popupOverlay.setPosition(undefined);
                                    popupOverlay.setPosition(evt.coordinate);
                                } catch (error) {
                                    popupOverlay.setPosition(undefined);
                                    return;
                                }
                            });
                    }
                })
            );
            break;
        default:
            popupOverlay.setPosition(undefined);
            coremap.map.un("singleclick", getInfo);
            coremap.map.un("singleclick", cordinfo);
    }
    function openExportBtsInfo(systemsiteid, outputFormat) {
        var selectedLayer = "sys_n_site_wg";

        var exportBtsInfo =
            gurl_ows +
            "?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:" +
            selectedLayer +
            "&CQL_FILTER=syssiteid='" +
            systemsiteid +
            "'&outputFormat=" +
            outputFormat+
            "&authkey="+ GEO_AUTHKEY;

            
        if (outputFormat == "SHAPE-ZIP") {
            exportBtsInfo +=
                "&format_options=filename:" +
                "export_imis_" +
                moment().format("YYYYMMDD_HHmmss") +
                ".zip";
        }
        window.open(exportBtsInfo);
    }
});

//**********************************************************************************************************************

//Click garda Coordinate dekhiney bhayo

var coordinateInfo = document.getElementById("coordinate_info");
coordinateInfo.addEventListener("click", function() {
    coremap.map.un("singleclick", getInfo);
    coremap.map.on("singleclick", (cordinfo = displayCoordinateInformation));
});
var popupContainer = document.getElementById("popup");
var popupContent = document.getElementById("popup-content");
var popupCloser = document.getElementById("popup-closer");

/**
 * Create an overlay to anchor the popup to the map
 */
var popupOverlay = new ol.Overlay({
    element: popupContainer,
    autoPan: true,
    stopEvent: true,
    autoPanAnimation: {
        duration: 250
    }
});

// $(popupContainer).show();

coremap.map.addOverlay(popupOverlay);

// var dragPan;

// coremap.map.getInteractions().forEach(function(interaction){
// 	if (interaction instanceof ol.interaction.DragPan) {
// 		dragPan = interaction;
// }
// });

// popupContainer.addEventListener('mousedown', function(evt) {
//     dragPan.setActive(false);
//     popupOverlay.set('dragging', true);
// });

// coremap.map.on('pointermove', function(evt) {
// 	if (popupOverlay.get('dragging') === true) {
//         popupOverlay.setPosition(evt.coordinate);
// }
// });

// coremap.map.on('pointerup', function(evt) {
// 	if (popupOverlay.get('dragging') === true) {
//     dragPan.setActive(true);
//     popupOverlay.set('dragging', false);
// }
// });

popupCloser.onclick = function(event) {
    event.preventDefault();
    popupOverlay.setPosition(undefined);
    coremap.map.un("singleclick", cordinfo);
    popupCloser.blur();
    return false;
};

// Display information about coordinate
function displayCoordinateInformation(evt) {
    var coordinate = ol.proj.transform(
        evt.coordinate,
        "EPSG:3857",
        "EPSG:4326"
    );

    var html = '<div style="text-decoration:underline;">EPSG:3587</div>';
    html += '<table style="margin-bottom: 10px;">';
    html += "<tr>";
    html += '<td style="padding-right:5px;">Longitude</td>';
    html += "<td>" + evt.coordinate[0].toFixed(6) + "</td>";
    html += "</tr>";
    html += "<tr>";
    html += '<td style="padding-right:5px;">Latitude</td>';
    html += "<td>" + evt.coordinate[1].toFixed(6) + "</td>";
    html += "</tr>";
    html += "<table>";
    html += '<div style="text-decoration:underline;">EPSG:4326</div>';
    html += "<table>";
    html += "<tr>";
    html += '<td style="padding-right:5px;">Longitude</td>';
    html += "<td>" + coordinate[0].toFixed(6) + "</td>";
    html += "</tr>";
    html += "<tr>";
    html += '<td style="padding-right:5px;">Latitude</td>';
    html += "<td>" + coordinate[1].toFixed(6) + "</td>";
    html += "</tr>";
    html += "<table>";

    popupContent.innerHTML = html;
    popupOverlay.setPosition(evt.coordinate);
}

//for plotting
let urlString = document.URL;
let paramString = urlString.split("?")[1];
let queryString = new URLSearchParams(paramString);
let field = "",
    layer = "",
    val = "";
for (let pair of queryString.entries()) {
    pair[0] == "layer" ? (layer = pair[1]) : "";
    pair[0] == "field" ? (field = pair[1]) : "";
    pair[0] == "val" ? (val = pair[1]) : "";
}
if (layer != "" && field != "" && val != "") {
    handleZoomToExtent(layer, field, val);
}
var marker_geom;

function handleZoomToExtent(layer, field, val) {
    var url =
        APP_URL+"/getExtent" +
        "/" +
        layer +
        "/" +
        field +
        "/" +
        val;

    $.ajax({
        url: url,
        type: "get",
        success: function(data) {
            var extent = ol.proj.transformExtent(
                [
                    parseFloat(data.xmin),
                    parseFloat(data.ymin),
                    parseFloat(data.xmax),
                    parseFloat(data.ymax)
                ],
                "EPSG:4326",
                "EPSG:3857"
            );
            coremap.map.getView().fit(extent,{size:coremap.map.getSize(), maxZoom:8});
            marker_geom = data.geom;
            var format = new ol.format.WKT();
            var feature = format.readFeature(marker_geom, {
                dataProjection: "EPSG:4326",
                featureProjection: "EPSG:3857"
            });
            vectorSource.addFeature(feature);
        },
        error: function(data) {
            // console.error(data);
        }
    });
}

function draganddrop() {
    const dragAndDropInteraction = new ol.interaction.DragAndDrop({
        formatConstructors: [ol.format.GeoJSON, ol.format.KML]
    });
    coremap.map.addInteraction(dragAndDropInteraction);

    dragAndDropInteraction.on("addfeatures", function(event) {
        var vectorSourceDragAndDrop = new ol.source.Vector({
            features: event.features
        });
        coremap.map.addLayer(
            new ol.layer.Vector({
                source: vectorSourceDragAndDrop
            })
        );
        coremap.map.getView().fit(vectorSourceDragAndDrop.getExtent());
    });
}
draganddrop();

var parser = new ol.format.WMSCapabilities();

var wmsUrl = document.getElementById("wmsURL");
var mapLayer = document.getElementById("mapLayer");
wmsUrl.addEventListener("click", function() {
    var wmsAddress = document.getElementById("wmsAddress").value;
    fetch(wmsAddress)
        .then(function(response) {
            return response.text();
        })
        .then(function(text) {
            $("#wmsModal").modal("hide");
            var result = parser.read(text);
            let layers = result.Capability.Layer.Layer;
            let i;
            $("#getLayerModal").modal();
            let layerName = [];
            mapLayer.options.length = 0;
            for (i = 0; i < layers.length; i++) {
                layerName[i] = layers[i].Name;
                var option = document.createElement("option");
                option.text = option.value = layers[i].Name;
                mapLayer.add(option);
            }
            var wms_gurl = wmsAddress.split("?")[0];
            mapLayer.addEventListener("change", function() {
                const source = new ol.source.TileWMS({
                    url: wms_gurl,
                    params: {
                        layers: mapLayer.value,
                        authkey: GEO_AUTHKEY,
                        TILED: true
                    },
                    crossOrigin: "anonymous",
                    serverType: "geoserver",
                    attributions: "This is from getcapabilities"
                });
                const layer = new ol.layer.Tile({
                    source: source,
                    visible: true
                });
                coremap.map.addLayer(layer);
            });
        })
        .catch(function(err) {
            alert("Enter Valid URL");
        });
});

//2020-feb-16

var DEMChart = document.getElementById("DEMChart");
const mapDraw = document.getElementById("dem_profile");
let myChart;
mapDraw.addEventListener("click", function drawline() {
    const drawInteraction = new ol.interaction.Draw({
        type: "LineString",
        maxPoints: 2
    });
    coremap.map.addInteraction(drawInteraction);
    drawInteraction.on("drawend", function(e) {
        var format = new ol.format.WKT();
        var geom = format.writeGeometry(
            e.feature
                .getGeometry()
                .clone()
                .transform("EPSG:3857", "EPSG:4326")
        );
        $(document).ready(function() {
            $.ajax({
                url: "map/get_DEM_line_geom",
                type: "POST",
                data: { geom: geom },
                success: function(data) {
                    let elevation = new Array();
                    for (let i = 0; i < data.length; i++) {
                        elevation[i] = data[i];
                    }

                    let labelForChart = new Array();
                    for (let i = 0; i < elevation.length; i++) {
                        labelForChart[i] = i;
                    }
                    var speedData = {
                        labels: labelForChart,
                        datasets: [
                            {
                                label: "Elevation",
                                data: elevation,
                                borderColor: "#3e95cd"
                            }
                        ]
                    };
                    myChart = new Chart(DEMChart, {
                        type: "line",
                        data: speedData
                    });
                    $("#DEMModal").modal();
                    coremap.map.removeInteraction(drawInteraction);
                }
            });
        });
    });
});

$("#DEMModal").on("hidden.bs.modal", function(event) {
    myChart.destroy();
});
$('#map_print_modal').on('hidden.bs.modal', function () {
     if (eLayer.print_box_layer) {
        eLayer.print_box_layer.layer.getSource().clear();
    }
    $("#print_map_title").val("");
    $("#print_map_comment").val("");
    $("#print_map_description").val("");
    $("#print_scale").val("25000");
    $("#print_paper_size").val("A4");
    $("#print_dpi").val("150");
});
//Print function ajax
$("#print_map_fish").on("click", function() {
    let print_map_title = $("#print_map_title").val();
    let print_map_comment = $("#print_map_comment").val();
    let print_map_description = $("#print_map_description").val();
    let print_scale = $("#print_scale").val();
    let print_paper_size = $("#print_paper_size").val();
    let print_dpi = $("#print_dpi").val();
    let map_print_center = $('#map-print-polygon-center').val();
    if (!print_map_title) {
        return alert("Please provide title for print job");
    }
    // if (!print_map_comment) {
    //     return alert("Please provide comment for print job");
    // }
    // if (!print_map_description) {
    //     return alert("Please provide description for print job");
    // }
    const tileRasterLayerElements = document.querySelectorAll(
        ".sideba > input[type=checkbox]"
    );
    let alllayers = [];
    for (let tileRasterLayerElement of tileRasterLayerElements) {
        if (tileRasterLayerElement.checked) {
            alllayers.push(tileRasterLayerElement.value);
        }
    }
    
        var removeItem = 'heatmaplayer';

        alllayers = jQuery.grep(alllayers, function(value) {
          return value != removeItem;
        });
        
        var removeItem2 = 'elevation';
        alllayers = jQuery.grep(alllayers, function(value) {
          return value != removeItem2;
        });
        console.log(alllayers);
    let allstyles = [];
    var multistylelayers = ['maps_nepal', 'maps_province', 'maps_district', 'maps_vdc', 'maps_ward', 'road', 'river', 'settlement', 'imp_places', 'elevation_nepal', 'microwaves', 'microwavestations', 'vsats', 'opticalfibers_new', 'opticalfiberlinks_new', 'opticalfiberplans_new', 'opticalfiberlinkplans_new', 'bts', 'coverage_data'];
    $.each(alllayers, function (key, value) {
        
                if(value == 'maps_nepal')
                {
                var style = 'fill_stroke_nepal_border';
                }
                else if(value == 'road')
                {
                var style = 'road_line';
                }
                else if(value == 'maps_province'){
                var style = $('#provinceLayerFilter').find(":selected").val();
                }
                else if(value == 'maps_district'){
                var style = $('#districtLayerFilter').find(":selected").val();
                }
                else if(value == 'maps_vdc'){
                var style = $('#vdcLayerFilter').find(":selected").val();
                }
                else if(value == 'maps_ward'){
                var style = $('#wardLayerFilter').find(":selected").val();
                }
                else if(value == 'river'){
                var style = 'river_style';
                }
                else if(value == 'settlement'){
                var style = 'settlement_external_data';
                }
                else if(value == 'imp_places'){
                var style = 'imp_places_style';
                }
                else if(value == 'elevation_nepal'){
                var style = 'nepal_elevation_style';
                }
                else if(value == 'microwaves'){
                var style = $('#microwavestationLayerFilter').find(":selected").val();
                }
                else if(value == 'microwavestations'){
                var style = $('#microwavestationlinkLayerFilter').find(":selected").val();
                }
                else if(value == 'microwavestations'){
                var style = $('#microwavestationlinkLayerFilter').find(":selected").val();
                }
                else if(value == 'vsats'){
                var style = $('#vsatLayerFilter').find(":selected").val();
                }
                else if(value == 'opticalfibers_new'){
                var style = $('#opticalfiberLayerFilter').find(":selected").val();
                }
                else if(value == 'opticalfiberlinkplans_new'){
                var style = $('#opticalfiberplannedLayerFilter').find(":selected").val();
                }
                else if(value == 'bts'){
                var style = $('#btsLayerFilter').find(":selected").val();
                }
                else if(value == 'coverage_data'){
                var style = $('#coveragedataLayerFilter').find(":selected").val();
                }
                else
                {
                var style = value;
                }
            allstyles.push(style);
        
    });

    console.log(allstyles);
    // debugger;

    var printBounds = eLayer.print_box_layer.layer.getSource().getExtent();
    var printBoundsTransform = ol.proj.transformExtent(printBounds,'EPSG:3857','EPSG:4326');


    var json = {

        comment: print_map_comment,
        mapTitle: print_map_title,
        description: print_map_description,
        dpi: print_dpi,
        scale: print_scale,
        layout: "A4 portrait",
        srs: "EPSG:4326",
        units: "degrees",
        geodetic: false,
        outputFilename: "nepal_map",
        outputFormat: "pdf",
        layers: [
            {
                type: "WMS",
                layers: alllayers,
                baseURL: GEO_URL + "/nepal_map/wms?authkey=3930c378-caac-4a35-b22b-efbfd062d564",
                format: "image/jpeg",
                styles: allstyles,
            }
        ],
        pages: [
            {
                bbox: printBoundsTransform,
                mapTitle: print_map_title,
                scale: print_scale,
                dpi: 150,
                geodetic: false,
                strictEpsg4326: false
            }
        ]
    };

    
    async function getFile(e) {
        e.preventDefault();
        await fetch( GEO_URL + "/pdf/print.pdf?authkey=3930c378-caac-4a35-b22b-efbfd062d564", {
            method: "POST",
            body: JSON.stringify(json)
        })
            .then(function(resp) {
                return resp.blob();
            })
            .then(function(blob) {
                return download(blob, "nepal_map.pdf");
            });
    }
    getFile(event);
    $("#map_print_modal").modal("hide");
   
});

// $('#geographic_penetration').click(function() {
//                 $.ajax({
//                     url: "maptools/geographic_penetration",
//                     type: "POST",
//                     success: function(received_data) {
//                         new Chart($('#geographic_penetration_chart'), {
//                             type: "bar",
//                             data: {
//                             labels: ["Province 1", "Province 2", "Bagmati", "Gandaki", "Province 5","Karnali","Sudurpaschim"],
//                             datasets: [{
//                             backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#e31c1e","#3cbd9e"],
//                             data:received_data
//                             }]
//                         },
//                         options: {
//                             legend:{
//                                 display:false
//                             },
//                             scales: {
//                                 yAxes: [{
//                                     ticks: {
//                                         beginAtZero: true
//                                     }
//                                 }]
//                             }
//                         }
//                         });
//                         $('#geographicpenetrationModal').modal();
//                     }
//                 });
//             });
// Extra Overlays Object
    var eLayer = {};
    // Add extra overlay to Extra Overlays Object
    function addExtraLayer(key, name, layer) {
        // adding as property of Extra Overlays Object
        eLayer[key] = {name: name, layer: layer};

        // Adding layer to OpenLayers Map
        coremap.map.addLayer(layer);

    }
$('#map_print').click(function() {
    if (!($('#map_print_modal .modal.in').length)) {
    $('map_print_modal .modal-dialog').css({
      top: 100,
      left: 100
    });
  }

  $('#map_print_modal').modal({
    backdrop: false,
    show: true
  });

  $('#map_print_modal .modal-dialog').draggable({
    handle: ".modal-header"
  });

  //***function to calculate H and W of pring box**//

    let print_map_title = $("#print_map_title").val();
    let print_map_comment = $("#print_map_comment").val();
    let print_map_description = $("#print_map_description").val();
    let print_scale = 25000;
    let print_paper_size = $("#print_paper_size").val();
    let print_dpi = $("#print_dpi").val();
    var dimension = getHeightWidthPrintBox(print_scale, print_paper_size, print_dpi);
    var center = coremap.map.getView().getCenter();
    $('#map-print-polygon-center').val(center);
    var x1 = ( center[0] - ( dimension['W'] / 2 ) );
    var y1 = ( center[1] - ( dimension['H'] / 2) );
    var x2 = ( center[0] + ( dimension['W'] / 2) )
    var y2 = ( center[1] - ( dimension['H'] / 2) );
    var x3 = ( center[0] + ( dimension['W'] / 2) )
    var y3 = ( center[1] + ( dimension['H'] / 2) );
    var x4 = ( center[0] - ( dimension['W'] / 2) )
    var y4 = ( center[1] + ( dimension['H'] / 2) );

    var ring = [
                    [x1,y1], [x2,y2],
                    [x3,y3], [x4,y4],
                    [x1,y1]
               ];


    if (eLayer.print_box_layer) {
        eLayer.print_box_layer.layer.getSource().clear();
    } else {
       var layer = new ol.layer.Vector({
                        // visible: false,
                        source: new ol.source.Vector()
                    });
        addExtraLayer('print_box_layer', 'Print Box', layer);
    }

    var feature = new ol.Feature({
        geometry: new ol.geom.Polygon([ring])
    });

    var style = new ol.style.Style({
                fill: new ol.style.Fill({
                    color: [0, 0, 255, 0.3]
                }),
                stroke: new ol.style.Stroke({
                    color: [255, 160, 25, 1],
                    width: 0.6,
                })
            });
    feature.setStyle(style);
    eLayer.print_box_layer.layer.getSource().addFeature(feature);
    var control = new ol.interaction.Translate({
        features: new ol.Collection([feature])
    });
    coremap.map.addInteraction(control);
});

$('#print_scale').on('change', function() {

  //***function to calculate H and W of pring box**//
    let print_scale = $("#print_scale").val();
    let print_dpi = $("#print_dpi").val();
    let print_paper_size = $("#print_paper_size").val();
    var dimension = getHeightWidthPrintBox(print_scale, print_paper_size, print_dpi);
    var center = coremap.map.getView().getCenter();
    var x1 = ( center[0] - ( dimension['W'] / 2 ) );
    var y1 = ( center[1] - ( dimension['H'] / 2) );
    var x2 = ( center[0] + ( dimension['W'] / 2) )
    var y2 = ( center[1] - ( dimension['H'] / 2) );
    var x3 = ( center[0] + ( dimension['W'] / 2) )
    var y3 = ( center[1] + ( dimension['H'] / 2) );
    var x4 = ( center[0] - ( dimension['W'] / 2) )
    var y4 = ( center[1] + ( dimension['H'] / 2) );

    var ring = [
                    [x1,y1], [x2,y2],
                    [x3,y3], [x4,y4],
                    [x1,y1]
               ];
    if (eLayer.print_box_layer) {

        eLayer.print_box_layer.layer.getSource().clear();

    } else {

       var layer = new ol.layer.Vector({
                        // visible: false,
                        source: new ol.source.Vector()
                    });

        addExtraLayer('print_box_layer', 'Print Box', layer);
        }
        var feature = new ol.Feature({
        geometry: new ol.geom.Polygon([ring])
    });

    var style = new ol.style.Style({
                fill: new ol.style.Fill({
                    color: [0, 0, 255, 0.3]
                }),
                stroke: new ol.style.Stroke({
                    color: [255, 160, 25, 1],
                    width: 0.6,
                })
            });

    feature.setStyle(style);
    eLayer.print_box_layer.layer.getSource().addFeature(feature);
    var control = new ol.interaction.Translate({
        features: new ol.Collection([feature])
    });
    coremap.map.addInteraction(control);
});

function getHeightWidthPrintBox(print_scale, print_paper_size, print_dpi){
    if(print_dpi == 300)
    {
    var print_dpi_x = 1 / 300; //inches per pixel.
        print_dpi_x  = 1 / 300 * 25.4; //mm/inch
        print_dpi_x  = 0.0846 ; //mm
        print_dpi_x = 0.000085; //meters
    }

    if(print_dpi == 150)
    {
    var print_dpi_x = 1 / 150; //inches per pixel.
        print_dpi_x  = 1 / 150 * 25.4; //mm/inch
        print_dpi_x  = 0.17 ; //mm
        print_dpi_x = 0.00017; //meters
    }

    if(print_dpi == 75)
    {
    var print_dpi_x = 1 / 75; //inches per pixel.
        print_dpi_x  = 1 / 75 * 25.4; //mm/inch
        print_dpi_x  = 0.34 ; //mm
        print_dpi_x = 0.00034; //meters
    }

    if(print_paper_size == 'A4')
    {
        var image_width_in = 8.26;
        var image_height_in = 11.7;
    }

    if(print_paper_size == 'A3')
    {
        var image_width_in = 11.7;
        var image_height_in = 16.5;
    }

    var map_realwidth_m = ( print_scale * 25.4 * image_width_in ) / 1000;
    var map_realheight_m = ( print_scale * 25.4 * image_height_in )  / 1000;

    var dimension = new Array();
        dimension['W'] = map_realwidth_m;
        dimension['H'] = map_realheight_m;

    return dimension;
}
//layer opacity sliders
$('#microwavestation_slider').on('input',function() {
    microwaveStation.setOpacity(this.value / 100);
});
$('#microwavestationlink_slider').on('input',function() {
    microwaveStationLink.setOpacity(this.value / 100);
});
$('#vsat_slider').on('input',function() {
    vsats.setOpacity(this.value / 100);
});
$('#opticalfiber_slider').on('input',function() {
    opticalFiber.setOpacity(this.value / 100);
});
$('#opticalfiberlink_slider').on('input',function() {
    opticalFiberLink.setOpacity(this.value / 100);
});
$('#opticalfiberplanned_slider').on('input',function() {
    opticalFiberPlanned.setOpacity(this.value / 100);
});
$('#opticalfiberlinkplanned_slider').on('input',function() {
    opticalFiberLinkPlanned.setOpacity(this.value / 100);
});
$('#bts_slider').on('input',function() {
    bts.setOpacity(this.value / 100);
});
$('#coveragedata_slider').on('input',function() {
    coveragedata.setOpacity(this.value / 100);
});
