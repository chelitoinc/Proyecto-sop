<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();
# Rutas a plantillass
Route::get('/', 'HomeController@index')->name('home');

/* RUTAS USUARIO */
Route::resource('user', 'UserController');
Route::post('user/updateAdmin', 'UserController@updateAdmin')->name('user.updateAdmin');
Route::get('user/destroy/{id}', 'UserController@destroy');

Route::get('configuracion', 'UserController@config')->name('config');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::get('user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

/* Subir foto */
Route::post('user/foto', 'UserController@updatePhoto');


/* RUTAS PARTIDAS */
Route::resource('partidas', 'PartidaController');
Route::get('importPartidas', 'PartidaController@partidaView');
Route::get('importPartida', 'PartidaController@partidasView');
Route::post('partidas/update', 'PartidaController@update')->name('partidas.update');
//Route::post('partidas/change', 'PartidaController@change')->name('partidas.change');

Route::post('partidas/tranferencia', 'PartidaController@tranferencia')->name('transferencia.ready');

Route::get('partidas/destroy/{id}', 'PartidaController@destroy');
Route::get('partidas/downloadPartida/{type}', 'PartidaController@downloadPartida');
Route::get('partidas/downloadPlantilla/{type}', 'PartidaController@downloadPlantilla');
Route::post('partidas/importData', 'PartidaController@importPartida');

Route::get('partidas/empty','PartidaController@empty')->name('partidas.empty');

/* RUTAS REPORTES */
Route::resource('reportes', 'ReporteController');
Route::post('reportes/update', 'ReporteController@update')->name('reportes.update');
Route::get('reportes/destroy/{id}', 'ReporteController@destroy');

// Ruta para descargar los reportes pidiedo el folio del reporte
Route::post('reportes/pdf', 'ReporteController@exportpdf')->name('reportes.pdf');

Route::get('reportes/editar/{id}', 'ReporteController@show')->name('reportes.editar');

Route::post('reportes/editar/', 'ReporteController@updateImporte')->name('reportes.editar');



/* RUTAS BENEFICIARIO */
Route::resource('beneficiario', 'BeneficiarioController');
Route::post('beneficiario/update', 'BeneficiarioController@update')->name('beneficiario.update');
Route::get('beneficiario/destroy/{id}', 'BeneficiarioController@destroy');

/* RUTAS CLASIFICADOS */
Route::resource('clasificados', 'ClasificadoController');
Route::post('clasificados/update', 'ClasificadoController@update')->name('clasificados.update');
Route::get('clasificados/destroy/{id}', 'ClasificadoController@destroy');
Route::get('clasificados/downloadClasificados/{type}', 'ClasificadoController@downloadClasificados');
Route::get('clasificados/downdoaldPlantillaC/{type}', 'ClasificadoController@downdoaldPlantillaC');
Route::post('clasificados/importDataC', 'ClasificadoController@importClasificadosC');

/* RUTAS CLASIFICADOS */
Route::resource('responsables', 'ResponsableController');
Route::post('responsables/update', 'ResponsableController@update')->name('responsables.update');
Route::get('responsables/destroy/{id}', 'ResponsableController@destroy');
Route::get('clasificados/downloadResponsables/{type}', 'ResponsableController@downloadResponsables');
Route::get('clasificados/downdoaldPlantilla/{type}', 'ResponsableController@downdoaldPlantilla');
Route::post('clasificados/importData', 'ResponsableController@importResponsables');

/* RUTA PLANTILLAS PDF */
//Route::get('plantillas/pdf/{id}', 'PlantillaController@exportpdf');
Route::get('plantillas/', 'PlantillaController@index');