window.onload = init;

function init() {
    // **************************************************************************************************************************
    //Defined for safety
    var cordinfo;
    //Defined Extent Globally
    const extent = [8519000, 2930000, 10395000, 3665000];
    //URL for geoserver
    const gurl = "http://localhost:8080/geoserver/nepal_map/wms";
    const gurl_ows = "http://localhost:8080/geoserver/nepal_map/ows";

    // Controls
    //FullScreen
    const fullScreenControl = new ol.control.FullScreen();

    //Drag and Rotate
    const dragRotateAndZoom = new ol.interaction.DragRotateAndZoom();

    // ZoomSlider
    const zoomSliderControl = new ol.control.ZoomSlider();

    //Overview of map
    const overViewMapControl = new ol.control.OverviewMap({
        collapsed: false,
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ]
    });

    // Attributions
    const attributionControl = new ol.control.Attribution({
        collapsible: true
    });

    // **************************************************************************************************************************

    //Layers

    //Drawing Layer
    //Vector Layer::Donot touch this,it is for drawing
    var vectorSource = new ol.source.Vector({
        crossOrigin: "anonymous",
        wrapX: false
    });
    var vector = new ol.layer.Vector({
        source: vectorSource,
        visible: true,
        zIndex: 99
    });

    //Base Layer
    //No Layer
    const base_no_layer = new ol.layer.Tile({
        source: "",
        visible: true,
        title: "NoLayer"
    });

    // Openstreet Map Standard
    const base_osm_standardmap = new ol.layer.Tile({
        source: new ol.source.OSM({
            crossOrigin: "anonymous"
        }),
        visible: false,
        title: "OSMStandard"
    });

    // Openstreet Map Humanitarian
    const base_osm_humanitarianmap = new ol.layer.Tile({
        source: new ol.source.OSM({
            crossOrigin: "anonymous",
            url: "https://{a-c}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png"
        }),
        visible: false,
        title: "OSMHumanitarian"
    });

    // Bing Maps Basemap Layer
    const base_bing_map = new ol.layer.Tile({
        source: new ol.source.BingMaps({
            crossOrigin: "anonymous",
            key: "Am91Zo6OSOQGKiN4xHLCgW3hd27DTm6n2E1xiKxMEzQb0JOXFYuttfbabSCavjpe",
            imagerySet: "CanvasGray" // Road, CanvasDark, CanvasGray
        }),
        visible: false,
        title: "BingMaps"
    });

    //Google Map Normal
    const base_gmap = new ol.layer.Tile({
        source: new ol.source.XYZ({
            crossOrigin: "anonymous",
            url: "http://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}",
            key: "AIzaSyCy29Hks6xqzvqjmVqixslBhMQYlJgZkLk"
        }),
        visible: false,
        title: "gmap"
    });

    //Google Map Statellite View
    const base_gsatmap = new ol.layer.Tile({
        source: new ol.source.XYZ({
            crossOrigin: "anonymous",
            url: "http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}",
            key: "AIzaSyCy29Hks6xqzvqjmVqixslBhMQYlJgZkLk"
        }),
        visible: false,
        title: "gsatmap"
    });

    // CartoDB BaseMap Layer
    const base_cartoDB_map = new ol.layer.Tile({
        source: new ol.source.XYZ({
            crossOrigin: "anonymous",
            url: "http://{1-4}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png",
            attributions: "© CARTO"
        }),
        visible: false,
        title: "CartoDarkAll"
    });

    // Stamen BaseMap Layer with Terrain
    const base_stamenwithlabel_map = new ol.layer.Tile({
        source: new ol.source.Stamen({
            crossOrigin: "anonymous",
            layer: "terrain-labels",
            attributions: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
        }),
        visible: false,
        title: "StamenTerrainWithLabels"
    });

    // Stamen BaseMap Layer
    const base_stamen_map = new ol.layer.Tile({
        source: new ol.source.XYZ({
            crossOrigin: "anonymous",
            url: "http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg",
            attributions: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
        }),
        visible: false,
        title: "StamenTerrain"
    });

    //Upper Layer
    sourceNepalBorder = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:maps_nepal",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });
    var NepalBorder = new ol.layer.Image({
        source: sourceNepalBorder,
        title: "NepalBorder",
        visible: true
    });

    sourceNepalProvince = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:maps_province",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var NepalProvince = new ol.layer.Tile({
        source: sourceNepalProvince,
        title: "NepalProvince",
        visible: false
    });

    sourceNepalDistrict = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:maps_district",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });
    var NepalDistrict = new ol.layer.Image({
        source: sourceNepalDistrict,
        title: "NepalDistrict",
        visible: false
    });

    sourceNepalVdc = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:maps_vdc",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });
    var NepalVDC = new ol.layer.Tile({
        source: sourceNepalVdc,
        title: "NepalVDC",
        visible: false
    });
    sourceNepalWard = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:maps_ward",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });
    var NepalWard = new ol.layer.Tile({
        source: sourceNepalWard,
        title: "NepalWard",
        visible: false
    });

    //Data Layer
//Population
var sourceElevation = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:elevation_nepal",
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});
var elevation = new ol.layer.Tile({
    source: sourceElevation,
    title: "elevation",
    visible: false
});
    //Extra Info Layer
    var sourceRiver = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:river",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var river = new ol.layer.Tile({
        source: sourceRiver,
        title: "river",
        visible: false
    });

    var sourceRoad = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:road",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var road = new ol.layer.Tile({
        source: sourceRoad,
        title: "road",
        visible: false
    });

    var sourceSettlement = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:settlement",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var settlement = new ol.layer.Tile({
        source: sourceSettlement,
        title: "settlement",
        visible: false
    });

    var sourceImpplaces = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:imp_places",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var impplaces = new ol.layer.Tile({
        source: sourceImpplaces,
        title: "impplaces",
        visible: false,
        crossOrigin: "anonymous"
    });

    //Actual Data Layer
    var sourceMicrowaveStation = new ol.source.TileWMS({
        url: gurl,
        params: {
            layers: "nepal_map:microwaves",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var microwaveStation = new ol.layer.Tile({
        source: sourceMicrowaveStation,
        title: "microwavestation",
        visible: false
    });

    var sourceMicrowaveStationLink = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:microwavestations",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var microwaveStationLink = new ol.layer.Image({
        source: sourceMicrowaveStationLink,
        title: "microwavestationlink",
        visible: false
    });

    var sourceVsat = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:vsats",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var vsat = new ol.layer.Image({
        source: sourceVsat,
        title: "vsat",
        visible: false
    });

    var sourceOpticalfiberplanned = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:opticalfiberplanned",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var opticalFiberPlanned = new ol.layer.Image({
        source: sourceOpticalfiberplanned,
        title: "opticalfiberplanned",
        visible: false
    });

    var sourceOpticalfiberlink = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:opticalfiberlink",
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var opticalFiber = new ol.layer.Image({
        source: sourceOpticalfiberlink,
        title: "opticalfiberlink",
        visible: false
    });

    var sourceBts = new ol.source.ImageWMS({
        url: gurl,
        params: {
            layers: "nepal_map:bts",
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
            TILED: true
        },
        crossOrigin: "anonymous",
        serverType: "geoserver",
        attributions: "© Innovative Solution Pvt. Ltd."
    });

    var coveragedata = new ol.layer.Image({
        source: sourceCoveragedata,
        title: "coveragedata",
        visible: false
    });
    var heatmaplayer = new ol.layer.Heatmap({
        source: new ol.source.Vector({
            url: gurl_ows +
                "?service=WFS&version=1.0.0&request=GetFeature&typeName=nepal_map%3Abts&outputFormat=kml",
            format: new ol.format.KML({
                extractStyles: false
            })
        }),
        blur: parseInt(10, 10),
        title: "heatmaplayer",
        visible: false,
        radius: parseInt(5, 10),
        weight: function (feature) {
            var name = feature.get("no_of_system");
            return name;
        }
    });

    // **************************************************************************************************************************
    //Map Instance
    const map = new ol.Map({
        view: new ol.View({
            center: [9443807.824891845, 3281690.3876565387],
            extent: [8519000, 2930000, 10395000, 3665000],
            zoom: 6,
            minZoom: 6
        }),
        // Layers
        layers: [base_no_layer],
        target: "js-map",

        //Default Keyboard Interaction
        keyboardEventTarget: document,

        //Controls

        //To add new controls define at Controls at top(eg:const myControls=new example_control();) and add here in extend array
        controls: ol.control
            .defaults({
                attribution: false
            })
            .extend([
                fullScreenControl,
                overViewMapControl,
                zoomSliderControl,
                attributionControl,
                dragRotateAndZoom
            ])
    });

    // **************************************************************************************************************************

    // Layer Group

    //Base Layer
    const baseLayerGroup = new ol.layer.Group({
        layers: [
            base_no_layer,
            base_osm_standardmap,
            base_osm_humanitarianmap,
            base_bing_map,
            base_cartoDB_map,
            base_stamenwithlabel_map,
            base_stamen_map,
            vector,
            base_gmap,
            base_gsatmap
        ]
    });

    // Raster Tile Layer Group
    const rasterTileLayerGroup = new ol.layer.Group({
        layers: [
            NepalBorder,
            NepalProvince,
            NepalDistrict,
            NepalVDC,
            NepalWard,
            road,
            river,
            settlement,
            impplaces,
            microwaveStation,
            microwaveStationLink,
            coveragedata,
            vsat,
            opticalFiber,
            opticalFiberPlanned,
            bts,
            heatmaplayer,
            elevation,
        ]
    });

    map.addLayer(baseLayerGroup);
    map.addLayer(rasterTileLayerGroup);
    // **************************************************************************************************************************

    // Interaction

    // DragRotate Interaction
    const dragRotateInteraction = new ol.interaction.DragRotate({
        condition: ol.events.condition.altKeyOnly
    });
    //Added Interaction
    map.addInteraction(dragRotateInteraction);

    // if (window.location.href != "http://gbtimis.test/map") {
    //     url = window.location.href;
    //     data = url.split("data=").pop();
    //     datasplit = data.split("%20");
    //     datalong = datasplit[0];
    //     datalat = datasplit[1];
    //     console.log(datalong);
    //     console.log(datalat);
    //     map.getView().setCenter(ol.proj.fromLonLat([datalong, datalat]));
    //     map.getView().setZoom(20);
    // }

    // **************************************************************************************************************************

    // LayerSwitcher

    //LayerSwitcher Logic
    const baseLayerElements = document.querySelectorAll(
        ".sideba>select[id=base_layer]"
    );
    for (let baseLayerElement of baseLayerElements) {
        baseLayerElement.addEventListener("change", function () {
            let baseLayerElementValue = this.value;
            baseLayerGroup.getLayers().forEach(function (element, index, array) {
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
        tileRasterLayerElement.addEventListener("change", function () {
            let tileRasterLayerElementValue = this.value;
            let tileRasterLayer;

            rasterTileLayerGroup
                .getLayers()
                .forEach(function (element, index, array) {
                    if (tileRasterLayerElementValue === element.get("title")) {
                        tileRasterLayer = element;
                    }
                });
            this.checked ?
                tileRasterLayer.setVisible(true) :
                tileRasterLayer.setVisible(false);
        });
    }

    // **************************************************************************************************************************

    // Layer Opacity Slider Control

    var base_map_slider = document.getElementById("base_map_slider");
    base_map_slider.oninput = function () {
        var opacity = this.value / 100;
        base_osm_standardmap.setOpacity(opacity);
        base_osm_humanitarianmap.setOpacity(opacity);
        base_bing_map.setOpacity(opacity);
        base_cartoDB_map.setOpacity(opacity);
        base_stamenwithlabel_map.setOpacity(opacity);
        base_stamen_map.setOpacity(opacity);
    };

    var border_slider = document.getElementById("border_slider");
    border_slider.oninput = function () {
        NepalBorder.setOpacity(this.value / 100);
    };

    var province_slider = document.getElementById("province_slider");
    province_slider.oninput = function () {
        NepalProvince.setOpacity(this.value / 100);
    };

    var district_slider = document.getElementById("district_slider");
    district_slider.oninput = function () {
        NepalDistrict.setOpacity(this.value / 100);
    };

    var vdc_slider = document.getElementById("vdc_slider");
    vdc_slider.oninput = function () {
        NepalVDC.setOpacity(this.value / 100);
    };

    var ward_slider = document.getElementById("ward_slider");
    ward_slider.oninput = function () {
        NepalWard.setOpacity(this.value / 100);
    };

    var microwavestation_slider = document.getElementById(
        "microwavestation_slider"
    );
    microwavestation_slider.oninput = function () {
        microwaveStation.setOpacity(this.value / 100);
    };

    var microwavestationlink_slider = document.getElementById(
        "microwavestationlink_slider"
    );
    microwavestationlink_slider.oninput = function () {
        microwaveStationLink.setOpacity(this.value / 100);
    };

    var vsat_slider = document.getElementById("vsat_slider");
    vsat_slider.oninput = function () {
        vsat.setOpacity(this.value / 100);
    };
    var opticalfiberlink_slider = document.getElementById(
        "opticalfiberlink_slider"
    );
    opticalfiberlink_slider.oninput = function () {
        opticalFiber.setOpacity(this.value / 100);
    };
    var opticalfiberplanned_slider = document.getElementById(
        "opticalfiberplanned_slider"
    );
    opticalfiberplanned_slider.oninput = function () {
        opticalFiberPlanned.setOpacity(this.value / 100);
    };
    var bts_slider = document.getElementById("bts_slider");
    bts_slider.oninput = function () {
        bts.setOpacity(this.value / 100);
    };
    var coveragedata_slider = document.getElementById("coveragedata_slider");
    coveragedata_slider.oninput = function () {
        coveragedata.setOpacity(this.value / 100);
    };

    var road_slider = document.getElementById("road_slider");
    road_slider.oninput = function () {
        road.setOpacity(this.value / 100);
    };
    var river_slider = document.getElementById("river_slider");
    river_slider.oninput = function () {
        river.setOpacity(this.value / 100);
    };
    var settlement_slider = document.getElementById("settlement_slider");
    settlement_slider.oninput = function () {
        settlement.setOpacity(this.value / 100);
    };
    var impplaces_slider = document.getElementById("impplaces_slider");
    impplaces_slider.oninput = function () {
        impplaces.setOpacity(this.value / 100);
    };
    //*********************************************************************************************************

    //Legend
    var resolution = map.getView().getResolution();

    //Border
    //Border Legend
    borderLegend();
    borderLayerFilter = document.getElementById("borderLayerFilter");

    function borderLegend(value) {
        var bordergraphicUrl = sourceNepalBorder.getLegendUrl(resolution, {
            LAYER: "maps_nepal",
            STYLE: value
        });
        var nepalBorderLegendImg = document.getElementById("NepalBorderLegend");
        nepalBorderLegendImg.src = bordergraphicUrl;
    }

    //District
    //District Legend

    districtLegend();
    districtLayerFilter = document.getElementById("districtLayerFilter");
    districtLayerFilter.addEventListener("change", function () {
        sourceNepalDistrict.updateParams({
            STYLES: districtLayerFilter.value
        });
        districtLegend(districtLayerFilter.value);
    });

    function districtLegend(value) {
        var districtgraphicUrl = sourceNepalDistrict.getLegendUrl(resolution, {
            LAYER: "maps_district",
            STYLE: value
        });
        var nepalDistrictLegendImg = document.getElementById(
            "NepalDistrictLegend"
        );
        nepalDistrictLegendImg.src = districtgraphicUrl;
    }

    //Province
    //Province Legend
    provinceLegend();
    provinceLayerFilter = document.getElementById("provinceLayerFilter");
    provinceLayerFilter.addEventListener("change", function () {
        sourceNepalProvince.updateParams({
            STYLES: provinceLayerFilter.value
        });
        provinceLegend(provinceLayerFilter.value);
    });

    function provinceLegend(value) {
        var provincegraphicUrl = sourceNepalProvince.getLegendUrl(resolution, {
            LAYER: "maps_province",
            STYLE: value
        });
        var nepalProvinceLegendImg = document.getElementById(
            "NepalProvinceLegend"
        );
        nepalProvinceLegendImg.src = provincegraphicUrl;
    }

    //VDC
    //VDC Legend
    vdcLegend();
    vdcLayerFilter = document.getElementById("vdcLayerFilter");
    vdcLayerFilter.addEventListener("change", function () {
        sourceNepalVdc.updateParams({
            STYLES: vdcLayerFilter.value
        });
        vdcLegend(vdcLayerFilter.value);
    });

    function vdcLegend(value) {
        var vdcgraphicUrl = sourceNepalVdc.getLegendUrl(resolution, {
            LAYER: "maps_vdc",
            STYLE: value
        });
        var nepalVdcLegendImg = document.getElementById("NepalVdcLegend");
        nepalVdcLegendImg.src = vdcgraphicUrl;
    }

    //Ward
    //Ward Legend
    wardLegend();
    wardLayerFilter = document.getElementById("wardLayerFilter");
    wardLayerFilter.addEventListener("change", function () {
        sourceNepalWard.updateParams({
            STYLES: wardLayerFilter.value
        });
        wardLegend(wardLayerFilter.value);
    });

    function wardLegend(value) {
        var wardgraphicUrl = sourceNepalWard.getLegendUrl(resolution, {
            LAYER: "maps_ward",
            STYLE: value
        });
        var nepalWardLegendImg = document.getElementById("NepalWardLegend");
        nepalWardLegendImg.src = wardgraphicUrl;
    }

    //coveragedata Legend
    coveragedataLegend();
    coveragedataLayerFilter = document.getElementById(
        "coveragedataLayerFilter"
    );
    coveragedataLayerFilter.addEventListener("change", function () {
        sourceCoveragedata.updateParams({
            STYLES: coveragedataLayerFilter.value
        });
        coveragedataLegend(coveragedataLayerFilter.value);
    });

    function coveragedataLegend(value) {
        var coveragedatagraphicUrl = sourceCoveragedata.getLegendUrl(
            resolution, {
                LAYER: "coverage_data",
                STYLE: value
            }
        );
        var coveragedataLegendImg = document.getElementById(
            "coveragedataLegend"
        );
        coveragedataLegendImg.src = coveragedatagraphicUrl;
    }

    //Microwave Legend
    microwavestationLegend();
    microwavestationLayerFilter = document.getElementById(
        "microwavestationLayerFilter"
    );
    microwavestationLayerFilter.addEventListener("change", function () {
        sourceMicrowaveStation.updateParams({
            STYLES: microwavestationLayerFilter.value
        });
        microwavestationLegend(microwavestationLayerFilter.value);
    });

    function microwavestationLegend(value) {
        var microwavestationgraphicUrl = sourceMicrowaveStation.getLegendUrl(
            resolution, {
                LAYER: "microwaves",
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
    microwavestationlinkLayerFilter = document.getElementById(
        "microwavestationlinkLayerFilter"
    );
    microwavestationlinkLayerFilter.addEventListener("change", function () {
        sourceMicrowaveStationLink.updateParams({
            STYLES: microwavestationlinkLayerFilter.value
        });
        microwavestationlinkLegend(microwavestationlinkLayerFilter.value);
    });

    function microwavestationlinkLegend(value) {
        var microwavestationlinkgraphicUrl = sourceMicrowaveStationLink.getLegendUrl(
            resolution, {
                LAYER: "microwavestations",
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
    vsatLayerFilter = document.getElementById("vsatLayerFilter");
    vsatLayerFilter.addEventListener("change", function () {
        sourceVsat.updateParams({
            STYLES: vsatLayerFilter.value
        });
        vsatLegend(vsatLayerFilter.value);
    });

    function vsatLegend(value) {
        var vsatgraphicUrl = sourceVsat.getLegendUrl(resolution, {
            LAYER: "vsats",
            STYLE: value
        });

        var vsatLegendImg = document.getElementById("vsatLegend");
        vsatLegendImg.src = vsatgraphicUrl;
    }

    //BTS Legend
    btsLegend();
    btsLayerFilter = document.getElementById("btsLayerFilter");
    btsLayerFilter.addEventListener("change", function () {
        sourceBts.updateParams({
            STYLES: btsLayerFilter.value
        });
        btsLegend(btsLayerFilter.value);
    });

    function btsLegend(value) {
        var btsgraphicUrl = sourceBts.getLegendUrl(resolution, {
            LAYER: "bts",
            STYLE: value
        });

        var btsLegendImg = document.getElementById("btsLegend");
        btsLegendImg.src = btsgraphicUrl;
    }

    //OpticalFiberPlanned Legend
    opticalfiberplannedLegend();
    opticalfiberplannedLayerFilter = document.getElementById(
        "opticalfiberplannedLayerFilter"
    );
    opticalfiberplannedLayerFilter.addEventListener("change", function () {
        sourceOpticalfiberplanned.updateParams({
            STYLES: opticalfiberplannedLayerFilter.value
        });
        opticalfiberplannedLegend(opticalfiberplannedLayerFilter.value);
    });

    function opticalfiberplannedLegend(value) {
        var opticalfiberplannedgraphicUrl = sourceOpticalfiberplanned.getLegendUrl(
            resolution, {
                LAYER: "opticalfiberplanned"
            }
        );
        var opticalfiberplannedLegendImg = document.getElementById(
            "opticalfiberplannedLegend"
        );
        opticalfiberplannedLegendImg.src = opticalfiberplannedgraphicUrl;
    }

    //Opticalfiberlink Legend
    opticalfiberlinkLegend();
    opticalfiberlinkLayerFilter = document.getElementById(
        "opticalfiberlinkLayerFilter"
    );
    opticalfiberlinkLayerFilter.addEventListener("change", function () {
        sourceOpticalfiberlink.updateParams({
            STYLES: opticalfiberlinkLayerFilter.value
        });
        opticalfiberlinkLegend(opticalfiberlinkLayerFilter.value);
    });

    function opticalfiberlinkLegend(value) {
        var opticalfiberlinkgraphicUrl = sourceOpticalfiberlink.getLegendUrl(
            resolution, {
                LAYER: "opticalfiberlink"
            }
        );
        var opticalfiberlinkLegendImg = document.getElementById(
            "opticalfiberlinkLegend"
        );
        opticalfiberlinkLegendImg.src = opticalfiberlinkgraphicUrl;
    }

    //Road Legend
    var roadgraphicUrl = sourceOpticalfiberlink.getLegendUrl(resolution, {
        LAYER: "road"
    });
    var roadLegendImg = document.getElementById("roadLegend");
    roadLegendImg.src = roadgraphicUrl;

    //River Legend
    var rivergraphicUrl = sourceRoad.getLegendUrl(resolution, {
        LAYER: "river"
    });
    var riverLegendImg = document.getElementById("riverLegend");
    riverLegendImg.src = rivergraphicUrl;

    //Settlement Legend
    var settlementgraphicUrl = sourceRiver.getLegendUrl(resolution, {
        LAYER: "settlement"
    });
    var settlementLegendImg = document.getElementById("settlementLegend");
    settlementLegendImg.src = settlementgraphicUrl;

    //Imp Places Legend
    var impplacesgraphicUrl = sourceImpplaces.getLegendUrl(resolution, {
        LAYER: "imp_places"
    });
    var impplacesLegendImg = document.getElementById("impplacesLegend");
    impplacesLegendImg.src = impplacesgraphicUrl;

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
    var opticalfiberlinkDIV = document.getElementById("opticalfiberlinkDIV");
    var opticalfiberplannedDIV = document.getElementById(
        "opticalfiberplannedDIV"
    );
    var coveragedataDIV = document.getElementById("coveragedataDIV");
    var btsDIV = document.getElementById("btsDIV");
    var roadDIV = document.getElementById("roadDIV");
    var riverDIV = document.getElementById("riverDIV");
    var settlementDIV = document.getElementById("settlementDIV");
    var impplacesDIV = document.getElementById("impplacesDIV");
    var nepalwardDIV = document.getElementById("nepalwardDIV");

    //Setting entire div to visible none
    nepalprovinceDIV.style.display = "none";
    nepaldistrictDIV.style.display = "none";
    nepalvdcDIV.style.display = "none";
    microwavestationDIV.style.display = "none";
    microwavestationlinkDIV.style.display = "none";
    vsatDIV.style.display = "none";
    opticalfiberlinkDIV.style.display = "none";
    opticalfiberplannedDIV.style.display = "none";
    coveragedataDIV.style.display = "none";
    btsDIV.style.display = "none";
    roadDIV.style.display = "none";
    riverDIV.style.display = "none";
    settlementDIV.style.display = "none";
    impplacesDIV.style.display = "none";
    nepalwardDIV.style.display = "none";

    //Display for div
    for (let showSlider of tileRasterLayerElements) {
        showSlider.addEventListener("change", function () {
            let showSliderValue = this.value;
            if (this.checked == true) {
                switch (showSliderValue) {
                    case "NepalBorder":
                        nepalborderDIV.style.display = "initial";
                        break;
                    case "NepalProvince":
                        nepalprovinceDIV.style.display = "initial";
                        sourceNepalProvince.updateParams({
                            cql_filter: "province LIKE '%'"
                        });
                        break;
                    case "NepalDistrict":
                        nepaldistrictDIV.style.display = "initial";
                        sourceNepalDistrict.updateParams({
                            cql_filter: "district LIKE '%'"
                        });
                        break;
                    case "NepalVDC":
                        nepalvdcDIV.style.display = "initial";
                        sourceNepalVdc.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "NepalWard":
                        nepalwardDIV.style.display = "initial";
                        sourceNepalWard.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "microwavestation":
                        microwavestationDIV.style.display = "initial";

                        break;
                    case "microwavestationlink":
                        microwavestationlinkDIV.style.display = "initial";

                        break;
                    case "vsat":
                        vsatDIV.style.display = "initial";

                        break;
                    case "bts":
                        btsDIV.style.display = "initial";

                        break;
                    case "opticalfiberplanned":
                        opticalfiberplannedDIV.style.display = "initial";

                        break;
                    case "opticalfiberlink":
                        opticalfiberlinkDIV.style.display = "initial";

                        break;
                    case "coveragedata":
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
                    case "impplaces":
                        impplacesDIV.style.display = "initial";
                        break;
                }
            }
            if (this.checked == false) {
                switch (showSliderValue) {
                    case "NepalBorder":
                        nepalborderDIV.style.display = "none";
                        break;
                    case "NepalProvince":
                        nepalprovinceDIV.style.display = "none";
                        sourceNepalProvince.updateParams({
                            cql_filter: "province LIKE '%'"
                        });
                        break;
                    case "NepalDistrict":
                        nepaldistrictDIV.style.display = "none";
                        sourceNepalDistrict.updateParams({
                            cql_filter: "district LIKE '%'"
                        });
                        break;
                    case "NepalVDC":
                        nepalvdcDIV.style.display = "none";
                        sourceNepalVdc.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "NepalWard":
                        nepalwardDIV.style.display = "none";
                        break;

                    case "microwavestation":
                        microwavestationDIV.style.display = "none";
                        break;

                    case "microwavestationlink":
                        microwavestationlinkDIV.style.display = "none";
                        break;
                    case "vsat":
                        vsatDIV.style.display = "none";

                        break;
                    case "bts":
                        btsDIV.style.display = "none";

                        break;
                    case "opticalfiberplanned":
                        opticalfiberplannedDIV.style.display = "none";

                        break;
                    case "opticalfiberlink":
                        opticalfiberlinkDIV.style.display = "none";
                        break;
                    case "coveragedata":
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
                    case "impplaces":
                        impplacesDIV.style.display = "none";
                        break;
                }
            }
        });
    }
    //**************************************************************************************************************************

    const original_extent = document.getElementById("original_extent");
    original_extent.addEventListener("click", function () {
        map.getView().fit(extent, map.getSize());
    });
    //Added because serverside error as map doesnot load without onload initially
    window.onload = map.getView().fit(extent, map.getSize());

    //Export Popup
    /**
     * Elements that make up the popup for export.
     */
    var exportPopupContainer = document.getElementById("export-popup");
    var exportPopupCloser = document.getElementById("export-popup-closer");
    /**
     * Create an overlay to anchor the popup to the map.
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
    map.addOverlay(exportPopupOverlay);

    /**
     * Add a click handler to hide the popup for export.
     * @return {boolean} Don't follow the href.
     */
    exportPopupCloser.onclick = function () {
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

            map.addInteraction(draw);
        }
    }
    /**
     * Handle change event.
     */
    interactionDraw.onchange = function () {
        map.removeInteraction(draw);
        addInteraction();
    };

    addInteraction();

    //Export Data
    var draw_for_export = document.getElementById("draw_for_export");

    var drawForExport; // global so we can remove it later
    function addInteractionForExport() {
        drawForExport = new ol.interaction.Draw({
            source: vectorSource,
            type: "Polygon"
        });
        drawForExport.on("drawend", function (evt) {
            map.removeInteraction(drawForExport);
            geometry = evt.feature.getGeometry();

            exportPopupOverlay.setPosition(
                geometry.getInteriorPoint().getCoordinates()
            );
            $("#export-csv-btn, #export-kml-btn, #export-shape-btn").off(
                "click"
            );

            $("#export-csv-btn").on("click", function () {
                openExportLink(geometry, "CSV");
            });

            $("#export-kml-btn").on("click", function () {
                openExportLink(geometry, "KML");
            });

            $("#export-shape-btn").on("click", function () {
                openExportLink(geometry, "SHAPE-ZIP");
            });
        });
        map.addInteraction(drawForExport);
    }

    /**
     * Handle change event.
     */
    draw_for_export.onclick = function () {
        map.removeInteraction(drawForExport);
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
            outputFormat;
        console.log(exportLink);
        if (outputFormat == "SHAPE-ZIP") {
            exportLink +=
                "&format_options=filename:" +
                "export_imis_" +
                moment().format("YYYYMMDD_HHmmss") +
                ".zip";
        }
        window.open(exportLink);
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

    var pointerMoveHandler = function (evt) {
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

    var draw; // global so we can remove it later

    var formatLength = function (line) {
        var length = ol.sphere.getLength(line);
        var output;
        if (length > 100) {
            output = Math.round((length / 1000) * 100) / 100 + " " + "km";
        } else {
            output = Math.round(length * 100) / 100 + " " + "m";
        }
        return output;
    };

    var formatArea = function (polygon) {
        var area = ol.sphere.getArea(polygon);
        var output;
        if (area > 10000) {
            output =
                Math.round((area / 1000000) * 100) / 100 +
                " " +
                "km<sup>2</sup>";
        } else {
            output = Math.round(area * 100) / 100 + " " + "m<sup>2</sup>";
        }
        return output;
    };

    function measurementAddInteraction() {
        if (measurement.value !== "None") {
            map.on("pointermove", pointerMoveHandler);

            map.getViewport().addEventListener("mouseout", function () {
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
            map.addInteraction(draw);

            createMeasureTooltip();
            createHelpTooltip();
        }
        var listener;
        draw.on("drawstart", function (evt) {
            // set sketch
            sketch = evt.feature;
            var tooltipCoord = evt.coordinate;

            listener = sketch.getGeometry().on("change", function (evt) {
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

        draw.on("drawend", function () {
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
        map.addOverlay(helpTooltip);
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
        map.addOverlay(measureTooltip);
    }

    /**
     * Let user change the geometry type.
     */
    measurement.onchange = function () {
        map.removeInteraction(draw);
        map.removeOverlay(measureTooltip);
        map.removeOverlay(helpTooltip);
        measureTooltipElement = null;

        if (measurement.value !== "None") {
            measurementAddInteraction();
        }
    };

    measurementAddInteraction();

    var clear = document.getElementById("clear");
    clear.addEventListener("click", function () {
        vectorSource.clear();
        $(".ol-tooltip-static").remove();
        map.removeInteraction(drawForExport);
        map.removeInteraction(draw);
        popupOverlay.setPosition(undefined);
        exportPopupOverlay.setPosition(undefined);
        $("#coordinate_info").unbind("click");
        map.un("singleclick", cordinfo);
        map.un("singleclick", any);
    });
    //**************************************************************************************************************************
    //Tool Bar filter

    var provinceFilter = document.getElementById("province");
    provinceFilter.addEventListener("change", function () {
        if (!document.getElementById("provincelayerCheckbox").checked) {
            document.getElementById("provincelayerCheckbox").click();
        }
        sourceNepalProvince.updateParams({
            cql_filter: "province LIKE '" + provinceFilter.value + "'"
        });
    });

    var dictrictFilter = document.getElementById("district");

    dictrictFilter.addEventListener("change", function () {
        if (!document.getElementById("districtlayerCheckbox").checked) {
            document.getElementById("districtlayerCheckbox").click();
        }
        sourceNepalDistrict.updateParams({
            cql_filter: "district LIKE '" + dictrictFilter.value + "'"
        });
    });

    var vdcFilter = document.getElementById("vdc");

    vdcFilter.addEventListener("change", function () {
        if (!document.getElementById("vdclayerCheckbox").checked) {
            document.getElementById("vdclayerCheckbox").click();
        }
        sourceNepalVdc.updateParams({
            cql_filter: "gapa_napa LIKE '" + vdcFilter.value + "'"
        });
    });

    var wardFilter = document.getElementById("ward");

    wardFilter.addEventListener("change", function () {
        if (!document.getElementById("wardlayerCheckbox").checked) {
            document.getElementById("wardlayerCheckbox").click();
        }
        sourceNepalWard.updateParams({
            cql_filter: "new_ward_n = '" +
                wardFilter.value +
                "'" +
                "AND gapa_napa LIKE'" +
                vdcFilter.value +
                "'"
        });
    });

    // There is some problem will need to fix later, rn in hurry
    map.on("singleclick", (any = function (evt) {}));

    var selectedInfo = document.getElementById("info");
    selectedInfo.addEventListener("change", function () {
        switch (selectedInfo.value) {
            case "provinceInfo":
                if (!document.getElementById("provincelayerCheckbox").checked) {
                    document.getElementById("provincelayerCheckbox").click();
                }
                map.un("singleclick", cordinfo);

                map.un("singleclick", any);
                map.on(
                    "singleclick",
                    (any = function (evt) {
                        var currentView = map.getView();
                        var viewResolution = currentView.getResolution();
                        var projection = currentView.getProjection();
                        var url = NepalProvince.getSource().getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection, {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_province"
                            }
                        );

                        if (url) {
                            fetch(url)
                                .then(function (response) {
                                    return response.text();
                                })
                                .then(function (json) {
                                    var jsonData = JSON.parse(json);

                                    try {
                                        var table =
                                            "<div><h5>Province Data</h5></div><table>";
                                        var dataHeading = [
                                            "State Code",
                                            "Province",
                                            "No. of Microwave Station",
                                            "No. of VSAT",
                                            "No. of Systemsite",
                                            "No. of PSTN",
                                            "No. of Wireless",
                                            "Total Opticalfiber Length",
                                            "Total area(km²)"
                                        ];

                                        var data = [
                                            jsonData.features[0].properties
                                            .state_code,
                                            jsonData.features[0].properties
                                            .province,
                                            jsonData.features[0].properties
                                            .no_of_microwavestation,
                                            jsonData.features[0].properties
                                            .no_of_vsat,
                                            jsonData.features[0].properties
                                            .no_of_bts,
                                            jsonData.features[0].properties
                                            .no_of_pstn,
                                            jsonData.features[0].properties
                                            .no_of_wireless,
                                            jsonData.features[0].properties
                                            .opticalfiber_length,
                                            jsonData.features[0].properties
                                            .total_area
                                        ];
                                        for (
                                            i = 0; i < dataHeading.length; i++
                                        ) {
                                            table +=
                                                "<tr><th>" +
                                                dataHeading[i] +
                                                "</th><td>" +
                                                data[i] +
                                                "</td></tr>";
                                        }
                                        table += "</table>";
                                        popupContent.innerHTML = table;
                                        popupOverlay.setPosition(undefined);
                                        popupOverlay.setPosition(
                                            evt.coordinate
                                        );
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
                if (!document.getElementById("districtlayerCheckbox").checked) {
                    document.getElementById("districtlayerCheckbox").click();
                }
                map.un("singleclick", cordinfo);

                map.un("singleclick", any);
                map.on(
                    "singleclick",
                    (any = function (evt) {
                        var currentView = map.getView();
                        var viewResolution = currentView.getResolution();
                        var projection = currentView.getProjection();
                        var url = NepalDistrict.getSource().getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection, {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_district"
                            }
                        );

                        if (url) {
                            fetch(url)
                                .then(function (response) {
                                    return response.text();
                                })
                                .then(function (json) {
                                    var jsonData = JSON.parse(json);
                                    try {
                                        var table =
                                            "<div><h5>District Data</h5></div><table>";
                                        var dataHeading = [
                                            "State Code",
                                            "District",
                                            "Province",
                                            "No. of Microwave Station",
                                            "No. of VSAT",
                                            "No. of Systemsite",
                                            "No. of PSTN",
                                            "No. of Wireless",
                                            "Total Opticalfiber Length",
                                            "Total area(km²)"
                                        ];
                                        var data = [
                                            jsonData.features[0].properties
                                            .state_code,
                                            jsonData.features[0].properties
                                            .district,
                                            jsonData.features[0].properties
                                            .province,
                                            jsonData.features[0].properties
                                            .no_of_microwavestation,
                                            jsonData.features[0].properties
                                            .no_of_vsat,
                                            jsonData.features[0].properties
                                            .no_of_bts,
                                            jsonData.features[0].properties
                                            .no_of_pstn,
                                            jsonData.features[0].properties
                                            .no_of_wireless,
                                            jsonData.features[0].properties
                                            .opticalfiber_length,
                                            jsonData.features[0].properties
                                            .total_area
                                        ];
                                        for (
                                            i = 0; i < dataHeading.length; i++
                                        ) {
                                            table +=
                                                "<tr><th>" +
                                                dataHeading[i] +
                                                "</th><td>" +
                                                data[i] +
                                                "</td></tr>";
                                        }
                                        table += "</table>";
                                        popupContent.innerHTML = table;
                                        popupOverlay.setPosition(undefined);
                                        popupOverlay.setPosition(
                                            evt.coordinate
                                        );
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
                if (!document.getElementById("vdclayerCheckbox").checked) {
                    document.getElementById("vdclayerCheckbox").click();
                }
                map.un("singleclick", cordinfo);

                map.un("singleclick", any);
                map.on(
                    "singleclick",
                    (any = function (evt) {
                        var currentView = map.getView();
                        var viewResolution = currentView.getResolution();
                        var projection = currentView.getProjection();
                        var url = NepalVDC.getSource().getFeatureInfoUrl(
                            evt.coordinate,
                            viewResolution,
                            projection, {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_vdc"
                            }
                        );

                        if (url) {
                            fetch(url)
                                .then(function (response) {
                                    return response.text();
                                })
                                .then(function (json) {
                                    var jsonData = JSON.parse(json);
                                    try {
                                        var table =
                                            "<div><h5>VDC/Municipality Data</h5></div><table>";
                                        var dataHeading = [
                                            "State Code",
                                            "District",
                                            "Name",
                                            "Type",
                                            "Province",
                                            "No. of Microwave Station",
                                            "No. of VSAT",
                                            "No. of Systemsite",
                                            "No. of PSTN",
                                            "No. of Wireless",
                                            "Total Opticalfiber Length",
                                            "Total area(km²)"
                                        ];
                                        var data = [
                                            jsonData.features[0].properties
                                            .state_code,
                                            jsonData.features[0].properties
                                            .district,
                                            jsonData.features[0].properties
                                            .gapa_napa,
                                            jsonData.features[0].properties
                                            .type_gn,
                                            jsonData.features[0].properties
                                            .province,
                                            jsonData.features[0].properties
                                            .no_of_microwavestation,
                                            jsonData.features[0].properties
                                            .no_of_vsat,
                                            jsonData.features[0].properties
                                            .no_of_bts,
                                            jsonData.features[0].properties
                                            .no_of_pstn,
                                            jsonData.features[0].properties
                                            .no_of_wireless,
                                            jsonData.features[0].properties
                                            .opticalfiber_length,
                                            jsonData.features[0].properties
                                            .total_area
                                        ];
                                        for (
                                            i = 0; i < dataHeading.length; i++
                                        ) {
                                            table +=
                                                "<tr><th>" +
                                                dataHeading[i] +
                                                "</th><td>" +
                                                data[i] +
                                                "</td></tr>";
                                        }
                                        table += "</table>";
                                        popupContent.innerHTML = table;
                                        popupOverlay.setPosition(undefined);
                                        popupOverlay.setPosition(
                                            evt.coordinate
                                        );
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
                map.un("singleclick", any);
                map.un("singleclick", cordinfo);
        }
    });

    //**********************************************************************************************************************

    var exportButton = document.getElementById("print_map");
    var format, format_value, resolution_value, size, viewResolution;
    var resolution;
    var dims = {
        a0: [1189, 841],
        a1: [841, 594],
        a2: [594, 420],
        a3: [420, 297],
        a4: [297, 210],
        a5: [210, 148]
    };

    exportButton.addEventListener("click", function () {
        exportButton.disabled = true;
        document.body.style.cursor = "progress";
        $("#print_map_modal").modal();
        format = document.getElementById("print_format");
        resolution = document.getElementById("print_resolution");
        format_value = format.value;
        resolution_value = resolution.value;
        format.addEventListener("change", function () {
            format_value = format.value;
        });
        resolution.addEventListener("change", function () {
            resolution_value = resolution.value;
        });
        size = map.getSize();
        viewResolution = map.getView().getResolution();
        map
    });
    confirmexport = document.getElementById("confirm_export");
    confirmexport.addEventListener(
        "click",
        function () {
            var dim = dims[format_value];
            var width = Math.round((dim[0] * resolution_value) / 25.4);
            var height = Math.round((dim[1] * resolution_value) / 25.4);
            map.once("rendercomplete", function () {
                var printtitle = document.getElementById("printmaptitle");
                var printdescription = document.getElementById(
                    "printmapdescription"
                );

                var size = map.getSize();
                var viewResolution = map.getView().getResolution();

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, "0");
                var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
                var yyyy = today.getFullYear();

                today = mm + "/" + dd + "/" + yyyy;

                var mapCanvas = document.createElement("canvas");
                mapCanvas.width = width;
                mapCanvas.height = height;
                var mapContext = mapCanvas.getContext("2d");
                Array.prototype.forEach.call(
                    document.querySelectorAll(".ol-layer canvas"),
                    function (canvas) {
                        if (canvas.width > 0) {
                            var opacity = canvas.parentNode.style.opacity;
                            mapContext.globalAlpha =
                                opacity === "" ? 1 : Number(opacity);
                            var transform = canvas.style.transform;
                            // Get the transform parameters from the style's transform matrix
                            var matrix = transform
                                .match(/^matrix\(([^\(]*)\)$/)[1]
                                .split(",")
                                .map(Number);
                            // Apply the transform to the export map context
                            CanvasRenderingContext2D.prototype.setTransform.apply(
                                mapContext,
                                matrix
                            );
                            mapContext.drawImage(canvas, 0, 0);
                        }
                    }
                );

                function getImgFromUrl(logo_url, callback) {
                    var img = new Image();
                    img.src = logo_url;
                    img.onload = function () {
                        callback(img);
                    };
                }

                var logo_url = "/js/logo.png";
                getImgFromUrl(logo_url, function (img) {
                    generatePDF(img);
                });

                function generatePDF(img) {
                    var pdf = new jsPDF();
                    pdf.crossOrigin = "Anonymous";
                    pdf.setFontSize(24);
                    pdf.text("Nepal Telecommunication Authority", 40, 20);
                    pdf.setFontSize(20);
                    pdf.text(printtitle.value, 80, 40);
                    pdf.setFontSize(12);
                    pdf.text("Date:" + today, 170, 40);
                    pdf.text(printdescription.value, 40, 50);
                    pdf.addImage(img, "JPEG", 5, 5, 30, 30);
                    pdf.addImage(
                        mapCanvas.toDataURL("image/jpeg"),
                        "JPEG",
                        0,
                        55,
                        dim[0],
                        dim[1]
                    );
                    $("#printtitle").val("");
                    $("#printdescription").val("");
                    pdf.save("map.pdf");
                }
                // Reset original map size
                map.setSize(size);
                map.getView().setResolution(viewResolution);
            });

            // Set print size
            var printSize = [width, height];
            map.setSize(printSize);
            var scaling = Math.min(width / size[0], height / size[1]);
            map.getView().setResolution(viewResolution / scaling);
        },
        false
    );

    /**
     * Elements that make up the popup.
     */
    coordinateInfo = document.getElementById("coordinate_info");
    coordinateInfo.addEventListener("click", function () {
        map.un("singleclick", any);
        map.on("singleclick", (cordinfo = displayCoordinateInformation));
    });
    var popupContainer = document.getElementById("popup");
    var popupContent = document.getElementById("popup-content");
    var popupCloser = document.getElementById("popup-closer");

    /**
     * Create an overlay to anchor the popup to the map.
     */
    var popupOverlay = new ol.Overlay(
        /** @type  {olx.OverlayOptions} */
        ({
            element: popupContainer,
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        })
    );

    $(popupContainer).show();

    map.addOverlay(popupOverlay);

    /**
     * Add a click handler to hide the popup.
     * @return  {boolean} Don't follow the href.
     */
    popupCloser.onclick = function () {
        popupOverlay.setPosition(undefined);
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
}
