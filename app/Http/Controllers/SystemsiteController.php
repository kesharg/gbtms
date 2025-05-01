<?php

namespace App\Http\Controllers;

use App\Systemsite;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SystemsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:systemsite-list|systemsite-create|systemsite-edit|systemsite-delete', ['only' => ['index']]);
        $this->middleware('permission:systemsite-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:systemsite-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:systemsite-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("systemsites")->get(['id', 'syssiteid','oprcd','oprsitename','district','vdc','ward','lat','long','province','antbase','antloc']);
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><a type="button" href="'.route("systemsite.show",[$data->id]).'" id="' . $data->id . '" class="btn btn-success btn-sm "><i class="far fa-eye"></i></button></a>';
                    $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'systemsites','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
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

        return view('systemsite.systemsite', compact('operators', 'provinces', 'districts', 'vdcs'));
    }

    public function show($id)
    {
        $data = Systemsite::where('id', '=', $id)->firstOrFail();
        return view('systemsite.systemsite_view',compact('data'));
    }
}
