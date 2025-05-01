import * as baselayer from "./base_layer.js";
import * as mapcontrols from './map_controls_interaction.js';


 //Map Instance
export  const map = new ol.Map({
    view: new ol.View({
        // center: [9443807.824891845, 3281690.3876565387],
        center: [9243807.824891845, 3281690.3876565387],
        extent: [7572000, 2500000, 11324000, 3970000],
        zoom: 7.5,
        minZoom: 6
    }),
    // Layers
    layers: [baselayer.base_no_layer],
    target: "js-map",

    //Default Keyboard Interaction
    keyboardEventTarget: document,

    //Controls

    //To add new controls define at mapcontrols
    // (eg:export const myControls=new example_control();) and add here in extend array
    controls: ol.control
        .defaults({
            attribution: false
        })
        .extend([
            mapcontrols.fullScreenControl,
            mapcontrols.overViewMapControl,
            mapcontrols.zoomSliderControl,
            mapcontrols.attributionControl,
            mapcontrols.dragRotateAndZoom
        ])
});
