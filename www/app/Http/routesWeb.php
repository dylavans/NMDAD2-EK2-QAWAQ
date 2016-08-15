<?php

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::group([
    //
], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::group([
        'namespace' => 'CustomerManagement',
        'prefix' => 'management',
    ], function () {
        Route::resource('customers', 'CustomersController', [
            'except' => [
                //
            ]
        ]);
        Route::resource('customers', 'CustomersController');
    });

    Route::group([
        'namespace' => 'Store',
        'prefix' => 'store',
    ], function () {
        Route::resource('products', 'ProductsController', [
            'except' => [
                //
            ]
        ]);
        Route::resource('products', 'ProductsController');
    });

});