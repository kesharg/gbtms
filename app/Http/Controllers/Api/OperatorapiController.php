<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MStaack\LaravelPostgis\Geometries\Point;

class OperatorapiController extends Controller
{
    //Gets all the data which
    public function getAllOperator()
    {
        $operator = Operator::get()->toJson(JSON_PRETTY_PRINT);
        return response($operator, 200);
    }

    //Create new record
    public function createOperator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'operator_code' => 'required|unique:operators|regex:/[A-Z\s]+/',
        ],[
            'operator_code.unique' => 'The operator ID should be unique.',
            'operator_code.regex' => 'the operator code should be UPPERCASE.',
        ]);

        if ($validator->fails()) {
            return response()->json
            (
                [
                    'message' => $validator->errors()->all(),
                ], 422
            );
        }

        $new_oprcd = $this->create($request);
        return response()->json
            (
            [
                'message' => 'New operator node was created with oprcd :' . $new_oprcd,
            ], 201
        );
    }

    //Gets specific data as per oprcd from database
    public function getOperator($oprcd)
    {
        if (Operator::where('operator_code', $oprcd)->exists()) {
            $operator = Operator::where('operator_code', $oprcd)->get()->toJson(JSON_PRETTY_PRINT);
            return response($operator, 200);
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }

    //Update specific data in database as per oprcd
    public function updateOperator(Request $request, $oprcd)
    {
        //Must have content-type as x-www-form-urlencoded to process put request
        if ($request->header('content-type') === 'application/x-www-form-urlencoded') {
            if (Operator::where('operator_code', $oprcd)->exists()) {
                $new_oprcd = $this->update($request, $oprcd);
                return response()->json([
                    'message' => 'Record with oprcd=' . $new_oprcd . ' was update successfully',
                ], 200);
            } else {
                return response()->json
                    (
                    [
                        'message' => 'Record was not found',
                    ], 404
                );

            }
        } else {
            return response()->json
                (
                [
                    'message' => 'Unsupported media type',
                ], 415
            );
        }
    }

    //Data create
    private function create($request)
    {
        $operator              = new operator;
        $operator->operator_id      = $request->operator_id;
        $operator->operator_code       = $request->operator_code;
        $operator->operator_name   = $request->operator_name;
        $operator->operator_url = $request->operator_url;
        $operator->color_code    = $request->color_code;
        
        $operator->save();

        return $operator->operator_code;
    }

    //Data update
    private function update($request, $oprcd)
    {
        $operator              = Operator::find($oprcd);
        $operator->operator_id      = is_null($request->operator_id) ? $operator->operator_id : $operator->operator_id;
        $operator->operator_code       = is_null($request->operator_code) ? $operator->operator_code : $request->operator_code;
        $operator->operator_name   = is_null($request->operator_name) ? $operator->operator_name : $request->operator_name;
        $operator->operator_url = is_null($request->operator_url) ? $operator->operator_url : $request->operator_url;
        $operator->color_code    = is_null($request->color_code) ? $operator->color_code : $request->color_code;
        
        $operator->save();

        return $operator->operator_code;
    }

    public function destroy($oprcd)
    {
        if (Operator::where('operator_code', $oprcd)->exists()) {
            $operator = Operator::destroy($oprcd);
            return response()->json
                (
                [
                    'message' => 'Record was deleted successfully',
                ], 200
        );
        } else {
            return response()->json
                (
                [
                    'message' => 'Record was not found',
                ], 404
            );
        }
    }
}
