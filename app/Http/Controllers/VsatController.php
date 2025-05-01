<?php

namespace App\Http\Controllers;

use App\Vsat;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class VsatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:vsat-list|vsat-create|vsat-edit|vsat-delete', ['only' => ['index']]);
        $this->middleware('permission:vsat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vsat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vsat-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vsat::latest()->get();
            return DataTables::of($data)

                ->addColumn('action', function ($data) {
    $button = '<div class="d-flex"><a type="button" href="'.route("vsat.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'vsats','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';

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

        return view('vsat.vsat', compact('operators', 'provinces', 'districts', 'vdcs'));
    }

   public function show($id)
    {
        $data = Vsat::where('id', '=', $id)->firstOrFail();
        return view('vsat.vsat_view',compact('data'));

    }

}
