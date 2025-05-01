<div class="float-right mt-2 mb-4">
    <a
    href="{{env('GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:coverage_data+&outputFormat=csv&authkey={{env('GEO_Authkey')}}">
    <button type="button" data-toggle="tooltip" data-placement="bottom"
        title="Export data to CSV"
        class="btn btn-success ml-2">Export To
        CSV
    </button></a>
    <a
        href="{{env('GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:coverage_data+&outputFormat=shape-zip&authkey={{env('GEO_Authkey')}}">
        <button type="button" data-toggle="tooltip" data-placement="bottom"
            title="Export data to Shape file"
            class="btn btn-success ml-2">Export To
            Shapefile
        </button></a>
        <a
        href="{{env('GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:coverage_data+&outputFormat=kml&authkey={{env('GEO_Authkey')}}">
        <button type="button" data-toggle="tooltip" data-placement="bottom"
            title="Export data to KML"
            class="btn btn-success ml-2">Export To
            KML
        </button></a>
</div>
