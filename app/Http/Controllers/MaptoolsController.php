<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaptoolsController extends Controller
{
    public function geographic_penetration()
    {

        $province_1_coverage = $this->get_province_coverage(1);
        $province_2_coverage = $this->get_province_coverage(2);
        $province_3_coverage             = $this->get_province_coverage(3);
        $province_4_coverage             = $this->get_province_coverage(4);
        $province_5_coverage             = $this->get_province_coverage(5);
        $province_6_coverage             = $this->get_province_coverage(6);
        $province_7_coverage             = $this->get_province_coverage(7);
        $province_penetration_percentage = [$province_1_coverage, $province_2_coverage, $province_3_coverage, $province_4_coverage, $province_5_coverage, $province_6_coverage, $province_7_coverage];
        return $province_penetration_percentage;
    }

    private function get_province_coverage($state_code)
    {
        $coverage_area_query = "create materialized view as select st_area(st_intersection(province.geom,st_union_2g.st_union)) from maps_province as province , st_union_2g where province.state_code=1";
        $total_area_query    = "select st_area(geom) from maps_province where gid=" . $state_code;
        $coverage_area       = DB::select($coverage_area_query)[0]->st_area;
        $total_area          = DB::select($total_area_query)[0]->st_area;
        $coverage_percentage = (int)(($coverage_area / $total_area) * 100);
        return $coverage_area;

    }

    public function printMap(){

    }
}
