<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {

    // CommonLaravel 
    // ----------------------------------------------------------------------------------------------------
    // Generals
    Route::post('search/{model_name}', 'CommonLaravel\SearchController@search');
    Route::post('search-from-modal/{model_name}', 'CommonLaravel\SearchController@searchFromModal');
    Route::post('search/save-if-not-exist/{model_name}/{propertye}/{query}', 'CommonLaravel\SearchController@saveIfNotExist');
    Route::get('previus-day/{model_name}/{index}', 'CommonLaravel\PreviusDayController@previusDays');
    Route::get('previus-next/{model_name}/{index}', 'CommonLaravel\PreviusNextController@previusNext');
    Route::get('previus-next-index/{model_name}/{id}', 'CommonLaravel\PreviusNextController@getIndexPreviusNext');
    Route::put('update/{model_name}', 'CommonLaravel\UpdateController@update');
    Route::put('delete/{model_name}', 'CommonLaravel\DeleteController@delete');
    
    // User
    Route::get('user', 'CommonLaravel\AuthController@user');
    Route::put('user/{id}', 'UserController@update');
    Route::put('user-password', 'CommonLaravel\UserController@updatePassword');
    Route::post('user/last-activity', 'CommonLaravel\UserController@setLastActivity');

    // Employee
    Route::resource('employee', 'CommonLaravel\EmployeeController');

    // Permissions
    Route::get('permission', 'CommonLaravel\PermissionController@index');

    // Images
    Route::post('set-image/{prop}', 'CommonLaravel\ImageController@setImage');
    Route::delete('delete-image-prop/{model_name}/{id}/{prop_name}', 'CommonLaravel\ImageController@deleteImageProp');
    Route::delete('delete-image-model/{model_name}/{model_id}/{image_id}', 'CommonLaravel\ImageController@deleteImageModel');

    // Error
    Route::post('error', 'CommonLaravel\ErrorController@store');

    // ----------------------------------------------------------------------------------------------------

    Route::resource('siniestro', 'SiniestroController');
    Route::post('siniestro/casos-por-dia', 'SiniestroController@casosPorDia');

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
    Route::resource('tecnico-asegurado', 'TecnicoAseguradoController');
    Route::resource('tecnico-scrap-free', 'TecnicoScrapFreeController');
    Route::resource('logistica', 'LogisticaController');
    Route::resource('cobertura', 'CoberturaController');
    Route::resource('poliza', 'PolizaController');
    Route::resource('tipo-producto-de-seguro', 'TipoProductoDeSeguroController');
    Route::resource('ramo', 'RamoController');
    Route::resource('transportista', 'TransportistaController');
    Route::resource('honorario-liquidacion', 'HonorarioLiquidacionController');
    Route::resource('tipo-documento', 'TipoDocumentoController');
    Route::resource('centro-reparacion', 'CentroReparacionController');
    Route::resource('color-siniestro', 'ColorSiniestroController');
    Route::resource('nota-importante', 'NotaImportanteController');


    Route::resource('sale', 'SaleController')->except(['show']);
    Route::get('sale/{from_date}/{until_date?}', 'SaleController@index');
});
