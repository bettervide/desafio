<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('usuarios', 'UsuariosController@index');
Route::get('usuarios/adicionar', 'UsuariosController@adicionar');
Route::get('usuarios/{cliente}/editar', 'UsuariosController@editar');
Route::post('usuarios/adicionar/salvar', 'UsuariosController@salvar');
Route::patch('usuarios/{cliente}', 'UsuariosController@atualizar');
Route::delete('usuarios/{cliente}', 'UsuariosController@deletar');
