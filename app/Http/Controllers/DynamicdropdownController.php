<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DynamicdropdownController extends Controller {
    public function getdistrict( $province ) {
        $province = DB::table( 'maps_province' )->where( 'province', $province )->pluck( 'state_code' );
        $district = DB::table( 'maps_district' )
        ->where( 'state_code', $province )
        ->pluck( 'district' );
        return json_encode( $district );
    }

    public function getalldistrict() {
        $district = DB::table( 'maps_district' )->orderby( 'district' )->pluck( 'district' );
        return json_encode( $district );
    }

    public function getvdc( $district ) {
        $vdc = DB::table( 'maps_vdc' )
        ->where( 'district', $district )
        ->pluck( 'gapa_napa' );
        return json_encode( $vdc );
    }

    public function getallvdc() {
        $vdc = DB::table( 'maps_vdc' )->orderby( 'gapa_napa' )->pluck( 'gapa_napa' );
        return json_encode( $vdc );
    }

    public function getward( $vdc ) {
        $ward = DB::table( 'maps_ward' )->orderby( 'new_ward_n' )
        ->where( 'gapa_napa', $vdc )
        ->pluck( 'new_ward_n' );
        return json_encode( $ward );
    }
}
