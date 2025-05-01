{{-- Chart Begins --}}
<div class="row">

    {{-- Full width cardview --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">All Operator Data View</div>
                <button id="showLabeldataByAllOperator" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadOperatorChart" download="Infrastructure Data of Operators.jpg" href=""
                    class="btn btn-primary float-right bg-flat-color-1 ml-3">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="alloperatordata" width="400" max-height="400"></canvas>
                <script>
                    var DataofOperator=new Chart(document.getElementById("alloperatordata"), {
                        type: "bar",
                        data: {
                            labels: ["Microwave Node", "Opticalfiber Node", "Vsat Node", "System node"],
                            datasets: 
                            [
                                @for($i=0;$i<$operatorCount;$i++)
                                {
                                    label: '{{ $operatorName[$i] }}',
                                    backgroundColor: '{{ $operatorColor[$i] }}',
                                    data: [{{ $microwaveNode[$i]}},{{ $opticalfiberNode[$i] }},{{$vsatNode[$i] }},{{$systemSiteNode[$i] }} ]
                                },
                                @endfor
                            ]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            title: {
                            display: true,
                            text: 'Total Number of Infrastructure by Operator'
                                }
                        }
                    });

                    function showLabelByDataofOperator(){
                        DataofOperator.options.plugins.datalabels = {
                            color:'#ffffff',
                            display: true,
                            rotation:90,
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

                        DataofOperator.update();
                    }

                    document.getElementById("downloadOperatorChart").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("alloperatordata").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadOperatorChart");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });


                    var clickedThirdChart=false;
                    document.getElementById("showLabeldataByAllOperator").addEventListener('click', function(){
                        if (clickedThirdChart){
                            DataofOperator.options.plugins.datalabels.display=false;
                            DataofOperator.update();
                            clickedThirdChart=false;
                        }
                        else{
                            showLabelByDataofOperator();
                            clickedThirdChart=true;
                        }
                    });
                </script>
            </div>
        </div>
    </div>

</div>
