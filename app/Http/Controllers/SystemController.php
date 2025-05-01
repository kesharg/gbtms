<?php

namespace App\Http\Controllers;

use App\System;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:system-list|system-create|system-edit|system-delete', ['only' => ['index']]);
        $this->middleware('permission:system-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:system-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:system-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table("systems")
                ->leftJoin("systemsites","systemsites.syssiteid","=","systems.syssiteid")
                ->select("systems.*","systemsites.id AS systemsitesid")
                ->latest();
//            ->get(['id', 'syssiteid', 'oprcd', 'deviceid', 'azimuth', 'tilt', 'antgain', 'transpwr', 'polariz', 'type' , 'status' ,'oprdate'])
            return DataTables::of($data)
//                FROM X DATE TO Y DATE FILTER **COMMENTED BECAUSE OPRDATE DOESNT HAVE CONSISTENT FORMAT IN DB
//                ->filter(function ($query) use ($request) {
//                    if ($request->date_from && $request->date_to) {
//                        $query->whereDate('systems.oprdate', '>=', $request->date_from);
//                        $query->whereDate('systems.oprdate', '<=', $request->date_to);
//                    }
//                    if ($request->date_from) {
//                        $query->whereDate('systems.oprdate', '>=', $request->date_from);
//                        $query->whereDate('systems.oprdate', '<=', date("Y-m-d"));
//                    }
//                    if ($request->date_to) {
//                        $query->whereDate('systems.oprdate', '<=', $request->date_to);
//                    }
//                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><a type="button" href="'.route("system.show",[$data->id]).'" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></a>';
                    $button .= '<a type="button" href="'.action("MapController@index", ['layer'=>'systemsites','field'=>'id','val'=>$data->systemsitesid]).'" class="map btn btn-secondary btn-sm ml-1"><i class="fas fa-map-marker-alt"></i></a></div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //Extract all info for filter in datatable
        $operators = DB::table('operators')->pluck('operator_name', 'operator_code');
        return view('system.system', compact('operators'));
    }


    public function show($id)
    {
        $data = System::where('id', '=', $id)->firstOrFail();
        return view('system.system_view',compact('data'));
    }

}
