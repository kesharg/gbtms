<?php

namespace App\Http\Controllers\Api;

use App\Opticalfiberlink;
use File;
use DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use MStaack\LaravelPostgis\Geometries\Point;
use Illuminate\Support\Facades\Validator;


class OpticalfiberlinkapiController extends Controller
{
    //Gets all the data which
    public function getAllOpticalfiberlink()
    {
        $Opticalfiberlink = Opticalfiberlink::get()->toJson(JSON_PRETTY_PRINT);
        return response($Opticalfiberlink, 200);
    }

    //Create new record
    public function createOpticalfiberlink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oflinkid' => 'required|unique:opticalfiberlinks',
            'orgnodeid' => 'required|exists:opticalfibers,nodeid',
            'endnodeid' => 'required|exists:opticalfibers,nodeid',
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
                'message' => 'New optical fiber link successfully created!!',
            ], 201
        );
        
    }

    //Gets specific data as per oflinkid from database
    public function getOpticalfiberlink($oflinkid)
    {
        if (Opticalfiberlink::where('oflinkid', $oflinkid)->exists()) {
            $Opticalfiberlink = Opticalfiberlink::where('oflinkid', $oflinkid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($Opticalfiberlink, 200);
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
    public function updateOpticalfiberlink(Request $request, $oflinkid)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Opticalfiberlink::where('oflinkid', $oflinkid)->exists()) {

                $validator = Validator::make($request->all(), [
                    'orgnodeid' => 'required|exists:opticalfibers,nodeid',
                    'endnodeid' => 'required|exists:opticalfibers,nodeid',
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
        $Opticalfiberlink            = new Opticalfiberlink;
        $Opticalfiberlink->oflinkid  = $request->oflinkid;
        $Opticalfiberlink->oprlinkid = $request->oprlinkid;
        $Opticalfiberlink->linkname  = $request->linkname;
        $Opticalfiberlink->oprcd     = $request->oprcd;
        $Opticalfiberlink->length    = $request->length;
        $Opticalfiberlink->orgnodeid = $request->orgnodeid;
        $Opticalfiberlink->endnodeid = $request->endnodeid;
        $Opticalfiberlink->cabletype = $request->cabletype;
        $Opticalfiberlink->fibers    = $request->fibers;
        $Opticalfiberlink->capacity  = $request->capacity;
        $Opticalfiberlink->status    = $request->status;
        $Opticalfiberlink->kmlpath   = $kmlpath;
        $Opticalfiberlink->geom      = Null;
        $Opticalfiberlink->save();

        $oflinkid = $Opticalfiberlink->oflinkid;

        //extract geom from kml file
        $this->extractgeomfromkml($oflinkid, $kmlpath, $filename);

        return $Opticalfiberlink->oflinkid;
    }

    //Data update
    private function update($request, $oflinkid)
    {
        $validated = $request->validate([
            'kmlfile' => 'max:2048',
        ]);
        $Opticalfiberlink               = Opticalfiberlink::find($oflinkid);
        $Opticalfiberlink->oflinkid     = is_null($request->oflinkid) ? $Opticalfiberlink->oflinkid : $Opticalfiberlinkplan->oflinkid;
        $Opticalfiberlink->oprlinkid    = is_null($request->oprlinkid) ? $Opticalfiberlink->oprlinkid : $request->oprlinkid;
        $Opticalfiberlink->linkname     = is_null($request->linkname) ? $Opticalfiberlink->linkname : $request->linkname;
        $Opticalfiberlink->oprcd        = is_null($request->oprcd) ? $Opticalfiberlink->oprcd : $request->oprcd;
        $Opticalfiberlink->length       = is_null($request->length) ? $Opticalfiberlink->length : $request->length;
        $Opticalfiberlink->orgnodeid    = is_null($request->orgnodeid) ? $Opticalfiberlink->orgnodeid : $request->orgnodeid;
        $Opticalfiberlink->endnodeid    = is_null($request->endnodeid) ? $Opticalfiberlink->endnodeid : $request->endnodeid;
        $Opticalfiberlink->cabletype    = is_null($request->cabletype) ? $Opticalfiberlink->cabletype : $request->cabletype;
        $Opticalfiberlink->fibers       = is_null($request->fibers) ? $Opticalfiberlink->fibers : $request->fibers;
        $Opticalfiberlink->capacity     = is_null($request->capacity) ? $Opticalfiberlink->capacity : $request->capacity;
        $Opticalfiberlink->status       = is_null($request->status) ? $Opticalfiberlink->status : $request->status;      

        if ($request->hasFile('kmlfile')){
            $kml_file = $validated['kmlfile'];

            //store kml file in disk with new name
            $filename = $operator . '_link_' . $oflinkid .'.'. $kml_file->getClientOriginalExtension();
            Storage::disk('kmlfiles')->delete('/' . $filename);
            $kml_file->storeAs('/', $filename, 'kmlfiles');

            //get path of the stored kml file
            $path = Storage::disk('kmlfiles')->path('/');
            $filepath = str_replace("\\", "", $path);
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

            $Opticalfiberlink->kmlpath   = $kmlpath;
            $Opticalfiberlink->geom      = $geomlinestring;
        }
        else{
            $Opticalfiberlink->kmlpath   = is_null($request->kmlpath) ? $Opticalfiberlink->kmlpath : $request->kmlpath;
            $Opticalfiberlink->geom     = is_null($request->geom) ? $Opticalfiberlink->geom : $request->geom;
        }
        $Opticalfiberlink->save();

        return $Opticalfiberlink->oflinkid;
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
            $filename = $operator . '_link_' . $oflinkid .'.'. $kml_file->getClientOriginalExtension();
            $kml_file->storeAs('/', $filename, 'kmlfiles');

            //get path of the stored kml file
            $path = Storage::disk('kmlfiles')->path('/');
            $filepath = str_replace("\\", "", $path);
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
        if (Storage::disk('kmlfiles')->exists('/' . $filename)) {
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

                    $Opticalfiberlink            = Opticalfiberlink::find($oflinkid);
                    $Opticalfiberlink->geom      = $geomlinestring;
                    $Opticalfiberlink->save();
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
        if (Opticalfiberlink::where('oflinkid', $oflinkid)->exists()) {
            $Opticalfiberlink = Vsat::destroy($oflinkid);
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
