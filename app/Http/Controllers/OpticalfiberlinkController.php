<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use App\Opticalfiber;
use App\Opticalfiberlink;
use Illuminate\Http\Request;

class OpticalfiberlinkController extends Controller

{
    public function __construct() {
        $this->middleware( 'auth' );
        $this->middleware( 'permission:opticalfiberlink-list|opticalfiberlink-create|opticalfiberlink-edit|opticalfiberlink-delete', ['only' => ['index']] );
        $this->middleware( 'permission:opticalfiberlink-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:opticalfiberlink-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:opticalfiberlink-delete', ['only' => ['destroy']] );
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
            $data = Opticalfiberlink::latest()->get();
            return DataTables::of($data)


            ->addColumn('action', function ($data) {
                $button = '<div class="d-flex"><a type="button" href="'.route("opticalfiberlink.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    /*if(auth()->user()->can('opticalfiberlink-edit')){
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                    }
                    if(auth()->user()->can('opticalfiberlink-delete')){
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
            }*/
            $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'opticalfiberlinks','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';

            return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        //Extract all info for filter in datatable
        $operators = DB::table('opticalfiberlinks')->groupBy('oprcd')->pluck('oprcd');
        $cable_laying_type = DB::table('opticalfiberlinks')->groupBy('cabletype')->pluck('cabletype');

        return view('opticalfiber.opticalfiberlink', compact('operators','cable_laying_type' ));
    }

    public function show($id)
    {
        $data = Opticalfiberlink::where('id', '=', $id)->firstOrFail();
        return view('modal.opticalfiberlink.view',compact('data'));

    }

}

