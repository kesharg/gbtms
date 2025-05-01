<?php

namespace App\Http\Controllers;

use Validator;
use DataTables;
use App\Microwave;

use App\Microwavestation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use MStaack\LaravelPostgis\Geometries\Point;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\LineString;

class MicrowavestationController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
         $this->middleware( 'permission:microwavelink-list|microwavelink-create|microwavelink-edit|microwavelink-delete', ['only' => ['index']] );
        $this->middleware( 'permission:microwavelink-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:microwavelink-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:microwavelink-delete', ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $data = Microwavestation::latest();
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->distance){
                        $query->where('distance','>=',$request->distance);
                    }
                })

            ->addColumn('action', function ($data) {
                $button = '<div class="d-flex"><a type="button" href="'.route("microwavestationlink.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'microwavestations','field'=>'id','val'=>$data->id]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('microwavestation.microwavestation');
    }
    public function show($id)
    {
        $data = Microwavestation::where('id', '=', $id)->firstOrFail();
        return view('microwavestation.microwavestation_view',compact('data'));

    }
}
