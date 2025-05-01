// Controls
//FullScreen
export const fullScreenControl = new ol.control.FullScreen();

//Drag and Rotate
export const dragRotateAndZoom = new ol.interaction.DragRotateAndZoom();

// ZoomSlider
export const zoomSliderControl = new ol.control.ZoomSlider();

//Overview of map
export const overViewMapControl = new ol.control.OverviewMap({
    collapsed: false,
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ]
});

// Attributions
export const attributionControl = new ol.control.Attribution({
    collapsible: true
});

// Interaction

// DragRotate Interaction
export const dragRotateInteraction = new ol.interaction.DragRotate({
    condition: ol.events.condition.altKeyOnly
});
