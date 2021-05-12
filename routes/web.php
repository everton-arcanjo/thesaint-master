<?php

Route::get('/', 'PrincipalController@principal');
Route::resource('/estoque', 'EstoqueController');
Route::resource('/materiaprima', 'MateriaPrimaController');
Route::post('/materiaprima/store','MateriaPrimaController@store');
Route::get('/materiaprima/edit/{id}','MateriaPrimaController@edit')->where('id','[0-9]+');
Route::post('/materiaprima/update/{id}','MateriaPrimaController@update')->where('id','[0-9]+');
Route::get('/materiaprima/destroy/{id}','MateriaPrimaController@destroy')->where('id','[0-9]+');
Route::get('/materiaprima/editarcompra/{id}','MateriaPrimaController@editarCompra')->where('id','[0-9]+');
Route::get('/materiaprima/excluircompra/{id}','MateriaPrimaController@excluirCompra')->where('id','[0-9]+');

Route::get('/compra','MateriaPrimaController@compra');
Route::get('/compra/novacompra','MateriaPrimaController@novacompra');
Route::post('/compra/salvarnovacompra','MateriaPrimaController@salvarnovacompra');
Route::post('/compra/atualizacompra/{id}','MateriaPrimaController@atualizacompra')->where('id','[0-9]+');
Route::get('/compra/showcompra/{id}','MateriaPrimaController@showcompra')->where('id','[0-9]+');
Route::get('/compra/destroy/{id}','MateriaPrimaController@destroy')->where('id','[0-9]+');
Route::get('/compra/adicionarLinha', 'MateriaPrimaController@adicionarLinha');
Route::get('/materiaprima/destroy/{id}','MateriaPrimaController@destroy')->where('id','[0-9]+');


Route::prefix('produto')->group(function(){
    Route::resource('/','ProdutoController');
    Route::post('/store','ProdutoController@store');
    Route::get('/edit/{id}','ProdutoController@edit')->where('id','[0-9]+');
    Route::post('/update/{id}','ProdutoController@update')->where('id','[0-9]+');
    Route::get('/adicionarlinhacaracteristicas','ProdutoController@adicionarlinhacaracteristicas');
    Route::get('/destroy/{id}','ProdutoController@destroy')->where('id','[0-9]+');
    Route::get('/info/{id}','ProdutoController@info');


});



Route::prefix('linhatempo')->group(function(){

    Route::resource('/','LinhaDoTempoController');
    Route::get('/edit/{id}','LinhaDoTempoController@edit')->where('id','[0-9]+');

});

Route::prefix('pedidovenda')->group( function(){

    Route::resource('/','PedidoVendaController');
    Route::get('/create','PedidoVendaController@create');
    Route::post('/store','PedidoVendaController@store');
    Route::get('/edit/{id}','PedidoVendaController@edit')->where('id','[0-9]+');
    Route::get('/adicionarlinha','PedidoVendaController@adicionarlinha');
    Route::post('/update/{id}','PedidoVendaController@update')->where('id','[0-9]+');
    Route::get('/destroy/{id}','PedidoVendaController@destroy')->where('id','[0-9]+');
    Route::get('/gerarpdf/{id}','PedidoVendaController@gerarpdf')->where('id','[0-9]+');
    Route::post('/aprovarecusa','PedidoVendaController@aprovarecusa');
    Route::get('/buscacliente/{id}','PedidoVendaController@buscacliente');

});

Route::prefix('fornecedor')->group( function() {

   Route::resource('/', 'FornecedorController');
   Route::post('/store','FornecedorController@store');
   Route::get('/edit/{id}', 'FornecedorController@edit')->where('id','[0-9]+');
   Route::post('/update/{id}','FornecedorController@update')->where('id','[0-9]+');
   Route::get('/destroy/{id}','FornecedorController@destroy')->where('id','[0-9]+');
});

Route::prefix('tipoproduto')->group(function(){

    Route::resource('/','TipoProdutoController');
    Route::get('/create','TipoProdutoController@create');
    Route::post('/store','TipoProdutoController@store');
    Route::get('/edit/{id}','TipoProdutoController@edit')->where('id','[0-9]+');
    Route::post('/update/{id}','TipoProdutoController@update')->where('id','[0-9]+');
});

Route::prefix('molde')->group( function(){

    Route::resource('/', 'MoldeController');
    Route::get('/edit/{id}','MoldeController@edit')->where('id','[0-9]+');
    Route::post('/update/{id}','MoldeController@update')->where('id','[0-9]+');
    Route::post('/store','MoldeController@store');
    Route::get('/destroy/{id}','MoldeController@destroy')->where('id','[0-9]+');
});

Route::prefix('cor')->group(function(){

    Route::resource('/','CorController');
    Route::get('/edit/{id}','CorController@edit')->where('id','[0-9]+');
    Route::get('/destroy/{id}','CorController@destroy')->where('id','[0-9]+');
    Route::get('/create','CorController@create');
    Route::post('/update/{id}','CorController@update')->where('id','[0-9]+');
    Route::post('/store','CorController@store');
});

Route::prefix('tecido')->group(function(){
    Route::resource('/','TecidoController');
    Route::get('/edit/{id}','TecidoController@edit')->where('id','[0-9]+');
    Route::get('/destroy/{id}','TecidoController@destroy')->where('id','[0-9]+');
    Route::get('/create','TecidoController@create');
    Route::post('/update/{id}','TecidoController@update')->where('id','[0-9]+');
    Route::post('/store','TecidoController@store');
    Route::get('/show/{id}','TecidoController@show')->where('id','[0-9]+');

});


Route::prefix('cliente')->group(function(){
    Route::get('/','ClienteController@index');
    Route::get('/create','ClienteController@create');
    Route::post('/store','ClienteController@store');
    Route::get('/edit/{id}','ClienteController@edit')->where('id','[0-9]+');
    Route::post('/update/{id}','ClienteController@update')->where('id','[0-9]+');
    Route::get('/destroy/{id}','ClienteController@destroy')->where('id','[0-9]+');
});

//Route::resource('/login','LoginController');

Route::prefix('usuario')->group(function(){
    Route::resource('/','UsuarioController');
    Route::get('/create','UsuarioController@create');
    Route::post('/store','UsuarioController@store');
    Route::get('/edit/{id}','UsuarioController@edit')->where('id','[0-9]+');
    Route::post('/update/{id}','UsuarioController@update')->where('id','[0-9]+');
    Route::get('/destroy/{id}','UsuarioController@destroy')->where('id','[0-9]+');
});

Auth::routes();

Route::get('/logout','Auth\LoginController@logout')->name('sair');

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('meta')->group(function(){

    Route::resource('/','MetaController');
    Route::get('/create','MetaController@create');
    Route::get('/edit/{id}','MetaController@edit')->where('id','[0-9]+');
    Route::post('/store','MetaController@store');
    Route::post('/update/{id}','MetaController@update')->where('id','[0-9]+');

});

Route::prefix('estoqueproduto')->group(function(){
    Route::get('/indexproduto','EstoqueController@indexproduto');
    Route::get('/editproduto/{id}','EstoqueController@editproduto')->where('id','[0-9]+');
    Route::post('/updateestoque/{id}','EstoqueController@updateestoque')->where('id','[0-9]+');


});
