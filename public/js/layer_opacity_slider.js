   import * as baselayer from './base_layer.js';
   import * as administrativelayer from './administrative_layer.js';
   import * as informationlayer from './information_layer.js';
   // Layer Opacity Slider Control

   $('#base_map_slider').on('input',function() {
    var opacity = this.value / 100;
    baselayer.base_osm_standardmap.setOpacity(opacity);
    baselayer.base_osm_humanitarianmap.setOpacity(opacity);
    baselayer.base_bing_map.setOpacity(opacity);
    baselayer.base_cartoDB_map.setOpacity(opacity);
    baselayer.base_stamenwithlabel_map.setOpacity(opacity);
    baselayer.base_stamen_map.setOpacity(opacity);
});

$('#border_slider').on('input',function() {
    administrativelayer.maps_nepal.setOpacity(this.value / 100);
});

$('#province_slider').on('input',function() {
    administrativelayer.maps_province.setOpacity(this.value / 100);
});
$('#district_slider').on('input',function() {
    administrativelayer.maps_district.setOpacity(this.value / 100);
});
$('#vdc_slider').on('input',function() {
    administrativelayer.maps_vdc.setOpacity(this.value / 100);
});
$('#ward_slider').on('input',function() {
    administrativelayer.maps_ward.setOpacity(this.value / 100);
});

$('#road_slider').on('input',function() {
    informationlayer.road.setOpacity(this.value / 100);
});
$('#river_slider').on('input',function() {
    informationlayer.river.setOpacity(this.value / 100);
});
$('#settlement_slider').on('input',function() {
    informationlayer.settlement.setOpacity(this.value / 100);
});
$('#imp_places_slider').on('input',function() {
    informationlayer.imp_places.setOpacity(this.value / 100);
});

