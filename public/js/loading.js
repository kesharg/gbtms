//For loading screen
$(document).ajaxStart(function() {
    $("#loading-overlay").show();
});

$(document).ajaxStop(function() {
    $("#loading-overlay").hide();
});
