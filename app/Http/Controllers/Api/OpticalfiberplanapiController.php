<?php

namespace App\Http\Controllers\Api;

use App\Opticalfiberplan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MStaack\LaravelPostgis\Geometries\Point;
use Illuminate\Support\Facades\Validator;


class OpticalfiberplanapiController extends Controller
{
    //Gets all the data which
    public function getAllOpticalfiberplan()
    {
        $Opticalfiberplan = Opticalfiberplan::get()->toJson(JSON_PRETTY_PRINT);
        return response($Opticalfiberplan, 200);
    }

    //Create new record
    public function createOpticalfiberplan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nodeid' => 'required|unique:opticalfiberplans',
            'oprcd' => 'required|exists:operators,operator_code',
        ],[
            'nodeid.unique' => 'The NODE ID should be unique.',
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

        $new_nodeid = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New Opticalfiberplan node was created with nodeid :' . $new_nodeid,
            ], 201
        );
    }

    //Gets specific data as per nodeid from database
    public function getOpticalfiberplan($nodeid)
    {
        if (Opticalfiberplan::where('nodeid', $nodeid)->exists()) {
            $Opticalfiberplan = Opticalfiberplan::where('nodeid', $nodeid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($Opticalfiberplan, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per nodeid
    public function updateOpticalfiberplan(Request $request, $nodeid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Opticalfiberplan::where('nodeid', $nodeid)->exists()) {

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

                $new_nodeid = $this->update($request, $nodeid);
                return response()->json([
                    'message' => 'Record with nodeid=' . $new_nodeid . ' was update successfully',
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
        $Opticalfiberplan           = new Opticalfiberplan;
        $Opticalfiberplan->nodeid   = $request->nodeid;
        $Opticalfiberplan->nodename = $request->nodename;
        $Opticalfiberplan->oprcd    = $request->oprcd;
        $Opticalfiberplan->lat      = is_null($request->lat)?null:$request->lat;
        $Opticalfiberplan->long     = is_null($request->long)?null:$request->long;
        $Opticalfiberplan->province = $request->province;
        $Opticalfiberplan->district = $request->district;
        $Opticalfiberplan->vdc      = $request->vdc;
        $Opticalfiberplan->ward     = $request->ward;
        $Opticalfiberplan->strtname = $request->strtname;
        $Opticalfiberplan->geom     = (is_null($request->lat) || is_null($request->long))?null: new Point($Opticalfiberplan->lat, $Opticalfiberplan->long);
        $Opticalfiberplan->save();

        return $Opticalfiberplan->nodeid;
    }

    //Data update
    private function update($request, $nodeid)
    {

        $Opticalfiberplan           = Opticalfiberplan::find($nodeid);
        $Opticalfiberplan->nodeid   = is_null($request->nodeid) ? $Opticalfiberplan->nodeid : $Opticalfiberplan->nodeid;
        $Opticalfiberplan->nodename = is_null($request->nodename) ? $Opticalfiberplan->nodename : $request->nodename;
        $Opticalfiberplan->oprcd    = is_null($request->oprcd) ? $Opticalfiberplan->oprcd : $request->oprcd;
        $Opticalfiberplan->lat      = is_null($request->lat) ? $Opticalfiberplan->lat : $request->lat;
        $Opticalfiberplan->long     = is_null($request->long) ? $Opticalfiberplan->long : $request->long;
        $Opticalfiberplan->province = is_null($request->province) ? $Opticalfiberplan->province : $request->province;
        $Opticalfiberplan->district = is_null($request->district) ? $Opticalfiberplan->district : $request->district;
        $Opticalfiberplan->vdc      = is_null($request->vdc) ? $Opticalfiberplan->vdc : $request->vdc;
        $Opticalfiberplan->ward     = is_null($request->ward) ? $Opticalfiberplan->ward : $request->ward;
        $Opticalfiberplan->strtname = is_null($request->strtname) ? $Opticalfiberplan->strtname : $request->strtname;
        $Opticalfiberplan->geom     = new Point($Opticalfiberplan->lat, $Opticalfiberplan->long);
        $Opticalfiberplan->save();

        return $Opticalfiberplan->nodeid;
    }

    public function destroy($nodeid)
    {
        if (Opticalfiberplan::where('nodeid', $nodeid)->exists()) {
            $Opticalfiberplan = Opticalfiberplan::destroy($nodeid);
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
