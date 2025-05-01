@include('map.mapCharts.coverageChart')
@include('map.mapCharts.geographical_penetration_chart')
<script>
    function openRightMenu() {
				document.getElementById("rightMenu").style.display = "block";
				document.getElementById("openRightMenu").style.display = "none";
				document.getElementById("closeRightMenu").style.opacity = "1";
				document.getElementById("closeRightMenu").style.display = "block";
			}

			function closeRightMenu() {
				document.getElementById("rightMenu").style.display = "none";
				document.getElementById("closeRightMenu").style.display = "none";
				document.getElementById("openRightMenu").style.display ="block";
            }

</script>
<script>
    function hide_print_modal(){
    $("#print_map_modal").modal('hide');
}


function triggerSelectclick(){
    $('#info').css("display","block");
}
function triggerdblSelectclick(){
    $('#info').css("display","none");
}

</script>
<script>
    const gurl_ows = "{{Config::get('geo.GEO_URL')}}/nepal_map/ows";

    $(document).ready(function() {
        $('select[name="province"]').on('change', function() {
            var state_code = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(state_code) {
                $.ajax({
                    url: 'map/getdistrict/'+state_code,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="district"]').empty();
                        $('select[name="district"]').append('<option value=""> - Select District -</option>');
                        $('select[name="district"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="district"]').append('<option value="'+ value +'">'+ value +'</option>');
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
                        $('select[name="district"]').empty();
                        $('select[name="district"]').append('<option value=""> - Select District - </option>');
                        $('select[name="district"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="district"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="district"]').on('change', function() {
            var district = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(district) {
                $.ajax({
                    url: 'map/getvdc/'+district,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="vdc"]').empty();
                        $('select[name="vdc"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="vdc"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="vdc"]').append('<option value="'+ value +'">'+ value +'</option>');
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
                        $('select[name="vdc"]').empty();
                        $('select[name="vdc"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="vdc"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="vdc"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="vdc"]').on('change', function() {
            var vdc = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(vdc) {
                $.ajax({
                    url: 'map/getward/'+vdc,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="ward"]').empty();
                        $('select[name="ward"]').append('<option value=""> - Select Ward - </option>');
                        $('select[name="ward"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="ward"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-input').removeAttr("disabled");
                    }
                });
            }else{
                $('select[name="ward"]').empty();
                $('select[name="ward"]').append('<option value=""> - Select Ward - </option>');
                $('select[name="ward"]').trigger('change');
                $('.filter-input').removeAttr("disabled");
            }
        });
    });

    $(document).ready(function() {
        $('select[name="ex_province"]').on('change', function () {
            var state_code = $(this).val();
            $('.filter-export').attr("disabled", "disabled");
            if (state_code) {
                $.ajax({
                    url: 'map/getdistrict/' + state_code,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="ex_district"]').empty();
                        $('select[name="ex_district"]').append('<option value=""> - Select District -</option>');
                        $('select[name="ex_district"]').trigger('change');
                        $.each(data, function (key, value) {
                            $('select[name="ex_district"]').append('<option value="' + value + '">' + value + '</option>');
                        });
                        $('.filter-export').removeAttr("disabled");
                    }
                });
            } else {
                $.ajax({
                    url: 'getalldistrict',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="ex_district"]').empty();
                        $('select[name="ex_district"]').append('<option value=""> - Select District - </option>');
                        $('select[name="ex_district"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="ex_district"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-export').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="ex_district"]').on('change', function() {
            var district = $(this).val();
            $('.filter-input').attr("disabled", "disabled");
            if(district) {
                $.ajax({
                    url: 'map/getvdc/'+district,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="ex_vdc"]').empty();
                        $('select[name="ex_vdc"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="ex_vdc"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="ex_vdc"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-export').removeAttr("disabled");
                    }
                });
            }else{
                $.ajax({
                    url: 'getallvdc',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="ex_vdc"]').empty();
                        $('select[name="ex_vdc"]').append('<option value=""> - Select VDC - </option>');
                        $('select[name="ex_vdc"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="ex_vdc"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-export').removeAttr("disabled");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('select[name="ex_vdc"]').on('change', function() {
            var vdc = $(this).val();
            $('.filter-export').attr("disabled", "disabled");
            if(vdc) {
                $.ajax({
                    url: 'map/getward/'+vdc,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="ex_ward"]').empty();
                        $('select[name="ex_ward"]').append('<option value=""> - Select Ward - </option>');
                        $('select[name="ex_ward"]').trigger('change');
                        $.each(data, function(key, value) {
                            $('select[name="ex_ward"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                        $('.filter-export').removeAttr("disabled");
                    }
                });
            }else{
                $('select[name="ex_ward"]').empty();
                $('select[name="ex_ward"]').append('<option value=""> - Select Ward - </option>');
                $('select[name="ex_ward"]').trigger('change');
                $('.filter-export').removeAttr("disabled");
            }
        });
        $("#exportdata_as_shape").click(function() {
            selected_vdc=$('select[name="ex_vdc"]').val();
            selected_district=$('select[name="ex_district"]').val();
            selected_province=$('select[name="ex_province"]').val();
            selected_ward=$('select[name="ex_ward"]').val();
            selected_layer=$('select[name="ex_layer"]').val();

            if(selected_vdc && selected_district && selected_province && selected_ward && selected_layer != "" || null)
            {
                wfsurl=   gurl_ows+"?request=GetFeature&service=WFS&version=1.0.0&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}&typeName=nepal_map:";
                cql="+&cql_filter=";
                cql_province=" strToLowerCase(province) ='" + selected_province.toLowerCase() + "'";
                cql_district=" AND strToLowerCase(district) ='" + selected_district.toLowerCase() + "'";
                cql_vdc=" AND strToLowerCase(vdc) ='" + selected_vdc.toLowerCase() + "'";
                cql_ward=" AND strToLowerCase(ward) ='" + selected_ward.toLowerCase() + "'";
                outputformat="+&outputFormat=shape-zip";
                postData= wfsurl+selected_layer+cql+cql_province+cql_district+cql_vdc+cql_ward+outputformat;
                $("#export_attr_shape").attr("href", postData);
            }
            else
            {
                alert("Please input valid data");
            }
        });
        $("#exportdata_as_csv").click(function() {
            selected_vdc=$('select[name="ex_vdc"]').val();
            selected_district=$('select[name="ex_district"]').val();
            selected_province=$('select[name="ex_province"]').val();
            selected_ward=$('select[name="ex_ward"]').val();
            selected_layer=$('select[name="ex_layer"]').val();

            if(selected_vdc && selected_district && selected_province && selected_ward && selected_layer != "" || null)
            {
                wfsurl=   gurl_ows+"?request=GetFeature&service=WFS&version=1.0.0&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}&typeName=nepal_map:";
                cql="+&cql_filter=";
                cql_province=" strToLowerCase(province) ='" + selected_province.toLowerCase() + "'";
                cql_district=" AND strToLowerCase(district) ='" + selected_district.toLowerCase() + "'";
                cql_vdc=" AND strToLowerCase(vdc) ='" + selected_vdc.toLowerCase() + "'";
                cql_ward=" AND strToLowerCase(ward) ='" + selected_ward.toLowerCase() + "'";
                outputformat="+&outputFormat=csv";
                postData= wfsurl+selected_layer+cql+cql_province+cql_district+cql_vdc+cql_ward+outputformat;
                $("#export_attr_csv").attr("href", postData);
            }
            else
            {
                alert("Please input valid data");
            }
        });
        $("#exportdata_as_kml").click(function() {
            selected_vdc=$('select[name="ex_vdc"]').val();
            selected_district=$('select[name="ex_district"]').val();
            selected_province=$('select[name="ex_province"]').val();
            selected_ward=$('select[name="ex_ward"]').val();
            selected_layer=$('select[name="ex_layer"]').val();

            if(selected_vdc && selected_district && selected_province && selected_ward && selected_layer != "" || null)
            {
                wfsurl=   gurl_ows+"?request=GetFeature&service=WFS&version=1.0.0&authkey={!! Config::get('geo.GEO_AUTHKEY') !!}&typeName=nepal_map:";
                cql="+&cql_filter=";
                cql_province=" strToLowerCase(province) ='" + selected_province.toLowerCase() + "'";
                cql_district=" AND strToLowerCase(district) ='" + selected_district.toLowerCase() + "'";
                cql_vdc=" AND strToLowerCase(vdc) ='" + selected_vdc.toLowerCase() + "'";
                cql_ward=" AND strToLowerCase(ward) ='" + selected_ward.toLowerCase() + "'";
                outputformat="+&outputFormat=kml";
                postData= wfsurl+selected_layer+cql+cql_province+cql_district+cql_vdc+cql_ward+outputformat;
                $("#export_attr_kml").attr("href", postData);
            }
            else
            {
                alert("Please input valid data");
            }
        });


});



//Print Modal for map
$('#map_tools').click(function() {
    if (!($('#map_tools_modal .modal.in').length)) {
    $('#map_tools_modal .modal-dialog').css({
      top: 100,
      left: 100
    });
  }

  $('#map_tools_modal').modal({
    backdrop: false,
    show: true
  });

  $('#map_tools_modal .modal-dialog').draggable({
    handle: ".modal-header"
  });
});











</script>
