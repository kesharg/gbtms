<?php

namespace App\Http\Controllers\Api;

use App\Opticalfiberlinkplan;
use File;
use DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use MStaack\LaravelPostgis\Geometries\Point;
use Illuminate\Support\Facades\Validator;


class OpticalfiberlinkplanapiController extends Controller
{
    //Gets all the data which
    public function getAllOpticalfiberlinkplan()
    {
        $Opticalfiberlinkplan = Opticalfiberlinkplan::get()->toJson(JSON_PRETTY_PRINT);
        return response($Opticalfiberlinkplan, 200);
    }

    //Create new record
    public function createOpticalfiberlinkplan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'oflinkid' => 'required|unique:opticalfiberlinkplans',
            'orgnodeid' => 'required|exists:opticalfiberplans,nodeid',
            'endnodeid' => 'required|exists:opticalfiberplans,nodeid',
            'oprcd' => 'required|exists:operators,operator_code'
        ],[
            'oflinkid.required' => 'The Device ID is required!',
            'oflinkid.unique' => 'The Device ID should be unique.',
            'orgnodeid.exists' => 'The Origin Node ID doesnot exists!',
            'endnodeid.exists' => 'The End Node ID doesnot exists!',
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

        // $new_oflinkid = $this->create($request);
        $createnew = $this->createfromkml($request);
        return response()->json(
            [
                'message' => 'New Opticalfiber planned Link successfully created!!',
            ], 201
        );
    }

    //Gets specific data as per oflinkid from database
    public function getOpticalfiberlinkplan($oflinkid)
    {
        if (Opticalfiberlinkplan::where('oflinkid', $oflinkid)->exists()) {
            $Opticalfiberlinkplan = Opticalfiberlinkplan::where('oflinkid', $oflinkid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($Opticalfiberlinkplan, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per oflinkid
    public function updateOpticalfiberlinkplan(Request $request, $oflinkid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Opticalfiberlinkplan::where('oflinkid', $oflinkid)->exists()) {

                $validator = Validator::make($request->all(), [
                    'orgnodeid' => 'required|exists:opticalfiberplans,nodeid',
                    'endnodeid' => 'required|exists:opticalfiberplans,nodeid',
                    'oprcd' => 'required|exists:operators,operator_code'
                ],[
                    'orgnodeid.exists' => 'The Origin Node ID doesnot exists!',
                    'endnodeid.exists' => 'The End Node ID doesnot exists!',
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

                $new_oflinkid = $this->update($request, $oflinkid);
                return response()->json([
                    'message' => 'Record with oflinkid=' . $new_oflinkid . ' was update successfully',
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
    private function create($request, $kmlpath, $filename)
    {
        $Opticalfiberlinkplan            = new Opticalfiberlinkplan;
        $Opticalfiberlinkplan->oflinkid  = $request->oflinkid;
        $Opticalfiberlinkplan->oprlinkid = $request->oprlinkid;
        $Opticalfiberlinkplan->linkname  = $request->linkname;
        $Opticalfiberlinkplan->oprcd     = $request->oprcd;
        $Opticalfiberlinkplan->length    = $request->length;
        $Opticalfiberlinkplan->orgnodeid = $request->orgnodeid;
        $Opticalfiberlinkplan->endnodeid = $request->endnodeid;
        $Opticalfiberlinkplan->cabletype = $request->cabletype;
        $Opticalfiberlinkplan->fibers    = $request->fibers;
        $Opticalfiberlinkplan->capacity  = $request->capacity;
        $Opticalfiberlinkplan->status    = $request->status;
        $Opticalfiberlinkplan->kmlpath       = $kmlpath;
        $Opticalfiberlinkplan->geom          = Null;
        $Opticalfiberlinkplan->save();

        $oflinkid = $Opticalfiberlinkplan->oflinkid;

        //extract geom from kml file
        $this->extractgeomfromkml($oflinkid, $kmlpath, $filename);

        return $Opticalfiberlinkplan->oflinkid;
    }

    //Data update
    private function update($request, $oflinkid)
    {
        $validated = $request->validate([
            'kmlfile' => 'max:2048',
        ]);
        $Opticalfiberlinkplan           = Opticalfiberlinkplan::find($oflinkid);
        $Opticalfiberlinkplan->oflinkid   = is_null($request->oflinkid) ? $Opticalfiberlinkplan->oflinkid : $Opticalfiberlinkplan->oflinkid;
        $Opticalfiberlinkplan->oprlinkid = is_null($request->oprlinkid) ? $Opticalfiberlinkplan->oprlinkid : $request->oprlinkid;
        $Opticalfiberlinkplan->linkname    = is_null($request->linkname) ? $Opticalfiberlinkplan->linkname : $request->linkname;
        $Opticalfiberlinkplan->oprcd      = is_null($request->oprcd) ? $Opticalfiberlinkplan->oprcd : $request->oprcd;
        $Opticalfiberlinkplan->length     = is_null($request->length) ? $Opticalfiberlinkplan->length : $request->length;
        $Opticalfiberlinkplan->orgnodeid = is_null($request->orgnodeid) ? $Opticalfiberlinkplan->orgnodeid : $request->orgnodeid;
        $Opticalfiberlinkplan->endnodeid = is_null($request->endnodeid) ? $Opticalfiberlinkplan->endnodeid : $request->endnodeid;
        $Opticalfiberlinkplan->cabletype      = is_null($request->cabletype) ? $Opticalfiberlinkplan->cabletype : $request->cabletype;
        $Opticalfiberlinkplan->fibers     = is_null($request->fibers) ? $Opticalfiberlinkplan->fibers : $request->fibers;
        $Opticalfiberlinkplan->capacity = is_null($request->capacity) ? $Opticalfiberlinkplan->capacity : $request->capacity;
        $Opticalfiberlinkplan->status = is_null($request->status) ? $Opticalfiberlinkplan->status : $request->status;

        if ($request->hasFile('kmlfile')){
            $kml_file = $validated['kmlfile'];

            //store kml file in disk with new name
            $filename = $operator . '_linkplanned_' . $oflinkid .'.'. $kml_file->getClientOriginalExtension();
            Storage::disk('kmlfiles')->delete('planned/' . $filename);
            $kml_file->storeAs('/planned', $filename, 'kmlfiles');

            //get path of the stored kml file
            $path = Storage::disk('kmlfiles/planned')->path('/');
            $filepath = str_replace("\\", "", $path."planned/");
            $kmlpath = $filepath . $filename;

            //extract geom from kml file
            $xml = new DOMDocument();
            $xml->load($kmlpath);
            
            $placemark = $xml->getElementsByTagName('Placemark');
            if($placemark->length > 0) {
                $lineString = $placemark[0]->getElementsByTagName('coordinates');
                if($lineString->length > 0) {
                    $value = $lineString[0]->nodeValue;
                    $points1 = str_replace(' ', '_', $value);
                    $points2 = str_replace(',', ' ', $points1);
                    $points = str_replace('_', ',', $points2);

                    $geomlinestring = DB::raw("(select ST_GeomFromText('SRID=4326; LINESTRING(" . $points.  ")'))");
                }
            }

            $Opticalfiberlinkplan->kmlpath   = $kmlpath;
            $Opticalfiberlinkplan->geom      = $geomlinestring;
        }
        else{
            $Opticalfiberlinkplan->kmlpath   = is_null($request->kmlpath) ? $Opticalfiberlinkplan->kmlpath : $request->kmlpath;
            $Opticalfiberlinkplan->geom     = is_null($request->geom) ? $Opticalfiberlinkplan->geom : $request->geom;
        }
        $Opticalfiberlinkplan->save();

        return $Opticalfiberlinkplan->oflinkid;
    }



    //Data create
    private function createfromkml($request)
    {
        $validated = $request->validate([
            'oflinkid'    => 'required',
            'oprcd' => 'required',
            'kmlfile' => 'required|max:2048',
        ]);
        $operator   = Str::lower($validated['oprcd']);
        $oflinkid = Str::lower($validated['oflinkid']);

        if ($request->hasFile('kmlfile'))
        {
            $kml_file = $validated['kmlfile'];
            //store kml file in disk with new name
            $filename = $operator . '_linkplanned_' . $oflinkid .'.'. $kml_file->getClientOriginalExtension();
            $kml_file->storeAs('/planned', $filename, 'kmlfiles');

            //get path of the stored kml file
            $path = Storage::disk('kmlfiles')->path('/');
            $filepath = str_replace("\\", "", $path."planned/");
            $kmlpath = $filepath . $filename;

            // create new data in database
            $this->create($request, $kmlpath, $filename);
        }
        else
        {
            return response()->json
            (
                [
                    'message' => 'No file found',
                ], 404
            );
        }
    }

    //Extract geom from KML file to Optical fiber Link Table
    private function extractgeomfromkml($oflinkid, $kmlpath, $filename)
    {
        //extract geom from kml file
        if (Storage::disk('kmlfiles')->exists('planned/' . $filename)) {
            $xml = new DOMDocument();
            $xml->load($kmlpath);
            
            $placemark = $xml->getElementsByTagName('Placemark');
            if($placemark->length > 0) {
                $lineString = $placemark[0]->getElementsByTagName('coordinates');
                if($lineString->length > 0) {
                    $value = $lineString[0]->nodeValue;
                    $points1 = str_replace(' ', '_', $value);
                    $points2 = str_replace(',', ' ', $points1);
                    $points = str_replace('_', ',', $points2);

                    $geomlinestring = DB::raw("(select ST_GeomFromText('SRID=4326; LINESTRING(" . $points.  ")'))");

                    $Opticalfiberlinkplan            = Opticalfiberlinkplan::find($oflinkid);
                    $Opticalfiberlinkplan->geom      = $geomlinestring;
                    $Opticalfiberlinkplan->save();
                }
            }
        }
        else{
            return response()->json
            (
                [
                    'message' => 'Geom extracted from kml file.',
                ], 200
            );
        }
    }

    public function destroy($oflinkid)
    {
        if (Opticalfiberlinkplan::where('oflinkid', $oflinkid)->exists()) {
            $Opticalfiberlinkplan = Opticalfiberlinkplan::destroy($oflinkid);
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
