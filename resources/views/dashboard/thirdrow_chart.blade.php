<div class="row">

    {{-- Leftside Card View --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Total Infrastructure Throughtout Country</div>
                <button id="showLabeldataByCountry" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadCountryChart" download="Infrastructure Throughtout Country.jpg" href=""
                    class="btn btn-primary float-right bg-flat-color-1 ml-3">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="infrastructureInCountry" width="400" height="400"></canvas>
                <script>
                    var InfrastructureInCountryChart=new Chart(document.getElementById("infrastructureInCountry"), {
                        type:"horizontalBar",
                        data: {
                            labels: ["Microwave Node", "Vsat`    Node", "SystemSite Node", "Opticalfiber Node"],
                            datasets: [{
                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
                            data:[{{ $totalMicrowave }},{{ $totalVsat }},{{$totalSystemsites}},{{$totalOpticalfibernode}}],
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
                            text: 'Total Number of Infrastructure in Country'
                                }
                        }
                    });
                    document.getElementById("downloadCountryChart").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("infrastructureInCountry").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadCountryChart");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    function showLabelByInfrastructureInCountry(){
                        InfrastructureInCountryChart.options.plugins.datalabels = {
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
                        InfrastructureInCountryChart.update();
                    }

                    var clickedFourthChart=false;
                    document.getElementById("showLabeldataByCountry").addEventListener('click', function(){
                        if (clickedFourthChart) {
                            InfrastructureInCountryChart.options.plugins.datalabels.display=false;
                            InfrastructureInCountryChart.update();
                            clickedFourthChart=false;
                        }
                        else{
                            showLabelByInfrastructureInCountry();
                            clickedFourthChart=true;
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
                <div class="mr-auto">Total Infrastructure Of Operator</div>

                <button id="showLabeldataByTotalInfrastructure" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadTotalInfrastructure" download="Total Infrastructure of Operator.jpg" href=""
                    class="btn btn-primary float-right bg-flat-color-1 ml-3">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="infrastructureOfOperator" width="400" height="400"></canvas>
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
                    var InfrastructureOfOperatorChart=new Chart(document.getElementById("infrastructureOfOperator"), {
                        type:"pie",
                        data: {
                            labels: dynamicOperatorfromController,
                            datasets: [{
                                backgroundColor: dynamicColorfromController,
                                data:[{{ $microwaveNode[0]+$opticalfiberNode[0]+$vsatNode[0]+$systemSiteNode[0] }},{{$microwaveNode[1]+$opticalfiberNode[1]+$vsatNode[1]+$systemSiteNode[1] }},{{$microwaveNode[2]+$opticalfiberNode[2]+$vsatNode[2]+$systemSiteNode[2]}},{{$microwaveNode[3]+$opticalfiberNode[3]+$vsatNode[3]+$systemSiteNode[3]}},{{ $microwaveNode[4]+$opticalfiberNode[4]+$vsatNode[4]+$systemSiteNode[4] }},{{ $microwaveNode[5]+$opticalfiberNode[5]+$vsatNode[5]+$systemSiteNode[5] }}],
                            }]
                        },
                        options: {
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
                                text: 'Total Number of Infrastructure of Operator'
                            }
                        }
                    });

                    function showLabelByInfrastructureOfOperator(){
                        InfrastructureOfOperatorChart.options.plugins.datalabels = {
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
                        
                        InfrastructureOfOperatorChart.update();
                    }
                        
                    document.getElementById("downloadTotalInfrastructure").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("infrastructureOfOperator").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadTotalInfrastructure");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });

                    var clickedFifthChart=false;
                    document.getElementById("showLabeldataByTotalInfrastructure").addEventListener('click', function(){
                        if (clickedFifthChart) {
                            InfrastructureOfOperatorChart.options.plugins.datalabels.display=false;
                            InfrastructureOfOperatorChart.update();
                            clickedFifthChart=false;
                        }
                        else{
                            showLabelByInfrastructureOfOperator();
                            clickedFifthChart=true;
                        }
                    });
                </script>
            </div>
        </div>
    </div>


</div>
