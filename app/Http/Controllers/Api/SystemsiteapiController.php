<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Systemsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MStaack\LaravelPostgis\Geometries\Point;

class SystemsiteapiController extends Controller
{
    //Gets all the data which
    public function getAllSystemsite()
    {
        $systemsite = Systemsite::get()->toJson(JSON_PRETTY_PRINT);
        return response($systemsite, 200);
    }

    //Create new record
    public function createSystemsite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'syssiteid' => 'required|unique:systemsites',
            'oprcd' => 'required|exists:operators,operator_code',
        ],[
            'syssiteid.required' => 'The System Site ID is required!',
            'syssiteid.unique' => 'The System Site ID should be unique.',
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

        $new_syssiteid = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New systemsite node was created with syssiteid :' . $new_syssiteid,
            ], 201
        );
    }

    //Gets specific data as per id from database
    public function getSystemsite($syssiteid)
    {
        if (Systemsite::where('syssiteid', $syssiteid)->exists()) {
            $systemsite = Systemsite::where('syssiteid', $syssiteid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($systemsite, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per syssiteid
    public function updateSystemsite(Request $request, $syssiteid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Systemsite::where('syssiteid', $syssiteid)->exists()) {

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

                $new_syssiteid = $this->update($request, $syssiteid);
                return response()->json([
                    'message' => 'Record with syssiteid=' . $new_syssiteid . ' was update successfully',
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
        $systemsite              = new Systemsite;
        $systemsite->syssiteid   = $request->syssiteid;
        $systemsite->oprcd       = $request->oprcd;
        $systemsite->oprsitename = $request->oprsitename;
        $systemsite->oprsiteid   = $request->oprsiteid;
        $systemsite->lat         = is_null($request->lat)?null:$request->lat;
        $systemsite->long        = is_null($request->long)?null:$request->long;
        $systemsite->province    = $request->province;
        $systemsite->district    = $request->district;
        $systemsite->vdc         = $request->vdc;
        $systemsite->ward        = $request->ward;
        $systemsite->strtname    = $request->strtname;
        $systemsite->anthtmsl    = $request->anthtmsl;
        $systemsite->anthtgl     = $request->anthtgl;
        $systemsite->antbase     = $request->antbase;
        $systemsite->antloc      = $request->antloc;
        $systemsite->geom        = (is_null($request->lat) || is_null($request->long))?null: new Point($request->lat, $request->long);
        $systemsite->save();

        return $systemsite->syssiteid;
    }

    //Data update
    private function update($request, $syssiteid)
    {
        $systemsite              = Systemsite::find($syssiteid);
        $systemsite->syssiteid   = is_null($request->syssiteid) ? $systemsite->syssiteid : $systemsite->syssiteid;
        $systemsite->oprcd       = is_null($request->oprcd) ? $systemsite->oprcd : $request->oprcd;
        $systemsite->oprsitename = is_null($request->oprsitename) ? $systemsite->oprsitename : $request->oprsitename;
        $systemsite->oprsiteid   = is_null($request->oprsiteid) ? $systemsite->oprsiteid : $request->oprsiteid;
        $systemsite->lat         = is_null($request->lat) ? $systemsite->lat : $request->lat;
        $systemsite->long        = is_null($request->long) ? $systemsite->long : $request->long;
        $systemsite->province    = is_null($request->province) ? $systemsite->province : $request->province;
        $systemsite->district    = is_null($request->district) ? $systemsite->district : $request->district;
        $systemsite->vdc         = is_null($request->vdc) ? $systemsite->vdc : $request->vdc;
        $systemsite->ward        = is_null($request->ward) ? $systemsite->ward : $request->ward;
        $systemsite->strtname    = is_null($request->strtname) ? $systemsite->strtname : $request->strtname;
        $systemsite->anthtmsl    = is_null($request->anthtmsl) ? $systemsite->anthtmsl : $request->anthtmsl;
        $systemsite->anthtgl     = is_null($request->anthtgl) ? $systemsite->anthtgl : $request->anthtgl;
        $systemsite->antbase     = is_null($request->antbase) ? $systemsite->antbase : $request->antbase;
        $systemsite->antloc      = is_null($request->antloc) ? $systemsite->antloc : $request->antloc;
        $systemsite->geom        = new Point($systemsite->lat, $systemsite->long);
        $systemsite->save();

        return $systemsite->syssiteid;
    }

    public function destroy($syssiteid)
    {
        if (Systemsite::where('syssiteid', $syssiteid)->exists()) {
            $Systemsite = Systemsite::destroy($syssiteid);
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
