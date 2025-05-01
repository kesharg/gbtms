<?php

namespace App\Http\Controllers\Api;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SystemapiController extends Controller
{
    //Gets all the data which
    public function getAllSystem()
    {
        $system = System::get()->toJson(JSON_PRETTY_PRINT);
        return response($system, 200);
    }

    //Create new record
    public function createSystem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deviceid' => 'required|unique:systems',
            'syssiteid' => 'required|exists:systemsites,syssiteid',
            'oprcd' => 'required|exists:operators,operator_code'
        ],[
            'deviceid.required' => 'The Device ID is required!',
            'deviceid.unique' => 'The Device ID should be unique.',
            'syssiteid.required' => 'The System Site ID is required!',
            'syssiteid.exists' => 'The System Site ID doesnot exists!',
            'oprcd.exists' => 'The Operator Code doesnot exists!'
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->all(),
                ], 422
            );
        }

        $new_deviceid = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New system node was created with deviceid :' . $new_deviceid,
            ], 201
        );
    }

    //Gets specific data as per deviceid from database
    public function getSystem($deviceid)
    {
        if (System::where('deviceid',$deviceid)->exists()) {
            $system = System::where('deviceid',$deviceid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($system, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per deviceid
    public function updateSystem(Request $request, $deviceid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (System::where('deviceid',$deviceid)->exists()) {

                $validator = Validator::make($request->all(), [
                    'syssiteid' => 'required|exists:systemsites,syssiteid',
                    'oprcd' => 'required|exists:operators,operator_code'
                ],[
                    'syssiteid.exists' => 'The System Site ID doesnot exists!',
                    'oprcd.exists' => 'The Operator Code doesnot exists!'
                ]);

                if ($validator->fails()) {
                    return response()->json
                    (
                        [
                            'message' => $validator->errors()->all(),
                        ], 422
                    );
                }

                $new_deviceid = $this->update($request, $deviceid);
                return response()->json([
                    'message' => 'Record with deviceid=' . $new_deviceid . ' was update successfully',
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
        $system             = new System;
        $system->oprcd      = $request->oprcd;
        $system->syssiteid  = $request->syssiteid;
        $system->deviceid   = $request->deviceid;
        $system->azimuth    = $request->azimuth;
        $system->tilt       = $request->tilt;
        $system->antgain    = $request->antgain;
        $system->transpwr   = $request->transpwr;
        $system->sector     = $request->sector;
        $system->txchanls   = $request->txchanls;
        $system->rxchanls   = $request->rxchanls;
        $system->carbdwidth = $request->carbdwidth;
        $system->radiomodel = $request->radiomodel;
        $system->oprdate    = $request->oprdate;
        $system->polariz    = $request->polariz;
        $system->status     = $request->status;
        $system->type       = $request->type;
        $system->save();

        return $system->deviceid;
    }

    //Data update
    private function update($request, $deviceid)
    {

        $system             = System::find($deviceid);
        $system->oprcd      = is_null($request->oprcd) ? $system->oprcd : $request->oprcd;
        $system->syssiteid  = is_null($request->syssiteid) ? $system->syssiteid : $request->syssiteid;
        $system->deviceid   = is_null($request->deviceid) ? $system->deviceid : $system->deviceid;
        $system->azimuth    = is_null($request->azimuth) ? $system->azimuth : $request->azimuth;
        $system->tilt       = is_null($request->tilt) ? $system->tilt : $request->tilt;
        $system->antgain    = is_null($request->antgain) ? $system->antgain : $request->antgain;
        $system->transpwr   = is_null($request->transpwr) ? $system->transpwr : $request->transpwr;
        $system->sector     = is_null($request->sector) ? $system->sector : $request->sector;
        $system->txchanls   = is_null($request->txchanls) ? $system->txchanls : $request->txchanls;
        $system->rxchanls   = is_null($request->rxchanls) ? $system->rxchanls : $request->rxchanls;
        $system->carbdwidth = is_null($request->carbdwidth) ? $system->carbdwidth : $request->carbdwidth;
        $system->radiomodel = is_null($request->radiomodel) ? $system->radiomodel : $request->radiomodel;
        $system->oprdate    = is_null($request->oprdate) ? $system->oprdate : $request->oprdate;
        $system->polariz    = is_null($request->polariz) ? $system->polariz : $request->polariz;
        $system->status     = is_null($request->status) ? $system->status : $request->status;
        $system->type       = is_null($request->type) ? $system->type : $request->type;
        $system->save();

        return $system->deviceid;
    }

    public function destroy($deviceid)
    {
        if (System::where('deviceid', $deviceid)->exists()) {
            $System = System::destroy($deviceid);
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
