<?php

namespace App\Http\Controllers;
use App\Infrastructurecode;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class InfrastructurecodeController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
        $this->middleware( 'permission:infrastructure-list|infrastructure-create|infrastructure-edit|infrastructure-delete', ['only' => ['index']] );
        $this->middleware( 'permission:infrastructure-create', ['only' => ['create', 'store']] );
        $this->middleware( 'permission:infrastructure-edit', ['only' => ['edit', 'update']] );
        $this->middleware( 'permission:infrastructure-delete', ['only' => ['destroy']] );
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
                $data = Infrastructurecode::latest()->get();
                return DataTables::of($data)

                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><button type="button" name="view" id="' . $data->id . '" class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></button>';
                    if(auth()->user()->can('infrastructure-edit')){
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                    }
                    if(auth()->user()->can('infrastructure-delete')){
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
            }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('infrastructurecode.infrastructurecode');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

            $rules = array(
                'infrastructure_name'    =>  'required',
                'infrastructure_code'     =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = array(
                'infrastructure_name'         =>  $request->infrastructure_name,
                'infrastructure_code'             =>  $request->infrastructure_code,
            );

            Infrastructurecode::create($form_data);

            return response()->json(['success' => 'Data Added successfully.']);
        }

        /**
         * Display the specified resource.
         *
         * @param  Infrastructurecode  $Infrastructurecode
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            if(request()->ajax())
            {
                $data = Infrastructurecode::findOrFail($id);
                return response()->json(['result' => $data]);
            }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  Infrastructurecode  $Infrastructurecode
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            if(request()->ajax())
            {
                $data = Infrastructurecode::findOrFail($id);
                return response()->json(['result' => $data]);
            }
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  Infrastructurecode  $Infrastructurecode
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Infrastructurecode $Infrastructurecode)
        {
            $rules = array(
                'infrastructure_name'    =>  'required',
                'infrastructure_code'     =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = array(
                'infrastructure_name'         =>  $request->infrastructure_name,
                'infrastructure_code'             =>  $request->infrastructure_code,
            );

            Infrastructurecode::whereId($request->hidden_id)->update($form_data);

            return response()->json(['success' => 'Data is successfully updated']);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  Infrastructurecode  $Infrastructurecode
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $data = Infrastructurecode::findOrFail($id);
            $data->delete();
        }
    }

