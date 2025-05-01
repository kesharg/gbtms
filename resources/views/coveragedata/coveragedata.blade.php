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
@include('coveragedata.coverage_filter')
<div class="card mb-5">
    <div class="card-header">
        {{-- Card Head --}}
        <h2>Coverage Data</h2>
    </div>
    <div class="card-body">

@include('coveragedata.coveragedata_export')
        <div class="table-responsive">
            {{-- Table info --}}
            <table id="coverage_table" class="table table-sm table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        {{-- Table Headers --}}

                        <th>Operator Code</th>
                        <th>Generation</th>
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
    var table= $('#coverage_table').DataTable(
        {
            sDom: 'lrtip',
            searching:true,
            processing: true,
            serverSide: true,
            ajax:
            {
                // Path for indexing
                url: "{{ route('coveragedata.index') }}",

            },

            //All data and columns to be displayed
            columns:
            [{
                data: 'oprcd',
                name: 'oprcd'
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
        ]
        });


        $('#oprcdfilter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
        $('#generation_type_filter').change(function(){
            table.column($(this).data('column')).search($(this).val()).draw();
        });
    });


    $(document).ready(function() {
        $('select[name="provincefilter"]').on('change', function() {
            var province = $(this).val();
            if(province) {
                $.ajax({
                    url: 'getdistrict/'+province,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="districtfilter"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="districtfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'getalldistrict',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="districtfilter"]').empty();
                        $('select[name="districtfilter"]').append('<option value=""> - Select Province - </option>');
                        $.each(data, function(key, value) {
                            $('select[name="districtfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="districtfilter"]').on('change', function() {
            var district = $(this).val();
            if(district) {
                $.ajax({
                    url: 'getvdc/'+district,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="vdcfilter"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="vdcfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
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
                        $.each(data, function(key, value) {
                            $('select[name="vdcfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="vdcfilter"]').on('change', function() {
            var vdc = $(this).val();
            if(vdc) {
                $.ajax({
                    url: 'getward/'+vdc,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="wardfilter"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="wardfilter"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="wardfilter"]').empty();
            }
        });
    });

</script>
@endsection
