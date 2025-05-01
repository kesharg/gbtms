{{-- Chart Begins --}}
<div class="row">
    
    {{-- Full width cardview --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Coverage Data By District</div>
                <div>
                    <select id="GenerationOptionsDistricts">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByCoverageDistrict" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadCoverageDistrictData" download="Coverage Data By District.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="districtCoverageData" width="400" max-height="400"></canvas>
                <script>
                    var coverage_percent_2g_district=
                    [
                        @foreach ($coverage_percent_2g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var coverage_percent_3g_district=
                    [
                        @foreach ($coverage_percent_3g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var coverage_percent_4g_district=
                    [
                        @foreach ($coverage_percent_4g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var districtName=
                    [
                        @for ($district = 1; $district <=77; $district++ )
                        "{{ ucfirst(strtolower($districtName[$district][0] ))}}",
                        @endfor
                    ];

                    var DataByCoverageDistrictChart=new Chart(document.getElementById("districtCoverageData"), {
                        type: "bar",

                        data: {
                        labels: districtName,

                        datasets: [{
                            backgroundColor:'rgba(46, 204, 113, 1)',
                            data: coverage_percent_2g_district
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
                            text: 'Total Coverage Data per District'
                                }
                        }
                    });
                    
                    function updateCoverageDistrict_2g(){
                        DataByCoverageDistrictChart.data.datasets[0].data=coverage_percent_2g_district;
                        DataByCoverageDistrictChart.options.title.text="Total Coverage Data by 2G per District";
                        DataByCoverageDistrictChart.update();
                    }
                    function updateCoverageDistrict_3g(){
                        DataByCoverageDistrictChart.data.datasets[0].data=coverage_percent_3g_district;
                        DataByCoverageDistrictChart.options.title.text="Total Coverage Data by 3G per District";
                        DataByCoverageDistrictChart.update();
                    }
                    function updateCoverageDistrict_4g(){
                        DataByCoverageDistrictChart.data.datasets[0].data=coverage_percent_4g_district;
                        DataByCoverageDistrictChart.options.title.text="Total Coverage Data by 4G per District";
                        DataByCoverageDistrictChart.update();
                    }
                   
                    function showLabelByDataByCoverageDistrictChart(){
                        DataByCoverageDistrictChart.options.plugins.datalabels = {
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
                        DataByCoverageDistrictChart.update();
                    }

                    $("select[id='GenerationOptionsDistricts']").on('change', function(DataByAdministrativeChart) {
                        if (this.value == "2g") {
                            updateCoverageDistrict_2g();
                        }
                        if (this.value == "3g") {
                            updateCoverageDistrict_3g();
                        }
                        if (this.value == "4g") {
                            updateCoverageDistrict_4g();
                        }
                        
                    });
                    
                    document.getElementById("downloadCoverageDistrictData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("districtCoverageData").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadCoverageDistrictData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    var clickedeleventhChart=false;
                    document.getElementById("showLabeldataByCoverageDistrict").addEventListener('click', function(){
                        if (clickedeleventhChart) {
                            DataByCoverageDistrictChart.options.plugins.datalabels.display=false;
                            DataByCoverageDistrictChart.update();
                            clickedeleventhChart=false;
                        }
                        else{
                            showLabelByDataByCoverageDistrictChart();
                            clickedeleventhChart=true;
                        }

                    });
                </script>
            </div>
        </div>
    </div>

</div>