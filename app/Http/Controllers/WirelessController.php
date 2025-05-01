<?php

namespace App\Http\Controllers;

use App\Wireless;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class WirelessController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
         $this->middleware( 'permission:wireless-list|wireless-create|wireless-edit|wireless-delete', ['only' => ['index']] );
        $this->middleware( 'permission:wireless-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:wireless-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:wireless-delete', ['only' => ['destroy']] );
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
            $data = Wireless::latest()->get();
            return DataTables::of($data)


            ->addColumn('action', function ($data) {
                $button = '<div class="d-flex"><a type="button" href="'.route("wireless.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    /*if(auth()->user()->can('wireless-edit')){
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                    }
                    if(auth()->user()->can('wireless-delete')){
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
            }*/
                $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'wirelesses','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('wireless.wireless');
    }

    public function show($id)
    {
        $data = Wireless::findOrFail($id);
        return view('modal.wireless.view',compact('data'));

    }


}
