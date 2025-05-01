<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoverageReportGenerationController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function printCoverageData(Request $request) {

        $generation = $request->generation_for_geographic;
        $administration = $request->administration_for_geographic;
        
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        if($administration=='province'){
            ${'coverage_area_'.$generation.'_province'}=DB::table('coverage_area_'.$generation.'_province')->orderby('state_code')->pluck('st_area','state_code');
            $coverage_area_province=DB::table('coverage_area_'.$generation.'_province')->orderby('state_code')->pluck('st_area','state_code');
            $province_area=DB::table('maps_province')->orderby('state_code')->pluck('total_area','state_code');
            $province_name=DB::table('maps_province')->orderby('state_code')->pluck('province','state_code');
            foreach(${'coverage_area_'.$generation.'_province'} as $key=>$value){
                ${'coverage_area_'.$generation.'_province'}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_province'}[$key]=(int)((${'coverage_area_'.$generation.'_province'}[$key]/$province_area[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_province'};
            $pdf = PDF::loadView( 'reportgeneration.pdf_coverage_province',  compact(['province_name','gen_data','province_area','coverage_area_province',
            'todayDate',
            'todayTime']));
            return $pdf->download( 'Province '.$generation .'Coverage Data.pdf' );
        }
        elseif($administration=='district'){
            ${'coverage_area_'.$generation.'_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${'coverage_area_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${$administration.'_area'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('total_area','gid');
            ${$administration.'_name'}=DB::table('maps_'.$administration)->orderby('gid')->pluck($administration,'gid');
            foreach(${'coverage_area_'.$generation.'_'.$administration} as $key=>$value){
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)((${'coverage_area_'.$generation.'_'.$administration}[$key]/${$administration.'_area'}[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_'.$administration};
            $pdf = PDF::loadView( 'reportgeneration.pdf_coverage_'.$administration,  compact([$administration.'_name','gen_data',$administration.'_area','coverage_area_'.$administration,
            'todayDate',
            'todayTime']));
            return $pdf->download( $administration.$generation .'Coverage Data.pdf' );
        }
        elseif($administration=='vdc'){
            ${'coverage_area_'.$generation.'_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${'coverage_area_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${$administration.'_area'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('total_area','gid');
            ${$administration.'_name'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('gapa_napa','gid');
            foreach(${'coverage_area_'.$generation.'_'.$administration} as $key=>$value){
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)((${'coverage_area_'.$generation.'_'.$administration}[$key]/${$administration.'_area'}[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_'.$administration};
            $pdf = PDF::loadView( 'reportgeneration.pdf_coverage_'.$administration,  compact([$administration.'_name','gen_data',$administration.'_area','coverage_area_'.$administration,
            'todayDate',
            'todayTime']));
            return $pdf->download( $administration.$generation .'Coverage Data.pdf' );
        }
        
    }

    public function printpopulationCoverageData(Request $request) {

        $generation = $request->generation_for_population_penetration;
        $administration = $request->administration_for_population_penetration;

        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        if($administration=='province'){
            ${'coverage_area_'.$generation.'_province'}=DB::table('coverage_area_'.$generation.'_province')->orderby('state_code')->pluck('st_area','state_code');
            $coverage_area_province=DB::table('coverage_area_'.$generation.'_province')->orderby('state_code')->pluck('st_area','state_code');
            $province_area=DB::table('maps_province')->orderby('state_code')->pluck('total_area','state_code');
            $province_name=DB::table('maps_province')->orderby('state_code')->pluck('province','state_code');
            foreach(${'coverage_area_'.$generation.'_province'} as $key=>$value){
                ${'coverage_area_'.$generation.'_province'}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_province'}[$key]=(int)((${'coverage_area_'.$generation.'_province'}[$key]/$province_area[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_province'};
            $province_population=DB::table('maps_province')->orderby('state_code')->pluck('population','state_code');
            $provinceCount=DB::table('maps_province')->count();
            for ( $i = 1; $i <= $provinceCount; $i++ ) {
                $population_penetration[$i] = (int)(($gen_data[$i]/100) * $province_population[$i]);
            }
            $pdf = PDF::loadView( 'reportgeneration.pdf_population_penetration_province',  compact(['province_name','gen_data','province_population','population_penetration',
            'todayDate',
            'todayTime']));
            return $pdf->download( 'Province'.$generation .'Coverage Population Data.pdf' );
        }
        elseif($administration=='district'){
            ${'coverage_area_'.$generation.'_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${'coverage_area_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${$administration.'_area'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('total_area','gid');
            ${$administration.'_name'}=DB::table('maps_'.$administration)->orderby('gid')->pluck($administration,'gid');
            foreach(${'coverage_area_'.$generation.'_'.$administration} as $key=>$value){
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)((${'coverage_area_'.$generation.'_'.$administration}[$key]/${$administration.'_area'}[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_'.$administration};
            ${$administration.'_population'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('population','gid');
            ${$administration.'Count'}=DB::table('maps_'.$administration)->count();
            for ( $i = 1; $i <= ${$administration.'Count'}; $i++ ) {
                $population_penetration[$i] = (int)(($gen_data[$i]/100) * ${$administration.'_population'}[$i]);
            }
            $pdf = PDF::loadView( 'reportgeneration.pdf_population_penetration_'.$administration,  compact([$administration.'_name','gen_data', $administration.'_population','population_penetration',
            'todayDate',
            'todayTime']));
            return $pdf->download( $administration . $generation .'Coverage Population Data.pdf' );
        }
        elseif($administration=='vdc'){
            ${'coverage_area_'.$generation.'_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${'coverage_area_'.$administration}=DB::table('coverage_area_'.$generation.'_'.$administration)->orderby('gid')->pluck('st_area','gid');
            ${$administration.'_area'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('total_area','gid');
            ${$administration.'_name'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('gapa_napa','gid');
            foreach(${'coverage_area_'.$generation.'_'.$administration} as $key=>$value){
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)($value/1000000);
                ${'coverage_area_'.$generation.'_'.$administration}[$key]=(int)((${'coverage_area_'.$generation.'_'.$administration}[$key]/${$administration.'_area'}[$key])*100);
            }
            $gen_data=  ${'coverage_area_'.$generation.'_'.$administration};
            ${$administration.'_population'}=DB::table('maps_'.$administration)->orderby('gid')->pluck('population','gid');
            ${$administration.'Count'}=DB::table('maps_'.$administration)->count();
            for ( $i = 1; $i <= ${$administration.'Count'}; $i++ ) {
                $population_penetration[$i] = (int)(($gen_data[$i]/100) * ${$administration.'_population'}[$i]);
            }
            $pdf = PDF::loadView( 'reportgeneration.pdf_population_penetration_'.$administration,  compact([$administration.'_name','gen_data', $administration.'_population','population_penetration',
            'todayDate',
            'todayTime']));
            return $pdf->download( $administration . $generation .'Coverage Population Data.pdf' );
        }
    }

    public function getDate() {
        date_default_timezone_set( 'Asia/Kathmandu' );

        return date( 'Y-m-d ' );

    }

    public function getTime() {
        date_default_timezone_set( 'Asia/Kathmandu' );
        return date( 'h:i:sa' );
    }
}
