export function createProvinceTable(jsonData) {
    var table = "<div><h5>Province Data</h5></div><table>";
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
        jsonData.features[0].properties.state_code,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.no_of_microwavestation,
        jsonData.features[0].properties.no_of_vsat,
        jsonData.features[0].properties.no_of_bts,
        jsonData.features[0].properties.no_of_pstn,
        jsonData.features[0].properties.no_of_wireless,
        jsonData.features[0].properties.opticalfiber_length,
        jsonData.features[0].properties.total_area
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if(data[i]!=null){
        table +=
            "<tr><th>" + dataHeading[i] + "</th><td>" + data[i] + "</td></tr>";
    }}
    table += "</table>";
    return table;
}

export function createDistrictTable(jsonData) {
    var table = "<div><h5>District Data</h5></div><table>";

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
        jsonData.features[0].properties.state_code,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.no_of_microwavestation,
        jsonData.features[0].properties.no_of_vsat,
        jsonData.features[0].properties.no_of_bts,
        jsonData.features[0].properties.no_of_pstn,
        jsonData.features[0].properties.no_of_wireless,
        jsonData.features[0].properties.opticalfiber_length,
        jsonData.features[0].properties.total_area
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if(data[i]!=null){
        table +=
            "<tr><th>" + dataHeading[i] + "</th><td>" + data[i] + "</td></tr>";
    }}
    table += "</table>";
    return table;
}

export function createVdcTable(jsonData) {
    var table = "<div><h5>VDC/Municipality Data</h5></div><table>";
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
        jsonData.features[0].properties.state_code,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.gapa_napa,
        jsonData.features[0].properties.type_gn,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.no_of_microwavestation,
        jsonData.features[0].properties.no_of_vsat,
        jsonData.features[0].properties.no_of_bts,
        jsonData.features[0].properties.no_of_pstn,
        jsonData.features[0].properties.no_of_wireless,
        jsonData.features[0].properties.opticalfiber_length,
        jsonData.features[0].properties.total_area
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createMicrowavenodeTable(jsonData) {
    var table = "<div><h5>Microwave Data</h5></div><table>";
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
        jsonData.features[0].properties.mwstncode,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.vdc,
        jsonData.features[0].properties.ward,
        jsonData.features[0].properties.mwstnname,
        jsonData.features[0].properties.lat,
        jsonData.features[0].properties.long
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createMicrowavelinkTable(jsonData) {
    var table = "<div><h5>MicrowaveLink Data</h5></div><table>";
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
        jsonData.features[0].properties.mwlinkid,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.distance,
        jsonData.features[0].properties.polariz,
        jsonData.features[0].properties.mwstncodea,
        jsonData.features[0].properties.mwstncodeb,
        jsonData.features[0].properties.bdwidth
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createVsatTable(jsonData) {
    var table = "<div><h5>Vsat Data</h5></div><table>";
    var dataHeading = ["Vsta ID", "Operator", "Province", "District", "VDC"];
    var data = [
        jsonData.features[0].properties.vsatid,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.vdc
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createBtsTable(jsonData) {
    var table = "<div><h5>BTS Data</h5></div><table>";
    var dataHeading = [
        "Systemsite ID",
        "Operator",
        "oprsitename",
        "oprsiteid",
        "antenna location",
        "Province",
        "District",
        "Vdc",
        "Ward",
        "no_of_systems"
    ];
    var data = [
        jsonData.features[0].properties.syssiteid,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.oprsitename,
        jsonData.features[0].properties.oprsiteid,
        jsonData.features[0].properties.antloc,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.vdc,
        jsonData.features[0].properties.ward,
        jsonData.features[0].properties.no_of_systems
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
                
        }
    }
    table += "</table>"+"<br/> <button class='btn btn-primary mr-0' id='export-btsinfo'>Export BTS info to csv</button>";
    return table;
}

export function createRiverTable(jsonData) {
    var table = "<div><h5>River Data</h5></div><table>";
    var dataHeading = ["Length", "River Name", "River Type"];
    var data = [
        jsonData.features[0].properties.length,
        jsonData.features[0].properties.river_nm,
        jsonData.features[0].properties.river_type
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createRoadTable(jsonData) {
    var table = "<div><h5>Road Data</h5></div><table>";
    var dataHeading = ["Length", "Type", "Road Name", "Link Code"];
    var data = [
        jsonData.features[0].properties.length,
        jsonData.features[0].properties.type,
        jsonData.features[0].properties.road_nm,
        jsonData.features[0].properties.link_code
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createOpticalfiberTable(jsonData) {
    var table = "<div><h5>Optical Fiber Data</h5></div><table>";
    var dataHeading = [
        "nodeid",
        "nodename",
        "oprcd",
        "province",
        "district",
        "vdc",
        "ward",
        "strtname",
        "lat",
        "long"
    ];
    var data = [
        jsonData.features[0].properties.nodeid,
        jsonData.features[0].properties.nodename,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.vdc,
        jsonData.features[0].properties.ward,
        jsonData.features[0].properties.strtname,
        jsonData.features[0].properties.lat,
        jsonData.features[0].properties.long
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createOpticalfiberlinkTable(jsonData) {
    var table = "<div><h5>Optical Fiber Link Data</h5></div><table>";
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
        jsonData.features[0].properties.oflinkid,
        jsonData.features[0].properties.oprlinkid,
        jsonData.features[0].properties.linkname,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.length,
        jsonData.features[0].properties.orgnodeid,
        jsonData.features[0].properties.endnodeid,
        jsonData.features[0].properties.cabletype,
        jsonData.features[0].properties.fibers,
        jsonData.features[0].properties.capacity,
        jsonData.features[0].properties.status
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createOpticalfiberplannedTable(jsonData) {
    var table = "<div><h5>Optical Fiber Planned Data</h5></div><table>";
    var dataHeading = [
        "nodeid",
        "nodename",
        "oprcd",
        "province",
        "district",
        "vdc",
        "ward",
        "strtname",
        "lat",
        "long"
    ];
    var data = [
        jsonData.features[0].properties.nodeid,
        jsonData.features[0].properties.nodename,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.province,
        jsonData.features[0].properties.district,
        jsonData.features[0].properties.vdc,
        jsonData.features[0].properties.ward,
        jsonData.features[0].properties.strtname,
        jsonData.features[0].properties.lat,
        jsonData.features[0].properties.long
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

export function createOpticalfiberlinkplannedTable(jsonData) {
    var table = "<div><h5>Optical Fiber Link Planned Data</h5></div><table>";
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
        jsonData.features[0].properties.oflinkid,
        jsonData.features[0].properties.oprlinkid,
        jsonData.features[0].properties.linkname,
        jsonData.features[0].properties.oprcd,
        jsonData.features[0].properties.length,
        jsonData.features[0].properties.orgnodeid,
        jsonData.features[0].properties.endnodeid,
        jsonData.features[0].properties.cabletype,
        jsonData.features[0].properties.fibers,
        jsonData.features[0].properties.capacity,
        jsonData.features[0].properties.status
    ];
    for (let i = 0; i < dataHeading.length; i++) {
        if (data[i] != null) {
            table +=
                "<tr><th>" +
                dataHeading[i] +
                "</th><td>" +
                data[i] +
                "</td></tr>";
        }
    }
    table += "</table>";
    return table;
}

