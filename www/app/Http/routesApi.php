<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Disable CSRF for `api/*`
| @link https://laravel.com/docs/5.2/routing#csrf-excluding-uris
|
*/

// header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Credentials: true');

Route::group([

    'namespace' => 'Api',
    'prefix' => 'api/v1',
    'middleware' => 'cors',

], function () {

    // Customers

    Route::get('customers/{customer_id}', 'CustomersController@show')->where('customer_id','[0-9]+');
    Route::get('customers', 'CustomersController@index');
    Route::post('customers/{customer_id}/update', 'CustomersController@update')->where('customer_id','[0-9]+');
    Route::delete('customers/{customer_id}/delete', 'CustomersController@deleteCustomer')->where('customer_id','[0-9]+');
    Route::post('register', 'CustomersController@registerCustomer');

    // Products

    Route::get('products/{product_id}', 'ProductsController@show')->where('product_id','[0-9]+');
    Route::get('products', 'ProductsController@index');
    // toevoegen aan orders?

    // Orders

    Route::get('orders/{order_id}', 'OrdersController@show')->where('order_id','[0-9]+');
    Route::get('orders/customers/{customer_id}', 'OrdersController@getOrdersByCustomerId')/*->where('customer_id','[0-9]+')*/;
    Route::post('orders/add', 'OrdersController@store');

    /*
    $options = [
        'except' => [
            'create',
            'edit',
        ]
    ];
    Route::resource('categories', 'CategoriesController', $options);
    Route::resource('products', 'ProductsController', $options);
    Route::resource('customers', 'CustomersController', $options);
    Route::resource('orders', 'OrdersController', $options);
    */

});


/*
// Customers

Route::get('/v1/api/customers/{customer_id}', 'Api\CustomersController@getCustomerById')->where('user_id','[0-9]+');
Route::get('/v1/api/customers', 'Api\CustomersController@index');
Route::post('/v1/api/customers/{customer_id}/update', 'Api\CustomersController@updateCustomer')->where('customer_id','[0-9]+');
Route::post('/v1/api/register', 'Api\CustomersController@registerCustomer');

// Products

Route::get('/v1/api/products/{product_id}', 'Api\ProductsController@show')->where('product_id','[0-9]+');
Route::get('/v1/api/products', 'Api\ProductsController@index');
// toevoegen aan orders?

// Orders

Route::get('/v1/api/orders/{order_id}', 'Api\OrdersController@show')->where('order_id','[0-9]+');
Route::get('/v1/api/orders/user/{customer_id}', 'Api\OrdersController@getOrdersByCustomerId')->where('customer_id','[0-9]+');
*/