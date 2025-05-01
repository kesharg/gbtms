<?php
// Our Controller
namespace App\Http\Controllers;

use PDF;
use App\PSTN;
use App\Vsat;
use App\System;
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

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport_province;
use App\Exports\ReportExport_country;
use App\Exports\ReportExport_district;
use App\Exports\ReportExport_vdc;


class ReportgenerationController  extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function printCountryData() {
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();
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
        // $totalPSTN = PSTN::count();
        //Wireless sites
        // $totalWireless = Wireless::count();

        // $operatorName = ['NCELL', 'UTL', 'NSTPL', 'NDCL', 'STM', 'SMART'];
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
        $provinceCount = DB::table( 'maps_province' )->count();

        for ( $province = 1; $province <= $provinceCount; $province++ ) {
            $provinceName[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'province' );
            $provinceMicrowaveNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_microwavestation' );
            $provinceVsatNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_vsat' );
            $provinceOpticalfiberLink[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'opticalfiber_length' );
            $provinceBts[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_bts' );
        }
        $districtCount = DB::table( 'maps_district' )->count();
        for ( $district = 1; $district <= $districtCount; $district++ ) {
            $districtMicrowaveNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_microwavestation' );
            $districtName[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'district' );
            $districtVsatNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_vsat' );
            $districtOpticalfiberLink[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'opticalfiber_length' );
            $districtBts[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_bts' );
        }

        $pdf = PDF::loadView( 'reportgeneration.pdf_country',  compact(
            'totalMicrowave',
            'totalMicrowaveLinks',
            'totalVsat',
            'totalSystemsites',
            'totalSystemnodes',
            'totalOpticalfibernode',
            'totalOpticalfiberlink',
            'totalInfrastructure',
            'totalOperator',
            // 'totalPSTN',
            // 'totalWireless',
            //operator wise info
            'vsatNode',
            'opticalfiberLink',
            'opticalfiberNode',
            'systemSiteNode',
            'systemNodes',
            'microwaveLink',
            'microwaveNode',
            //Province info
            'provinceName',
            'provinceMicrowaveNode',
            'provinceVsatNode',
            'provinceOpticalfiberLink',
            'provinceBts',
            'provinceCount',
            //District info
            'districtCount',
            'districtName',
            'districtMicrowaveNode',
            'districtVsatNode',
            'districtOpticalfiberLink',
            'districtBts',
            //Extra info
            'operatorName',
            'todayDate',
            'todayTime',
        ) );
        return $pdf->download( 'Country Data.pdf' );
    }

    public function printProvinceData() {
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        //Microwave Node
        $totalMicrowave = Microwave::count();
        //Opticalfiber Node
        $totalOpticalfibernode = Opticalfiber::count();
        //Vsat Node
        $totalVsat = Vsat::count();
        //BTS system towers
        $totalSystemsites = Systemsite::count();
        //Total count of administrative Unit
        $provinceCount = DB::table( 'maps_province' )->count();

        for ( $province = 1; $province <= $provinceCount; $province++ ) {
            $provinceName[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'province' );
            $provinceMicrowaveNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_microwavestation' );
            $provinceVsatNode[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_vsat' );
            $provinceOpticalfiberLink[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'opticalfiber_length' );
            $provinceBts[$province] = DB::table( 'maps_province' )->where( 'state_code', $province )->pluck( 'no_of_bts' );
        }

        $pdf = PDF::loadView( 'reportgeneration.pdf_province', compact(
            'totalMicrowave',
            'totalOpticalfibernode',
            'totalVsat',
            'totalSystemsites',
            //Province info
            'provinceName',
            'provinceMicrowaveNode',
            'provinceVsatNode',
            'provinceOpticalfiberLink',
            'provinceBts',
            'provinceCount',
            //Extra info
            'todayDate',
            'todayTime',
        ) );
        return $pdf->download( 'Province Data.pdf' );
    }

    public function printDistrictData() {
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        //Microwave Node
        $totalMicrowave = Microwave::count();
        //Opticalfiber Node
        $totalOpticalfibernode = Opticalfiber::count();
        //Vsat Node
        $totalVsat = Vsat::count();
        //BTS system towers
        $totalSystemsites = Systemsite::count();

        //Total count of administrative Unit
        $districtCount = DB::table( 'maps_district' )->count();
        for ( $district = 1; $district <= $districtCount; $district++ ) {
            $districtMicrowaveNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_microwavestation' );
            $districtName[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'district' );
            $districtVsatNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_vsat' );
            $districtOpticalfiberLink[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'opticalfiber_length' );
            $districtBts[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_bts' );
        }
        $pdf = PDF::loadView( 'reportgeneration.pdf_district', compact(
            'totalMicrowave',
            'totalOpticalfibernode',
            'totalVsat',
            'totalSystemsites',
            //District info
            'districtCount',
            'districtName',
            'districtMicrowaveNode',
            'districtVsatNode',
            'districtOpticalfiberLink',
            'districtBts',
            //Extra info
            'todayDate',
            'todayTime',
        ) );
        return $pdf->download( 'District Data.pdf' );
    }

    public function printVdcData() {
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        //Microwave Node
        $totalMicrowave = Microwave::count();
        //Opticalfiber Node
        $totalOpticalfibernode = Opticalfiber::count();
        //Vsat Node
        $totalVsat = Vsat::count();
        //BTS system towers
        $totalSystemsites = Systemsite::count();

        //Total count of administrative Unit
        $vdcCount = DB::table( 'maps_vdc' )->count();
        for ( $vdc = 1; $vdc <= $vdcCount; $vdc++ ) {
            $vdcMicrowaveNode[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_microwavestation' );
            $vdcName[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'gapa_napa' );
            $vdcVsatNode[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_vsat' );
            $vdcOpticalfiberLink[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'opticalfiber_length' );
            $vdcBts[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_bts' );
        }
        $pdf = PDF::loadView( 'reportgeneration.pdf_vdc', compact(
            'totalMicrowave',
            'totalOpticalfibernode',
            'totalVsat',
            'totalSystemsites',
            //District info
            'vdcCount',
            'vdcName',
            'vdcMicrowaveNode',
            'vdcVsatNode',
            'vdcOpticalfiberLink',
            'vdcBts',
            //Extra info
            'todayDate',
            'todayTime',
        ) );
        return $pdf->download( 'Vdc Data.pdf' );
    }

    public function getDate() {
        date_default_timezone_set( 'Asia/Kathmandu' );

        return date( 'Y-m-d ' );

    }

    public function getTime() {
        date_default_timezone_set( 'Asia/Kathmandu' );
        return date( 'h:i:sa' );
    }


    //Division of information based on operator code

    //Microwave Node
    public function getMicrowaveNodeCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            // Contains array with serial information of operators as operator_id
            $Microwave[$o]= Microwave::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Microwave;
    }

    //Microwave Link
    public function getMicrowaveLinkCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $MicrowaveLink[$o]= Microwavestation::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $MicrowaveLink;
    }

    //Optical Fiber Node
    public function getOpticalFiberNode($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Opticalfibernode[$o]= Opticalfiber::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Opticalfibernode;
    }

    //Optical Fiber Link
    public function getOpticalFiberLink($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Opticalfiberlink[$o]= Opticalfiberlink::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Opticalfiberlink;
    }

    //Base Station Node( System Site )
    public function getSystemsiteNode($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Systemsite[$o]= Systemsite::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Systemsite;
    }

    //System node( Multiple system node in single base station )
    public function getSystemNodes($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $System[$o]= System::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $System;
    }

    //Vsat node
    public function getVsatNodeCount($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Vsat[$o]= Vsat::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        return $Vsat;
    }

    //PSTN node( public switched telephone network )
    public function getPSTN($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Pstn[$o]= PSTN::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        // return $Pstn;
    }

    //Wireless node
    public function getWirelessSite($operatorName,$operatorCount) {
        for ( $o = 0; $o < $operatorCount; $o++ ) {
            $Wirelesssite[$o]= Wireless::where( 'oprcd', 'ilike', $operatorName[$o] )->count();
        }
        // return $Wirelesssite;
    }

    public function exportCSV_province(Request $request)
    {
        return Excel::download(new ReportExport_province, 'ReportExport_province.csv');
    }

    public function exportCSV_country(Request $request)
    {
        return Excel::download(new ReportExport_country, 'ReportExport_country.csv');
    }

    public function exportCSV_district(Request $request)
    {
        return Excel::download(new ReportExport_district, 'ReportExport_district.csv');
    }

    public function exportCSV_vdc(Request $request)
    {
        return Excel::download(new ReportExport_vdc, 'ReportExport_vdc.csv');
    }
}
