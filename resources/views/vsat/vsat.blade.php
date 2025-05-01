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

@include('vsat.vsat_filter')
<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Vsat Station</h2>
    </div>
    <div class="card-body">
       @include('vsat.vsat_export')
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="VS_table" class="table table-sm table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Station Code by NTA</th>
                        <th>Station Code by Operator</th>
                        <th>Station Name</th>
                        <th>Operator Code</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>VDC</th>
                        <th class="text-left">Ward</th>
                        <th>Station Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <br />
        <br />
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
      var table=  $('#VS_table').DataTable(
        {
            sDom: 'lrtip',
            searching:true,
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('vsat.index') }}",
            },

            //left align numeric values
            "columnDefs":
            [{
                className: "align-right", "targets": [7]
            }],
            //All data and columns to be displayed
            columns:
            [{
                data: 'vsatid',
                name: 'vsatid'
            },
            {
                data: 'oprvsatid',
                name: 'oprvsatid'
            },
            {
                data: 'vsatstnname',
                name: 'vsatstnname'
            },
            {
                data: 'oprcd',
                name: 'oprcd'
            },
            {
                data: 'province',
                name: 'province'
            },
            {
                data: 'district',
                name: 'district'
            },
            {
                data: 'vdc',
                name: 'vdc'
            },
            {
                data: 'ward',
                name: 'ward'
            },
            {
                data: 'stationtype',
                name: 'stationtype'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
            {
                data:'stationtype',
                name:'stationtype',
                visible:false
            },
            {
                data:'status',
                name:'status',
                visible:false
            },
            {
                data:'purpose',
                name:'purpose',
                visible:false
            },
            {
                data:'province',
                name:'province',
                visible:false
            },
            {
                data:'ward',
                name:'ward',
                visible:false
            },
            {
                data:'oprcd',
                name:'oprcd',
                visible:false
            }]
        });

        $('#provincefilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#districtfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#vdcfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#wardfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#oprcdfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#stationtype').keyup(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#status').keyup(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#purpose').keyup(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
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
            var province = $('#provincefilter').val();
            var district = $('#districtfilter').val();
            var vdc = $('#vdcfilter').val();
            var ward = $('#wardfilter').val();
            var oprcd = $('#oprcdfilter').val();
            var stationtype = $('#stationtype').val();
            var status = $('#status').val();
            var purpose = $('#purpose').val();
            var base_url = '{{env('GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:vsats+&authkey={{env('GEO_Authkey')}}'
            var cql_param = "&CQL_FILTER=1=1";
            $('.export').attr("disabled", "disabled");
            if ($(this).val().length > 0) {
                $(this).addClass("border border-success bg-light");
            } else {
                $(this).removeClass("border border-success bg-light");
            }
            if (province) {
                cql_param += " AND strToLowerCase(province) ILIKE'%" + province.toLowerCase()  + "%'";
            }
            if (district) {
                cql_param += " AND strToLowerCase(district) ILIKE'%" + district.toLowerCase()  + "%'";
            }
            if (vdc) {
                cql_param += " AND strToLowerCase(vdc) ILIKE'%" + vdc.toLowerCase()  + "%'";
            }
            if (ward) {
                cql_param += " AND strToLowerCase(ward) ='" + ward.toLowerCase()  + "'";
            }
            if (oprcd) {
                cql_param += " AND strToLowerCase(oprcd) ='" + oprcd.toLowerCase()  + "'";
            }
            if (stationtype) {
                cql_param += " AND strToLowerCase(stationtype) ='" + stationtype.toLowerCase()  + "'";
            }
            if (status) {
                cql_param += " AND strToLowerCase(status) ='" + status.toLowerCase()  + "'";
            }
            if (purpose) {
                cql_param += " AND strToLowerCase(purpose) ILIKE'%" + purpose.toLowerCase()  + "%'";
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


    $(document).ready(function() {
        $('select[name="provincefilter"]').on('change', function() {
            var province = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(province) {
                $.ajax({
                    url: 'getdistrict/'+province,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="districtfilter"]').empty();
                        $('select[name="districtfilter"]').append('<option value=""> - Select District -</option>');
                        $('select[name="districtfilter"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="districtfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }else{
                $.ajax({
                    url: 'getalldistrict',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="districtfilter"]').empty();
                        $('select[name="districtfilter"]').append('<option value=""> - Select District - </option>');
                        $('select[name="districtfilter"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="districtfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="districtfilter"]').on('change', function() {
            var district = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(district) {
                $.ajax({
                    url: 'getvdc/'+district,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="vdcfilter"]').empty();
                        $('select[name="vdcfilter"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="vdcfilter"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="vdcfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }else{
                $.ajax({
                    url: 'getallvdc',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="vdcfilter"]').empty();
                        $('select[name="vdcfilter"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="vdcfilter"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="vdcfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="vdcfilter"]').on('change', function() {
            var vdc = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(vdc) {
                $.ajax({
                    url: 'getward/'+vdc,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="wardfilter"]').empty();
                        $('select[name="wardfilter"]').append('<option value=""> - Select Ward - </option>');
                        $('select[name="wardfilter"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="wardfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }else{
                $('select[name="wardfilter"]').empty();
                $('select[name="wardfilter"]').append('<option value=""> - Select Ward - </option>');
                $('select[name="wardfilter"]').trigger('change');
                $('.filter-input').removeAttr("disabled");
            }
        });
    });
</script>
@endsection
