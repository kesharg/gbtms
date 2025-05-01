<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Login Route
// Route::get('/', function () {
//     return view('auth.login');
// });

//Authentication Routes disabled
Auth::routes([
    'register' => false, // Register Routes Disabled
    'reset' => false, // Reset Password Routes Disabled
    'verify' => false, // Email Verification Routes Disabled
]);

//Home Route
Route::get('/', 'HomeController@index')->name('home');

//Role and Permission Route
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
});

//Microwave Route
Route::resource('microwavenode', 'MicrowaveController');
Route::get('microwavenode/destroy/{id}', 'MicrowaveController@destroy');


//Microwave Link Route
Route::resource('microwavestationlink', 'MicrowavestationController');

//Vsat Route
Route::resource('vsat', 'VsatController');


//Opticalfiber Route
Route::resource('opticalfiber', 'OpticalfiberController');


//Opticalfiberlink Route
Route::resource('opticalfiberlink', 'OpticalfiberlinkController');


//Opticalfiberplanned Route
Route::resource('opticalfiberplanned', 'OpticalfiberplannedController');

//Opticalfiberlinkplanned Route
Route::resource('opticalfiberlinkplanned', 'OpticalfiberlinkplannedController');


//System
Route::resource('system', 'SystemController');


//System Site
Route::resource('systemsite', 'SystemsiteController');


//PSTN Route
// Route::resource('pstn', 'PSTNController');
// Route::get('pstn/destroy/{id}', 'PSTNController@destroy');


//Wireless Route
// Route::resource('wireless', 'WirelessController');


// Operator
Route::resource('operator', 'OperatorController');
Route::post('operator/update', 'OperatorController@update')->name('operator.update');
Route::get('operator/destroy/{id}', 'OperatorController@destroy');

//Infrastructure Code
// Route::resource('infrastructurecode', 'InfrastructurecodeController');
// Route::post('infrastructurecode/update', 'InfrastructurecodeController@update')->name('infrastructurecode.update');
// Route::get('infrastructurecode/destroy/{id}', 'InfrastructurecodeController@destroy');

//Band
// Route::resource('band', 'BandController');
// Route::post('band/update', 'BandController@update')->name('band.update');
// Route::get('band/destroy/{id}', 'BandController@destroy');

//CoverageData
Route::resource('coveragedata', 'CoveragedataController');


//Map
Route::get('map', 'MapController@index')->name('map');
Route::post('map/get_DEM_line_geom', 'MapController@get_DEM_line_geom');
Route::get('map/{geom}', 'MapController@geom')->name('map.geom');

//MapTools
Route::get('maptools/geographic_penetration','MaptoolsController@geographic_penetration');
Route::get('maptools/print_geoserver_mapfish','MaptoolsController@printmap');
//Import
Route::get('import', 'ImportController@index');

//Generate Report
Route::get('/country/pdf', ['as' => 'print_country', 'uses' => 'ReportgenerationController@printCountryData']);
Route::get('/province/pdf', ['as' => 'print_province', 'uses' => 'ReportgenerationController@printProvinceData']);
Route::get('/district/pdf', ['as' => 'print_district', 'uses' => 'ReportgenerationController@printDistrictData']);
Route::get('/vdc/pdf', ['as' => 'print_vdc', 'uses' => 'ReportgenerationController@printVdcData']);

Route::get('/country/CSV', ['as' => 'exportCSV_country', 'uses' => 'ReportgenerationController@exportCSV_country']);
Route::get('/province/CSV', ['as' => 'exportCSV_province', 'uses' => 'ReportgenerationController@exportCSV_province']);
Route::get('/district/CSV', ['as' => 'exportCSV_district', 'uses' => 'ReportgenerationController@exportCSV_district']);
Route::get('/vdc/CSV', ['as' => 'exportCSV_vdc', 'uses' => 'ReportgenerationController@exportCSV_vdc']);

//Generate Coverage Report
Route::post('/coverage/pdf', ['as' => 'print_coverage', 'uses' => 'CoverageReportGenerationController@printCoverageData']);
Route::post('/population_penetration/pdf', ['as' => 'print_population_coverage', 'uses' => 'CoverageReportGenerationController@printpopulationCoverageData']);

//Route for dynamic Dropboxes in map
Route::get('map/getdistrict/{state_code}', array('as' => 'map.getdistrict', 'uses' => 'MapController@getdistrict'));
Route::get('map/getvdc/{district}', array('as' => 'map.getvdc', 'uses' => 'MapController@getvdc'));
Route::get('map/getward/{vdc}', array('as' => 'map.getward', 'uses' => 'MapController@getward'));

//Route for obtaining extent
Route::get('map/get_province_extent/{province}','MapController@getProvinceExtent');
Route::get('map/get_district_extent/{district}','MapController@getDistrictExtent');
Route::get('map/get_vdc_extent/{vdc}','MapController@getVdcExtent');

//Route for dynamic Dropboxes
Route::get('getdistrict/{province}', array('as' => 'getdistrict', 'uses' => 'DynamicdropdownController@getdistrict'));
Route::get('getalldistrict', array('as' => 'getalldistrict', 'uses' => 'DynamicdropdownController@getalldistrict'));
Route::get('getvdc/{district}', array('as' => 'getvdc', 'uses' => 'DynamicdropdownController@getvdc'));
Route::get('getallvdc', array('as' => 'getallvdc', 'uses' => 'DynamicdropdownController@getallvdc'));
Route::get('getward/{vdc}', array('as' => 'getward', 'uses' => 'DynamicdropdownController@getward'));

//Route for import/export
Route::get('exportmicrowave', 'MicrowaveController@export')->name('exportmicrowave');
Route::get('exportsystemsite', 'MicrowaveController@export')->name('exportsystemsite');

//Map length calculation tool
Route::get('map/{selectedLink}/{geom}', 'MapController@get_totallinklength');



///////////////////////////////////////////////////////
Route::get('getExtent/{val1}/{val2}/{val3}', 'MapController@getExtent')->name('getExtent');
