@extends('layouts.home')
@section('styles')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

{{-- Donot delete please! --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</script>
@endsection

@section('content')

@include('microwavestation.microwavestation_filter')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Microwave Station Link</h2>
    </div>
    <div class="card-body">

 @include('microwavestation.microwavestation_export')
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="MWSL_table" class="table table-sm table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Link ID by NTA</th>
                        <th>Link Name</th>
                        <th class="text-left">Distance</th>
                        <th class="text-left">Bandwidth</th>
                        <th>Polariz</th>
                        <th>Status</th>
                        <th>MSCode A</th>
                        <th>MSCODE B</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- All the modal used --}}
@include('empty.space')
@endsection

@section('scripts')

{{-- Ajax,for serverside procesing --}}
<script>
    $(document).ready(function()
    {
        // Table ID
        var mwlTable=  $('#MWSL_table').DataTable(
        {
            sDom: 'lrtip',
            searching:true,
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('microwavestationlink.index') }}",
                data: function(d){
                    d.distance = $('#distance').val();
                }

            },

            //left align numeric values
            "columnDefs":
            [{
                className: "align-right", "targets": [2,3]
            }],
            //All data and columns to be displayed
            columns:
            [{
                data: 'mwlinkid',
                name: 'mwlinkid'
            },
            {
                data: 'linkname',
                name: 'linkname'
            },

            {
                data: 'distance',
                name: 'distance'
            },
            {
                data: 'bdwidth',
                name: 'bdwidth'
            },
            {
                data: 'polariz',
                name: 'polariz'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'mwstncodea',
                name: 'mwstncodea'
            },
            {
                data: 'mwstncodeb',
                name: 'mwstncodeb'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false
            },
            {
                data: 'bdwidth',
                name: 'bdwidth',
                visible:false
            },

            {
                data: 'polariz',
                name: 'polariz',
                visible:false
            },
            {
                data: 'status',
                name: 'status',
                visible:false
            },
        ]
        });


        $('#linkidfilter').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#linknamefilter').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#mscodeafilter').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#mscodebfilter').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#bandwidth').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#polariz').keyup(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#distance').keyup(function(e){
            if ($.isNumeric($(this).val()) || $(this).val()===''){
            mwlTable.draw();
            }
        });
        $('#status').change(function(){
            mwlTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#clear-filter-btn').click(function(){
            $.each($('.filter-input'), function(i, val) {
                if(val.value.length>0){
                    $(val).val('').trigger('change');
                    $(val).val('').trigger('keyup');
                }
            });
        });
        //highlight if filter is applied + Export params
        $('.filter-input').change(function() {
            var linkid = $('#linkidfilter').val();
            var linkname = $('#linknamefilter').val();
            var mscodea = $('#mscodeafilter').val();
            var mscodeb = $('#mscodebfilter').val();
            var bandwidth = $('#bandwidth').val();
            var polariz = $('#polariz').val();
            var distance = $('#distance').val();
            var status = $('#status').val();
            var base_url = '{{Config::get('geo.GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:microwavestations+&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}'
            var cql_param = "&CQL_FILTER=1=1";
            $('.export').attr("disabled", "disabled");
            if ($(this).val().length > 0) {
                $(this).addClass("border border-success bg-light");
            } else {
                $(this).removeClass("border border-success bg-light");
            }
            if (linkid) {
                cql_param += " AND strToLowerCase(mwlinkid) ILIKE'%" + linkid.toLowerCase()  + "%'";
            }
            if (linkname) {
                cql_param += " AND strToLowerCase(linkname) ILIKE'%" + linkname.toLowerCase()  + "%'";
            }
            if (mscodea) {
                cql_param += " AND strToLowerCase(mwstncodea) ILIKE'%" + mscodea.toLowerCase()  + "%'";
            }
            if (mscodeb) {
                cql_param += " AND strToLowerCase(mwstncodeb) ILIKE'%" + mscodeb.toLowerCase()  + "%'";
            }
            if (bandwidth) {
                cql_param += " AND strToLowerCase(bdwidth) ='" + bandwidth.toLowerCase()  + "'";
            }
            if (polariz) {
                cql_param += " AND strToLowerCase(polariz) ILIKE'%" + polariz.toLowerCase()  + "%'";
            }
            if (distance) {
                cql_param += " AND distance >='" + distance.toLowerCase()  + "'";
            }
            if (status) {
                cql_param += " AND strToLowerCase(status) ='" + status.toLowerCase()  + "'";
            }
            $('.export').attr('href', function() {
                this.href = "";
                switch (this.id){
                    case 'export-csv':
                        this.href = base_url + '&outputFormat=csv' + encodeURI(cql_param);
                        break;
                    case 'export-shp':
                        this.href = base_url + '&outputFormat=shape-zip' + encodeURI(cql_param);
                        break;
                    case 'export-kml':
                        this.href = base_url + '&outputFormat=kml' + encodeURI(cql_param);
                        break;
                }
            });
            $('.export').removeAttr("disabled");
        });
    });
</script>
@endsection
