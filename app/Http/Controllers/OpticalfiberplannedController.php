<?php

namespace App\Http\Controllers;

use App\Opticalfiberplan;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use App\Opticalfiber;
use App\Opticalfiberlink;
use App\Opticalfiberplanned;
use Illuminate\Http\Request;

class OpticalfiberplannedController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
        $this->middleware( 'permission:highwayopticalfibernode-list|highwayopticalfibernode-create|highwayopticalfibernode-edit|highwayopticalfibernode-delete', ['only' => ['index']] );
        $this->middleware( 'permission:highwayopticalfibernode-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:highwayopticalfibernode-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:highwayopticalfibernode-delete', ['only' => ['destroy']] );
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*return view('under_maintenance.um');*/
        if ($request->ajax()) {
            $data = Opticalfiberplan::latest()->get();
            return DataTables::of($data)


            ->addColumn('action', function ($data) {
                $button = '<div class="d-flex"><a type="button" href="'.route("opticalfiberplanned.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
/*                $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';*/
                $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'opticalfiberplans','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        //Extract all info for filter in datatable
        $operators = DB::table('opticalfiberplans')->groupBy('oprcd')->pluck('oprcd');
        $provinces = DB::table('maps_province')->orderby('state_code')->pluck('province');
        $districts = DB::table('maps_district')->orderby('state_code')->pluck('district');
        $vdcs = DB::table('maps_vdc')->orderby('state_code')->pluck('gapa_napa');

        return view('opticalfiber.opticalfiberplanned', compact('operators', 'provinces', 'districts', 'vdcs'));
    }

    public function show($id)
    {
        $data = Opticalfiberplan::where('id', '=', $id)->firstOrFail();
        return view('modal.opticalfiberplanned.view',compact('data'));

    }

}

