//Get Info from various layers
//When single clicked on map
var getInfo = function(evt) {};
coremap.map.on("singleclick", getInfo);
//Getting selected element from "info"
$('#info').on('change', function() {
    console.log(this);
    switch (this.value) {
        case "provinceInfo":
            if ($(this).is(":checked")) {
                document.getElementById("provincelayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);
            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalProvince.getSource().getFeatureInfoUrl(
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
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("districtlayerCheckbox").checked) {
                document.getElementById("districtlayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalDistrict.getSource().getFeatureInfoUrl(
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
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("vdclayerCheckbox").checked) {
                document.getElementById("vdclayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalVDC.getSource().getFeatureInfoUrl(
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
                                        jsonData.features[0].properties.type_gn,
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
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("microwavelayerCheckbox").checked) {
                document.getElementById("microwavelayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
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
                                    var table =
                                        "<div><h5>Microwave Data</h5></div><table>";
                                    var dataHeading = [
                                        "Station Code",
                                        "Operator",
                                        "District",
                                        "VDC",
                                        "Ward",
                                        "Station Name",
                                        "Lattitude",
                                        "Longitude"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .mwstncode,
                                        jsonData.features[0].properties.oprcd,
                                        jsonData.features[0].properties
                                            .district,
                                        jsonData.features[0].properties.vdc,
                                        jsonData.features[0].properties.ward,
                                        jsonData.features[0].properties
                                            .mwstnname,
                                        jsonData.features[0].properties.lat,
                                        jsonData.features[0].properties.long
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (
                !document.getElementById("microwavestationlinklayerCheckbox")
                    .checked
            ) {
                document
                    .getElementById("microwavestationlinklayerCheckbox")
                    .click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
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
                                    var table =
                                        "<div><h5>MicrowaveLink Data</h5></div><table>";
                                    var dataHeading = [
                                        "MicrowaveLink ID",
                                        "Operator",
                                        "Distance",
                                        "Polariz",
                                        "Microwave Station A",
                                        "Microwave Station B",
                                        "Bandwidth"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .mwlinkid,
                                        jsonData.features[0].properties.oprcd,
                                        jsonData.features[0].properties
                                            .distance,
                                        jsonData.features[0].properties.polariz,
                                        jsonData.features[0].properties
                                            .mwstncodea,
                                        jsonData.features[0].properties
                                            .mwstncodeb,
                                        jsonData.features[0].properties.bdwidth
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("vsatlayerCheckbox").checked) {
                document.getElementById("vsatlayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = vsat
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
                                    var table =
                                        "<div><h5>Vsat Data</h5></div><table>";
                                    var dataHeading = [
                                        "Vsta ID",
                                        "Operator",
                                        "District",
                                        "VDC"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties.vsatid,
                                        jsonData.features[0].properties.oprcd,
                                        jsonData.features[0].properties.district,
                                        jsonData.features[0].properties.vdc
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("opticalfiberlayerCheckbox").checked) {
                document.getElementById("opticalfiberlayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalDistrict.getSource().getFeatureInfoUrl(
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
                                    var table =
                                        "<div><h5>District Data</h5></div><table>";
                                    var dataHeading = [
                                        "nodeid",
                                        "nodename",
                                        "oprcd",
                                        "province",
                                        "district",
                                        "vdc",
                                        "ward",
                                        "strtname"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .nodeid,
                                        jsonData.features[0].properties
                                            .nodename,
                                        jsonData.features[0].properties
                                            .oprcd,
                                        jsonData.features[0].properties
                                            .province,
                                        jsonData.features[0].properties
                                            .district,
                                        jsonData.features[0].properties
                                            .vdc,
                                        jsonData.features[0].properties
                                            .ward,
                                        jsonData.features[0].properties
                                            .strtname
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("opticalfiberlinklayerCheckbox").checked) {
                document.getElementById("opticalfiberlinklayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalDistrict.getSource().getFeatureInfoUrl(
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
                                    var table =
                                        "<div><h5>District Data</h5></div><table>";
                                    var dataHeading = [
                                        "oflinkid",
                                        "oprlinkid",
                                        "linkname",
                                        "oprcd",
                                        "length",
                                        "orgnodeid",
                                        "endnodeid",
                                        "cabletype",
                                        "fibers",
                                        "capacity",
                                        "status"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .oflinkid,
                                        jsonData.features[0].properties
                                            .oprlinkid,
                                        jsonData.features[0].properties
                                            .linkname,
                                        jsonData.features[0].properties
                                            .oprcd,
                                        jsonData.features[0].properties
                                            .length,
                                        jsonData.features[0].properties
                                            .orgnodeid,
                                        jsonData.features[0].properties
                                            .endnodeid,
                                        jsonData.features[0].properties
                                            .cabletype,
                                        jsonData.features[0].properties
                                            .fibers,
                                        jsonData.features[0].properties
                                            .capacity,
                                        jsonData.features[0].properties
                                            .status
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("opticalfiberplannedlayerCheckbox").checked) {
                document.getElementById("opticalfiberplannedlayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalDistrict.getSource().getFeatureInfoUrl(
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
                                    var table =
                                        "<div><h5>District Data</h5></div><table>";
                                    var dataHeading = [
                                        "nodeid",
                                        "nodename",
                                        "oprcd",
                                        "province",
                                        "district",
                                        "vdc",
                                        "ward",
                                        "strtname"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .nodeid,
                                        jsonData.features[0].properties
                                            .nodename,
                                        jsonData.features[0].properties
                                            .oprcd,
                                        jsonData.features[0].properties
                                            .province,
                                        jsonData.features[0].properties
                                            .district,
                                        jsonData.features[0].properties
                                            .vdc,
                                        jsonData.features[0].properties
                                            .ward,
                                        jsonData.features[0].properties
                                            .strtname
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            if (!document.getElementById("opticalfiberlinkplannedlayerCheckbox").checked) {
                document.getElementById("opticalfiberlinkplannedlayerCheckbox").click();
            }
            coremap.map.un("singleclick", cordinfo);

            coremap.map.un("singleclick", getInfo);
            coremap.map.on(
                "singleclick",
                (getInfo = function(evt) {
                    var currentView = coremap.map.getView();
                    var viewResolution = currentView.getResolution();
                    var projection = currentView.getProjection();
                    var url = NepalDistrict.getSource().getFeatureInfoUrl(
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
                                    var table =
                                        "<div><h5>District Data</h5></div><table>";
                                    var dataHeading = [
                                        "oflinkid",
                                        "oprlinkid",
                                        "linkname",
                                        "oprcd",
                                        "length",
                                        "orgnodeid",
                                        "endnodeid",
                                        "cabletype",
                                        "fibers",
                                        "capacity",
                                        "status"
                                    ];
                                    var data = [
                                        jsonData.features[0].properties
                                            .oflinkid,
                                        jsonData.features[0].properties
                                            .oprlinkid,
                                        jsonData.features[0].properties
                                            .linkname,
                                        jsonData.features[0].properties
                                            .oprcd,
                                        jsonData.features[0].properties
                                            .length,
                                        jsonData.features[0].properties
                                            .orgnodeid,
                                        jsonData.features[0].properties
                                            .endnodeid,
                                        jsonData.features[0].properties
                                            .cabletype,
                                        jsonData.features[0].properties
                                            .fibers,
                                        jsonData.features[0].properties
                                            .capacity,
                                        jsonData.features[0].properties
                                            .status
                                    ];
                                    for (i = 0; i < dataHeading.length; i++) {
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
            coremap.map.un("singleclick", getInfo);
            coremap.map.un("singleclick", cordinfo);
    }
});
