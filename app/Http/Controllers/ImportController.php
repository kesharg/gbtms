<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MicrowaveImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index() {
        return view( 'import.import' );
    }

    public function importmicrowave( Request $request ) {

        if ( request()->file( 'file' ) != null ) {
            $this->validate( $request, [
                'file'  => 'required|mimes:xls,xlsx'
            ] );
            Excel::import( new MicrowaveImport, request()->file( 'file' ) );
        } else {
            return back()->withErrors( 'Please Upload a File' );

        }
        return back()->with( 'success', 'Excel Data Imported successfully.' );
        ;
    }
}
