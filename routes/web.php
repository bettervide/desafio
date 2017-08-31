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

Route::get('salas', 'SalasController@index');
Route::get('salas/adicionar', 'SalasController@adicionar');
Route::get('salas/{cliente}/editar', 'SalasController@editar');
Route::post('salas/adicionar/salvar', 'SalasController@salvar');
Route::patch('salas/{cliente}', 'SalasController@atualizar');
Route::delete('salas/{cliente}', 'SalasController@deletar');

Route::get('reservar', 'ReservarController@index');
Route::get('reservar/adicionar', 'ReservarController@adicionar');
Route::post('reservar/adicionar/salvar', 'ReservarController@salvar');
