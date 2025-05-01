
const gurl = GEO_URL + "/nepal_map/wms";

var sourcemaps_nepal = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:maps_nepal",
        authkey: GEO_AUTHKEY,
        TILED: true

    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var maps_nepal = new ol.layer.Image({
    source: sourcemaps_nepal,
    title: "maps_nepal",
    visible: true
});

var sourcemaps_province = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:maps_province",
        authkey: GEO_AUTHKEY,
        TILED: true

    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var maps_province = new ol.layer.Tile({
    source: sourcemaps_province,
    title: "maps_province",
    visible: false
});

var sourcemaps_district = new ol.source.ImageWMS({
    url: gurl,
    params: {
        layers: "nepal_map:maps_district",
        authkey: GEO_AUTHKEY,
        TILED: true

    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});
export var maps_district = new ol.layer.Image({
    source: sourcemaps_district,
    title: "maps_district",
    visible: false
});

var sourcemaps_vdc = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:maps_vdc",
        authkey: GEO_AUTHKEY,
        TILED: true

    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});
export var maps_vdc = new ol.layer.Tile({
    source: sourcemaps_vdc,
    title: "maps_vdc",
    visible: false
});

var sourcemaps_ward = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:maps_ward",
        authkey: GEO_AUTHKEY,
        TILED: true

    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});
export var maps_ward = new ol.layer.Tile({
    source: sourcemaps_ward,
    title: "maps_ward",
    visible: false
});
