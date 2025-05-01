<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use App\CoverageData;
use ZanySoft\Zip\Zip;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CoveragedataapiController extends Controller
{
    //Data create
    public function create(Request $request)
    {
        $validated = $request->validate([
            'oprcd'    => 'required',
            'gen_type' => 'required',
            'tab_file' => 'required|mimes:zip|max:200000',
            //200MB
        ]);

        $operator   = Str::upper($validated['oprcd']);
        $generation = Str::upper($validated['gen_type']);
        $populateQuery = "select fnc_repopulate_coveragedata("."'"."$operator"."'".","."'"."$generation"."'".");";

        if ($request->hasFile('tab_file'))
        {
            $tab_file = $validated['tab_file'];
            $filename = $operator . '_' . $generation . '_coverage.' . $tab_file->getClientOriginalExtension();
            if (Storage::disk('tabfiles')->exists('zip/' . $filename))
            {
                Storage::disk('tabfiles')->delete('zip/' . $filename);
                $this->extractTabfiles($operator, $generation, $tab_file, $filename);
                Artisan::call('import:tab');
                DB::select($populateQuery);
                return response()->json
                (
                    [
                        'message' => 'Coverage Data Successfully Uploaded(Replaced)',
                    ], 200
                );
            }
            else {
                $this->extractTabfiles($operator, $generation, $tab_file, $filename);
                Artisan::call('import:tab');
                DB::select($populateQuery);
                return response()->json
                (
                    [
                        'message' => 'Coverage Data Successfully Uploaded',
                    ], 200
                );
            }

            $coverage_data = new CoverageData;
            return $microwave->id;
        }
        else
        {
            return response()->json
            (
                [
                    'message' => 'No file found',
                ], 404
            );
        }
    }

    private function extractTabfiles($operator, $generation, $tab_file, $filename)
    {
        $ziparchive = new ZipArchive();
        $ziparchive->open($tab_file);
        $extensions = array();
        if ($ziparchive->numFiles === 4) {
            for ($i = 0; $i < $ziparchive->numFiles; $i++) {
                $file      = $ziparchive->statIndex($i);
                $extension = Str::lower(explode('.', $file['name'])[1]);
                array_push($extensions, $extension);
            }
            $extensions = array_unique($extensions);
            if (count(array_intersect($extensions, ['dat', 'id', 'map', 'tab'])) === 4) {
                for ($i = 0; $i < $ziparchive->numFiles; $i++) {
                    $extension = explode('.', $ziparchive->statIndex($i)['name'])[1];
                    $ziparchive->renameIndex($i, $operator . '_' . $generation . '_coverage.' . $extension);
                }
                $ziparchive->close();
                $zip = Zip::open($tab_file)->extract(Storage::disk('tabfiles')->path('/'));
                $tab_file->storeAs('/zip', $filename, 'tabfiles');
            }
            else{
                return response()->json
                (
                    [
                        'message' => 'Incorrect file format.',
                    ], 404
                );
            }
        }
        else{
            return response()->json
            (
                [
                    'message' => 'Uploaded file is less/more in number.',
                ], 404
            );
        }
    }
}
