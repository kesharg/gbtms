{{-- Chart Begins --}}
<div class="row">
    {{-- Leftside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Geographic Penetration By Province</div>
                <div>
                    <select id="CoverageDataByProvinceOptions">
                        <option value="0" selected="selected">1</option>
                        <option value="1">2</option>
                        <option value="2">Bagmati</option>
                        <option value="3">Gandaki</option>
                        <option value="4">5</option>
                        <option value="5">Karnali</option>
                        <option value="6">Sudur Paschim</option>
                    </select>

                    <select id="GenerationOptions">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByhalfDoughnut" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="CoverageDataByProvinceDownload" download="Coverage Data By Province.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="CoverageDataByProvince" width="400" height="400"></canvas>
        <script>

                var coverage_percent_2g_province=
                    [
                        @foreach ($coverage_percent_2g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                var coverage_percent_3g_province=
                    [
                        @foreach ($coverage_percent_3g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                var coverage_percent_4g_province=
                    [
                        @foreach ($coverage_percent_4g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];

                var CoverageDataByProvinceChart= new Chart(document.getElementById("CoverageDataByProvince"), {
                    type: "doughnut",
                    data: {
                        labels: ["Coverage Available", "No Coverage"],
                        datasets: [{
                            backgroundColor:       ['rgba(46, 204, 113, 1)','rgba(189, 204, 183, 1)'],
                            data:[coverage_percent_2g_province[0],(100-coverage_percent_2g_province[0])]
                        }]
                    },
                    options: {

                        rotation: 1 * Math.PI,
                        circumference: 1 * Math.PI,
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        },
                        cutoutPercentage: 45,
                        plugins: {
                            datalabels: {
                                display: false,
                            }
                        },
                        legend:{
                                display:true
                        },
                        title: {
                            display: true,
                            text: 'Province 1 , 2G Coverage in Percentage'
                        }
                    }
                });

                function updatechart(province_index,generation){
                    CoverageDataByProvinceChart.data.datasets[0].data=[eval('coverage_percent_'+generation+'_province')[province_index],100-eval('coverage_percent_'+generation+'_province')[province_index]];
                    CoverageDataByProvinceChart.options.title.text="Povince "+(parseInt(province_index)+1)+" , "+(generation).toUpperCase()+" Coverage in Percentage";
                    CoverageDataByProvinceChart.update();
                }

                function showLabeldataByhalfDoughnut(){
                    CoverageDataByProvinceChart.options.plugins.datalabels = {
                        color:'#ffffff',
                        display: true,
                        align: 'center',
                        anchor: 'center',
                        formatter: function(value, index, values) {
                            if(value >0 ){
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                value = value.join(',');
                                return value;
                            }
                            else
                            {
                                value = "";
                                return value;
                            }
                        },
                        font: {
                        weight: 'bold'
                        }
                    };

                    CoverageDataByProvinceChart.update();
                }


                $("#CoverageDataByProvinceOptions,#GenerationOptions").on('change', function() {
                    var province_index=$("#CoverageDataByProvinceOptions").val();
                    var generation=$("#GenerationOptions").val()
                    updatechart(province_index,generation);
                    console.log(eval('coverage_percent_'+generation+'_province')[province_index]);
                });

                document.getElementById("CoverageDataByProvinceDownload").addEventListener('click',
                function()
                    {
                        var url_base64jp = document.getElementById("CoverageDataByProvince").toDataURL("image/jpg");
                        var a =  document.getElementById("CoverageDataByProvinceDownload");
                        a.href = url_base64jp;
                });

                var clickedninethChart=false;
                document.getElementById("showLabeldataByhalfDoughnut").addEventListener('click',
                function()
                {
                    if (clickedninethChart)
                        {
                            CoverageDataByProvinceChart.options.plugins.datalabels.display=false;
                            CoverageDataByProvinceChart.update();
                            clickedninethChart=false;
                        }
                    else
                        {
                            showLabeldataByhalfDoughnut();
                            clickedninethChart=true;
                        }
                });
                </script>
            </div>
        </div>
    </div>


    {{-- Rightside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Population Penetration By Province</div>
                <div>
                    <select id="PopulationPenetrationByProvinceOptions">
                        <option value="0" selected="selected">1</option>
                        <option value="1">2</option>
                        <option value="2">Bagmati</option>
                        <option value="3">Gandaki</option>
                        <option value="4">5</option>
                        <option value="5">Karnali</option>
                        <option value="6">Sudur Paschim</option>
                    </select>

                    <select id="PopulationGenerationOptions">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByhalfDoughnut2" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="PopulationPenetrationByProvinceDownload" download="Population Penetration By Province.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="PopulationPenetrationByProvince" width="400" height="400"></canvas>
        <script>

                var population_penetration_2g_province=
                    [
                        @foreach ($population_penetration_2g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                var population_penetration_3g_province=
                    [
                        @foreach ($population_penetration_3g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                var population_penetration_4g_province=
                    [
                        @foreach ($population_penetration_4g_province as $key=>$value)
                            {{ $value }},
                        @endforeach
                    ];
                var province_population=
                [
                    @foreach ($province_population as $key=>$value)
                        {{ $value }},
                    @endforeach
                ];
                var PopulationPenetrationByProvinceChart= new Chart(document.getElementById("PopulationPenetrationByProvince"), {
                    type: "doughnut",
                    data: {
                        labels: ["Coverage Available", "No Coverage"],
                        datasets: [{
                            backgroundColor:       ['rgba(255, 128, 119, 1)','rgba(225, 215, 215, 1)'],
                            data:[population_penetration_2g_province[0],(province_population[0]-population_penetration_2g_province[0])]
                        }]
                    },
                    options: {

                        rotation: 1 * Math.PI,
                        circumference: 1 * Math.PI,
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        },
                        cutoutPercentage: 45,
                        plugins: {
                            datalabels: {
                                display: false,
                            }
                        },
                        legend:{
                                display:true
                        },
                        title: {
                            display: true,
                            text: 'Province 1 , 2G Population Coverage in Percentage'
                        }
                    }
                });

                function updatechart2(province_index,generation){
                    PopulationPenetrationByProvinceChart.data.datasets[0].data=[eval('population_penetration_'+generation+'_province')[province_index],province_population[province_index]-eval('population_penetration_'+generation+'_province')[province_index]];
                    PopulationPenetrationByProvinceChart.options.title.text="Povince "+(parseInt(province_index)+1)+" , "+(generation).toUpperCase()+" Coverage in Percentage";
                    PopulationPenetrationByProvinceChart.update();
                }

                function showLabeldataByhalfDoughnut2(){
                    PopulationPenetrationByProvinceChart.options.plugins.datalabels = {
                        color:'#ffffff',
                        display: true,
                        align: 'center',
                        anchor: 'center',
                        formatter: function(value, index, values) {
                            if(value >0 ){
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                value = value.join(',');
                                return value;
                            }
                            else
                            {
                                value = "";
                                return value;
                            }
                        },
                        font: {
                        weight: 'bold'
                        }
                    };

                    PopulationPenetrationByProvinceChart.update();
                }


                $("#PopulationPenetrationByProvinceOptions,#PopulationGenerationOptions").on('change', function() {
                    var province_index=$("#PopulationPenetrationByProvinceOptions").val();
                    var generation=$("#PopulationGenerationOptions").val()
                    updatechart2(province_index,generation);
                    console.log(eval('population_penetration_'+generation+'_province')[province_index]);
                });

                document.getElementById("PopulationPenetrationByProvinceDownload").addEventListener('click',
                function()
                    {
                        var url_base64jp = document.getElementById("PopulationPenetrationByProvince").toDataURL("image/jpg");
                        var a =  document.getElementById("PopulationPenetrationByProvinceDownload");
                        a.href = url_base64jp;
                });

                var clickedtenthChart=false;
                document.getElementById("showLabeldataByhalfDoughnut2").addEventListener('click',
                function()
                {
                    if (clickedtenthChart)
                        {
                            PopulationPenetrationByProvinceChart.options.plugins.datalabels.display=false;
                            PopulationPenetrationByProvinceChart.update();
                            clickedtenthChart=false;
                        }
                    else
                        {
                            showLabeldataByhalfDoughnut2();
                            clickedtenthChart=true;
                        }
                });
                </script>
            </div>
        </div>
    </div>


</div>

