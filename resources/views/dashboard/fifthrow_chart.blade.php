{{-- Chart Begins --}}
<div class="row">
    {{-- Leftside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Nodes Data By Operator(Bar Chart)</div>
                <div>
                    <select id="piedataByOperatorOptions">
                        <option value="microwavenode" selected="selected">Microwave Nodes</option>
                        <option value="opticalfiberNode">Opticalfiber Node</option>
                        <option value="vsat">Vsat Node</option>
                        <option value="bts">Systemsite Node</option>
                    </select><br />
                </div>
                <button id="showLabeldataByBar" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="piedownloadOperatorData" download="Infrastructure Data By Operator.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="piedataByOperator" width="400" height="400"></canvas>

                <script>
                    var dynamicOperatorfromController=
                    [
                        @foreach ($operatorName as $operators)
                        '{{ $operators }}',
                        @endforeach
                    ];
                    var dynamicColorfromController=
                    [
                        @foreach ($operatorColor as $colorcode)
                        '{{ $colorcode }}',
                        @endforeach
                    ];
                    var microwaveDataByOperatorfromControllerpie=
                    [
                        @foreach ($microwaveNode as $microwave)
                        {{ $microwave }},
                        @endforeach
                    ];
                    var vsatDataByOperatorfromControllerpie=
                    [
                        @foreach ($vsatNode as $vsat)
                        {{ $vsat }},
                        @endforeach
                    ];
                    var systemDataByOperatorfromControllerpie=
                    [
                        @foreach ($systemSiteNode as $system)
                        {{ $system }},
                        @endforeach
                    ];
                    var opticalfiberDataByOperatorfromControllerpie=
                    [
                        @foreach ($opticalfiberNode as $opticalfiber)
                        {{ $opticalfiber }},
                        @endforeach
                    ];

                    var DataByOperatorChartpie= new Chart(document.getElementById("piedataByOperator"), {
                        type: "bar",
                        data: {
                            labels: dynamicOperatorfromController,
                            datasets: [{
                                backgroundColor: dynamicColorfromController,
                                data:microwaveDataByOperatorfromControllerpie
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            legend:{
                                    display:false
                                },
                            title: {
                                display: true,
                                text: 'Total Number of Microwave Node per Operator'
                            }
                        }
                    });

                    function updateMicrowave_(){
                        DataByOperatorChartpie.data.datasets[0].data=microwaveDataByOperatorfromControllerpie;
                        DataByOperatorChartpie.options.title.text="Total Number of Microwave Node per Operator";
                        DataByOperatorChartpie.update();
                    }
                    function updateOpticalfiber_(){
                        DataByOperatorChartpie.data.datasets[0].data=opticalfiberDataByOperatorfromControllerpie;
                        DataByOperatorChartpie.options.title.text="Total Number of Opticalfiber Node per Operator";
                        DataByOperatorChartpie.update();
                    }
                    function updateVsat_(){
                        DataByOperatorChartpie.data.datasets[0].data=vsatDataByOperatorfromControllerpie;
                        DataByOperatorChartpie.options.title.text="Total Number of VSAT Node per Operator";
                        DataByOperatorChartpie.update();
                    }
                    function updateSystem_(){
                        DataByOperatorChartpie.data.datasets[0].data=systemDataByOperatorfromControllerpie;
                        DataByOperatorChartpie.options.title.text="Total Number of Base Station Node per Operator";
                        DataByOperatorChartpie.update();
                    }
                    function showLabelByDataByOperatorChartpie(){
                        DataByOperatorChartpie.options.plugins.datalabels = {
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
                        
                        DataByOperatorChartpie.update();
                    }

                    $("select[id='piedataByOperatorOptions']").on('change', function(DataByOperatorChartpie) {
                        if (this.value == "microwavenode") {
                            updateMicrowave_();
                        }
                        if (this.value == "opticalfiberNode") {
                            updateOpticalfiber_();
                        }
                        if (this.value == "vsat") {
                            updateVsat_();
                        }
                        if (this.value == "bts") {
                            updateSystem_();
                        }
                    });

                    document.getElementById("piedownloadOperatorData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("piedataByOperator").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("piedownloadOperatorData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });
                    
                    var clickedSeventhChart=false;
                    document.getElementById("showLabeldataByBar").addEventListener('click', function(){
                        if (clickedSeventhChart) {
                            DataByOperatorChartpie.options.plugins.datalabels.display=false;
                            DataByOperatorChartpie.update();
                            clickedSeventhChart=false;
                        }
                        else{
                            showLabelByDataByOperatorChartpie();
                            clickedSeventhChart=true;
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
                <div class="mr-auto">Infrastructure Data By Province(Pie Chart)</div>

                <div>
                    <select id="pieinfrastructureOptions">
                        <option value="microwavenode" selected="selected">Microwave Count</option>
                        <option value="opticalfiberNode">Opticalfiber Length</option>
                        <option value="vsat">Vsat Count</option>
                        <option value="bts">Systemsite Count</option>
                    </select><br />
                </div>
                <button id="showLabeldataByPie" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="piedownloadProvinceData" download="Infrastructure Data By Province.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="pieMWstationVSprovince" width="400" height="400"></canvas>
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
                    var microwaveCountProvincepie=
                    [
                        @for ($province = 1; $province <=7; $province++ )
                        {{ $provinceMicrowaveNode[$province][0] }},
                        @endfor
                    ];
                    var vsatCountProvincepie=
                    [
                        @for ($province = 1; $province <=7; $province++ )
                        {{ $provinceVsatNode[$province][0] }},
                        @endfor
                    ];
                    var opticalfiberCountProvincepie=
                    [
                        @for ($province = 1; $province <=7; $province++ )
                        {{ $provinceOpticalfiberLink[$province][0] }},
                        @endfor
                    ];
                    var btsCountProvincepie=
                    [
                        @for ($province = 1; $province <=7; $province++ )
                        {{ $provinceBts[$province][0] }},
                        @endfor
                    ];

                    var DataByAdministrativeChartpie=new Chart(document.getElementById("pieMWstationVSprovince"), {
                        type: "pie",

                        data: {
                            labels: dynamicProvincefromController,
                            datasets: [{
                                backgroundColor: dynamicProvinceColorfromController,
                                data: microwaveCountProvincepie
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            title: {
                                display: true,
                                text: 'Total Number of Microwave Node per Province'
                                }
                        }
                    });

                    function updateMicrowaveCountpie(){
                        DataByAdministrativeChartpie.data.datasets[0].data=microwaveCountProvincepie;
                        DataByAdministrativeChartpie.options.title.text="Total Number of Microwave Node per Province";
                        DataByAdministrativeChartpie.update();
                    }
                    function updateOpticalfiberCountpie(){
                        DataByAdministrativeChartpie.data.datasets[0].data=opticalfiberCountProvincepie;
                        DataByAdministrativeChartpie.options.title.text="Length of Opticalfiber Node per Province(km)";
                        DataByAdministrativeChartpie.update();
                    }
                    function updateVsatCountpie(){
                        DataByAdministrativeChartpie.data.datasets[0].data=vsatCountProvincepie;
                        DataByAdministrativeChartpie.options.title.text="Total Number of VSAT Node per Province";
                        DataByAdministrativeChartpie.update();
                    }
                    function updateSystemCountpie(){
                        DataByAdministrativeChartpie.data.datasets[0].data=btsCountProvincepie;
                        DataByAdministrativeChartpie.options.title.text="Total Number of Base Station Node per Province";
                        DataByAdministrativeChartpie.update();
                    }
                    function showLabelBymicrowaveCountProvincepie(){
                        DataByAdministrativeChartpie.options.plugins.datalabels = {
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
                        
                        DataByAdministrativeChartpie.update();
                    }
                    $("select[id='pieinfrastructureOptions']").on('change', function(DataByAdministrativeChart) {
                        if (this.value == "microwavenode") {
                            updateMicrowaveCountpie();
                        }
                        if (this.value == "opticalfiberNode") {
                            updateOpticalfiberCountpie();
                        }
                        if (this.value == "vsat") {
                            updateVsatCountpie();
                        }
                        if (this.value == "bts") {
                            updateSystemCountpie();
                        }
                    });
                    document.getElementById("piedownloadProvinceData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("pieMWstationVSprovince").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("piedownloadProvinceData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    var clickedEighthChart=false;
                    document.getElementById("showLabeldataByPie").addEventListener('click', function(){
                        if (clickedEighthChart) {
                            DataByAdministrativeChartpie.options.plugins.datalabels.display=false;
                            DataByAdministrativeChartpie.update();
                            clickedEighthChart=false;
                        }
                        else{
                            showLabelBymicrowaveCountProvincepie();
                            clickedEighthChart=true;
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
