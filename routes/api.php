<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('login', 'Api\ApiauthController@login');

Route::group(['namespace' => 'Api',
    'middleware'              => 'auth:api',
], function () {

    //Operators
    Route::get('api_operator', 'OperatorapiController@getAllOperator');
    Route::get('api_operator/{oprcd}', 'OperatorapiController@getOperator');
    Route::post('api_operator', 'OperatorapiController@createOperator');
    Route::put('api_operator/{oprcd}', 'OperatorapiController@updateOperator');
    Route::delete('api_operator/{oprcd}', 'OperatorapiController@destroy');


    //Microwavenode
    Route::get('api_microwavenode', 'MicrowaveapiController@getAllMicrowave');
    Route::get('api_microwavenode/{mwstncode}', 'MicrowaveapiController@getMicrowave');
    Route::post('api_microwavenode', 'MicrowaveapiController@createMicrowave');
    Route::put('api_microwavenode/{mwstncode}', 'MicrowaveapiController@updateMicrowave');
    Route::delete('api_microwavenode/{mwstncode}', 'MicrowaveapiController@destroy');

    //MicrowaveLink
    Route::get('api_microwavelink', 'MicrowavestationapiController@getAllMicrowavestation');
    Route::get('api_microwavelink/{mwlinkid}', 'MicrowavestationapiController@getMicrowavestation');
    Route::post('api_microwavelink', 'MicrowavestationapiController@createMicrowavestation');
    Route::put('api_microwavelink/{mwlinkid}', 'MicrowavestationapiController@updateMicrowavestation');
    Route::delete('api_microwavelink/{mwlinkid}', 'MicrowavestationapiController@destroy');

    //VSAT node
    Route::get('api_vsatnode', 'VsatapiController@getAllVsat');
    Route::get('api_vsatnode/{vsatid}', 'VsatapiController@getVsat');
    Route::post('api_vsatnode', 'VsatapiController@createVsat');
    Route::put('api_vsatnode/{vsatid}', 'VsatapiController@updateVsat');
    Route::delete('api_vsatnode/{vsatid}', 'VsatapiController@destroy');

    //Base Transceiver Station(System Site)
    Route::get('api_systemsite', 'SystemsiteapiController@getAllSystemsite');
    Route::get('api_systemsite/{syssiteid}', 'SystemsiteapiController@getSystemsite');
    Route::post('api_systemsite', 'SystemsiteapiController@createSystemsite');
    Route::put('api_systemsite/{syssiteid}', 'SystemsiteapiController@updateSystemsite');
    Route::delete('api_systemsite/{syssiteid}', 'SystemsiteapiController@destroy');

    //Systems(Nodes in system site)
    Route::get('api_systems', 'SystemapiController@getAllSystem');
    Route::get('api_systems/{deviceid}', 'SystemapiController@getSystem');
    Route::post('api_systems', 'SystemapiController@createSystem');
    Route::put('api_systems/{deviceid}', 'SystemapiController@updateSystem');
    Route::delete('api_systems/{deviceid}', 'SystemapiController@destroy');

    //Wireless Node
    // Route::get('api_wirelessnode', 'WirelessapiController@getAllWireless');
    // Route::get('api_wirelessnode/{id}', 'WirelessapiController@getWireless');
    // Route::post('api_wirelessnode', 'WirelessapiController@createWireless');
    // Route::put('api_wirelessnode/{id}', 'WirelessapiController@updateWireless');

    //PSTN Node
    // Route::get('api_pstnnode', 'PstnapiController@getAllPstn');
    // Route::get('api_pstnnode/{id}', 'PstnapiController@getPstn');
    // Route::post('api_pstnnode', 'PstnapiController@createPstn');
    // Route::put('api_pstnnode/{id}', 'PstnapiController@updatePstn');

    //Coverage Data
    // Route::get('api_coverage', 'PstnapiController@getAllPstn');
    // Route::get('api_coverage/{id}', 'PstnapiController@getPstn');
    Route::post('api_coverage', 'CoveragedataapiController@create');
    // Route::put('api_coverage/{id}', 'PstnapiController@updatePstn');

    //Optical fiber Node
    Route::get('api_opticalfibernode', 'OpticalfiberapiController@getAllOpticalfiber');
    Route::get('api_opticalfibernode/{nodeid}', 'OpticalfiberapiController@getOpticalfiber');
    Route::post('api_opticalfibernode', 'OpticalfiberapiController@createOpticalfiber');
    Route::put('api_opticalfibernode/{nodeid}', 'OpticalfiberapiController@updateOpticalfiber');
    Route::delete('api_opticalfibernode/{nodeid}', 'OpticalfiberapiController@destroy');

    //Optical fiber Link
    Route::get('api_opticalfiberlink', 'OpticalfiberlinkapiController@getAllOpticalfiberlink');
    Route::get('api_opticalfiberlink/{oflinkid}', 'OpticalfiberlinkapiController@getOpticalfiberlink');
    Route::post('api_opticalfiberlink', 'OpticalfiberlinkapiController@createOpticalfiberlink');
    Route::put('api_opticalfiberlink/{oflinkid}', 'OpticalfiberlinkapiController@updateOpticalfiberlink');
    Route::delete('api_opticalfiberlink/{oflinkid}', 'OpticalfiberlinkapiController@destroy');

    //Optical fiber Node Planned
    Route::get('api_opticalfiberplannode', 'OpticalfiberplanapiController@getAllOpticalfiberplan');
    Route::get('api_opticalfiberplannode/{nodeid}', 'OpticalfiberplanapiController@getOpticalfiberplan');
    Route::post('api_opticalfiberplannode', 'OpticalfiberplanapiController@createOpticalfiberplan');
    Route::put('api_opticalfiberplannode/{nodeid}', 'OpticalfiberplanapiController@updateOpticalfiberplan');
    Route::delete('api_opticalfiberplannode/{nodeid}', 'OpticalfiberplanapiController@destroy');

    //Optical fiber Link Planned 
    Route::get('api_opticalfiberplanlink', 'OpticalfiberlinkplanapiController@getAllOpticalfiberlinkplan');
    Route::get('api_opticalfiberplanlink/{oflinkid}', 'OpticalfiberlinkplanapiController@getOpticalfiberlinkplan');
    Route::post('api_opticalfiberplanlink', 'OpticalfiberlinkplanapiController@createOpticalfiberlinkplan');
    Route::put('api_opticalfiberplanlink/{oflinkid}', 'OpticalfiberlinkplanapiController@updateOpticalfiberlinkplan');
    Route::delete('api_opticalfiberplanlink/{oflinkid}', 'OpticalfiberlinkplanapiController@destroy');

});
