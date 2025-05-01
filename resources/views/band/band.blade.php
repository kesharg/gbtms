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
        <h2>Band</h2>
    </div>
    <div class="card-body">
        <div class="pull-right mt-2 mb-4">
            {{-- Button Info --}}
            <button type="button" name="create_record" id="create_record" class="btn btn-primary">Create
                a new
                Record</button>
        </div>
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="band_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Band Code</th>
                        <th>Band Name</th>
                        <th>Band Category</th>
                        <th>Tx/Rx Frequency</th>
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
@include('modal.band.edit')
@include('modal.band.delete')
@include('modal.band.view')
@include('empty.space')
@endsection

@section('scripts')

{{-- Ajax,for serverside procesing --}}
<script>
    $(document).ready(function()
    {
        // Table ID
        $('#band_table').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('band.index') }}",
            },
            //All data and columns to be displayed
            columns:
            [{
                data: 'band_code',
                name: 'band_code'
            },
            {
                data: 'band_name',
                name: 'band_name'
            },
            {
                data: 'band_category',
                name: 'band_category'
            },
            {
                data: 'tx_rx_frequency',
                name: 'tx_rx_frequency'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }]
        });
        // Button ID
        $('#create_record').click(function()
        {
            $('#band_form')[0].reset();

            $('.modal-title').text('Add New Record');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#bandModal').modal('show');
            $('#action_button').show();
            $('#band_form').show();
        });
        //Path to be followed upon Add or Edit
        $('#band_form').on('submit', function(event)
        {
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('band.store') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('band.update') }}";
            }

            $.ajax(
            {
                url: action_url,
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    //If any error occurs during data trasmission
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    //Upon Successful Transmission
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#band_form')[0].reset();
                        $('#band_table').DataTable().ajax.reload();
                        $('#action_button').hide();
                    $('#band_form').hide();
                    setTimeout(function()
                        {
                            $('#bandModal').modal('hide');
                        }, 1000);
                    }
                    $('#form_result').html(html);


                }
            });
        });
        //Edit Button on action
        $(document).on('click', '.edit', function()
        {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax(
            {
                url :"band/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#band_code').val(data.result.band_code);
                    $('#band_name').val(data.result.band_name);
                    $('#band_category').val(data.result.band_category);
                    $('#tx_rx_frequency').val(data.result.tx_rx_frequency);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Record');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#bandModal').modal('show');
                    $('#action_button').show();
                    $('#band_form').show();

                }

            })
        });
        //View Button on action
        $(document).on('click', '.view', function()
        {
            var id = $(this).attr('id');
            $.ajax(
            {
                url :"band/"+id,
                dataType:"json",
                success:function(data)
                {
                    $('#view_band_code').val(data.result.band_code);
                    $('#view_band_name').val(data.result.band_name);
                    $('#view_band_category').val(data.result.band_category);
                    $('#view_tx_rx_frequency').val(data.result.tx_rx_frequency);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('View Record');
                    $('#view_band_modal').modal('show');
                    $('#view_band_form').show();
                }
            })
        });
        var user_id;
        //Delete Button on action
        $(document).on('click', '.delete', function()
        {
            user_id = $(this).attr('id');
            $('#ok_delete').text('Delete');
            $('#confirmModal').modal('show');
            $('#title_data').text('Confirmation');
            $('#body_data').html ('Are you sure you want to remove this data?');
            $('#ok_delete').show();
            $('#cancel_delete').show();
        });
        $('#ok_delete').click(function()
        {
            $.ajax(
            {
                url:"band/destroy/"+user_id,
                beforeSend:function()
                {
                    $('#ok_delete').text('Deleting...');
                },
                success:function(data)
                {
                    $('#ok_delete').hide();
                    $('#cancel_delete').hide();
                    $('#title_data').text('Data Deleted');
                    $('#body_data').html ('<div class="alert alert-success">Data Has Been Deleted Successfully<div>');


                    setTimeout(function()
                    {
                        $('#confirmModal').modal('hide');
                        $('#band_table').DataTable().ajax.reload();
                    }, 1000);
                }
            })
        });
    });
</script>
@endsection
