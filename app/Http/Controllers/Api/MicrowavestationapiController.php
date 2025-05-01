<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Microwavestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MStaack\LaravelPostgis\Geometries\LineString;
use MStaack\LaravelPostgis\Geometries\Point;

class MicrowavestationapiController extends Controller
{
    //Gets all the data
    public function getAllMicrowavestation()
    {
        $microwavestation = Microwavestation::get()->toJson(JSON_PRETTY_PRINT);
        return response($microwavestation, 200);
    }

    //Create new record
    public function createMicrowavestation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mwlinkid' => 'required|unique:microwavestations',
            'oprcd' => 'required|exists:operators,operator_code',
            'mwstncodea' => 'required|exists:microwaves,mwstncode',
            'mwstncodeb' => 'required|exists:microwaves,mwstncode',
        ],[
            'mwlinkid.required' => 'The Microwave Link ID is required!',
            'mwlinkid.unique' => 'The Microwave Link ID should be unique.',
            'oprcd.exists' => 'The Operator Code doesnot exists!',
            'mwstncodea.exists' => 'The Microwavestation Code doesnot exists! ( point A )',
            'mwstncodeb.exists' => 'The Microwavestation Code doesnot exists! ( point B )',
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->all(),
                ], 422
            );
        }

        $new_mwlinkid = $this->create($request);

        return response()->json
            (
            [
                'message' => 'New microwavelink was created with mwlinkid :' . $new_mwlinkid,
            ], 201
        );
    }

    //Gets specific data as per mwlinkid from database
    public function getMicrowavestation($mwlinkid)
    {
        if (Microwavestation::where('mwlinkid', $mwlinkid)->exists()) {
            $microwavestation = Microwavestation::where('mwlinkid', $mwlinkid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($microwavestation, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was Not Found',
                ], 404
            );
        }
    }

    //Update specific data in database as per mwlinkid
    public function updateMicrowavestation(Request $request, $mwlinkid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Microwavestation::where('mwlinkid', $mwlinkid)->exists()) {

                $validator = Validator::make($request->all(), [
                    'oprcd' => 'required|exists:operators,operator_code',
                    'mwstncodea' => 'required|exists:microwaves,mwstncode',
                    'mwstncodeb' => 'required|exists:microwaves,mwstncode',
                ],[
                    'oprcd.exists' => 'The Operator Code doesnot exists!',
                    'mwstncodea.exists' => 'The Microwavestation Code doesnot exists! ( point A )',
                    'mwstncodeb.exists' => 'The Microwavestation Code doesnot exists! ( point B )',
                ]);

                if ($validator->fails()) {
                    return response()->json
                    (
                        [
                            'message' => $validator->errors()->all(),
                        ], 422
                    );
                }

                $new_mwlinkid = $this->update($request, $mwlinkid);
                return response()->json([
                    'message' => 'Record with mwlinkid=' . $new_mwlinkid . ' was Updated Successfully',
                ], 200);
            } else {
                return response()->json
                    (
                    [
                        'message' => 'Record was Not Found',
                    ], 404
                );

            }
        } else {
            return response()->json
                (
                [
                    'message' => 'Unsupported media type',
                ], 415
            );
        }
    }

    //Data create
    private function create($request)
    {
        $microwavestation              = new Microwavestation;
        $microwavestation->mwlinkid    = $request->mwlinkid;
        $microwavestation->oprcd       = $request->oprcd;
        $microwavestation->oprlinkid   = $request->oprlinkid;
        $microwavestation->linkname    = $request->linkname;
        $microwavestation->distance    = $request->distance;
        $microwavestation->bdwidth     = $request->bdwidth;
        $microwavestation->polariz     = $request->polariz;
        $microwavestation->protection  = $request->protection;
        $microwavestation->dateapprove = $request->dateapprove;
        $microwavestation->mwstnname   = $request->mwstnname;
        $microwavestation->dateoprt    = $request->dateoprt;
        $microwavestation->status      = $request->status;
        $microwavestation->mwstncodea  = $request->mwstncodea;
        $microwavestation->azimutha    = $request->azimutha;
        $microwavestation->radiomodela = $request->radiomodela;
        $microwavestation->txfrqa      = $request->txfrqa;
        $microwavestation->rxfrqa      = $request->rxfrqa;
        $microwavestation->antdiaa     = $request->antdiaa;
        $microwavestation->antgaina    = $request->antgaina;
        $microwavestation->txpowera    = $request->txpowera;
        $microwavestation->rxpowera    = $request->rxpowera;
        $microwavestation->anthtgla    = $request->anthtgla;
        $microwavestation->mwstncodeb  = $request->mwstncodeb;
        $microwavestation->azimuthb    = $request->azimuthb;
        $microwavestation->radiomodelb = $request->radiomodelb;
        $microwavestation->txfrqb      = $request->txfrqb;
        $microwavestation->rxfrqb      = $request->rxfrqb;
        $microwavestation->antdiab     = $request->antdiab;
        $microwavestation->antgainb    = $request->antgainb;
        $microwavestation->txpowerb    = $request->txpowerb;
        $microwavestation->rxpowerb    = $request->rxpowerb;
        $microwavestation->anthtglb    = $request->anthtglb;
        $microwavestation->band_code   = $request->band_code;
        $start_point                   = (is_null($request->start_point_lat) || is_null($request->start_point_long))?null: new Point($request->start_point_lat, $request->start_point_long);
        $end_point                     = (is_null($request->end_point_lat) || is_null($request->end_point_long))?null: new Point($request->end_point_lat, $request->end_point_long);
        $microwavestation->geom        = new LineString([$start_point, $end_point]);
        $microwavestation->save();

        return $microwavestation->mwlinkid;
    }

    //Data update
    private function update($request, $mwlinkid)
    {
        $microwavestation              = Microwavestation::find($mwlinkid);
        $microwavestation->mwlinkid    = is_null($request->mwlinkid) ? $microwavestation->mwlinkid : $microwavestation->mwlinkid;
        $microwavestation->oprcd       = is_null($request->oprcd) ? $microwavestation->oprcd : $request->oprcd;
        $microwavestation->oprlinkid   = is_null($request->oprlinkid) ? $microwavestation->oprlinkid : $request->oprlinkid;
        $microwavestation->linkname    = is_null($request->linkname) ? $microwavestation->linkname : $request->linkname;
        $microwavestation->distance    = is_null($request->distance) ? $microwavestation->distance : $request->distance;
        $microwavestation->bdwidth     = is_null($request->bdwidth) ? $microwavestation->bdwidth : $request->bdwidth;
        $microwavestation->polariz     = is_null($request->polariz) ? $microwavestation->polariz : $request->polariz;
        $microwavestation->protection  = is_null($request->protection) ? $microwavestation->protection : $request->protection;
        $microwavestation->dateapprove = is_null($request->dateapprove) ? $microwavestation->dateapprove : $request->dateapprove;
        $microwavestation->mwstnname   = is_null($request->mwstnname) ? $microwavestation->mwstnname : $request->mwstnname;
        $microwavestation->dateoprt    = is_null($request->dateoprt) ? $microwavestation->dateoprt : $request->dateoprt;
        $microwavestation->status      = is_null($request->status) ? $microwavestation->status : $request->status;
        $microwavestation->mwstncodea  = is_null($request->mwstncodea) ? $microwavestation->mwstncodea : $request->mwstncodea;
        $microwavestation->azimutha    = is_null($request->azimutha) ? $microwavestation->azimutha : $request->azimutha;
        $microwavestation->radiomodela = is_null($request->radiomodela) ? $microwavestation->radiomodela : $request->radiomodela;
        $microwavestation->txfrqa      = is_null($request->txfrqa) ? $microwavestation->txfrqa : $request->txfrqa;
        $microwavestation->rxfrqa      = is_null($request->rxfrqa) ? $microwavestation->rxfrqa : $request->rxfrqa;
        $microwavestation->antdiaa     = is_null($request->antdiaa) ? $microwavestation->antdiaa : $request->antdiaa;
        $microwavestation->antgaina    = is_null($request->antgaina) ? $microwavestation->antgaina : $request->antgaina;
        $microwavestation->txpowera    = is_null($request->txpowera) ? $microwavestation->txpowera : $request->txpowera;
        $microwavestation->rxpowera    = is_null($request->rxpowera) ? $microwavestation->rxpowera : $request->rxpowera;
        $microwavestation->anthtgla    = is_null($request->anthtgla) ? $microwavestation->anthtgla : $request->anthtgla;
        $microwavestation->mwstncodeb  = is_null($request->mwstncodeb) ? $microwavestation->mwstncodeb : $request->mwstncodeb;
        $microwavestation->azimuthb    = is_null($request->azimuthb) ? $microwavestation->azimuthb : $request->azimuthb;
        $microwavestation->radiomodelb = is_null($request->radiomodelb) ? $microwavestation->radiomodelb : $request->radiomodelb;
        $microwavestation->txfrqb      = is_null($request->txfrqb) ? $microwavestation->txfrqb : $request->txfrqb;
        $microwavestation->rxfrqb      = is_null($request->rxfrqb) ? $microwavestation->rxfrqb : $request->rxfrqb;
        $microwavestation->antdiab     = is_null($request->antdiab) ? $microwavestation->antdiab : $request->antdiab;
        $microwavestation->antgainb    = is_null($request->antgainb) ? $microwavestation->antgainb : $request->antgainb;
        $microwavestation->txpowerb    = is_null($request->txpowerb) ? $microwavestation->txpowerb : $request->txpowerb;
        $microwavestation->rxpowerb    = is_null($request->rxpowerb) ? $microwavestation->rxpowerb : $request->rxpowerb;
        $microwavestation->anthtglb    = is_null($request->anthtglb) ? $microwavestation->anthtglb : $request->anthtglb;
        $microwavestation->band_code   = is_null($request->band_code) ? $microwavestation->band_code : $request->band_code;
        $start_point_lat               = is_null($request->start_point_lat) ? $this->get_start_lat($mwlinkid) : $request->start_point_lat;
        $start_point_long              = is_null($request->start_point_long) ? $this->get_start_long($mwlinkid) : $request->start_point_long;
        $end_point_lat                 = is_null($request->end_point_lat) ? $this->get_end_lat($mwlinkid) : $request->end_point_lat;
        $end_point_long                = is_null($request->end_point_long) ? $this->get_end_long($mwlinkid) : $request->end_point_long;
        $start_point                   = new Point($start_point_lat, $start_point_long);
        $end_point                     = new Point($end_point_lat, $end_point_long);
        $microwavestation->geom        = new LineString([$start_point, $end_point]);
        $microwavestation->save();

        return $microwavestation->mwlinkid;
    }

    public function destroy($mwlinkid)
    {
        if (Microwavestation::where('mwlinkid', $mwlinkid)->exists()) {
            $Microwavestation = Microwavestation::destroy($mwlinkid);
            return response()->json
                (
                [
                    'message' => 'Record was deleted successfully',
                ], 200
        );
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Gets start point lattitude from geom in database
    private function get_start_lat($mwlinkid)
    {
        $info_in_json = Microwavestation::where('mwlinkid', $mwlinkid)->get()->toJson(JSON_PRETTY_PRINT);
        $decoded_info = json_decode($info_in_json);
        return $decoded_info[0]->geom->coordinates[0][1];
    }

    //Gets start point longtitude from geom in database
    private function get_start_long($mwlinkid)
    {
        $info_in_json = Microwavestation::where('mwlinkid', $mwlinkid)->get()->toJson(JSON_PRETTY_PRINT);
        $decoded_info = json_decode($info_in_json);
        return $decoded_info[0]->geom->coordinates[0][0];
    }

    //Gets end point lattitude from geom in database
    private function get_end_lat($mwlinkid)
    {
        $info_in_json = Microwavestation::where('mwlinkid', $mwlinkid)->get()->toJson(JSON_PRETTY_PRINT);
        $decoded_info = json_decode($info_in_json);
        return $decoded_info[0]->geom->coordinates[1][1];
    }

    //Gets end point longtitude from geom in database
    private function get_end_long($mwlinkid)
    {
        $info_in_json = Microwavestation::where('mwlinkid', $mwlinkid)->get()->toJson(JSON_PRETTY_PRINT);
        $decoded_info = json_decode($info_in_json);
        return $decoded_info[0]->geom->coordinates[1][0];
    }
}
