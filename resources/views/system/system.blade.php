@extends('layouts.home')

@section('content')
@include('system.system_filter')
    <div class="card-header">
        {{-- Card Head --}}
        <h2>System (BTS)</h2>
    </div>
    <div class="card-body">
        @include('system.system_export')
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="System_table" class="table table-bordered table-striped" width="100%">
                <thead>
                   <tr>
                        {{-- Table Headers --}}
                        <th>System ID</th>
                        <th>Operator Code</th>
                        <th>Device ID</th>
                        <th>Azimuth</th>
                        <th>Tilt</th>
                        <th class="text-left">Antenna Gain (db)</th>
                        <th class="text-left">Transmitted Power (dBm)</th>
                        <th>Operation Date</th>
                        <th>Polarization</th>
                        <th>Status</th>
                        <th>Type</th>
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
     var systemTable=   $('#System_table').DataTable(
        {
            //Default search of datatable is hidden
            sDom: 'lrtip',
            //These functions are set to true
            searching:true,
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('system.index') }}",
                //for from x date to y date filter
                // data: function(d) {
                //     d.date_from = $('#date_from').val();
                //     d.date_to = $('#date_to').val();
                // }
            },
            //left align numeric values
            "columnDefs":
            [{
                className: "align-right", "targets": [5,6]
            }],
            //All data and columns to be displayed
            columns:
            [{
                data: 'syssiteid',
                name: 'syssiteid'
            },
            {
                data: 'oprcd',
                name: 'oprcd'
            },
            {
                data: 'deviceid',
                name: 'deviceid'
            },
            {
                data: 'azimuth',
                name: 'azimuth'
            },
            {
                data: 'tilt',
                name: 'tilt'
            },
            {
                data: 'antgain',
                name: 'antgain'
            },
            {
                data: 'transpwr',
                name: 'transpwr'
            },
            {
                data: 'oprdate',
                name: 'oprdate'
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
                data: 'type',
                name: 'type'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
            {
                data: 'status',
                name: 'status',
                visible:false
            },
            {
                data: 'type',
                name: 'type',
                visible:false
            }]
        });

        $('#oprcdfilter').change(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#polarizfilter').keyup(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#syssiteidfilter').keyup(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#deviceidfilter').keyup(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#statusfilter').change(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#typefilter').change(function(){
            systemTable.column($(this).data('column')).search($(this).val()).draw();
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
            var oprcd = $('#oprcdfilter').val();
            var polariz = $('#polarizfilter').val();
            var syssiteid = $('#syssiteidfilter').val();
            var deviceid = $('#deviceidfilter').val();
            var status = $('#statusfilter').val();
            var typeVal = $('#typefilter').val();
            var base_url = '{{env('GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:sys_n_site_wg+&authkey={{env('GEO_Authkey')}}'
            var cql_param = "&CQL_FILTER=1=1";
            $('.export').attr("disabled", "disabled");
            if ($(this).val().length > 0) {
                $(this).addClass("border border-success bg-light");
            } else {
                $(this).removeClass("border border-success bg-light");
            }
            if (oprcd) {
                cql_param += " AND strToLowerCase(oprcd) ='" + oprcd.toLowerCase()  + "'";
            }
            if (polariz) {
                cql_param += " AND strToLowerCase(polariz) ILIKE'%" + polariz.toLowerCase()  + "%'";
            }
            if (syssiteid) {
                cql_param += " AND strToLowerCase(syssiteid) ILIKE'%" + syssiteid.toLowerCase()  + "%'";
            }
            if (deviceid) {
                cql_param += " AND strToLowerCase(deviceid) ILIKE'%" + deviceid.toLowerCase()  + "%'";
            }
            if (status) {
                cql_param += " AND strToLowerCase(status) ='" + status.toLowerCase()  + "'";
            }
            if (typeVal) {
                cql_param += " AND strToLowerCase(typeVal) ='" + typeVal.toLowerCase()  + "'";
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

        //for from x date to y date filter

        // $('#date_from, #date_to').datepicker({
        //     format: 'yyyy-mm-dd',
        //     todayHighlight: true,
        //     orientation: "bottom left"
        // });
        // $('#date_from, #date_to').focus(function(){
        //     $(this).blur();
        // });
        // $('#date_from').on("change", function(){
        //     //when date_from is chosen, make date_to start from the chosen date
        //     var startVal = $('#date_from').val();
        //     $('#date_to').data('datepicker').setStartDate(startVal);
        //     console.log(startVal);
        //     systemTable.draw();
        // });
        // $('#date_to').on("change", function(){
        //     //when date_to is chosen, make date_from end at the chosen date
        //     var endVal = $('#date_to').val();
        //     if($(this).val()!=="" && getFormattedDate($('#date_from').data('datepicker').getEndDate())!== endVal)
        //         $('#date_from').data('datepicker').setEndDate(endVal);
        //     systemTable.draw();
        // });
        // // $('#date_from, #date_to').on("change", function(){
        // //     systemTable.draw();
        // // });
        //
        // function getFormattedDate(datePickerDate) {
        //     var date = new Date(datePickerDate),
        //         month = ("0" + (date.getMonth() + 1)).slice(-2),
        //         day = ("0" + date.getDate()).slice(-2);
        //     return [date.getFullYear(), month, day].join("-");
        // }

    });



</script>
@endsection

