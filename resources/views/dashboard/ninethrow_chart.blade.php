{{-- Chart Begins --}}
<div class="row">
    {{-- Leftside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Coverage Data By District</div>
                <div>
                    <select id="GenerationOptionbyDistricts">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByhalfDoughnut3" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="CoverageDataByDistrictDownload" download="Coverage Data By District.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="CoverageDataByDistrict" width="400" height="400"></canvas>
                
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
                var coverage_count_2g_district = (coverage_percent_2g_district.filter(item => item !== 0)).length;
                var coverage_count_3g_district = (coverage_percent_3g_district.filter(item => item !== 0)).length;
                var coverage_count_4g_district = (coverage_percent_4g_district.filter(item => item !== 0)).length;

                var CoverageDataByDistrictChart= new Chart(document.getElementById("CoverageDataByDistrict"), {
                    type: "doughnut",
                    data: {
                        labels: ["Coverage Available", "No Coverage"],
                        datasets: [{
                            backgroundColor:       ['rgba(46, 204, 113, 1)','rgba(189, 204, 183, 1)'],
                            data:[coverage_count_2g_district,(77-coverage_count_2g_district)]
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
                            text: 'Total 2G Coverage in number by District'
                        }
                    }
                });

                function updateCoveragebyDistrict_2g(){
                        CoverageDataByDistrictChart.data.datasets[0].data=[coverage_count_2g_district,(77-coverage_count_2g_district)];
                        CoverageDataByDistrictChart.options.title.text="Total 2G Coverage in number by District";
                        CoverageDataByDistrictChart.update();
                    }
                    function updateCoveragebyDistrict_3g(){
                        CoverageDataByDistrictChart.data.datasets[0].data=[coverage_count_3g_district,(77-coverage_count_3g_district)];
                        CoverageDataByDistrictChart.options.title.text="Total 3G Coverage in number by District";
                        CoverageDataByDistrictChart.update();
                    }
                    function updateCoveragebyDistrict_4g(){
                        CoverageDataByDistrictChart.data.datasets[0].data=[coverage_count_4g_district,(77-coverage_count_4g_district)];
                        CoverageDataByDistrictChart.options.title.text="Total 4G Coverage in number by District";
                        CoverageDataByDistrictChart.update();
                    }
                function showLabeldataByhalfDoughnut3(){
                    CoverageDataByDistrictChart.options.plugins.datalabels = {
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

                    CoverageDataByDistrictChart.update();
                }


                $("select[id='GenerationOptionbyDistricts']").on('change', function(DataByCoveragePerProvinceChart) {
                        if (this.value == "2g") {
                            updateCoveragebyDistrict_2g();
                        }
                        if (this.value == "3g") {
                            updateCoveragebyDistrict_3g();
                        }
                        if (this.value == "4g") {
                            updateCoveragebyDistrict_4g();
                        }
                        
                    });

                document.getElementById("CoverageDataByDistrictDownload").addEventListener('click',
                function()
                    {
                        var url_base64jp = document.getElementById("CoverageDataByDistrict").toDataURL("image/jpg");
                        var a =  document.getElementById("CoverageDataByDistrictDownload");
                        a.href = url_base64jp;
                });

                var clickedthirteenthChart=false;
                document.getElementById("showLabeldataByhalfDoughnut3").addEventListener('click',
                function()
                {
                    if (clickedthirteenthChart)
                        {
                            CoverageDataByDistrictChart.options.plugins.datalabels.display=false;
                            CoverageDataByDistrictChart.update();
                            clickedthirteenthChart=false;
                        }
                    else
                        {
                            showLabeldataByhalfDoughnut3();
                            clickedthirteenthChart=true;
                        }
                });
                </script>
            </div>
        </div>
    </div>

    
    {{-- Right side cardview --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Geographic penetration for coverage</div>

                <div>
                    <select id="GenerationOptionsCoverage">
                        <option value="2g" selected="selected">2G</option>
                        <option value="3g">3G</option>
                        <option value="4g">4G</option>
                    </select>
                </div>
                <button id="showLabeldataByProvinceCoverage" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadProvinceCoverageData" download="Infrastructure Data By Province.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="GenerationCoveragePerProvince" width="400" height="400"></canvas>

                <script>
                    var dynamicProvincefromController=
                        [
                            @foreach ($provinceNameForCharts as $provinceName)
                            '{{ $provinceName }}',
                            @endforeach
                        ];
                    var dynamicProvinceColorfromController=
                        [
                            @for ($i = 0; $i < $provinceCount; $i++ )
                            "{{ $provinceColorArray[$i] }}" ,
                            @endfor
                        ];
                    var coverage_2g_per_province=
                        [
                            @foreach ($coverage_percent_2g_province as $key=>$value)
                                {{ $value }},
                            @endforeach
                        ];
                    var coverage_3g_per_province=
                        [
                            @foreach ($coverage_percent_3g_province as $key=>$value)
                                {{ $value }},
                            @endforeach
                        ];
                    var coverage_4g_per_province=
                        [
                            @foreach ($coverage_percent_4g_province as $key=>$value)
                                {{ $value }},
                            @endforeach
                        ];

                    var DataByCoveragePerProvinceChart=new Chart(document.getElementById("GenerationCoveragePerProvince"), {
                        type: "bar",

                        data: {
                            labels: dynamicProvincefromController,
                            datasets: [{
                            backgroundColor: dynamicProvinceColorfromController,
                            data: coverage_2g_per_province
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            legend: {
                                    display: false
                            },
                            title: {
                                display: true,
                                text: 'Coverage Area of 2G per province'
                            }
                        }
                    });

                    function update_coverage2gperprovince(){
                        DataByCoveragePerProvinceChart.data.datasets[0].data=coverage_2g_per_province;
                        DataByCoveragePerProvinceChart.options.title.text="Coverage Area of 2G per province";
                        DataByCoveragePerProvinceChart.update();
                    }
                    function update_coverage3gperprovince(){
                        DataByCoveragePerProvinceChart.data.datasets[0].data=coverage_3g_per_province;
                        DataByCoveragePerProvinceChart.options.title.text="Coverage Area of 3G per province";
                        DataByCoveragePerProvinceChart.update();
                    }
                    function update_coverage4gperprovince(){
                        DataByCoveragePerProvinceChart.data.datasets[0].data=coverage_4g_per_province;
                        DataByCoveragePerProvinceChart.options.title.text="Coverage Area of 4G per province";
                        DataByCoveragePerProvinceChart.update();
                    }
                    function showLabelByProvinceCoverage(){
                        DataByCoveragePerProvinceChart.options.plugins.datalabels = {
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
                                }else{
                                    value = "";
                                    return value;
                                }
                            },
                            font: {
                                weight: 'bold'
                            }
                        };

                        DataByCoveragePerProvinceChart.update();
                    }

                    $("select[id='GenerationOptionsCoverage']").on('change', function(DataByCoveragePerProvinceChart) {
                        if (this.value == "2g") {
                            update_coverage2gperprovince();
                        }
                        if (this.value == "3g") {
                            update_coverage3gperprovince();
                        }
                        if (this.value == "4g") {
                            update_coverage4gperprovince();
                        }
                    });

                    var clickedSecondChart=false;
                    document.getElementById("showLabeldataByProvinceCoverage").addEventListener('click', function(){
                        if (clickedSecondChart) {
                            DataByCoveragePerProvinceChart.options.plugins.datalabels.display=false;
                            DataByCoveragePerProvinceChart.update();
                            clickedSecondChart=false;
                        }
                        else{
                            showLabelByProvinceCoverage();
                            clickedSecondChart=true;
                        }
                    });
                    document.getElementById("downloadProvinceCoverageData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("GenerationCoveragePerProvince").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadProvinceCoverageData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });
                </script>
            </div>
        </div>
    </div>
</div>

