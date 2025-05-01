<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        //To add number of elements that is contained within the VDC boundary
        // $totalVDC = DB::table( 'maps_vdc' )->count();
        // $currentInfrastructureInVdcCount = 0;
        // for ( $i = 1; $i <= $totalVDC; $i++ ) {
        //     $currentInfrastructureInVdcCount = DB::select( "SELECT sum(ST_length(ST_transform(ST_Intersection(opticalfiberlinks.geom,maps_vdc.geom),32645))) from maps_vdc,opticalfiberlinks where maps_vdc.gid=$i  and (ST_Intersects(opticalfiberlinks.geom,maps_vdc.geom))" );
        //     DB::table( 'maps_vdc' )->where( 'gid', $i )->update( ['opticalfiber_length'=>number_format( ( ( $currentInfrastructureInVdcCount[0]->sum )/1000 ), '0', '', '' )] );
        //     $currentInfrastructureInVdcCount = 0;
        // }

        // //To add number of elements that is contained within the Ward boundary
        // $totalWard = DB::table( 'maps_ward' )->count();
        // $currentInfrastructureInWardCount = 0;
        // for ( $i = 1; $i <= $totalWard; $i++ ) {
        //     $currentInfrastructureInWardCount = DB::select( "SELECT sum(ST_length(ST_transform(ST_Intersection(opticalfiberlinks.geom,maps_ward.geom),32645))) from maps_ward,opticalfiberlinks where maps_ward.gid=$i  and (ST_Intersects(opticalfiberlinks.geom,maps_ward.geom))" );
        //     DB::table( 'maps_ward' )->where( 'gid', $i )->update( ['opticalfiber_length'=>number_format( ( ( $currentInfrastructureInWardCount[0]->sum )/1000 ), '0', '', '' )] );
        //     $currentInfrastructureInWardCount = 0;
        // }

        //To add number of elements that is contained within the District boundary
        //  $totalDistrict = DB::table( 'maps_district' )->count();
        //  $currentInfrastructureInDistrictCount = 0;

        //  for ( $i = 1; $i <= $totalDistrict; $i++ ) {
        //      $currentInfrastructureInDistrictCount = DB::select( "SELECT ST_area(ST_transform(maps_district.geom,32645))
        //      from maps_district where maps_district.gid=$i " );
        //      DB::table( 'maps_district' )->where( 'gid', $i )->update( ['total_area'=> number_format( ( ( $currentInfrastructureInDistrictCount[0]->st_area )/1000000 ), '0', '', '' )] );
        //      $currentInfrastructureInDistrictCount = 0;
        //  }

        //To add number of elements that is contained within the Province boundary
        // $totalProvince = DB::table( 'maps_province' )->count();
        // $currentInfrastructureInProvinceCount = 0;
        // for ( $i = 1; $i <= $totalProvince; $i++ ) {
        //     $currentInfrastructureInProvinceCount = DB::select( "SELECT   sum(ST_area(ST_transform(ST_Intersection(coverage_data.geom,maps_province.geom),32645)))
        //     from
        //     maps_province,coverage_data
        //     where
        //     maps_province.gid=$i and coverage_data.type='3G' and coverage_data.oprcd='NDCL'
        //     and
        //     (ST_Intersects(coverage_data.geom,maps_province.geom)) " );
        //     DB::table( 'maps_province' )->where( 'gid', $i )->update( ['ca_ndcl3g'=>number_format( ( ( $currentInfrastructureInProvinceCount[0]->sum )/1000000 ), '0', '', '' )] );
        //     $currentInfrsastructureInProvinceCount = 0;
        // }

        //Getting data for placement in map filter according to administrative region/boundary
        $provinces = DB::table('maps_province')->orderby('state_code')->pluck('province', 'state_code');
        $districts = DB::table('maps_district')->orderby('state_code')->pluck('district');
        $vdcs = DB::table('maps_vdc')->orderby('state_code')->pluck('gapa_napa');
        $infrastructures = DB::table('infrastructurecodes')->pluck('infrastructure_name');
        $operators = DB::table('operators')->pluck('operator_name');

        //Returning map view
        return view('map.map', compact(['provinces',
        'districts',
        'vdcs',
        'infrastructures',
        'operators']));
    }


    public function getdistrict($state_code)
    {
        $statecode = DB::table('maps_province')->where('province', $state_code)->pluck('state_code');
        $district = DB::table('maps_district')
            ->where('state_code', $statecode)
            ->pluck('district');
        return json_encode($district);
    }

    public function getvdc($district)
    {
        $vdc = DB::table('maps_vdc')
            ->where('district', $district)
            ->pluck('gapa_napa');
        return json_encode($vdc);
    }

    public function getward($vdc)
    {
        $ward = DB::table('maps_ward')->orderby('new_ward_n')
            ->where('gapa_napa', $vdc)
            ->pluck('new_ward_n');
        return json_encode($ward);
    }
    function getExtent($val1,$val2,$val3){
        if(in_array($val1,array("vsats","microwaves","opticalfibers","systemsites")))
        {
                $xmin = Arr::pluck(DB::select(DB::raw("select st_xmin(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_xmin')[0];
                $ymin = Arr::pluck(DB::select(DB::raw("select st_ymin(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_ymin')[0];
                $xmax = Arr::pluck(DB::select(DB::raw("select st_xmax(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_xmax')[0];
                $ymax = Arr::pluck(DB::select(DB::raw("select st_ymax(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_ymax')[0];

                $lat  = Arr::pluck(DB::select(DB::raw("select lat from ".$val1." where ".$val2." = '".$val3."'")),'lat')[0];
                $long = Arr::pluck(DB::select(DB::raw("select long from ".$val1." where ".$val2." = '".$val3."'")),'long')[0];
                $geom=Arr::pluck(DB::select(DB::raw("select st_astext(geom) from ".$val1." where ".$val2." = '".$val3."'")),'st_astext')[0];
                $data = array(
                    'xmin' => $xmin,
                    'ymin' => $ymin,
                    'xmax' => $xmax,
                    'ymax' => $ymax,
                    'lat'  =>$lat,
                    'long' =>$long,
                    'geom'=>$geom
                );
        }
        else
        {
            $xmin = Arr::pluck(DB::select(DB::raw("select st_xmin(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_xmin')[0];
            $ymin = Arr::pluck(DB::select(DB::raw("select st_ymin(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_ymin')[0];
            $xmax = Arr::pluck(DB::select(DB::raw("select st_xmax(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_xmax')[0];
            $ymax = Arr::pluck(DB::select(DB::raw("select st_ymax(ST_Extent(geom)) from ".$val1." where ".$val2." = '".$val3."'")),'st_ymax')[0];

            $geom=Arr::pluck(DB::select(DB::raw("select st_astext(geom) from ".$val1." where ".$val2." = '".$val3."'")),'st_astext')[0];
            $data = array(
                'xmin' => $xmin,
                'ymin' => $ymin,
                'xmax' => $xmax,
                'ymax' => $ymax,
                'geom'=>$geom
            );
    }


        return $data;
    }


    public function get_DEM_line_geom(Request $request){
         $query = " WITH line AS
            (SELECT 'SRID=4326;" . $request->geom . "'::geometry AS geom),
            T_line As
            (SELECT st_transform(line.geom,3857)  AS geom from line),

            linemeasure AS
            -- Add a measure dimension to extract steps
            (SELECT ST_AddMeasure(T_line.geom, 0, ST_Length(T_line.geom)) as linem,
            generate_series(0, ST_Length(T_line.geom)::int, 100) as i FROM T_line),

            points2d AS
            (SELECT ST_GeometryN(ST_LocateAlong(linem, i), 1) AS geom FROM linemeasure),

            T_points2d As
            (SELECT st_transform(points2d.geom,4326)  AS geom from points2d),

            cells AS
            (SELECT  ST_Value(elevation.rast, 1, T_points2d.geom) AS val
            FROM elevation, T_points2d
            WHERE ST_Intersects(elevation.rast, T_points2d.geom))

            select * from cells";
        $results = DB::select($query);
        foreach ($results as $key => $value) {
        $values[] = $value->val;
        }
        return $values;
    }

    public function getProvinceExtent(Request $request){
        $query_to_get_extent="select st_extent(st_transform(geom,3857)) from maps_province where province='".$request->province."'";
        $result=DB::select($query_to_get_extent);
        $bbox=$this->get_extent($result);
        return json_encode($bbox);
    }
    public function getDistrictExtent(Request $request){
        $query_to_get_extent="select st_extent(st_transform(geom,3857)) from maps_district where district='".$request->district."'";
        $result=DB::select($query_to_get_extent);
        $bbox=$this->get_extent($result);
        return json_encode($bbox);
    }
    public function getVdcExtent(Request $request){
        $query_to_get_extent="select st_extent(st_transform(geom,3857)) from maps_vdc where gapa_napa='".$request->vdc."'";
        $result=DB::select($query_to_get_extent);
        $bbox=$this->get_extent($result);
        return json_encode($bbox);
    }

    //This is byfar hard and fast rule I have ever written, lame but works
    private function get_extent($result){
        $st_extent=$result[0]->st_extent;
        $break_bbox=explode(" ",$st_extent);
        $bbox_value1=explode("(",$break_bbox[0])[1];
        $bbox_value2=explode(",",$break_bbox[1])[0];
        $bbox_value3=explode(",",$break_bbox[1])[1];
        $bbox_value4=explode(")",$break_bbox[2])[0];
        $bbox=[intval($bbox_value1),intval($bbox_value2),intval($bbox_value3),intval($bbox_value4)];
        return $bbox;
    }


    public function get_totallinklength(Request $request, $selectedLink, $geom){
        $geom_wospace = str_replace('%20', ' ', $geom);
        $sum_of_length = "select round((sum(ST_Length(ST_Transform(ST_Intersection(st_geomfromtext('".$geom_wospace."', 4326), ".$selectedLink.".geom), 32645)))/1000)::numeric, 2) as totallength
                from ".$selectedLink;
        $totallength = DB::select($sum_of_length);
        return json_encode($totallength);
    }
}
