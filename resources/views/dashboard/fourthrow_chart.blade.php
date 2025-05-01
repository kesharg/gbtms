{{-- Chart Begins --}}
<div class="row">
    
    {{-- Full width cardview --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Infrastructure Data By District</div>

                <div>
                    <select id="infrastructureOptionsDistrict">
                        <option value="microwavenode" selected="selected">Microwave Count</option>
                        <option value="opticalfiberNode">Opticalfiber Length</option>
                        <option value="vsat">Vsat Count</option>
                        <option value="bts">Systemsite Count</option>
                    </select><br />
                </div>
                <button id="showLabeldataByDistrict" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadDistrictData" download="Infrastructure Data By District.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="districtData" width="400" max-height="400"></canvas>
                <script>
                    var microwaveCountDistrict=
                        [
                            @for ($district = 1; $district <=77; $district++ )
                            {{ $districtMicrowaveNode[$district][0] }},
                            @endfor
                        ];
                        var vsatCountDistrict=
                        [
                            @for ($district = 1; $district <=77; $district++ )
                            {{ $districtVsatNode[$district][0] }},
                            @endfor
                        ];
                        var opticalfiberCountDistrict=
                        [
                            @for ($district = 1; $district <=77; $district++ )
                            {{ $districtOpticalfiberLink[$district][0] }},
                            @endfor
                        ];
                        var btsCountDistrict=
                        [
                            @for ($district = 1; $district <=77; $district++ )
                            {{ $districtBts[$district][0] }},
                            @endfor
                        ];
                        var districtName=
                        [@for ($district = 1; $district <=77; $district++ )
                            "{{ ucfirst(strtolower($districtName[$district][0] ))}}",
                            @endfor
                        ];

                    var DataByDistrictChart=new Chart(document.getElementById("districtData"), {
                        type: "bar",

                        data: {
                            labels: districtName,

                            datasets: [{
                                backgroundColor:'#bb86fc',
                                data: microwaveCountDistrict
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            scales: {
                                    xAxes: [{
                                        display: true,
                                        ticks: {
                                            autoSkip: false,
                                            maxRotation: 90,
                                            minRotation: 90
                                        }
                                    }],
                                    yAxes: [{
                                        display: true
                                    }],
                            },
                            legend: {
                                    display: false
                            },
                            title: {
                            display: true,
                            text: 'Total Number of Microwave Node per District'
                                }
                        }
                    });
                    
                    function updateMicrowaveCountDistrict(){
                        DataByDistrictChart.data.datasets[0].data=microwaveCountDistrict;
                        DataByDistrictChart.options.title.text="Total Number of Microwave Node per District";
                        DataByDistrictChart.update();
                    }
                    function updateOpticalfiberCountDistrict(){
                        DataByDistrictChart.data.datasets[0].data=opticalfiberCountDistrict;
                        DataByDistrictChart.options.title.text="Length of Opticalfiber Node per District(km)";
                        DataByDistrictChart.update();
                    }
                    function updateVsatCountDistrict(){
                        DataByDistrictChart.data.datasets[0].data=vsatCountDistrict;
                        DataByDistrictChart.options.title.text="Total Number of VSAT Node per District";
                        DataByDistrictChart.update();
                    }
                    function updateSystemCountDistrict(){
                        DataByDistrictChart.data.datasets[0].data=btsCountDistrict;
                        DataByDistrictChart.options.title.text="Total Number of Base Station Node per District";
                        DataByDistrictChart.update();
                    }
                    function showLabelByDataByDistrictChart(){
                        DataByDistrictChart.options.plugins.datalabels = {
                            color:'#000000',
                            display: true,
                            rotation:90,
                            align: 'center',
                            anchor: 'end',
                            formatter: function(value, index, values) {
                                if(value >0 ){
                                    value = value.toString();
                                    value = value.split(/(?=(?:...)*$)/);
                                    value = value.join(',');
                                    return value;
                                }else{
                                    value = "";
                                    return value;
                                }
                            },
                            font: {
                                weight: 'bold'
                            }
                        };
                        DataByDistrictChart.update();
                    }

                    $("select[id='infrastructureOptionsDistrict']").on('change', function(DataByAdministrativeChart) {
                        if (this.value == "microwavenode") {
                            updateMicrowaveCountDistrict();
                        }
                        if (this.value == "opticalfiberNode") {
                            updateOpticalfiberCountDistrict();
                        }
                        if (this.value == "vsat") {
                            updateVsatCountDistrict();
                        }
                        if (this.value == "bts") {
                            updateSystemCountDistrict();
                        }
                    });
                    document.getElementById("downloadDistrictData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("districtData").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadDistrictData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    var clickedSixthChart=false;
                    document.getElementById("showLabeldataByDistrict").addEventListener('click', function(){
                        if (clickedSixthChart) {
                            DataByDistrictChart.options.plugins.datalabels.display=false;
                            DataByDistrictChart.update();
                            clickedSixthChart=false;
                        }
                        else{
                            showLabelByDataByDistrictChart();
                            clickedSixthChart=true;
                        }

                    });
                </script>
            </div>
        </div>
    </div>

</div>