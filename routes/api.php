<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {

    // CommonLaravel 
    // ----------------------------------------------------------------------------------------------------
    // Generals
    Route::post('search/{model_name}', 'CommonLaravel\SearchController@search');
    Route::post('search/save-if-not-exist/{model_name}/{propertye}/{query}', 'CommonLaravel\SearchController@saveIfNotExist');
    Route::get('previus-day/{model_name}/{index}', 'CommonLaravel\PreviusDayController@previusDays');
    
    
    // User
    Route::get('user', 'CommonLaravel\UserController@user');
    Route::put('user/{id}', 'CommonLaravel\UserController@update');
    Route::put('user-password', 'CommonLaravel\UserController@updatePassword');

    // Employee
    Route::resource('employee', 'CommonLaravel\EmployeeController');

    // Permissions
    Route::get('permission', 'CommonLaravel\PermissionController@index');

    // Images
    Route::post('set-image/{prop}', 'CommonLaravel\ImageController@setImage');
    Route::delete('delete-image-prop/{model_name}/{id}/{prop_name}', 'CommonLaravel\ImageController@deleteImageProp');
    Route::delete('delete-image-model/{model_name}/{model_id}/{image_id}', 'CommonLaravel\ImageController@deleteImageModel');

    // ----------------------------------------------------------------------------------------------------

    Route::resource('siniestro', 'SiniestroController');
    Route::resource('asegurado', 'AseguradoController');
    Route::resource('aseguradora', 'AseguradoraController');
    Route::resource('causa-siniestro', 'CausaSiniestroController');
    Route::resource('estado-siniestro', 'EstadoSiniestroController');
    Route::resource('estado-general-siniestro', 'EstadoGeneralSiniestroController');
    Route::resource('localidad', 'LocalidadController');
    Route::resource('provincia', 'ProvinciaController');
    Route::resource('tipo-orden-de-servicio', 'TipoOrdenDeServicioController');
    Route::resource('gestor-scrap-free', 'GestorScrapFreeController');
    Route::resource('gestor-aseguradora', 'GestorAseguradoraController');
    Route::resource('unidad-negocio', 'UnidadNegocioController');
    Route::resource('bien', 'BienController');
    Route::resource('causa-bien', 'CausaBienController');
    Route::resource('estado-bien', 'EstadoBienController');
    Route::resource('linea', 'LineaController');
    Route::resource('sub-linea', 'SubLineaController');
    Route::resource('tecnico', 'TecnicoController');
    Route::resource('logistica', 'LogisticaController');
    Route::resource('cobertura', 'CoberturaController');
    Route::resource('poliza', 'PolizaController');
    Route::resource('tipo-producto-de-seguro', 'TipoProductoDeSeguroController');
    Route::resource('ramo', 'RamoController');
    Route::resource('transportista', 'TransportistaController');
    Route::resource('honorario-liquidacion', 'HonorarioLiquidacionController');
    Route::resource('tipo-documento', 'TipoDocumentoController');
    Route::resource('centro-reparacion', 'CentroReparacionController');


    Route::resource('sale', 'SaleController')->except(['show']);
    Route::get('sale/{from_date}/{until_date?}', 'SaleController@index');
});
