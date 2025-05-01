<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Microwave;
use Illuminate\Http\Request;
use MStaack\LaravelPostgis\Geometries\Point;
use Illuminate\Support\Facades\Validator;

class MicrowaveapiController extends Controller
{

    //Gets all the data which
    public function getAllMicrowave()
    {
        $microwave = Microwave::get()->toJson(JSON_PRETTY_PRINT);
        return response($microwave, 200);
    }

    //Create new record
    public function createMicrowave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mwstncode' => 'required|unique:microwaves',
            'oprcd' => 'required|exists:operators,operator_code',
        ],[
            'mwstncode.unique' => 'The Microwave Station Code should be unique.',
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

        $new_mwstncode = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New microwave node was created with mwstncode :' . $new_mwstncode,
            ], 201
        );
    }

    //Gets specific data as per mwstncode from database
    public function getMicrowave($mwstncode)
    {
        if (Microwave::where('mwstncode', $mwstncode)->exists()) {
            $microwave = Microwave::where('mwstncode', $mwstncode)->get()->toJson(JSON_PRETTY_PRINT);
            return response($microwave, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was Not Found',
                ], 404
            );
        }
    }

    //Update specific data in database as per mwstncode
    public function updateMicrowave(Request $request, $mwstncode)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Microwave::where('mwstncode', $mwstncode)->exists()) {

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

                $new_mwstncode = $this->update($request, $mwstncode);
                return response()->json([
                    'message' => 'Record with mwstncode=' . $new_mwstncode . ' was update successfully',
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
        $microwave             = new Microwave;
        $microwave->mwstncode  = $request->mwstncode;
        $microwave->oprcd      = $request->oprcd;
        $microwave->mwstncdopr = $request->mwstncdopr;
        $microwave->mwstnname  = $request->mwstnname;
        $microwave->province   = $request->province;
        $microwave->district   = $request->district;
        $microwave->vdc        = $request->vdc;
        $microwave->ward       = $request->ward;
        $microwave->strtname   = $request->strtname;
        $microwave->lat        = is_null($request->lat)?null:$request->lat;
        $microwave->long       = is_null($request->long)?null:$request->long;
        $microwave->geom       = (is_null($request->lat) || is_null($request->long))?null: new Point($microwave->lat, $microwave->long);
        $microwave->save();

        return $microwave->mwstncode;
    }

    //Data update
    private function update($request, $mwstncode)
    {

        $microwave             = Microwave::find($mwstncode);
        $microwave->mwstncode  = is_null($request->mwstncode) ? $microwave->mwstncode : $microwave->mwstncode;
        $microwave->oprcd      = is_null($request->oprcd) ? $microwave->oprcd : $request->oprcd;
        $microwave->mwstncdopr = is_null($request->mwstncdopr) ? $microwave->mwstncdopr : $request->mwstncdopr;
        $microwave->mwstnname  = is_null($request->mwstnname) ? $microwave->mwstnname : $request->mwstnname;
        $microwave->province   = is_null($request->province) ? $microwave->province : $request->province;
        $microwave->district   = is_null($request->district) ? $microwave->district : $request->district;
        $microwave->vdc        = is_null($request->vdc) ? $microwave->vdc : $request->vdc;
        $microwave->ward       = is_null($request->ward) ? $microwave->ward : $request->ward;
        $microwave->strtname   = is_null($request->strtname) ? $microwave->strtname : $request->strtname;
        $microwave->lat        = is_null($request->lat) ? $microwave->lat : $request->lat;
        $microwave->long       = is_null($request->long) ? $microwave->long : $request->long;
        $microwave->geom       = new Point($microwave->lat, $microwave->long);
        $microwave->update();

        return $microwave->mwstncode;
    }

    public function destroy($mwstncode)
    {
        if (Microwave::where('mwstncode', $mwstncode)->exists()) {
            $Microwave = Microwave::destroy($mwstncode);
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
