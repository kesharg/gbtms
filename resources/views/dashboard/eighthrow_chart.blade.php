{{-- Chart Begins --}}
<div class="row">
    
    {{-- Full width cardview --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Population Penetration By District</div>
                <div>
                    <select id="PopulationGenerationOptionsDistricts">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByPopulationDistrict" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadPopulationPenetrationByDistrict" download="Population Penetration By District.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="districtPopulationPenetrationChart" width="400" max-height="400"></canvas>
                <script>
                    var population_penetration_2g_district=
                    [
                        @foreach ($population_penetration_2g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var population_penetration_3g_district=
                    [
                        @foreach ($population_penetration_3g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var population_penetration_4g_district=
                    [
                        @foreach ($population_penetration_4g_district as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                    var districtName=
                    [
                        @for ($district = 1; $district <=77; $district++ )
                        "{{ ucfirst(strtolower($districtName[$district][0] ))}}",
                        @endfor
                    ];

                    var DataByPopulationPenetrationDistrictChart=new Chart(document.getElementById("districtPopulationPenetrationChart"), {
                        type: "bar",

                        data: {
                        labels: districtName,

                        datasets: [{
                            backgroundColor:'rgba(255, 128, 119, 1)',
                            data: population_penetration_2g_district
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
                            text: 'Total Population Penetration per District'
                                }
                        }
                    });
                    
                    function updatePopulationPenetrationDistrict_2g(){
                        DataByPopulationPenetrationDistrictChart.data.datasets[0].data=population_penetration_2g_district;
                        DataByPopulationPenetrationDistrictChart.options.title.text="Total Population Penetration by 2G per District";
                        DataByPopulationPenetrationDistrictChart.update();
                    }
                    function updatePopulationPenetrationDistrict_3g(){
                        DataByPopulationPenetrationDistrictChart.data.datasets[0].data=population_penetration_3g_district;
                        DataByPopulationPenetrationDistrictChart.options.title.text="Total Population Penetration by 3G per District";
                        DataByPopulationPenetrationDistrictChart.update();
                    }
                    function updatePopulationPenetrationDistrict_4g(){
                        DataByPopulationPenetrationDistrictChart.data.datasets[0].data=population_penetration_4g_district;
                        DataByPopulationPenetrationDistrictChart.options.title.text="Total Population Penetration by 4G per District";
                        DataByPopulationPenetrationDistrictChart.update();
                    }
                   
                    function showLabelByDataByPopulationDistrictChart(){
                        DataByPopulationPenetrationDistrictChart.options.plugins.datalabels = {
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
                        DataByPopulationPenetrationDistrictChart.update();
                    }

                    $("select[id='PopulationGenerationOptionsDistricts']").on('change', function(DataByAdministrativeChart) {
                        if (this.value == "2g") {
                            updatePopulationPenetrationDistrict_2g();
                        }
                        if (this.value == "3g") {
                            updatePopulationPenetrationDistrict_3g();
                        }
                        if (this.value == "4g") {
                            updatePopulationPenetrationDistrict_4g();
                        }
                        
                    });
                    
                    document.getElementById("downloadPopulationPenetrationByDistrict").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("districtPopulationPenetrationChart").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadPopulationPenetrationByDistrict");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    var clickedtwelvethChart=false;
                    document.getElementById("showLabeldataByPopulationDistrict").addEventListener('click', function(){
                        if (clickedtwelvethChart) {
                            DataByPopulationPenetrationDistrictChart.options.plugins.datalabels.display=false;
                            DataByPopulationPenetrationDistrictChart.update();
                            clickedtwelvethChart=false;
                        }
                        else{
                            showLabelByDataByPopulationDistrictChart();
                            clickedtwelvethChart=true;
                        }

                    });
                </script>
            </div>
        </div>
    </div>

</div>