import * as coremap from './core_map.js'

//Define extent
export const extent=[7572000, 2500000, 11324000, 3970000];
//Get original extent of map
export const original_extent = document.getElementById("original_extent");
original_extent.addEventListener("click", function() {
    coremap.map.getView().fit(extent, coremap.map.getSize());
});
