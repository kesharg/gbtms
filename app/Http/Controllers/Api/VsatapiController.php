<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Vsat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MStaack\LaravelPostgis\Geometries\Point;

class VsatapiController extends Controller
{

    //Gets all the data which
    public function getAllVsat()
    {
        $vsat = Vsat::get()->toJson(JSON_PRETTY_PRINT);
        return response($vsat, 200);
    }

    //Create new record
    public function createVsat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vsatid' => 'required|unique:vsats',
            'oprcd' => 'required|exists:operators,operator_code',
        ],[
            'vsatid.unique' => 'The VSAT ID should be unique.',
            'oprcd.exists' => 'The Operator Code doesnot exists!',
        
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->all(),
                ], 422
            );
        }

        $new_vsatid = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New vsat node was created with vsatid :' . $new_vsatid,
            ], 201
        );
    }

    //Gets specific data as per vsatid from database
    public function getVsat($vsatid)
    {
        if (Vsat::where('vsatid', $vsatid)->exists()) {
            $vsat = Vsat::where('vsatid', $vsatid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($vsat, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per vsatid
    public function updateVsat(Request $request, $vsatid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Vsat::where('vsatid', $vsatid)->exists()) {

                $validator = Validator::make($request->all(), [
                    'oprcd' => 'required|exists:operators,operator_code',
                ],[
                   'oprcd.exists' => 'The Operator Code doesnot exists!',
                ]);

                if ($validator->fails()) {
                    return response()->json
                    (
                        [
                            'message' => $validator->errors()->all(),
                        ], 422
                    );
                }

                $new_vsatid = $this->update($request, $vsatid);
                return response()->json([
                    'message' => 'Record with vsatid=' . $new_vsatid . ' was update successfully',
                ], 200);
            } else {
                return response()->json
                    (
                    [
                        'message' => 'Record was not found',
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
        $vsat              = new Vsat;
        $vsat->vsatid      = $request->vsatid;
        $vsat->oprcd       = $request->oprcd;
        $vsat->oprvsatid   = $request->oprvsatid;
        $vsat->vsatstnname = $request->vsatstnname;
        $vsat->district    = $request->district;
        $vsat->vdc         = $request->vdc;
        $vsat->ward        = $request->ward;
        $vsat->strtname    = $request->strtname;
        $vsat->lat         = is_null($request->lat)?null:$request->lat;
        $vsat->long        = is_null($request->long)?null:$request->long;
        $vsat->geom        = $request->geom;
        $vsat->oprfrom     = $request->oprfrom;
        $vsat->oprto       = $request->oprto;
        $vsat->purpose     = $request->purpose;
        $vsat->uplink      = $request->uplink;
        $vsat->downlink    = $request->downlink;
        $vsat->modtechq    = $request->modtechq;
        $vsat->stationtype = $request->stationtype;
        $vsat->updatart    = $request->updatart;
        $vsat->dwndatart   = $request->dwndatart;
        $vsat->transpwr    = $request->transpwr;
        $vsat->radiomodel  = $request->radiomodel;
        $vsat->antdia      = $request->antdia;
        $vsat->anthtmsl    = $request->anthtmsl;
        $vsat->status      = $request->status;
        $vsat->band_code   = $request->band_code;
        $vsat->band_width  = $request->band_width;
        $vsat->namesat     = $request->namesat;
        $vsat->satorient   = $request->satorient;
        $vsat->rurubr      = $request->rurubr;
        $vsat->province    = $request->province;
        $vsat->geom        = (is_null($request->lat) || is_null($request->long))?null: new Point($request->lat, $request->long);
        $vsat->save();

        return $vsat->vsatid;
    }

    //Data update
    private function update($request, $vsatid)
    {
        $vsat              = Vsat::find($vsatid);
        $vsat->vsatid      = is_null($request->vsatid) ? $vsat->vsatid : $vsat->vsatid;
        $vsat->oprcd       = is_null($request->oprcd) ? $vsat->oprcd : $request->oprcd;
        $vsat->oprvsatid   = is_null($request->oprvsatid) ? $vsat->oprvsatid : $request->oprvsatid;
        $vsat->vsatstnname = is_null($request->vsatstnname) ? $vsat->vsatstnname : $request->vsatstnname;
        $vsat->district    = is_null($request->district) ? $vsat->district : $request->district;
        $vsat->vdc         = is_null($request->vdc) ? $vsat->vdc : $request->vdc;
        $vsat->ward        = is_null($request->ward) ? $vsat->ward : $request->ward;
        $vsat->strtname    = is_null($request->strtname) ? $vsat->strtname : $request->strtname;
        $vsat->lat         = is_null($request->lat) ? $vsat->lat : $request->lat;
        $vsat->long        = is_null($request->long) ? $vsat->long : $request->long;
        $vsat->geom        = is_null($request->geom) ? $vsat->geom : $request->geom;
        $vsat->oprfrom     = is_null($request->oprfrom) ? $vsat->oprfrom : $request->oprfrom;
        $vsat->oprto       = is_null($request->oprto) ? $vsat->oprto : $request->oprto;
        $vsat->purpose     = is_null($request->purpose) ? $vsat->purpose : $request->purpose;
        $vsat->uplink      = is_null($request->uplink) ? $vsat->uplink : $request->uplink;
        $vsat->downlink    = is_null($request->downlink) ? $vsat->downlink : $request->downlink;
        $vsat->modtechq    = is_null($request->modtechq) ? $vsat->modtechq : $request->modtechq;
        $vsat->stationtype = is_null($request->stationtype) ? $vsat->stationtype : $request->stationtype;
        $vsat->updatart    = is_null($request->updatart) ? $vsat->updatart : $request->updatart;
        $vsat->dwndatart   = is_null($request->dwndatart) ? $vsat->dwndatart : $request->dwndatart;
        $vsat->transpwr    = is_null($request->transpwr) ? $vsat->transpwr : $request->transpwr;
        $vsat->radiomodel  = is_null($request->radiomodel) ? $vsat->radiomodel : $request->radiomodel;
        $vsat->antdia      = is_null($request->antdia) ? $vsat->antdia : $request->antdia;
        $vsat->status      = is_null($request->status) ? $vsat->status : $request->status;
        $vsat->band_code   = is_null($request->band_code) ? $vsat->band_code : $request->band_code;
        $vsat->band_width  = is_null($request->band_width) ? $vsat->band_width : $request->band_width;
        $vsat->namesat     = is_null($request->namesat) ? $vsat->namesat : $request->namesat;
        $vsat->satorient   = is_null($request->satorient) ? $vsat->satorient : $request->satorient;
        $vsat->rurubr      = is_null($request->rurubr) ? $vsat->rurubr : $request->rurubr;
        $vsat->province    = is_null($request->province) ? $vsat->province : $request->province;
        $vsat->geom        = new Point($vsat->lat, $vsat->long);
        $vsat->save();

        return $vsat->vsatid;
    }

    public function destroy($vsatid)
    {
        if (Vsat::where('vsatid', $vsatid)->exists()) {
            $vsat = Vsat::destroy($vsatid);
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
}
