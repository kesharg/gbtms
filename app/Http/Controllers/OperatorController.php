<?php

namespace App\Http\Controllers;
use App\Operator;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function __construct() {
        $this->middleware( 'auth' );
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
                $data = Operator::latest()->get();
                return DataTables::of($data)

                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex"><button type="button" name="edit" id="' . $data->operator_id . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="view" id="' . $data->operator_id . '" class="view btn btn-success btn-sm ml-1"><i class="fas fa-eye"></i></button>';
                    // $button .= '<button type="button" name="delete" id="' . $data->operator_id . '" class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('operator.operator');
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
                // 'operator_id'    =>  'required',
                'operator_code'     =>  'required',
                'operator_name'    =>  'required',
                'color_code'    =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = array(
                'operator_id'         =>  str_pad(Operator::latest('operator_id')->first()->operator_id + 1, 3, '0', STR_PAD_LEFT),
                'operator_code'        =>  $request->operator_code,
                'operator_name'        =>  $request->operator_name,
                'operator_url'         =>  $request->operator_url,
                'color_code'          =>  $request->color_code,
            );
            
            Operator::create($form_data);
            
            return response()->json(['success' => 'Data Added successfully.']);
        }

        /**
         * Display the specified resource.
         *
         * @param  Operator  $Operator
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            if(request()->ajax())
            {
                $data = Operator::where('operator_id', '=', $id)->firstOrFail();
                return response()->json(['result' => $data]);
            }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  Operator  $Operator
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            if(request()->ajax())
            {
                // $data = Operator::findOrFail($id);
                $data = Operator::where('operator_id', '=', $id)->firstOrFail();
                return response()->json(['result' => $data]);
            }
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  Operator  $Operator
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Operator $Operator)
        {
            $rules = array(
                // 'operator_id'    =>  'required',
                'operator_code'     =>  'required',
                'operator_name'    =>  'required',
                'color_code'    =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = array(
                // 'operator_id'         =>  $request->operator_id,
                'operator_code'             =>  $request->operator_code,
                'operator_name'        =>  $request->operator_name,
                'operator_url'         =>  $request->operator_url,
                'color_code'          =>  $request->color_code,
            );

            Operator::whereId($request->hidden_id)->update($form_data);

            return response()->json(['success' => 'Data is successfully updated']);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  Operator  $Operator
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $data = Operator::findOrFail($id);
            $data->delete();
        }
    }

