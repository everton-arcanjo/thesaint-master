<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
});

Route::prefix('materiaprima')->group( function() {

    Route::post('/lancar','MateriaPrimaController@lancarcompra');
    Route::get('/show/{id}','MateriaPrimaController@show');
    Route::get('/showmateriaprimacompra/{id}','MateriaPrimaController@showMateriaPrimaCompra');
});

Route::prefix('produto')->group( function(){
    Route::get('/info/{id}','ProdutoController@info');
});

Route::prefix('pedidovenda')->group( function(){
    Route::get('/buscacliente/{id}','PedidoVendaController@buscacliente');
    Route::post('/aprovarecusa','PedidoVendaController@aprovarecusa');

});

Route::prefix('molde')->group(function(){
    Route::get('/showjson/{id}','MoldeController@showjson');
});

Route::prefix('tecido')->group(function(){
    Route::get('/show/{id}','TecidoController@show')->where('id','[0-9]+');
});
