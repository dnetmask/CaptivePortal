<?php

Route::group(['as' => 'cautiveportal.', 'middleware' => ['web']], function () {
    $namespacePrefix = '\App\Http\Controllers\\';

    Route::get('/', ['uses' => $namespacePrefix . 'CautivePortalController@index', 'as' => 'index']);
    Route::post('/store', ['uses' => $namespacePrefix . 'CautivePortalController@store', 'as' => 'store']);
    Route::match(['GET', 'POST'], '/afterstore', ['uses' => $namespacePrefix . 'CautivePortalController@afterStore', 'as' => 'afterstore']);
    Route::get('/success', ['uses' => $namespacePrefix . 'CautivePortalController@success', 'as' => 'success']);
    Route::get('/validate-otp', ['uses' => $namespacePrefix . 'CautivePortalController@validateOtp', 'as' => 'validateotp']);

    //Asset Routes
    Route::get('cautiveportal-assets', ['uses' => '\Netmask\CautivePortal\Controllers\\CautivePortalAssetsController@assets', 'as' => 'cautiveportal_assets']);
});