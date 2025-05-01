@can('export-data')
<div class="float-right mt-2 mb-4">
    <a
        id = "export-csv" class="export"
    href="{{Config::get('geo.GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:microwaves+&outputFormat=csv&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}">
    <button type="button" data-toggle="tooltip" data-placement="bottom"
        title="Export data to CSV"
        class="btn btn-success ml-2">Export To
        CSV
    </button></a>
    <a
        id="export-shp" class="export"
        href="{{Config::get('geo.GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:microwaves+&outputFormat=shape-zip&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}">
        <button type="button" data-toggle="tooltip" data-placement="bottom"
            title="Export data to Shape file"
            class="btn btn-success ml-2">Export To
            Shapefile
        </button></a>
        <a
            id="export-kml" class="export"
        href="{{Config::get('geo.GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:microwaves+&outputFormat=kml&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}">
        <button type="button" data-toggle="tooltip" data-placement="bottom"
            title="Export data to KML"
            class="btn btn-success ml-2">Export To
            KML
        </button></a>
</div>
@endcan
