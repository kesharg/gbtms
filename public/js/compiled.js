// Input 0
var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.arrayIteratorImpl = function(l) {
    var p = 0;
    return function() {
        return p < l.length ? { done: !1, value: l[p++] } : { done: !0 };
    };
};
$jscomp.arrayIterator = function(l) {
    return { next: $jscomp.arrayIteratorImpl(l) };
};
$jscomp.makeIterator = function(l) {
    var p =
        "undefined" != typeof Symbol && Symbol.iterator && l[Symbol.iterator];
    return p ? p.call(l) : $jscomp.arrayIterator(l);
};
window.onload = init;
function init() {
    function l(a) {
        a = sourceNepalBorder.getLegendUrl(h, {
            LAYER: "maps_nepal",
            STYLE: a
        });
        document.getElementById("NepalBorderLegend").src = a;
    }
    function p(a) {
        a = sourceNepalDistrict.getLegendUrl(h, {
            LAYER: "maps_district",
            STYLE: a
        });
        document.getElementById("NepalDistrictLegend").src = a;
    }
    function ba(a) {
        a = sourceNepalProvince.getLegendUrl(h, {
            LAYER: "maps_province",
            STYLE: a
        });
        document.getElementById("NepalProvinceLegend").src = a;
    }
    function ca(a) {
        a = sourceNepalVdc.getLegendUrl(h, { LAYER: "maps_vdc", STYLE: a });
        document.getElementById("NepalVdcLegend").src = a;
    }
    function da(a) {
        a = sourceNepalWard.getLegendUrl(h, { LAYER: "maps_ward", STYLE: a });
        document.getElementById("NepalWardLegend").src = a;
    }
    function ea(a) {
        a = z.getLegendUrl(h, { LAYER: "coverage_data", STYLE: a });
        document.getElementById("coveragedataLegend").src = a;
    }
    function fa() {
        "None" !== A.value &&
            ((q = new ol.interaction.Draw({ source: x, type: A.value })),
            c.addInteraction(q));
    }
    function ha() {
        "None" !== t.value &&
            (c.on("pointermove", Xa),
            c.getViewport().addEventListener("mouseout", function() {
                n.classList.add("hidden");
            }));
        q = new ol.interaction.Draw({
            source: x,
            type: "area" == t.value ? "Polygon" : "LineString",
            style: new ol.style.Style({
                fill: new ol.style.Fill({ color: "rgba(255, 255, 255, 0.2)" }),
                stroke: new ol.style.Stroke({
                    color: "rgba(0, 0, 0, 0.5)",
                    lineDash: [10, 10],
                    width: 2
                }),
                image: new ol.style.Circle({
                    radius: 5,
                    stroke: new ol.style.Stroke({
                        color: "rgba(0, 0, 0, 0.7)"
                    }),
                    fill: new ol.style.Fill({
                        color: "rgba(255, 255, 255, 0.2)"
                    })
                })
            })
        });
        "None" !== t.value &&
            (c.addInteraction(q),
            ia(),
            n && n.parentNode.removeChild(n),
            (n = document.createElement("div")),
            (n.className = "ol-tooltip hidden"),
            (y = new ol.Overlay({
                element: n,
                offset: [15, 0],
                positioning: "center-left"
            })),
            c.addOverlay(y));
        var a;
        q.on("drawstart", function(d) {
            u = d.feature;
            var e = d.coordinate;
            a = u.getGeometry().on("change", function(b) {
                b = b.target;
                if (b instanceof ol.geom.Polygon) {
                    var f = ol.sphere.getArea(b);
                    f =
                        1e4 < f
                            ? Math.round((f / 1e6) * 100) / 100 +
                              " km<sup>2</sup>"
                            : Math.round(100 * f) / 100 + " m<sup>2</sup>";
                    e = b.getInteriorPoint().getCoordinates();
                } else b instanceof ol.geom.LineString && ((f = ol.sphere.getLength(b)), (f = 100 < f ? Math.round((f / 1e3) * 100) / 100 + " km" : Math.round(100 * f) / 100 + " m"), (e = b.getLastCoordinate()));
                m.innerHTML = f;
                v.setPosition(e);
            });
        });
        q.on("drawend", function() {
            m.className = "ol-tooltip ol-tooltip-static";
            v.setOffset([0, -7]);
            m = u = null;
            ia();
            ol.Observable.unByKey(a);
        });
    }
    function ia() {
        m && m.parentNode.removeChild(m);
        m = document.createElement("div");
        m.className = "ol-tooltip ol-tooltip-measure";
        v = new ol.Overlay({
            element: m,
            offset: [0, -15],
            positioning: "bottom-center"
        });
        c.addOverlay(v);
    }
    var Ya = new ol.control.FullScreen(),
        Za = new ol.interaction.DragRotateAndZoom(),
        ja = [8519e3, 293e4, 10395e3, 3665e3],
        $a = new ol.control.ZoomSlider(),
        ab = new ol.control.OverviewMap({
            collapsed: !1,
            layers: [new ol.layer.Tile({ source: new ol.source.OSM() })]
        }),
        bb = new ol.control.Attribution({ collapsible: !0 }),
        x = new ol.source.Vector({ wrapX: !1 }),
        ka = new ol.layer.Vector({ source: x, visible: !0, zIndex: 99 }),
        la = new ol.layer.Tile({
            source: "",
            visible: !0,
            title: "NoLayer",
            crossOrigin: null
        }),
        ma = new ol.layer.Tile({
            source: new ol.source.OSM(),
            visible: !1,
            title: "OSMStandard",
            crossOrigin: null
        }),
        na = new ol.layer.Tile({
            source: new ol.source.OSM({
                url: "https://{a-c}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png"
            }),
            visible: !1,
            title: "OSMHumanitarian",
            crossOrigin: null
        }),
        oa = new ol.layer.Tile({
            source: new ol.source.BingMaps({
                key:
                    "Am91Zo6OSOQGKiN4xHLCgW3hd27DTm6n2E1xiKxMEzQb0JOXFYuttfbabSCavjpe",
                imagerySet: "CanvasGray"
            }),
            visible: !1,
            title: "BingMaps",
            crossOrigin: null
        }),
        pa = new ol.layer.Tile({
            source: new ol.source.XYZ({
                url:
                    "http://{1-4}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png",
                attributions: "\u00a9 CARTO"
            }),
            visible: !1,
            title: "CartoDarkAll",
            crossOrigin: null
        }),
        qa = new ol.layer.Tile({
            source: new ol.source.Stamen({
                layer: "terrain-labels",
                attributions:
                    'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
            }),
            visible: !1,
            title: "StamenTerrainWithLabels",
            crossOrigin: null
        }),
        ra = new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: "http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg",
                attributions:
                    'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
            }),
            visible: !1,
            title: "StamenTerrain",
            crossOrigin: null
        });
    sourceNepalBorder = new ol.source.ImageWMS({
        url: "http://localhost:8080/geoserver/nepal_map/wms",
        params: { layers: "nepal_map:maps_nepal", TILED: !0 },
        serverType: "geoserver",
        attributions: "\u00a9 Innovative Solution Pvt. Ltd."
    });
    var sa = new ol.layer.Image({
        source: sourceNepalBorder,
        title: "NepalBorder",
        visible: !0,
        crossOrigin: null
    });
    sourceNepalProvince = new ol.source.TileWMS({
        url: "http://localhost:8080/geoserver/nepal_map/wms",
        params: { layers: "nepal_map:maps_province", TILED: !0 },
        serverType: "geoserver",
        attributions: "\u00a9 Innovative Solution Pvt. Ltd."
    });
    var B = new ol.layer.Tile({
        source: sourceNepalProvince,
        title: "NepalProvince",
        visible: !1,
        crossOrigin: null
    });
    sourceNepalDistrict = new ol.source.ImageWMS({
        url: "http://localhost:8080/geoserver/nepal_map/wms",
        params: { layers: "nepal_map:maps_district", TILED: !0 },
        serverType: "geoserver",
        attributions: "\u00a9 Innovative Solution Pvt. Ltd."
    });
    var C = new ol.layer.Image({
        source: sourceNepalDistrict,
        title: "NepalDistrict",
        visible: !1,
        crossOrigin: null
    });
    sourceNepalVdc = new ol.source.TileWMS({
        url: "http://localhost:8080/geoserver/nepal_map/wms",
        params: { layers: "nepal_map:maps_vdc", TILED: !0 },
        serverType: "geoserver",
        attributions: "\u00a9 Innovative Solution Pvt. Ltd."
    });
    var D = new ol.layer.Tile({
        source: sourceNepalVdc,
        title: "NepalVDC",
        visible: !1,
        crossOrigin: null
    });
    sourceNepalWard = new ol.source.TileWMS({
        url: "http://localhost:8080/geoserver/nepal_map/wms",
        params: { layers: "nepal_map:maps_ward", TILED: !0 },
        serverType: "geoserver",
        attributions: "\u00a9 Innovative Solution Pvt. Ltd."
    });
    var ta = new ol.layer.Tile({
            source: sourceNepalWard,
            title: "NepalWard",
            visible: !1,
            crossOrigin: null
        }),
        ua = new ol.source.TileWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:river", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        va = new ol.layer.Tile({
            source: ua,
            title: "river",
            visible: !1,
            crossOrigin: null
        }),
        wa = new ol.source.TileWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:road", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        xa = new ol.layer.Tile({
            source: wa,
            title: "road",
            visible: !1,
            crossOrigin: null
        }),
        cb = new ol.source.TileWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:settlement", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        ya = new ol.layer.Tile({
            source: cb,
            title: "settlement",
            visible: !1,
            crossOrigin: null
        }),
        za = new ol.source.TileWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:imp_places", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Aa = new ol.layer.Tile({
            source: za,
            title: "impplaces",
            visible: !1,
            crossOrigin: null
        }),
        Ba = new ol.source.TileWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:microwaves", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        E = new ol.layer.Tile({
            source: Ba,
            title: "microwaveStation",
            visible: !1,
            crossOrigin: null
        }),
        Ca = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:microwavestations", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Da = new ol.layer.Image({
            source: Ca,
            title: "microwaveStationLink",
            visible: !1,
            crossOrigin: null
        }),
        Ea = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:vsats", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Fa = new ol.layer.Image({
            source: Ea,
            title: "vsat",
            visible: !1,
            crossOrigin: null
        }),
        Ga = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:opticalfiberplanned", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Ha = new ol.layer.Image({
            source: Ga,
            title: "opticalfiberplanned",
            visible: !1,
            crossOrigin: null
        }),
        F = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:opticalfiberlink", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Ia = new ol.layer.Image({
            source: F,
            title: "opticalfiberlink",
            visible: !1,
            crossOrigin: null
        }),
        Ja = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:bts", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        Ka = new ol.layer.Image({
            source: Ja,
            title: "bts",
            visible: !1,
            crossOrigin: null
        }),
        z = new ol.source.ImageWMS({
            url: "http://localhost:8080/geoserver/nepal_map/wms",
            params: { layers: "nepal_map:coverage_data", TILED: !0 },
            serverType: "geoserver",
            attributions: "\u00a9 Innovative Solution Pvt. Ltd."
        }),
        La = new ol.layer.Image({
            source: z,
            title: "coveragedata",
            visible: !1,
            crossOrigin: null
        }),
        c = new ol.Map({
            view: new ol.View({
                center: [9443807.824891845, 3281690.3876565387],
                extent: ja,
                zoom: 6,
                minZoom: 6
            }),
            layers: [la],
            target: "js-map",
            keyboardEventTarget: document,
            controls: ol.control
                .defaults({ attribution: !1 })
                .extend([Ya, ab, $a, bb, Za])
        }),
        Ma = new ol.layer.Group({ layers: [la, ma, na, oa, pa, qa, ra, ka] }),
        Na = new ol.layer.Group({
            layers: [sa, B, C, D, ta, xa, va, ya, Aa, E, Da, La, Fa, Ia, Ha, Ka]
        });
    c.addLayer(Ma);
    c.addLayer(Na);
    var db = new ol.interaction.DragRotate({
        condition: ol.events.condition.altKeyOnly
    });
    c.addInteraction(db);
    "http://gbtimis.test/map" != window.location.href &&
        ((url = window.location.href),
        (data = url.split("data=").pop()),
        (datasplit = data.split("%20")),
        (datalong = datasplit[0]),
        (datalat = datasplit[1]),
        console.log(datalong),
        console.log(datalat),
        c.getView().setCenter(ol.proj.fromLonLat([datalong, datalat])),
        c.getView().setZoom(20));
    for (
        var eb = document.querySelectorAll(".sideba>select[id=base_layer]"),
            Oa = $jscomp.makeIterator(eb),
            G = Oa.next();
        !G.done;
        G = Oa.next()
    )
        G.value.addEventListener("change", function() {
            var a = this.value;
            Ma.getLayers().forEach(function(d, e, b) {
                e = d.get("title");
                d.setVisible(e === a);
                ka.setVisible("true");
            });
        });
    for (
        var Pa = document.querySelectorAll(".sideba > input[type=checkbox]"),
            Qa = $jscomp.makeIterator(Pa),
            H = Qa.next();
        !H.done;
        H = Qa.next()
    )
        H.value.addEventListener("change", function() {
            var a = this.value,
                d;
            Na.getLayers().forEach(function(e, b, f) {
                a === e.get("title") && (d = e);
            });
            this.checked ? d.setVisible(!0) : d.setVisible(!1);
        });
    document.getElementById("base_map_slider").oninput = function() {
        var a = this.value / 100;
        ma.setOpacity(a);
        na.setOpacity(a);
        oa.setOpacity(a);
        pa.setOpacity(a);
        qa.setOpacity(a);
        ra.setOpacity(a);
    };
    document.getElementById("border_slider").oninput = function() {
        sa.setOpacity(this.value / 100);
    };
    document.getElementById("province_slider").oninput = function() {
        B.setOpacity(this.value / 100);
    };
    document.getElementById("district_slider").oninput = function() {
        C.setOpacity(this.value / 100);
    };
    document.getElementById("vdc_slider").oninput = function() {
        D.setOpacity(this.value / 100);
    };
    document.getElementById("ward_slider").oninput = function() {
        ta.setOpacity(this.value / 100);
    };
    document.getElementById("microwavestation_slider").oninput = function() {
        E.setOpacity(this.value / 100);
    };
    document.getElementById(
        "microwavestationlink_slider"
    ).oninput = function() {
        Da.setOpacity(this.value / 100);
    };
    document.getElementById("vsat_slider").oninput = function() {
        Fa.setOpacity(this.value / 100);
    };
    document.getElementById("opticalfiberlink_slider").oninput = function() {
        Ia.setOpacity(this.value / 100);
    };
    document.getElementById("opticalfiberplanned_slider").oninput = function() {
        Ha.setOpacity(this.value / 100);
    };
    document.getElementById("bts_slider").oninput = function() {
        Ka.setOpacity(this.value / 100);
    };
    document.getElementById("coveragedata_slider").oninput = function() {
        La.setOpacity(this.value / 100);
    };
    document.getElementById("road_slider").oninput = function() {
        xa.setOpacity(this.value / 100);
    };
    document.getElementById("river_slider").oninput = function() {
        va.setOpacity(this.value / 100);
    };
    document.getElementById("settlement_slider").oninput = function() {
        ya.setOpacity(this.value / 100);
    };
    document.getElementById("impplaces_slider").oninput = function() {
        Aa.setOpacity(this.value / 100);
    };
    var h = c.getView().getResolution();
    l();
    borderLayerFilter = document.getElementById("borderLayerFilter");
    borderLayerFilter.addEventListener("change", function() {
        sourceNepalBorder.updateParams({ STYLES: borderLayerFilter.value });
        l(borderLayerFilter.value);
    });
    p();
    districtLayerFilter = document.getElementById("districtLayerFilter");
    districtLayerFilter.addEventListener("change", function() {
        sourceNepalDistrict.updateParams({ STYLES: districtLayerFilter.value });
        p(districtLayerFilter.value);
    });
    ba();
    provinceLayerFilter = document.getElementById("provinceLayerFilter");
    provinceLayerFilter.addEventListener("change", function() {
        sourceNepalProvince.updateParams({ STYLES: provinceLayerFilter.value });
        ba(provinceLayerFilter.value);
    });
    ca();
    vdcLayerFilter = document.getElementById("vdcLayerFilter");
    vdcLayerFilter.addEventListener("change", function() {
        sourceNepalVdc.updateParams({ STYLES: vdcLayerFilter.value });
        ca(vdcLayerFilter.value);
    });
    da();
    wardLayerFilter = document.getElementById("wardLayerFilter");
    wardLayerFilter.addEventListener("change", function() {
        sourceNepalVdc.updateParams({ STYLES: wardLayerFilter.value });
        da(wardLayerFilter.value);
    });
    ea();
    coveragedataLayerFilter = document.getElementById(
        "coveragedataLayerFilter"
    );
    coveragedataLayerFilter.addEventListener("change", function() {
        z.updateParams({ STYLES: coveragedataLayerFilter.value });
        ea(coveragedataLayerFilter.value);
    });
    var fb = Ba.getLegendUrl(h, { LAYER: "microwaves" });
    document.getElementById("microwaveStationLegend").src = fb;
    var gb = Ca.getLegendUrl(h, { LAYER: "microwavestations" });
    document.getElementById("microwaveStationLinkLegend").src = gb;
    var hb = Ea.getLegendUrl(h, { LAYER: "vsats" });
    document.getElementById("vsatLegend").src = hb;
    var ib = Ja.getLegendUrl(h, { LAYER: "bts" });
    document.getElementById("btsLegend").src = ib;
    var jb = Ga.getLegendUrl(h, { LAYER: "opticalfiberplanned" });
    document.getElementById("opticalfiberplannedLegend").src = jb;
    var kb = F.getLegendUrl(h, { LAYER: "opticalfiberlink" });
    document.getElementById("opticalfiberlinkLegend").src = kb;
    var lb = F.getLegendUrl(h, { LAYER: "road" });
    document.getElementById("roadLegend").src = lb;
    var mb = wa.getLegendUrl(h, { LAYER: "river" });
    document.getElementById("riverLegend").src = mb;
    var nb = ua.getLegendUrl(h, { LAYER: "settlement" });
    document.getElementById("settlementLegend").src = nb;
    var ob = za.getLegendUrl(h, { LAYER: "imp_places" });
    document.getElementById("impplacesLegend").src = ob;
    var Ra = document.getElementById("nepalborderDIV"),
        I = document.getElementById("nepaldistrictDIV"),
        J = document.getElementById("nepalprovinceDIV"),
        K = document.getElementById("nepalvdcDIV"),
        L = document.getElementById("microwavestationDIV"),
        M = document.getElementById("microwavestationlinkDIV"),
        N = document.getElementById("vsatDIV"),
        O = document.getElementById("opticalfiberlinkDIV"),
        P = document.getElementById("opticalfiberplannedDIV"),
        Q = document.getElementById("coveragedataDIV"),
        R = document.getElementById("btsDIV"),
        S = document.getElementById("roadDIV"),
        T = document.getElementById("riverDIV"),
        U = document.getElementById("settlementDIV"),
        V = document.getElementById("impplacesDIV"),
        W = document.getElementById("nepalwardDIV");
    J.style.display = "none";
    I.style.display = "none";
    K.style.display = "none";
    L.style.display = "none";
    M.style.display = "none";
    N.style.display = "none";
    O.style.display = "none";
    P.style.display = "none";
    Q.style.display = "none";
    R.style.display = "none";
    S.style.display = "none";
    T.style.display = "none";
    U.style.display = "none";
    V.style.display = "none";
    W.style.display = "none";
    for (
        var Sa = $jscomp.makeIterator(Pa), X = Sa.next();
        !X.done;
        X = Sa.next()
    )
        X.value.addEventListener("change", function() {
            var a = this.value;
            if (1 == this.checked)
                switch (a) {
                    case "NepalBorder":
                        Ra.style.display = "initial";
                        break;
                    case "NepalProvince":
                        J.style.display = "initial";
                        sourceNepalProvince.updateParams({
                            cql_filter: "province LIKE '%'"
                        });
                        break;
                    case "NepalDistrict":
                        I.style.display = "initial";
                        sourceNepalDistrict.updateParams({
                            cql_filter: "district LIKE '%'"
                        });
                        break;
                    case "NepalVDC":
                        K.style.display = "initial";
                        sourceNepalVdc.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "NepalWard":
                        W.style.display = "initial";
                        sourceNepalWard.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "microwaveStation":
                        L.style.display = "initial";
                        break;
                    case "microwaveStationLink":
                        M.style.display = "initial";
                        break;
                    case "vsat":
                        N.style.display = "initial";
                        break;
                    case "bts":
                        R.style.display = "initial";
                        break;
                    case "opticalfiberplanned":
                        P.style.display = "initial";
                        break;
                    case "opticalfiberlink":
                        O.style.display = "initial";
                        break;
                    case "coveragedata":
                        Q.style.display = "initial";
                        break;
                    case "road":
                        S.style.display = "initial";
                        break;
                    case "river":
                        T.style.display = "initial";
                        break;
                    case "settlement":
                        U.style.display = "initial";
                        break;
                    case "impplaces":
                        V.style.display = "initial";
                }
            if (0 == this.checked)
                switch (a) {
                    case "NepalBorder":
                        Ra.style.display = "none";
                        break;
                    case "NepalProvince":
                        J.style.display = "none";
                        sourceNepalProvince.updateParams({
                            cql_filter: "province LIKE '%'"
                        });
                        break;
                    case "NepalDistrict":
                        I.style.display = "none";
                        sourceNepalDistrict.updateParams({
                            cql_filter: "district LIKE '%'"
                        });
                        break;
                    case "NepalVDC":
                        K.style.display = "none";
                        sourceNepalVdc.updateParams({
                            cql_filter: "gapa_napa LIKE '%'"
                        });
                        break;
                    case "NepalWard":
                        W.style.display = "none";
                        break;
                    case "microwaveStation":
                        L.style.display = "none";
                        break;
                    case "microwaveStationLink":
                        M.style.display = "none";
                        break;
                    case "vsat":
                        N.style.display = "none";
                        break;
                    case "bts":
                        R.style.display = "none";
                        break;
                    case "opticalfiberplanned":
                        P.style.display = "none";
                        break;
                    case "opticalfiberlink":
                        O.style.display = "none";
                        break;
                    case "coveragedata":
                        Q.style.display = "none";
                        break;
                    case "road":
                        S.style.display = "none";
                        break;
                    case "river":
                        T.style.display = "none";
                        break;
                    case "settlement":
                        U.style.display = "none";
                        break;
                    case "impplaces":
                        V.style.display = "none";
                }
        });
    document
        .getElementById("original_extent")
        .addEventListener("click", function() {
            c.getView().fit(ja, c.getSize());
        });
    var A = document.getElementById("interactionDraw"),
        q;
    A.onchange = function() {
        c.removeInteraction(q);
        fa();
    };
    fa();
    var t = document.getElementById("measurement"),
        u,
        n,
        y,
        m,
        v,
        Xa = function(a) {
            if (!a.dragging) {
                var d = "Click to start drawing";
                if (u) {
                    var e = u.getGeometry();
                    e instanceof ol.geom.Polygon
                        ? (d = "Click to continue drawing the polygon")
                        : e instanceof ol.geom.LineString &&
                          (d = "Click to continue drawing the line");
                }
                n.innerHTML = d;
                y.setPosition(a.coordinate);
                n.classList.remove("hidden");
            }
        };
    t.onchange = function() {
        c.removeInteraction(q);
        c.removeOverlay(v);
        c.removeOverlay(y);
        m = null;
        "None" !== t.value && ha();
    };
    ha();
    document.getElementById("clear").addEventListener("click", function() {
        x.clear();
        $(".ol-tooltip-static").remove();
    });
    var Ta = document.getElementById("province");
    Ta.addEventListener("change", function() {
        document.getElementById("provincelayerCheckbox").checked ||
            document.getElementById("provincelayerCheckbox").click();
        sourceNepalProvince.updateParams({
            cql_filter: "province LIKE '" + Ta.value + "'"
        });
    });
    var Ua = document.getElementById("district");
    Ua.addEventListener("change", function() {
        document.getElementById("districtlayerCheckbox").checked ||
            document.getElementById("districtlayerCheckbox").click();
        sourceNepalDistrict.updateParams({
            cql_filter: "district LIKE '" + Ua.value + "'"
        });
    });
    var Y = document.getElementById("vdc");
    Y.addEventListener("change", function() {
        document.getElementById("vdclayerCheckbox").checked ||
            document.getElementById("vdclayerCheckbox").click();
        sourceNepalVdc.updateParams({
            cql_filter: "gapa_napa LIKE '" + Y.value + "'"
        });
    });
    var Va = document.getElementById("ward");
    Va.addEventListener("change", function() {
        document.getElementById("wardlayerCheckbox").checked ||
            document.getElementById("wardlayerCheckbox").click();
        sourceNepalWard.updateParams({
            cql_filter:
                "new_ward_n = '" +
                Va.value +
                "'AND gapa_napa LIKE'" +
                Y.value +
                "'"
        });
    });
    var w = document.getElementById("informationPopup"),
        k = new ol.Overlay({ element: w, positioning: "bottom-right" });
    c.addOverlay(k);
    c.on("singleclick", (any = function(a) {}));
    var Wa = document.getElementById("info");
    Wa.addEventListener("change", function() {
        switch (Wa.value) {
            case "provinceInfo":
                document.getElementById("provincelayerCheckbox").checked ||
                    document.getElementById("provincelayerCheckbox").click();
                c.un("singleclick", any);
                c.on(
                    "singleclick",
                    (any = function(a) {
                        var d = c.getView(),
                            e = d.getResolution();
                        d = d.getProjection();
                        (e = B.getSource().getFeatureInfoUrl(
                            a.coordinate,
                            e,
                            d,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_province"
                            }
                        )) &&
                            fetch(e)
                                .then(function(b) {
                                    return b.text();
                                })
                                .then(function(b) {
                                    b = JSON.parse(b);
                                    try {
                                        var f =
                                                "<div><h4>Province Data</h4></div><table>",
                                            g = [
                                                "State Code",
                                                "Province",
                                                "No. of Microwave Station"
                                            ],
                                            r = [
                                                b.features[0].properties
                                                    .state_code,
                                                b.features[0].properties
                                                    .province,
                                                b.features[0].properties
                                                    .no_of_microwavestation
                                            ];
                                        for (i = 0; i < g.length; i++)
                                            f +=
                                                "<tr><th>" +
                                                g[i] +
                                                "</th><td>" +
                                                r[i] +
                                                "</td></tr>";
                                        w.innerHTML = f + "</table>";
                                        k.setPosition(void 0);
                                        k.setPosition(a.coordinate);
                                    } catch (Z) {
                                        k.setPosition(void 0);
                                    }
                                });
                    })
                );
                break;
            case "districtInfo":
                document.getElementById("districtlayerCheckbox").checked ||
                    document.getElementById("districtlayerCheckbox").click();
                c.un("singleclick", any);
                c.on(
                    "singleclick",
                    (any = function(a) {
                        var d = c.getView(),
                            e = d.getResolution();
                        d = d.getProjection();
                        (e = C.getSource().getFeatureInfoUrl(
                            a.coordinate,
                            e,
                            d,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_district"
                            }
                        )) &&
                            fetch(e)
                                .then(function(b) {
                                    return b.text();
                                })
                                .then(function(b) {
                                    b = JSON.parse(b);
                                    try {
                                        var f =
                                                "<div><h1>District Data</h1></div><table>",
                                            g = [
                                                "State Code",
                                                "District",
                                                "Province",
                                                "No. of MicrowaveStation"
                                            ],
                                            r = [
                                                b.features[0].properties
                                                    .state_code,
                                                b.features[0].properties
                                                    .district,
                                                b.features[0].properties
                                                    .province,
                                                b.features[0].properties
                                                    .no_of_microwavestation
                                            ];
                                        for (i = 0; i < g.length; i++)
                                            f +=
                                                "<tr><th>" +
                                                g[i] +
                                                "</th><td>" +
                                                r[i] +
                                                "</td></tr>";
                                        w.innerHTML = f + "</table>";
                                        k.setPosition(void 0);
                                        k.setPosition(a.coordinate);
                                    } catch (Z) {
                                        k.setPosition(void 0);
                                    }
                                });
                    })
                );
                break;
            case "vdcInfo":
                document.getElementById("vdclayerCheckbox").checked ||
                    document.getElementById("vdclayerCheckbox").click();
                c.un("singleclick", any);
                c.on(
                    "singleclick",
                    (any = function(a) {
                        var d = c.getView(),
                            e = d.getResolution();
                        d = d.getProjection();
                        (e = D.getSource().getFeatureInfoUrl(
                            a.coordinate,
                            e,
                            d,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "maps_vdc"
                            }
                        )) &&
                            fetch(e)
                                .then(function(b) {
                                    return b.text();
                                })
                                .then(function(b) {
                                    b = JSON.parse(b);
                                    try {
                                        var f =
                                                "<div><h1>VDC/Municipality Data</h1></div><table>",
                                            g = "State Code;District;Name;Type;Province;No. of Microwave Station".split(
                                                ";"
                                            ),
                                            r = [
                                                b.features[0].properties
                                                    .state_code,
                                                b.features[0].properties
                                                    .district,
                                                b.features[0].properties
                                                    .gapa_napa,
                                                b.features[0].properties
                                                    .type_gn,
                                                b.features[0].properties
                                                    .province,
                                                b.features[0].properties
                                                    .no_of_microwavestation
                                            ];
                                        for (i = 0; i < g.length; i++)
                                            f +=
                                                "<tr><th>" +
                                                g[i] +
                                                "</th><td>" +
                                                r[i] +
                                                "</td></tr>";
                                        w.innerHTML = f + "</table>";
                                        k.setPosition(void 0);
                                        k.setPosition(a.coordinate);
                                    } catch (Z) {
                                        k.setPosition(void 0);
                                    }
                                });
                    })
                );
                break;
            case "Print":
                window.location.href = "http://gbtimis.test/province/pdf";
                break;
            case "microwaveInfo":
                document.getElementById("microwavelayerCheckbox").checked ||
                    document.getElementById("microwavelayerCheckbox").click();
                c.un("singleclick", any);
                c.on(
                    "singleclick",
                    (any = function(a) {
                        var d = c.getView(),
                            e = d.getResolution();
                        d = d.getProjection();
                        (e = E.getSource().getFeatureInfoUrl(
                            a.coordinate,
                            e,
                            d,
                            {
                                INFO_FORMAT: "application/json",
                                QUERY_LAYERS: "microwaves"
                            }
                        )) &&
                            fetch(e)
                                .then(function(b) {
                                    return b.text();
                                })
                                .then(function(b) {
                                    b = JSON.parse(b);
                                    try {
                                        var f =
                                                "<div><h1>Microwave Data</h1></div><table>",
                                            g = [
                                                "MicrowaveStation Code",
                                                "Operator",
                                                "Microwave Station Name",
                                                "District",
                                                "VDC"
                                            ],
                                            r = [
                                                b.features[0].properties
                                                    .mwstncode,
                                                b.features[0].properties.oprcd,
                                                b.features[0].properties
                                                    .mwstnname,
                                                b.features[0].properties
                                                    .district,
                                                b.features[0].properties.vdc
                                            ];
                                        for (i = 0; i < g.length; i++)
                                            f +=
                                                "<tr><th>" +
                                                g[i] +
                                                "</th><td>" +
                                                r[i] +
                                                "</td></tr>";
                                        w.innerHTML = f + "</table>";
                                        k.setPosition(void 0);
                                        k.setPosition(a.coordinate);
                                    } catch (Z) {
                                        k.setPosition(void 0);
                                    }
                                });
                    })
                );
                break;
            default:
                c.un("singleclick", any);
        }
    });
    var aa = document.getElementById("export-pdf");
    aa.addEventListener(
        "click",
        function() {
            aa.disabled = !0;
            document.body.style.cursor = "progress";
            var a = [297, 210],
                d = Math.round((72 * a[0]) / 25.4),
                e = Math.round((72 * a[1]) / 25.4),
                b = c.getSize(),
                f = c.getView().getResolution();
            c.once("rendercomplete", function() {
                var g = document.getElementById("js-map");
                g.width = d;
                g.height = e;
                g = new jsPDF();
                g.crossOrigin = "Anonymous";
                g.text("NTA", 35, 25);
                g.save("map.pdf");
                c.setSize(b);
                c.getView().setResolution(f);
                aa.disabled = !1;
                document.body.style.cursor = "auto";
            });
            c.setSize([d, e]);
            a = Math.min(d / b[0], e / b[1]);
            c.getView().setResolution(f / a);
        },
        !1
    );
}
