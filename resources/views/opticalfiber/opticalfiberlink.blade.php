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
    @include('opticalfiber.filters.opticalfiberlinks_filter')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Optical Fiber Link</h2>
    </div>
    <div class="card-body">
        <div class="pull-right mt-2 mb-4">
            {{-- Button Info --}}
            {{-- <button type="button" name="create_record" id="create_record" class="btn btn-primary">Create
                a new
                Record</button> --}}
        </div>
        @include('opticalfiber.exports.opticalfiberlink_export')
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="OFL_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Code by NTA</th>
                        <th>Operator Code</th>
                        <th>Link Name</th>
                        <th>Link ID by Operator</th>
                        <th class="text-left">Segment Length</th>
                        <th>Cable Type</th>
                        <th class="text-left">No Of Fibers</th>
                        <th class="text-left">Capacity(dB)</th>
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
{{--@include('modal.opticalfiber.edit')
@include('modal.opticalfiber.delete')
@include('modal.opticalfiber.view')--}}
@include('empty.space')
@endsection

@section('scripts')

{{-- Ajax,for serverside procesing --}}
<script>
    $(document).ready(function()
    {
        // Table ID
        var table = $('#OFL_table').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('opticalfiberlink.index') }}",
            },
            //left align numeric values
            "columnDefs":
            [{
                className: "align-right", "targets": [4,6,7]
            }],
            //All data and columns to be displayed
            columns:
            [{
                data: 'oflinkid',
                name: 'oflinkid'
            },
                {
                    data: 'oprcd',
                    name: 'oprcd'
                },
            {
                data: 'linkname',
                name: 'linkname'
            },
            {
                data: 'oprlinkid',
                name: 'oprlinkid'
            },

            {
                data: 'length',
                name: 'length'
            },
            {
                data: 'cabletype',
                name: 'cabletype'
            },
            {
                data: 'fibers',
                name: 'fibers'
            },
            {
                data: 'capacity',
                name: 'capacity'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }]
        });
        //FILTERS

        $('#cablefilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#oprcdfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#linknamefilter').keyup(function(){
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
            var cable = $('#cablefilter').val();
            var linkname = $('#linknamefilter').val();
            var oprcd = $('#oprcdfilter').val();
            var base_url = '{{Config::get('geo.GEO_URL')}}/nepal_map/wfs?request=GetFeature&service=WFS&version=1.0.0&typeName=nepal_map:opticalfiberlinks_new+&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}'
            var cql_param = "&CQL_FILTER=1=1";
            $('.export').attr("disabled", "disabled");
            if ($(this).val().length > 0) {
                $(this).addClass("border border-success bg-light");
            } else {
                $(this).removeClass("border border-success bg-light");
            }
            if (cable) {
                cql_param += " AND strToLowerCase(cabletype) ='" + cable.toLowerCase()  + "'";
            }
            if (linkname) {
                cql_param += " AND strToLowerCase(linkname) ='" + linkname.toLowerCase()  + "'";
            }
            if (oprcd) {
                cql_param += " AND strToLowerCase(oprcd) ='" + oprcd.toLowerCase()  + "'";
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
        // Button ID
        {{--$('#create_record').click(function()--}}
        {{--{--}}
        {{--    $('#opticalfiber_form')[0].reset();--}}

        {{--    $('.modal-title').text('Add New Record');--}}
        {{--    $('#action_button').val('Add');--}}
        {{--    $('#action').val('Add');--}}
        {{--    $('#form_result').html('');--}}
        {{--    $('#opticalfiberModal').modal('show');--}}
        {{--    $('#action_button').show();--}}
        {{--    $('#opticalfiber_form').show();--}}
        {{--});--}}
        {{--//Path to be followed upon Add or Edit--}}
        {{--$('#opticalfiber_form').on('submit', function(event)--}}
        {{--{--}}
        {{--    event.preventDefault();--}}
        {{--    var action_url = '';--}}

        {{--    if($('#action').val() == 'Add')--}}
        {{--    {--}}
        {{--        action_url = "{{ route('opticalfiber.store') }}";--}}
        {{--    }--}}

        {{--    if($('#action').val() == 'Edit')--}}
        {{--    {--}}
        {{--        action_url = "{{ route('opticalfiber.update') }}";--}}
        {{--    }--}}

        {{--    $.ajax(--}}
        {{--    {--}}
        {{--        url: action_url,--}}
        {{--        method:"POST",--}}
        {{--        data:$(this).serialize(),--}}
        {{--        dataType:"json",--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            var html = '';--}}
        {{--            //If any error occurs during data trasmission--}}
        {{--            if(data.errors)--}}
        {{--            {--}}
        {{--                html = '<div class="alert alert-danger">';--}}
        {{--                for(var count = 0; count < data.errors.length; count++)--}}
        {{--                {--}}
        {{--                    html += '<p>' + data.errors[count] + '</p>';--}}
        {{--                }--}}
        {{--                html += '</div>';--}}
        {{--            }--}}
        {{--            //Upon Successful Transmission--}}
        {{--            if(data.success)--}}
        {{--            {--}}
        {{--                html = '<div class="alert alert-success">' + data.success + '</div>';--}}
        {{--                $('#opticalfiber_form')[0].reset();--}}
        {{--                $('#OFS_table').DataTable().ajax.reload();--}}
        {{--                $('#action_button').hide();--}}
        {{--            $('#opticalfiber_form').hide();--}}
        {{--            setTimeout(function()--}}
        {{--                {--}}
        {{--                    $('#opticalfiberModal').modal('hide');--}}
        {{--                }, 1000);--}}
        {{--            }--}}
        {{--            $('#form_result').html(html);--}}


        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        {{--//Edit Button on action--}}
        {{--$(document).on('click', '.edit', function()--}}
        {{--{--}}
        {{--    var id = $(this).attr('id');--}}
        {{--    $('#form_result').html('');--}}
        {{--    $.ajax(--}}
        {{--    {--}}
        {{--        url :"opticalfiber/"+id+"/edit",--}}
        {{--        dataType:"json",--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            $('#lnkcoden').val(data.result.lnkcoden);--}}
        {{--            $('#lnkidoprt').val(data.result.lnkidoprt);--}}
        {{--            $('#lnkname').val(data.result.lnkname);--}}
        {{--            $('#totlength').val(data.result.totlength);--}}
        {{--            $('#orignode').val(data.result.orignode);--}}
        {{--            $('#endnode').val(data.result.endnode);--}}
        {{--            $('#hidden_id').val(id);--}}
        {{--            $('.modal-title').text('Edit Record');--}}
        {{--            $('#action_button').val('Edit');--}}
        {{--            $('#action').val('Edit');--}}
        {{--            $('#opticalfiberModal').modal('show');--}}
        {{--            $('#action_button').show();--}}
        {{--            $('#opticalfiber_form').show();--}}

        {{--        }--}}

        {{--    })--}}
        {{--});--}}
        {{--//View Button on action--}}
        {{--$(document).on('click', '.view', function()--}}
        {{--{--}}
        {{--    var id = $(this).attr('id');--}}
        {{--    $.ajax(--}}
        {{--    {--}}
        {{--        url :"opticalfiber/"+id,--}}
        {{--        dataType:"json",--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            $('#view_lnkcoden').val(data.result.lnkcoden);--}}
        {{--            $('#view_lnkidoprt').val(data.result.lnkidoprt);--}}
        {{--            $('#view_lnkname').val(data.result.lnkname);--}}
        {{--            $('#view_totlength').val(data.result.totlength);--}}
        {{--            $('#view_orignode').val(data.result.orignode);--}}
        {{--            $('#view_endnode').val(data.result.endnode);--}}
        {{--            $('#hidden_id').val(id);--}}
        {{--            $('.modal-title').text('View Record');--}}
        {{--            $('#view_opticalfiber_modal').modal('show');--}}
        {{--            $('#view_opticalfiber_form').show();--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}
        {{--//Map Button on action--}}
        {{--$(document).on('click', '.map', function()--}}
        {{--{var id = $(this).attr('id');--}}
        {{--    $.ajax(--}}
        {{--    {--}}
        {{--        url :"opticalfiber/"+id,--}}
        {{--        dataType:"json",--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            $('#display_map').modal('show');--}}

        {{--        }--}}
        {{--    })--}}
        {{--});--}}
        {{--var user_id;--}}
        {{--//Delete Button on action--}}
        {{--$(document).on('click', '.delete', function()--}}
        {{--{--}}
        {{--    user_id = $(this).attr('id');--}}
        {{--    $('#ok_delete').text('Delete');--}}
        {{--    $('#confirmModal').modal('show');--}}
        {{--    $('#title_data').text('Confirmation');--}}
        {{--    $('#body_data').html ('Are you sure you want to remove this data?');--}}
        {{--    $('#ok_delete').show();--}}
        {{--    $('#cancel_delete').show();--}}
        {{--});--}}
        {{--$('#ok_delete').click(function()--}}
        {{--{--}}
        {{--    $.ajax(--}}
        {{--    {--}}
        {{--        url:"opticalfiber/destroy/"+user_id,--}}
        {{--        beforeSend:function()--}}
        {{--        {--}}
        {{--            $('#ok_delete').text('Deleting...');--}}
        {{--        },--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            $('#ok_delete').hide();--}}
        {{--            $('#cancel_delete').hide();--}}
        {{--            $('#title_data').text('Data Deleted');--}}
        {{--            $('#body_data').html ('<div class="alert alert-success">Data Has Been Deleted Successfully<div>');--}}


        {{--            setTimeout(function()--}}
        {{--            {--}}
        {{--                $('#confirmModal').modal('hide');--}}
        {{--                $('#OFS_table').DataTable().ajax.reload();--}}
        {{--            }, 1000);--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}
    });
</script>
@endsection
