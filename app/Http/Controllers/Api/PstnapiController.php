<?php

namespace App\Http\Controllers\Api;

use App\PSTN;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use MStaack\LaravelPostgis\Geometries\Point;

class PstnapiController extends Controller
{
    //Gets all the data which
    public function getAllPstn()
    {
        $pstn = PSTN::get()->toJson(JSON_PRETTY_PRINT);
        return response($pstn, 200);
    }

    //Create new record
    public function createPstn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exid' => 'required|unique:p_s_t_n_s',
        ],[
            'exid.required' => 'Exchange ID is required!',
            'exid.unique' => 'Exchange ID should be unique'
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->getMessages()['exid'],
                ], 404
            );
        }
        $new_id = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New pstn node was created with ID :' . $new_id,
            ], 201
        );
    }

    //Gets specific data as per id from database
    public function getPstn($id)
    {
        if (PSTN::where('id', $id)->exists()) {
            $pstn = PSTN::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($pstn, 200);
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
    public function updatePstn(Request $request, $id)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (PSTN::where('id', $id)->exists()) {
                $validator = Validator::make($request->all(), [
                    'exid' => 'unique:p_s_t_n_s,exid,' . $id . ',id',
                ],[
                    'exid.unique' => 'Exchange ID should be unique'
                ]);

                if ($validator->fails()) {
                    return response()->json
                    (
                        [
                            'message' => $validator->errors()->getMessages()['exid'],
                        ], 404
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
        $pstn           = new PSTN;
        $pstn->exid     = $request->exid;
        $pstn->oprexid  = $request->oprexid;
        $pstn->exname   = $request->exname;
        $pstn->extype   = $request->extype;
        $pstn->prtex    = $request->prtex;
        $pstn->district = $request->district;
        $pstn->vdc      = $request->vdc;
        $pstn->ward     = $request->ward;
        $pstn->strtname = $request->strtname;
        $pstn->lat      = is_null($request->lat)?null:$request->lat;
        $pstn->long     = is_null($request->long)?null:$request->long;
        $pstn->oprcd    = $request->oprcd;
        $pstn->province = $request->province;
        $pstn->geom     = (is_null($request->lat) || is_null($request->long))?null: new Point($pstn->lat, $pstn->long);
        $pstn->save();

        return $pstn->id;
    }

    //Data update
    private function update($request, $id)
    {

        $pstn           = PSTN::find($id);
        $pstn->exid     = is_null($request->exid) ? $pstn->exid : $request->exid;
        $pstn->oprexid  = is_null($request->oprexid) ? $pstn->oprexid : $request->oprexid;
        $pstn->exname   = is_null($request->exname) ? $pstn->exname : $request->exname;
        $pstn->extype   = is_null($request->extype) ? $pstn->extype : $request->extype;
        $pstn->prtex    = is_null($request->prtex) ? $pstn->prtex : $request->prtex;
        $pstn->district = is_null($request->district) ? $pstn->district : $request->district;
        $pstn->vdc      = is_null($request->vdc) ? $pstn->vdc : $request->vdc;
        $pstn->ward     = is_null($request->ward) ? $pstn->ward : $request->ward;
        $pstn->strtname = is_null($request->strtname) ? $pstn->strtname : $request->strtname;
        $pstn->lat      = is_null($request->lat) ? $pstn->lat : $request->lat;
        $pstn->long     = is_null($request->long) ? $pstn->long : $request->long;
        $pstn->oprcd    = is_null($request->oprcd) ? $pstn->oprcd : $request->oprcd;
        $pstn->province = is_null($request->province) ? $pstn->province : $request->province;
        $pstn->geom     = new Point($pstn->lat, $pstn->long);
        $pstn->save();

        return $pstn->id;
    }
}
