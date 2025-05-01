@extends('layouts.home')
@section('styles')

@endsection

@section('content')

<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Operator</h2>
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
            <table id="operator_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{-- Table Headers --}}
                        <th>Operator ID</th>
                        <th>Operator Code</th>
                        <th>Operator Name</th>
                        <th>Operator URL</th>
                        <th>Color Code</th>
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
@include('modal.operator.edit')
@include('modal.operator.delete')
@include('modal.operator.view')
@include('empty.space')
@endsection

@section('scripts')

{{-- Ajax,for serverside procesing --}}
<script>
    $(document).ready(function()
    {
        // Table ID
        $('#operator_table').DataTable(
        {
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('operator.index') }}",
            },
            //All data and columns to be displayed
            columns:
            [{
                data: 'operator_id',
                name: 'operator_id'
            },
            {
                data: 'operator_code',
                name: 'operator_code'
            },
            {
                data: 'operator_name',
                name: 'operator_name'
            },
            {
                data: 'operator_url',
                name: 'operator_url'
            },
            {
                data: 'color_code',
                name: 'color_code',

            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }],
            createdRow: (row, data, dataIndex, cells) => {
        // $(cells[4]).css('background-color', '#'+data.color_code)
        $(cells[4]).css('background-color', data.color_code)
    }
        });



        // Button ID
        $('#create_record').click(function()
        {
            $('#operator_form')[0].reset();

            $('.modal-title').text('Add New Record');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#operatorModal').modal('show');
            $('#action_button').show();
            $('#operator_form').show();
        });
        //Path to be followed upon Add or Edit
        $('#operator_form').on('submit', function(event)
        {
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('operator.store') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('operator.update') }}";
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
                        $('#operator_form')[0].reset();
                        $('#operator_table').DataTable().ajax.reload();
                        $('#action_button').hide();
                    $('#operator_form').hide();
                    setTimeout(function()
                        {
                            $('#operatorModal').modal('hide');
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
            console.log(id);
            $('#form_result').html('');
            $.ajax(
            {
                url :"operator/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#operator_id').val(data.result.operator_id);
                    $('#operator_code').val(data.result.operator_code);
                    $('#operator_name').val(data.result.operator_name);
                    $('#operator_url').val(data.result.operator_url);
                    $('#color_code').val(data.result.color_code);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Record');
                    $('#action_button').val('Save');
                    $('#action').val('Edit');
                    $('#operatorModal').modal('show');
                    $('#action_button').show();
                    $('#operator_form').show();

                }

            })
        });
        //View Button on action
        $(document).on('click', '.view', function()
        {
            var id = $(this).attr('id');
            $.ajax(
            {
                url :"operator/"+id,
                dataType:"json",
                success:function(data)
                {
                    $('#view_operator_id').val(data.result.operator_id);
                    $('#view_operator_code').val(data.result.operator_code);
                    $('#view_operator_name').val(data.result.operator_name);
                    $('#view_operator_url').val(data.result.operator_url);
                    $('#view_color_code').val(data.result.color_code);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('View Record');
                    $('#view_operator_modal').modal('show');
                    $('#view_operator_form').show();
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
                url:"operator/destroy/"+user_id,
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
                        $('#operator_table').DataTable().ajax.reload();
                    }, 1000);
                }
            })
        });
    });
</script>
@endsection
