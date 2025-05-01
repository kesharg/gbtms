{{-- <script>
    var ncell2gfromController=
                    [
                        @foreach ($province_coverage[0] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];
                    var ncell3gfromController=
                    [
                        @foreach ($province_coverage[1] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];
                    var ncell4gfromController=
                    [
                        @foreach ($province_coverage[2] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];
                    var smart2gfromController=
                    [
                        @foreach ($province_coverage[3] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];
                    var ndcl2gfromController=
                    [
                        @foreach ($province_coverage[4] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];
                    var ndcl3gfromController=
                    [
                        @foreach ($province_coverage[5] as $coverage_data)
                        {{ $coverage_data }},
                        @endforeach
                    ];

                    var DataBycoverageChart= new Chart(document.getElementById("coverage_data_province"), {
                        type: "pie",
                        data: {
                        labels: ["Province 1", "Province 2", "Bagmati", "Gandaki", "Province 5","Karnali","Sudurpaschim"],
                        datasets: [{
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#e31c1e","#3cbd9e"],
                        data:[ncell2gfromController[0],ncell2gfromController[1],ncell2gfromController[2],ncell2gfromController[3],ncell2gfromController[4],ncell2gfromController[5],ncell2gfromController[6]]
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: 'Coverage area of Ncell(2G) per province(km²)'
                            }
                        }
                    });
                    function updatencell2gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[ncell2gfromController[0],ncell2gfromController[1],ncell2gfromController[2],ncell2gfromController[3],ncell2gfromController[4],ncell2gfromController[5],ncell2gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Ncell(2G) per province(km²)";
                        DataBycoverageChart.update();
                    }
                    function updatencell3gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[ncell3gfromController[0],ncell3gfromController[1],ncell3gfromController[2],ncell3gfromController[3],ncell3gfromController[4],ncell3gfromController[5],ncell3gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Ncell(3G) per province(km²)";
                        DataBycoverageChart.update();
                    }
                    function updatencell4gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[ncell4gfromController[0],ncell4gfromController[1],ncell4gfromController[2],ncell4gfromController[3],ncell4gfromController[4],ncell4gfromController[5],ncell4gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Ncell(4G) per province(km²)";
                        DataBycoverageChart.update();
                    }
                    function updatendcl2gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[ndcl2gfromController[0],ndcl2gfromController[1],ndcl2gfromController[2],ndcl2gfromController[3],ndcl2gfromController[4],ndcl2gfromController[5],ndcl2gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Ndcl(2G) per province(km²)";ndcl2gfromController
                        DataBycoverageChart.update();
                    }
                    function updatendcl3gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[ndcl3gfromController[0],ndcl3gfromController[1],ndcl3gfromController[2],ndcl3gfromController[3],ndcl3gfromController[4],ndcl3gfromController[5],ndcl3gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Ndcl(3G) per province(km²)";
                        DataBycoverageChart.update();
                    }
                    function updatesmart2gProvince(){
                        DataBycoverageChart.data.datasets[0].data=[smart2gfromController[0],smart2gfromController[1],smart2gfromController[2],smart2gfromController[3],smart2gfromController[4],smart2gfromController[5],smart2gfromController[6]];
                        DataBycoverageChart.options.title.text="Coverage area of Smart(2G) per province(km²)";smart2gfromController
                        DataBycoverageChart.update();
                    }
                    $("select[id='databyoprcd_type']").on('change', function(DataBycoverageChart) {
                        if (this.value == "ncell2g") {
                            updatencell2gProvince();
                        }
                        if (this.value == "ncell3g") {
                            updatencell3gProvince();
                        }
                        if (this.value == "ncell4g") {
                            updatencell4gProvince();
                        }
                        if (this.value == "ndcl2g") {
                            updatendcl2gProvince();
                        }
                        if (this.value == "ndcl3g") {
                            updatendcl3gProvince();
                        }
                        if (this.value == "smart2g") {
                            updatesmart2gProvince();
                        }
                    });

</script> --}}
