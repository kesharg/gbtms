const gurl = GEO_URL + "/nepal_map/wms";

var sourceElevation = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:elevation_nepal",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var elevation = new ol.layer.Tile({
    source: sourceElevation,
    title: "elevation",
    visible: false
});

var sourcePopulation = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:population_nepal",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var population = new ol.layer.Tile({
    source: sourcePopulation,
    title: "population",
    visible: false
});

var sourceRiver = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:river",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var river = new ol.layer.Tile({
    source: sourceRiver,
    title: "river",
    visible: false
});

var sourceRoad = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:road",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var road = new ol.layer.Tile({
    source: sourceRoad,
    title: "road",
    visible: false
});

var sourceSettlement = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:settlement",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var settlement = new ol.layer.Tile({
    source: sourceSettlement,
    title: "settlement",
    visible: false
});

var sourceImpplaces = new ol.source.TileWMS({
    url: gurl,
    params: {
        layers: "nepal_map:imp_places",
        authkey: GEO_AUTHKEY,
        TILED: true
    },
    crossOrigin: "anonymous",
    serverType: "geoserver",
    attributions: "© Innovative Solution Pvt. Ltd."
});

export var imp_places = new ol.layer.Tile({
    source: sourceImpplaces,
    title: "imp_places",
    visible: false,
    crossOrigin: "anonymous"
});
