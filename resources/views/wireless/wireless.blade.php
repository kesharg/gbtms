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

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Wireless Site</h2>
    </div>
    <div class="card-body">
        <div class="pull-right mt-2 mb-4">
            {{-- Button Info --}}
            {{-- <button type="button" name="create_record" id="create_record" class="btn btn-primary">Create
                a new
                Record</button> --}}
        </div>
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="wireless_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Wireless ID</th>
                        <th>Site Name</th>
                        <th class="text-left">District</th>
                        <th class="text-left">Lat</th>
                        <th class="text-left">Long</th>
                        <th>Radiomodel</th>
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
        $('#wireless_table').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('wireless.index') }}",
            },
            //left align numeric values
            "columnDefs": 
            [{ 
                className: "align-right", "targets": [2,3,4] 
            }],
            //All data and columns to be displayed
            columns:
            [{
                data: 'wrlstid',
                name: 'wrlstid'
            },
            {
                data: 'oprsitename',
                name: 'oprsitename'
            },
            {
                data: 'district',
                name: 'district'
            },
            {
                data: 'lat',
                name: 'lat'
            },
            {
                data: 'long',
                name: 'long'
            },
            {
                data: 'radiomodel',
                name: 'radiomodel'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }]
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
