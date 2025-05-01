<?php

namespace App\Http\Controllers;

use App\Exports\MicrowaveExport;
use App\Microwave;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use MStaack\LaravelPostgis\Geometries\Point;
use Validator;

class MicrowaveController extends Controller
{

    //No access without authentication
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:microwavenode-list|microwavenode-create|microwavenode-edit|microwavenode-delete', ['only' => ['index']]);
        $this->middleware('permission:microwavenode-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Send request and if available return datatable with values from MICROWAVE
        if ($request->ajax()) {
            $data = Microwave::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><a type="button" href="'.route("microwavenode.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'microwaves','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //Extract all info for filter in datatable
        $operators = DB::table('operators')->pluck('operator_name', 'operator_code');
        $provinces = DB::table('maps_province')->orderby('state_code')->pluck('province');
        $districts = DB::table('maps_district')->orderby('state_code')->pluck('district');
        $vdcs = DB::table('maps_vdc')->orderby('state_code')->pluck('gapa_napa');

        return view('microwave.microwave', compact('operators', 'provinces', 'districts', 'vdcs'));
    }

    public function show($id)
    {
        $data = Microwave::findOrFail($id);
        return view('microwave.microwave_view',compact('data'));

    }

}
