<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as'=>'postagens', 'uses'=>'PostController@ver_feed']);
Route::get('/perfil/{username?}', ['as'=>'perfil.username', 'uses'=>'UserController@ver']);

Route::post('/salvar', ['as'=>'user.salvar', 'uses'=>'UserController@salvar']);

Auth::routes(['verify'=>true]);

Route::get('/login', ['as'=>'site.login', 'uses'=>'UserController@index']);
Route::post('/login/acessar', ['as'=>'site.login.acessar', 'uses'=>'UserController@login']);
Route::get('/logout', ['as'=>'logout', 'uses'=>'UserController@logout']);

Route::get('/cadastrar', ['as'=>'auth.cadastro', 'uses'=>'UserController@cadastrar']);
Route::post('/cadastrar/send', ['as'=>'site.cadastro.send', 'uses'=>'UserController@register']);

Route::post('/enviar_comentario', ['as' => 'posts.comentar', 'uses'=>'ComentarioController@comentar']);
Route::get('/perfil/{username?}', ['as'=>'perfil.username', 'uses'=>'UserController@ver'])->middleware('verified');

Route::get('/sugestoes', ['as'=>'sugestoes', 'uses'=>"PreferenciasController@find_matching"]);
Route::post('/publicar', ['as'=> 'newpost', 'uses'=>'PostController@nova_postagem']);

Route::get('/chat/{id}', ['as'=>'chat', 'uses'=>'MensagemController@index']);

//ROTAS DE ADMS
Route::get('/adm/preferencias', ['as' => 'adm.pref', 'uses' => 'PreferenciasController@index']);
//Route::get('/adm/preferencias/{id}', ['as' => 'adm.pref', 'uses' => 'PreferenciasController@update']);
Route::get('/adm/preferencias/add', ['as' => 'adm.pref.add', 'uses' => 'PreferenciasController@index_add']);
Route::post('/adm/preferencias/add/send', ['as' => 'adm.pref.add.send', 'uses' => 'PreferenciasController@add']);

