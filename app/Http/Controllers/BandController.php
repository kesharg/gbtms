<?php
namespace App\Http\Controllers;
use App\Band;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BandController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:band-list|band-create|band-edit|band-delete', ['only' => ['index']]);
        $this->middleware('permission:band-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:band-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:band-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Band::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function ($data)
            {
                $button = '<div class="d-flex"><button type="button" name="view" id="' . $data->id . '
                " class="view btn btn-success btn-sm "><i class="fas fa-eye"></i></button>';
                if (auth()
                    ->user()
                    ->can('band-edit'))
                {
                    $button .= '<button type="button" name="edit" id="' . $data->id . '
                    " class="edit btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></button>';
                }
                if (auth()
                    ->user()
                    ->can('band-delete'))
                {
                    $button .= '<button type="button" name="delete" id="' . $data->id . '
                    " class="delete btn btn-danger btn-sm ml-1"><i class="far fa-trash-alt"></i></button>';
                }
                return $button;
            })->rawColumns(['action'])
                ->make(true);
        }
        return view('band.band');
    }

    //Validate and Store


    //Display
    public function show($id)
    {
        if (request()->ajax())
        {
            $data = Band::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    //Edit
    public function edit($id)
    {
        if (request()->ajax())
        {
            $data = Band::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    //Validate and Update
    public function update(Request $request, Band $Band)
    {
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

        Band::whereId($request->hidden_id)
            ->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    // Delete Data
    public function destroy($id)
    {
        $data = Band::findOrFail($id);
        $data->delete();
    }
}

