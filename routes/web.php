<?php

Route::get('/', 'App\Http\Controllers\MainController@home')
    ->name('inicio');

/** Grupo de rutas de operadores */
Route::group(['middleware' => 'web'], function () {
    Route::match(['get', 'post'], 'lista-de-operadores', 'App\Http\Controllers\OperatorsController@index')
        ->name('operatorsList');
    Route::get('nuevo-operador', 'App\Http\Controllers\OperatorsController@create')
        ->name('operatorCreate');
    Route::post('grabar-operador', 'App\Http\Controllers\OperatorsController@store')
        ->name('operatorStore');
    Route::get('editar-operador/{operador}', 'App\Http\Controllers\OperatorsController@edit')
        ->name('operatorEdit');
    Route::post('grabar-cambios-operador', 'App\Http\Controllers\OperatorsController@update')
        ->name('operatorUpdate');
    Route::post('ver-operador', 'App\Http\Controllers\OperatorsController@show')
        ->name('operatorShow');
    Route::post('cambiar-estado-operador', 'App\Http\Controllers\OperatorsController@changeState')
        ->name('operatorChangeState');
});

/** Grupo de rutas de viajes */
Route::group(['middleware' => 'web'], function () {
    Route::match(['get', 'post'], 'lista-de-viajes', 'App\Http\Controllers\ToursController@index')
        ->name('toursList');
    Route::get('nuevo-viaje', 'App\Http\Controllers\ToursController@create')
        ->name('tourCreate');
    Route::post('grabar-viaje', 'App\Http\Controllers\ToursController@store')
        ->name('tourStore');
    Route::get('editar-viaje/{tour}', 'App\Http\Controllers\ToursController@edit')
        ->name('tourEdit');
    Route::post('actualizar-viaje', 'App\Http\Controllers\ToursController@update')
        ->name('tourUpdate');
    Route::post('desactivar-viaje', 'App\Http\Controllers\ToursController@destroy')
        ->name('tourDeactivate');
    Route::get('asociar-clientes/{tour}', 'App\Http\Controllers\ToursController@tourCustomers')
        ->name('tourCustomers');
    Route::post('actualizar-reservas', 'App\Http\Controllers\ToursController@setCustomers')
        ->name('setCustomers');
});

/** Grupo de rutas de clientes */
Route::group(['middleware' => 'web'], function () {
    Route::get('lista-de-clientes', 'App\Http\Controllers\CustomersController@index')
        ->name('customersList');
    Route::get('nuevo-cliente', 'App\Http\Controllers\CustomersController@create')
        ->name('customerCreate');
    Route::post('editar-cliente', 'App\Http\Controllers\CustomersController@store')
        ->name('customerStore');
    Route::get('editar-cliente', 'App\Http\Controllers\CustomersController@edit')
        ->name('customerEdit');
    Route::post('editar-cliente', 'App\Http\Controllers\CustomersController@update')
        ->name('customerUpdate');
    Route::post('desactivar-cliente', 'App\Http\Controllers\CustomersController@destroy')
        ->name('customerDeactivate');
});

