<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Wireless;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MStaack\LaravelPostgis\Geometries\Point;

class WirelessapiController extends Controller
{
    //Gets all the data which
    public function getAllWireless()
    {
        $wireless = Wireless::get()->toJson(JSON_PRETTY_PRINT);
        return response($wireless, 200);
    }

    //Create new record
    public function createWireless(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wrlstid' => 'required|unique:wirelesses',
//            'oprcd' => 'required',
        ],[
//            'opercd.required' => 'The Operator Code is required!',
            'wrlstid.required' => 'The Microwave Link ID is required!',
            'wrlstid.unique' => 'The Microwave Link ID should be unique.'
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->getMessages()['mwlinkid'],
                ], 404
            );
        }

        $new_id = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New wireless node was created with ID :' . $new_id,
            ], 201
        );
    }

    //Gets specific data as per id from database
    public function getWireless($id)
    {
        if (Wireless::where('id', $id)->exists()) {
            $wireless = Wireless::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($wireless, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per id
    public function updateWireless(Request $request, $id)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Wireless::where('id', $id)->exists()) {

                $validator = Validator::make($request->all(), [
                    'wrlstid' => 'unique:wirelesses,wrlstid,' . $id . ',id',
                ],[
                    'wrlstid.unique' => 'The Microwave Link ID should be unique.'
                ]);

                if ($validator->fails()) {
                    return response()->json
                    (
                        [
                            'message' => $validator->errors()->all(),
                        ], 422
                    );
                }

                $new_id = $this->update($request, $id);
                return response()->json([
                    'message' => 'Record with id=' . $new_id . ' was update successfully',
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
        $wireless              = new Wireless;
        $wireless->wrlstid     = $request->wrlstid;
        $wireless->oprcd       = $request->oprcd;
        $wireless->oprsiteid   = $request->oprsiteid;
        $wireless->oprsitename = $request->oprsitename;
        $wireless->district    = $request->district;
        $wireless->vdc         = $request->vdc;
        $wireless->ward        = $request->ward;
        $wireless->strtname    = $request->strtname;
        $wireless->lat         = is_null($request->lat)?null:$request->lat;
        $wireless->long        = is_null($request->long)?null:$request->long;
        $wireless->radiomodel  = $request->radiomodel;
        $wireless->anthmsl     = $request->anthmsl;
        $wireless->province    = $request->province;
        $wireless->geom        = (is_null($request->lat) || is_null($request->long))?null: new Point($wireless->lat, $wireless->long);
        $wireless->save();

        return $wireless->id;
    }

    //Data update
    private function update($request, $id)
    {

        $wireless              = Wireless::find($id);
        $wireless->wrlstid     = is_null($request->wrlstid) ? $wireless->wrlstid : $request->wrlstid;
        $wireless->oprcd       = is_null($request->oprcd) ? $wireless->oprcd : $request->oprcd;
        $wireless->oprsiteid   = is_null($request->oprsiteid) ? $wireless->oprsiteid : $request->oprsiteid;
        $wireless->oprsitename = is_null($request->oprsitename) ? $wireless->oprsitename : $request->oprsitename;
        $wireless->district    = is_null($request->district) ? $wireless->district : $request->district;
        $wireless->vdc         = is_null($request->vdc) ? $wireless->vdc : $request->vdc;
        $wireless->ward        = is_null($request->ward) ? $wireless->ward : $request->ward;
        $wireless->strtname    = is_null($request->strtname) ? $wireless->strtname : $request->strtname;
        $wireless->lat         = is_null($request->lat) ? $wireless->lat : $request->lat;
        $wireless->long        = is_null($request->long) ? $wireless->long : $request->long;
        $wireless->radiomodel  = is_null($request->radiomodel) ? $wireless->radiomodel : $request->radiomodel;
        $wireless->anthmsl     = is_null($request->anthmsl) ? $wireless->anthmsl : $request->anthmsl;
        $wireless->province    = is_null($request->province) ? $wireless->province : $request->province;
        $wireless->geom        = new Point($wireless->lat, $wireless->long);
        $wireless->save();

        return $wireless->id;
    }
}
