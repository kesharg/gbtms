<?php

namespace App\Http\Controllers\Api;

use App\Opticalfiber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MStaack\LaravelPostgis\Geometries\Point;
use Illuminate\Support\Facades\Validator;


class OpticalfiberapiController extends Controller
{
    //Gets all the data which
    public function getAllOpticalfiber()
    {
        $Opticalfiber = Opticalfiber::get()->toJson(JSON_PRETTY_PRINT);
        return response($Opticalfiber, 200);
    }

    //Create new record
    public function createOpticalfiber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nodeid' => 'required|unique:opticalfibers',
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
                'message' => 'New Opticalfiber node was created with nodeid :' . $new_nodeid,
            ], 201
        );
    }

    //Gets specific data as per nodeid from database
    public function getOpticalfiber($nodeid)
    {
        if (Opticalfiber::where('nodeid', $nodeid)->exists()) {
            $Opticalfiber = Opticalfiber::where('nodeid', $nodeid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($Opticalfiber, 200);
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
    public function updateOpticalfiber(Request $request, $nodeid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Opticalfiber::where('nodeid', $nodeid)->exists()) {

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
        $Opticalfiber           = new Opticalfiber;
        $Opticalfiber->nodeid   = $request->nodeid;
        $Opticalfiber->nodename = $request->nodename;
        $Opticalfiber->oprcd    = $request->oprcd;
        $Opticalfiber->lat      = is_null($request->lat)?null:$request->lat;
        $Opticalfiber->long     = is_null($request->long)?null:$request->long;
        $Opticalfiber->province = $request->province;
        $Opticalfiber->district = $request->district;
        $Opticalfiber->vdc      = $request->vdc;
        $Opticalfiber->ward     = $request->ward;
        $Opticalfiber->strtname = $request->strtname;
        $Opticalfiber->geom     = (is_null($request->lat) || is_null($request->long))?null: new Point($Opticalfiber->lat, $Opticalfiber->long);
        $Opticalfiber->save();

        return $Opticalfiber->nodeid;
    }

    //Data update
    private function update($request, $nodeid)
    {

        $Opticalfiber           = Opticalfiber::find($nodeid);
        $Opticalfiber->nodeid   = is_null($request->nodeid) ? $Opticalfiber->nodeid : $Opticalfiber->nodeid;
        $Opticalfiber->nodename = is_null($request->nodename) ? $Opticalfiber->nodename : $request->nodename;
        $Opticalfiber->oprcd    = is_null($request->oprcd) ? $Opticalfiber->oprcd : $request->oprcd;
        $Opticalfiber->lat      = is_null($request->lat) ? $Opticalfiber->lat : $request->lat;
        $Opticalfiber->long     = is_null($request->long) ? $Opticalfiber->long : $request->long;
        $Opticalfiber->province = is_null($request->province) ? $Opticalfiber->province : $request->province;
        $Opticalfiber->district = is_null($request->district) ? $Opticalfiber->district : $request->district;
        $Opticalfiber->vdc      = is_null($request->vdc) ? $Opticalfiber->vdc : $request->vdc;
        $Opticalfiber->ward     = is_null($request->ward) ? $Opticalfiber->ward : $request->ward;
        $Opticalfiber->strtname = is_null($request->strtname) ? $Opticalfiber->strtname : $request->strtname;
        $Opticalfiber->geom     = new Point($Opticalfiber->lat, $Opticalfiber->long);
        $Opticalfiber->save();

        return $Opticalfiber->nodeid;
    }

    public function destroy($nodeid)
    {
        if (Opticalfiber::where('nodeid', $nodeid)->exists()) {
            $Opticalfiber = Opticalfiber::destroy($nodeid);
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
