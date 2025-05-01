<?php

namespace App\Http\Controllers;

use Validator;
use DataTables;
use App\Operator;
use App\Microwave;
use App\Coveragedata;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\MicrowaveExport;
use App\Imports\MicrowaveImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use MStaack\LaravelPostgis\Geometries\Point;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

class CoveragedataController extends Controller
{

    //No access without authentication
    function __construct() {
        $this->middleware( 'auth' );
        $this->middleware( 'permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']] );
        $this->middleware( 'permission:user-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:user-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:user-delete', ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Send request and if available return datatable with values from MICROWAVE
        if($request->ajax())
        {
            $data = DB::table('coverage_data')->get(['gid','oprcd','type']);
            return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<div class="d-flex"><a type="button" href="'.route("coveragedata.show",[$data->gid]).'" id="' . $data->gid . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a></div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        //Extract all info for filter in datatable
        $operators = DB::table('operators')->pluck('operator_name','operator_code');
/*        $provinces = DB::table( 'maps_province' )->orderby( 'state_code' )->pluck( 'province');
        $districts = DB::table( 'maps_district' )->orderby( 'state_code' )->pluck( 'district' );
        $vdcs = DB::table( 'maps_vdc' )->orderby( 'state_code' )->pluck( 'gapa_napa' );*/
        return view('coveragedata.coverage_new',compact(['operators']));
    }

    public function show($id)
    {
        return view('under_maintenance.um');
        $data = Microwave::findOrFail($id);
        return view('microwave.microwave_view',compact('data'));

    }

    public function store(Request $request)
    {
        dd($request->all());
        $rules = array(
            'band_code' => 'required',
            'band_name' => 'required',
            'band_category' => 'required',
        );

        $error = Validator::make($request->all() , $rules);

        if ($error->fails())
        {
            return response()
                ->json(['errors' => $error->errors()
                ->all() ]);
        }

        $form_data = array(
            'band_code' => $request->band_code,
            'band_name' => $request->band_name,
            'band_category' => $request->band_category,
            'tx_rx_frequency' => $request->tx_rx_frequency,
        );

        Band::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

}
