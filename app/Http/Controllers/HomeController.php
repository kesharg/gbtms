<?php

namespace App\Http\Controllers;

use App\PSTN;
use App\Vsat;
use App\System;
use App\District;
use App\Operator;
use App\Province;
use App\Wireless;
use App\Microwave;
use App\Systemsite;
use App\Opticalfiber;
use App\Microwavestation;
use App\Opticalfiberlink;
use App\Infrastructurecode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        //Authentication is required to view the page
        $this->middleware( 'auth' );
    }

    public function index( Request $request ) {
        //Total count of all information on database
        //Microwave Node
        $totalMicrowave = Microwave::count();
        //Microwave Link
        $totalMicrowaveLinks = Microwavestation::count();
        //Vsat Node
        $totalVsat = Vsat::count();
        //BTS system towers
        $totalSystemsites = Systemsite::count();
        //System nodes in towers
        $totalSystemnodes = System::count();
        //Optical fiber node
        $totalOpticalfibernode = Opticalfiber::count();
        //Opticalfiber Link
        $totalOpticalfiberlink = Opticalfiberlink::count();
        //All type of infrastructure
        $totalInfrastructure = Infrastructurecode::count();
        //Operators of NTA like NCELL, SMART, etc.
        $totalOperator = Operator::count();
        //PSTN( public switched telephone network )
        $totalPSTN = PSTN::count();
        //Wireless sites
        $totalWireless = Wireless::count();

        $operatorName = DB::table('operators')->orderBy('operator_id', 'asc')->pluck('operator_code');
        $operatorCount = $operatorName->count();

        //Get information based on operator code
        $microwaveNode = $this->getMicrowaveNodeCount($operatorName,$operatorCount);
        $microwaveLink = $this->getMicrowaveLinkCount($operatorName,$operatorCount);
        $systemSiteNode = $this->getSystemsiteNode($operatorName,$operatorCount);
        $systemNodes = $this->getSystemNodes($operatorName,$operatorCount);
        $vsatNode = $this->getVsatNodeCount($operatorName,$operatorCount);
        $opticalfiberNode = $this->getOpticalFiberNode($operatorName,$operatorCount);
        $opticalfiberLink = $this->getOpticalFiberLink($operatorName,$operatorCount);

        //Total count of administrative Unit
        $provinceCount = DB::table('maps_province')->count();
        $districtCount = DB::table('maps_district')->count();

        //dynamic charts
        $operatorColor = DB::table('operators')->orderBy('operator_id', 'asc')->pluck('color_code');
        $provinceNameForCharts  = DB::table( 'maps_province' )->orderby('state_code', 'asc')->pluck('province');
        $provinceColorArray = ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#571845","#fff176"];
        $districtNameForCharts  = DB::table( 'maps_district' )->orderby('gid', 'asc')->pluck('district');

        //systemsite chart
        $genTypeArray = ['2G', '3G', '4G'];
        $genTypeCount = count($genTypeArray);
        $genTypeColor = ['#8CC6E3', '#2C87B5', '#143D52'];
        $province1 = DB::table( 'systemsites' );

        for($p=0; $p<$provinceCount; $p++){
            $SystemSiteGenProv[$p] = $this->getSystemsiteGen($genTypeArray, $genTypeCount, $provinceNameForCharts[$p]);
        }
        

        for ( $province = 1; $province <= $provinceCount; $province++ ) {
            $provinceMicrowaveNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_microwavestation' );
            $provinceName[$province]= DB::table( 'maps_province' )->orderby('state_code')->where( 'state_code', $province )->pluck('province');
            $provinceVsatNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_vsat' );
            $provinceOpticalfiberLink[$province]=DB::table('maps_province')->where('state_code',$province)->pluck('opticalfiber_length');
            $provinceBts[$province]=DB::table('maps_province')->where('state_code',$province)->pluck('no_of_bts');
        }

        for ( $district = 1; $district <= $districtCount; $district++ ) {
            $districtMicrowaveNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_microwavestation' );
            $districtName[$district]= DB::table( 'maps_district' )->orderby('gid')->where( 'gid', $district )->pluck('district');
            $districtVsatNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_vsat' );
            $districtOpticalfiberLink[$district]=DB::table('maps_district')->where('gid',$district)->pluck('opticalfiber_length');
            $districtBts[$district]=DB::table('maps_district')->where('gid',$district)->pluck('no_of_bts');
        }

                $coverage_percent_2g_province=$this->coverage_area_province('2g');
                $coverage_percent_3g_province=$this->coverage_area_province('3g');
                $coverage_percent_4g_province=$this->coverage_area_province('4g');
                $coverage_percent_2g_district=$this->coverage_area('2g','district');
                $coverage_percent_3g_district=$this->coverage_area('3g','district');
                $coverage_percent_4g_district=$this->coverage_area('4g','district');
                // $coverage_percent_2g_vdc=$this->coverage_area('2g','vdc');
                // $coverage_percent_3g_vdc=$this->coverage_area('3g','vdc');
                // $coverage_percent_4g_vdc=$this->coverage_area('4g','vdc');

                // dd($coverage_percent_2g_district);
                $population_penetration_2g_province=$this->population_penetration_province('2g');
                $population_penetration_3g_province=$this->population_penetration_province('3g');
                $population_penetration_4g_province=$this->population_penetration_province('4g');
                $population_penetration_2g_district=$this->population_penetration_district('2g');
                $population_penetration_3g_district=$this->population_penetration_district('3g');
                $population_penetration_4g_district=$this->population_penetration_district('4g');
                $province_population=DB::table('maps_province')->orderby('state_code')->pluck('population','state_code');

        return view( 'dashboard.dashboard',
        compact( 'totalMicrowave',
        'totalMicrowaveLinks',
        'totalVsat',
        'totalSystemsites',
        'totalSystemnodes',
        'totalOpticalfibernode',
        'totalOpticalfiberlink',
        'totalInfrastructure',
        'totalOperator',
        'totalPSTN',
        'totalWireless',
        //operator wise info
        'operatorName',
        'operatorCount',
        'vsatNode',
        'opticalfiberLink',
        'opticalfiberNode',
        'systemSiteNode',
        'systemNodes',
        'microwaveLink',
        'microwaveNode',
        //dynamic charts
        'operatorColor',
        'provinceNameForCharts',
        'provinceCount',
        'provinceColorArray',
        'districtNameForCharts',
        'genTypeArray',
        'genTypeColor',
        'SystemSiteGenProv',
        //Province info
        'province',
        'provinceName',
        'provinceMicrowaveNode',
        'provinceVsatNode',
        'provinceOpticalfiberLink',
        'provinceBts',
        //District info
        'district',
        'districtName',
        'districtMicrowaveNode',
        'districtVsatNode',
        'districtOpticalfiberLink',
        'districtBts',
        'coverage_percent_2g_province',
        'coverage_percent_3g_province',
        'coverage_percent_4g_province',
        'coverage_percent_2g_district',
        'coverage_percent_3g_district',
        'coverage_percent_4g_district',
        'population_penetration_2g_province',
        'population_penetration_3g_province',
        'population_penetration_4g_province',
        'province_population',
        'population_penetration_2g_district',
        'population_penetration_3g_district',
        'population_penetration_4g_district'

    ) );
    }

    public function population_penetration_province($generation){
        $coverage_percent_2g_province=$this->coverage_area_province('2g');
        $coverage_percent_3g_province=$this->coverage_area_province('3g');
        $coverage_percent_4g_province=$this->coverage_area_province('4g');

        $provinceCount = DB::table('maps_province')->count();
        $province_population=DB::table('maps_province')->orderby('state_code')->pluck('population','state_code');

        for ( $i = 1; $i <= $provinceCount; $i++ ) {
            $population_penetration[$i] = (int)((${'coverage_percent_'.$generation.'_province'}[$i]/100) * $province_population[$i]);
        }
        return $population_penetration;
    }

    public function population_penetration_district($generation){
        $coverage_percent_2g_district=$this->coverage_area('2g','district');
        $coverage_percent_3g_district=$this->coverage_area('3g','district');
        $coverage_percent_4g_district=$this->coverage_area('4g','district');

        $districtCount = DB::table('maps_district')->count();
        $district_population=DB::table('maps_district')->orderby('gid')->pluck('population','gid');

        for ( $i = 1; $i <= $districtCount; $i++ ) {
            $population_penetration_district[$i] = (int)((${'coverage_percent_'.$generation.'_district'}[$i]/100) * $district_population[$i]);
        }
        return $population_penetration_district;
    }

    public function coverage_area_province($generation){
        ${'coverage_area_'.$generation.'_province'}=DB::table('coverage_area_'.$generation.'_province')->orderby('state_code')->pluck('st_area','state_code');
        $province_area=DB::table('maps_province')->orderby('state_code')->pluck('total_area','state_code');
        foreach(${'coverage_area_'.$generation.'_province'} as $key=>$value){
            ${'coverage_area_'.$generation.'_province'}[$key]=(int)($value/1000000);
            ${'coverage_area_'.$generation.'_province'}[$key]=(int)((${'coverage_area_'.$generation.'_province'}[$key]/$province_area[$key])*100);
        }
        return ${'coverage_area_'.$generation.'_province'};
    }

    public function coverage_area($generation,$body){
        ${'coverage_area_'.$generation.'_'.$body}=DB::table('coverage_area_'.$generation.'_'.$body)->orderby('gid')->pluck('st_area','gid');
        $area=DB::table('maps_'.$body)->orderby('gid')->pluck('total_area','gid');
        foreach(${'coverage_area_'.$generation.'_'.$body} as $key=>$value){
            ${'coverage_area_'.$generation.'_'.$body}[$key]=(int)($value/1000000);
            ${'coverage_area_'.$generation.'_'.$body}[$key]=(int)((${'coverage_area_'.$generation.'_'.$body}[$key]/$area[$key])*100);
        }
        return ${'coverage_area_'.$generation.'_'.$body};
    }



    //Division of information based on operator code

    //Microwave Node
    private function getMicrowaveNodeCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            // Contains array with serial information of operators as operator_id
            $Microwave[$o]= Microwave::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Microwave;
    }

    //Microwave Link

    private function getMicrowaveLinkCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $MicrowaveLink[$o]= Microwavestation::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $MicrowaveLink;
    }

    //Optical Fiber Node

    private function getOpticalFiberNode($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Opticalfibernode[$o]= Opticalfiber::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Opticalfibernode;
    }

    //Optical Fiber Link
    private function getOpticalFiberLink($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Opticalfiberlink[$o]= Opticalfiberlink::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Opticalfiberlink;
    }

    //Base Station Node( System Site )

    private function getSystemsiteNode($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Systemsite[$o]= Systemsite::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Systemsite;
    }

    //System node( Multiple system node in single base station )

    private function getSystemNodes($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $System[$o]= System::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $System;
    }

    //Vsat node

    private function getVsatNodeCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Vsat[$o]= Vsat::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Vsat;
    }

    //PSTN node( public switched telephone network )

    private function getPSTN($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Pstn[$o]= PSTN::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        // return $Pstn;
    }

    //Wireless node

    private function getWirelessSite($operatorName,$operatorCount) {

        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Wirelesssite[$o]= Wireless::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        // return $Wirelesssite;
    }

    //Systemsite chart (Base Station Node)
    private function getSystemsiteGen($genTypeArray, $genTypeCount, $provinceName) {
        for ( $g = 0; $g < $genTypeCount; $g++ ) {
                $Systemsitegen[$g] = DB::table( 'systemsites as ss' )
                                    ->where('ss.province', 'ilike', $provinceName)
                                    ->where( 's.type', 'ilike', $genTypeArray[$g] )
                                    ->leftJoin('systems as s', 'ss.syssiteid', '=', 's.syssiteid')->count();
            }
        return $Systemsitegen;
    }

}
