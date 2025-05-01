{{-- Chart Begins --}}
<div class="row">

    {{-- Full width cardview --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex ">
                <div class="mr-auto">Systen Site by Generation type by Province</div>
                <button id="showLabeldataByGenProvince" data-toggle="tooltip" title="Show Label"
                    class="btn ml-3 btn-primary float-right bg-flat-color-1">
                    <!-- Label Icon -->
                    <i class="fas fa-tag"></i>
                </button>
                <a id="downloadGenProvinceChart" download="Systen Site by Generation type by Province.jpg" href=""
                    class="btn btn-primary float-right bg-flat-color-1 ml-3">
                    <!-- Download Icon -->
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <div class="card-body">
                <canvas id="allGenProvincedata" width="400" max-height="400"></canvas>
                
                <script>
                    var dynamicProvincefromController=
                        [
                            @foreach ($provinceNameForCharts as $provinceName)
                            '{{ $provinceName }}',
                            @endforeach
                        ];
                    
                    var DataofGenProvince=new Chart(document.getElementById("allGenProvincedata"), {
                        type: "bar",
                        data: {
                            labels: dynamicProvincefromController,
                            datasets: 
                            [
                                @for($i=0;$i<3;$i++)
                                {
                                    label: '{{ $genTypeArray[$i] }}',
                                    backgroundColor: '{{ $genTypeColor[$i] }}',
                                    data: [ {{ $SystemSiteGenProv[0][$i]}},
                                            {{ $SystemSiteGenProv[1][$i]}},
                                            {{ $SystemSiteGenProv[2][$i]}},
                                            {{ $SystemSiteGenProv[3][$i]}},
                                            {{ $SystemSiteGenProv[4][$i]}},
                                            {{ $SystemSiteGenProv[5][$i]}},
                                            {{ $SystemSiteGenProv[6][$i]}}]
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
                            text: 'Systen Site by Generation type by Province'
                                }
                        }
                    });

                    function showLabelByDataofGenProvince(){
                        DataofGenProvince.options.plugins.datalabels = {
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

                        DataofGenProvince.update();
                    }

                    document.getElementById("downloadGenProvinceChart").addEventListener('click', function(){
                        /*Get image of canvas element*/
                        var url_base64jp = document.getElementById("allGenProvincedata").toDataURL("image/jpg");
                        /*get download button (tag: <a></a>) */
                        var a =  document.getElementById("downloadGenProvinceChart");
                        /*insert chart image url to download button (tag: <a></a>) */
                        a.href = url_base64jp;
                    });


                    var clickedFifteenthChart=false;
                    document.getElementById("showLabeldataByGenProvince").addEventListener('click', function(){
                        if (clickedFifteenthChart){
                            DataofGenProvince.options.plugins.datalabels.display=false;
                            DataofGenProvince.update();
                            clickedFifteenthChart=false;
                        }
                        else{
                            showLabelByDataofGenProvince();
                            clickedFifteenthChart=true;
                        }
                    });
                </script>
            </div>
        </div>
    </div>

</div>