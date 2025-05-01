<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

{{-- Chart Begins --}}
<div class="row">
    {{-- Leftside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Nodes Data By Operator</div>
                <div>
                    <select id="dataByOperatorOptions">
                        <option value="microwavenode" selected="selected">Microwave Nodes</option>
                        <option value="opticalfiberNode">Opticalfiber Node</option>
                        <option value="vsat">Vsat Node</option>
                        <option value="bts">Systemsite Node</option>
                    </select><br />
                </div>
                <button id="showLabeldataByOperator" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a data-toggle="tooltip" title="Download" id="downloadOperatorData" download="Infrastructure Data By Operator.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="dataByOperator" width="400" height="400"></canvas>
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
                    var microwaveDataByOperatorfromController=
                    [
                        @foreach ($microwaveNode as $microwave)
                        {{ $microwave }},
                        @endforeach
                    ];
                    var vsatDataByOperatorfromController=
                    [
                        @foreach ($vsatNode as $vsat)
                        {{ $vsat }},
                        @endforeach
                    ];
                    var systemDataByOperatorfromController=
                    [
                        @foreach ($systemSiteNode as $system)
                        {{ $system }},
                        @endforeach
                    ];
                    var opticalfiberDataByOperatorfromController=
                    [
                        @foreach ($opticalfiberNode as $opticalfiber)
                        {{ $opticalfiber }},
                        @endforeach
                    ];
                    
                    var DataByOperatorChart= new Chart(document.getElementById("dataByOperator"), {
                        type: "doughnut",
                        data: {
                            labels: dynamicOperatorfromController,
                            datasets: [{
                                backgroundColor: dynamicColorfromController,
                                data:microwaveDataByOperatorfromController
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
                                text: 'Total Number of Microwave Node per Operator'
                            }
                        }
                    });

                    function updateMicrowave(){
                        DataByOperatorChart.data.datasets[0].data=microwaveDataByOperatorfromController;
                        DataByOperatorChart.options.title.text="Total Number of Microwave Node per Operator";
                        DataByOperatorChart.update();
                    }
                    function updateOpticalfiber(){
                        DataByOperatorChart.data.datasets[0].data=opticalfiberDataByOperatorfromController;
                        DataByOperatorChart.options.title.text="Total Number of Opticalfiber Node per Operator";
                        DataByOperatorChart.update();
                    }
                    function updateVsat(){
                        DataByOperatorChart.data.datasets[0].data=vsatDataByOperatorfromController;
                        DataByOperatorChart.options.title.text="Total Number of VSAT Node per Operator";
                        DataByOperatorChart.update();
                    }
                    function updateSystem(){
                        DataByOperatorChart.data.datasets[0].data=systemDataByOperatorfromController;
                        DataByOperatorChart.options.title.text="Total Number of Base Station Node per Operator";
                        DataByOperatorChart.update();
                    }
                    function showLabelByOperator(){
                        DataByOperatorChart.options.plugins.datalabels = {
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

                        DataByOperatorChart.update();
                    }

                    $("select[id='dataByOperatorOptions']").on('change', function(DataByOperatorChart) {
                        if (this.value == "microwavenode") {
                            updateMicrowave();
                        }
                        if (this.value == "opticalfiberNode") {
                            updateOpticalfiber();
                        }
                        if (this.value == "vsat") {
                            updateVsat();
                        }
                        if (this.value == "bts") {
                            updateSystem();
                        }
                    });

                    var clickedFirstChart=false;
                    document.getElementById("showLabeldataByOperator").addEventListener('click', function(){
                        if (clickedFirstChart) {
                            DataByOperatorChart.options.plugins.datalabels.display=false;
                            DataByOperatorChart.update();
                            clickedFirstChart=false;
                        }
                        else{
                            showLabelByOperator();
                            clickedFirstChart=true;
                        }
                    });
                    document.getElementById("downloadOperatorData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("dataByOperator").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadOperatorData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                </script>
            </div>
        </div>
    </div>

    {{-- Right side cardview --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Infrastructure Data By Province</div>

                <div>
                    <select id="infrastructureOptions">
                        <option value="microwavenode" selected="selected">Microwave Count</option>
                        <option value="opticalfiberNode">Opticalfiber Length</option>
                        <option value="vsat">Vsat Count</option>
                        <option value="bts">Systemsite Count</option>
                    </select><br />
                </div>
                <button id="showLabeldataByProvince" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadProvinceData" download="Infrastructure Data By Province.jpg" href=""
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="MWstationVSprovince" width="400" height="400"></canvas>

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
                    var microwaveCountProvince=
                        [
                            @for ($province = 1; $province <=7; $province++ )
                            {{ $provinceMicrowaveNode[$province][0] }},
                            @endfor
                        ];
                    var vsatCountProvince=
                        [
                            @for ($province = 1; $province <=7; $province++ )
                            {{ $provinceVsatNode[$province][0] }},
                            @endfor
                        ];
                    var opticalfiberCountProvince=
                        [
                            @for ($province = 1; $province <=7; $province++ )
                            {{ $provinceOpticalfiberLink[$province][0] }},
                            @endfor
                        ];
                    var btsCountProvince=
                        [
                            @for ($province = 1; $province <=7; $province++ )
                            {{ $provinceBts[$province][0] }},
                            @endfor
                        ];

                    var DataByAdministrativeChart=new Chart(document.getElementById("MWstationVSprovince"), {
                        type: "bar",

                        data: {
                            labels: dynamicProvincefromController,
                            datasets: [{
                            backgroundColor: dynamicProvinceColorfromController,
                            data: microwaveCountProvince
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
                                text: 'Total Number of Microwave Node per Province'
                            }
                        }
                    });

                    function updateMicrowaveCount(){
                        DataByAdministrativeChart.data.datasets[0].data=microwaveCountProvince;
                        DataByAdministrativeChart.options.title.text="Total Number of Microwave Node per Province";
                        DataByAdministrativeChart.update();
                    }
                    function updateOpticalfiberCount(){
                        DataByAdministrativeChart.data.datasets[0].data=opticalfiberCountProvince;
                        DataByAdministrativeChart.options.title.text="Length of Opticalfiber Node per Province(km)";
                        DataByAdministrativeChart.update();
                    }
                    function updateVsatCount(){
                        DataByAdministrativeChart.data.datasets[0].data=vsatCountProvince;
                        DataByAdministrativeChart.options.title.text="Total Number of VSAT Node per Province";
                        DataByAdministrativeChart.update();
                    }
                    function updateSystemCount(){
                        DataByAdministrativeChart.data.datasets[0].data=btsCountProvince;
                        DataByAdministrativeChart.options.title.text="Total Number of Base Station Node per Province";
                        DataByAdministrativeChart.update();
                    }
                    function showLabelByProvince(){
                        DataByAdministrativeChart.options.plugins.datalabels = {
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

                        DataByAdministrativeChart.update();
                    }

                    $("select[id='infrastructureOptions']").on('change', function(DataByAdministrativeChart) {
                        if (this.value == "microwavenode") {
                            updateMicrowaveCount();
                        }
                        if (this.value == "opticalfiberNode") {
                            updateOpticalfiberCount();
                        }
                        if (this.value == "vsat") {
                            updateVsatCount();
                        }
                        if (this.value == "bts") {
                            updateSystemCount();
                        }
                    });

                    var clickedSecondChart=false;
                    document.getElementById("showLabeldataByProvince").addEventListener('click', function(){
                        if (clickedSecondChart) {
                            DataByAdministrativeChart.options.plugins.datalabels.display=false;
                            DataByAdministrativeChart.update();
                            clickedSecondChart=false;
                        }
                        else{
                            showLabelByProvince();
                            clickedSecondChart=true;
                        }
                    });
                    document.getElementById("downloadProvinceData").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("MWstationVSprovince").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadProvinceData");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });
                </script>
            </div>
        </div>
    </div>
</div>
