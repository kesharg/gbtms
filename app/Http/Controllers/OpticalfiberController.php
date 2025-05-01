<?php

namespace App\Http\Controllers;

use App\Opticalfiber;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class OpticalfiberController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
         $this->middleware( 'permission:opticalfibernode-list|opticalfibernode-create|opticalfibernode-edit|opticalfibernode-delete', ['only' => ['index']] );
        $this->middleware( 'permission:opticalfibernode-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:opticalfibernode-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:opticalfibernode-delete', ['only' => ['destroy']] );
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
            $data = Opticalfiber::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function ($data) {
               $button = '<div class="d-flex"><a type="button" href="'.route("opticalfiber.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    /*if(auth()->user()->can('opticalfibernode-edit')){
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                    }
                    if(auth()->user()->can('opticalfibernode-delete')){
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
            }*/
                $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'opticalfibers','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        //Extract all info for filter in datatable
        $operators = DB::table('opticalfibers')->groupBy('oprcd')->pluck('oprcd');
        $provinces = DB::table('maps_province')->orderby('state_code')->pluck('province');
        $districts = DB::table('maps_district')->orderby('state_code')->pluck('district');
        $vdcs = DB::table('maps_vdc')->orderby('state_code')->pluck('gapa_napa');

        return view('opticalfiber.opticalfiber', compact('operators', 'provinces', 'districts', 'vdcs'));
    }

    public function show($id)
    {
        $data = Opticalfiber::where('id', '=', $id)->firstOrFail();
        return view('modal.opticalfiber.view',compact('data'));

    }


}
