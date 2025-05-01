<?php

namespace App\Http\Controllers;

use App\Opticalfiberlinkplan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpticalfiberlinkplannedController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
        $this->middleware( 'permission:highwayopticalfiberlink-list|highwayopticalfiberlink-create|highwayopticalfiberlink-edit|highwayopticalfiberlink-delete', ['only' => ['index']] );
        $this->middleware( 'permission:highwayopticalfiberlink-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:highwayopticalfiberlink-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:highwayopticalfiberlink-delete', ['only' => ['destroy']] );
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
            $data = Opticalfiberlinkplan::latest()->get();
            return DataTables::of($data)


                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><a type="button" href="'.route("opticalfiberlinkplanned.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    /*if(auth()->user()->can('opticalfiberlinkplanned-edit')){
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                    }
                    if(auth()->user()->can('opticalfiberlinkplanned-delete')){
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
                    }*/
                    $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'opticalfiberlinkplans','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //Extract all info for filter in datatable
        // $operators = DB::table('opticalfiberlinkplans')->groupBy('oprcd')->pluck('oprcd');
        $cable_laying_type = DB::table('opticalfiberlinks')->groupBy('cabletype')->pluck('cabletype');

        return view('opticalfiber.opticalfiberlinkplanned', compact('cable_laying_type'));
    }

    public function show($id)
    {
        $data = Opticalfiberlinkplan::where('id', '=', $id)->firstOrFail();
        return view('modal.opticalfiberlinkplanned.view',compact('data'));

    }
}
