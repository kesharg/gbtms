// Base Layer
//No layer
export const base_no_layer = new ol.layer.Tile({
    source: "",
    visible: true,
    title: "NoLayer"
});

// Openstreet Map Standard
export const base_osm_standardmap = new ol.layer.Tile({
    source: new ol.source.OSM({
        crossOrigin: "anonymous"
    }),
    visible: false,
    title: "OSMStandard"
});

// Openstreet Map Humanitarian
export const base_osm_humanitarianmap = new ol.layer.Tile({
    source: new ol.source.OSM({
        crossOrigin: "anonymous",
        url: "https://{a-c}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png"
    }),
    visible: false,
    title: "OSMHumanitarian"
});

// Bing Maps Basemap Layer
export const base_bing_map = new ol.layer.Tile({
    source: new ol.source.BingMaps({
        crossOrigin: "anonymous",
        key: "Am91Zo6OSOQGKiN4xHLCgW3hd27DTm6n2E1xiKxMEzQb0JOXFYuttfbabSCavjpe",
        imagerySet: "CanvasGray" // Road, CanvasDark, CanvasGray
    }),
    visible: false,
    title: "BingMaps"
});

//Google Map Normal
export const base_gmap = new ol.layer.Tile({
    source: new ol.source.XYZ({
        crossOrigin: "anonymous",
        url: "http://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}",
        key: "AIzaSyCy29Hks6xqzvqjmVqixslBhMQYlJgZkLk"
    }),
    visible: false,
    title: "gmap"
});

//Google Map Statellite View
export const base_gsatmap = new ol.layer.Tile({
    source: new ol.source.XYZ({
        crossOrigin: "anonymous",
        url: "http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}",
        key: "AIzaSyCy29Hks6xqzvqjmVqixslBhMQYlJgZkLk"
    }),
    visible: false,
    title: "gsatmap"
});

// CartoDB BaseMap Layer
export const base_cartoDB_map = new ol.layer.Tile({
    source: new ol.source.XYZ({
        crossOrigin: "anonymous",
        url:
            "http://{1-4}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png",
        attributions: "© CARTO"
    }),
    visible: false,
    title: "CartoDarkAll"
});

// Stamen BaseMap Layer with Terrain
export const base_stamenwithlabel_map = new ol.layer.Tile({
    source: new ol.source.Stamen({
        crossOrigin: "anonymous",
        layer: "terrain-labels",
        attributions:
            'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
    }),
    visible: false,
    title: "StamenTerrainWithLabels"
});

// Stamen BaseMap Layer
export const base_stamen_map = new ol.layer.Tile({
    source: new ol.source.XYZ({
        crossOrigin: "anonymous",
        url: "http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg",
        attributions:
            'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
    }),
    visible: false,
    title: "StamenTerrain"
});
