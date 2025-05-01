@extends('layouts.home')
@section('styles')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
{{-- Donot delete please! --}}
{{-- <scrip src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</script>
@endsection

@section('content')
<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h5>Filter data</h5>
    </div>
    <div class="card-body ml-5">
        <form id="export_form">
            <div class="form-group d-flex">
                <label class="col-2"> Operator </label>
                <select class="form-control multiple col-6"  multiple="multiple" data-column="0" name="oprcdfilter" id="oprcdfilter" >
                    <optgroup label="Select Operator">
                        @foreach ($operators as $key=>$value)
                            <option value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="form-group d-flex">
                <label class="col-2"> Generation </label>
                <select class="form-control multiple col-6" data-column="1" multiple="multiple" name="generation_type_filter" id="generation_type_filter">
                    <optgroup label="Select Generation">
                        <option value="2G">2G</option>
                        <option value="3G">3G</option>
                        <option value="4G">4G</option>
                    </optgroup>
                </select>
            </div>
            <div class="form-group d-flex">
                <label class="col-2"> Data Format </label>
                <select class="form-control multiple col-6" data-column="1" name="export_type_filter" id="export_type_filter">
                        <option value="">Select Export Type</option>
                        <option value="csv">CSV</option>
                        <option value="kml">KML</option>
                        <option value="shape-zip">Shape</option>
                </select>
            </div>
           <button class="footer d-flex btn btn-success px-5" type="submit" > Export </button>
        </form>
      </div>  
</div><!-- /.box -->
<script>
$(document).ready(function() {
    $('.multiple').select2();

    $('#export_form').on('submit', function() {
        var workspace = '{{Config::get('geo.GEO_WORKSPACE')}}';
        var gurl = '{{Config::get('geo.GEO_URL')}}';
        var gurl_wfs = gurl + '/' + workspace + '/wfs';
        var selected_layer = 'coverage_data';
        var authkey = '&authkey={{Config::get('geo.GEO_URL')}}';

        var selected_oprcd = $('#oprcdfilter').val();
        var selected_gentype = $('#generation_type_filter').val();
        var selected_exportformat = $('#export_type_filter').val();
        
        var oprcds = [];
        if (selected_oprcd) {
            $.each(selected_oprcd, function(index, value) {
                oprcds.push(value.toUpperCase());
            });
        }

        var gentypes = [];
        if (selected_gentype) {
            $.each(selected_gentype, function(index, value){
                gentypes.push(value.toUpperCase());
            });
        }

        if(selected_oprcd && selected_gentype && selected_exportformat != "" || null)
        {
            if (selected_oprcd && selected_gentype && selected_exportformat){

                wfsurl=   gurl_wfs+"?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:";
                cql="+&cql_filter=";

                if(selected_oprcd) {
                    cql_oprcd="oprcd IN('"+oprcds.join("','")+"')";
                }
                if(selected_gentype) {
                    cql_type="+AND type IN('"+gentypes.join("','")+"')";
                }
                outputformat="+&outputFormat=";
                var exportLink= wfsurl+selected_layer+cql+encodeURI(cql_oprcd)+encodeURI(cql_type)+authkey+outputformat+selected_exportformat;
                
                window.open(exportLink);
            }
        }
        else if ( !selected_oprcd || !selected_gentype) {
                alert('Please select Operator, Generation Type and Export format.');
                return false;
            } 
        return false;
    
    });
    
});
</script>


@endsection
