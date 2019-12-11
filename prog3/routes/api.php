<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//UserController
Route::get('/perfil/{username?}', ['as'=>'perfil.username', 'uses'=>'UserController@ver']);
Route::post('/salvar', ['as'=>'user.salvar', 'uses'=>'UserController@salvar']);
Route::get('/login', ['as'=>'site.login', 'uses'=>'UserController@index']);
Route::post('/login/acessar', ['as'=>'site.login.acessar', 'uses'=>'UserController@login']);
Route::get('/logout', ['as'=>'logout', 'uses'=>'UserController@logout']);
Route::get('/cadastrar', ['as'=>'auth.cadastro', 'uses'=>'UserController@cadastrar']);
Route::post('/cadastrar/send', ['as'=>'site.cadastro.send', 'uses'=>'UserController@register']);

//PostController



Auth::routes(['verify'=>true]);

Route::post('/configuracoes/update', ['as'=>'configs.update', 'uses'=>'PreferenciasController@update_user']);

//ROTAS DE ADMS
Route::get('/adm/preferencias', ['as' => 'adm.pref', 'uses' => 'PreferenciasController@index']);
//Route::get('/adm/preferencias/{id}', ['as' => 'adm.pref', 'uses' => 'PreferenciasController@update']);
Route::get('/adm/preferencias/add', ['as' => 'adm.pref.add', 'uses' => 'PreferenciasController@index_add']);
Route::post('/adm/preferencias/add/send', ['as' => 'adm.pref.add.send', 'uses' => 'PreferenciasController@add']);

//ROTAS AUTENTICADAS
Route::group(['middleware'=>'auth'], function (){
    Route::get('/', ['as'=>'postagens', 'uses'=>'PostController@ver_feed']);
    Route::post('/publicar', ['as'=> 'newpost', 'uses'=>'PostController@nova_postagem']);
    Route::post('/enviar_comentario', ['as' => 'posts.comentar', 'uses'=>'ComentarioController@comentar']);
    Route::get('/sugestoes', ['as'=>'sugestoes', 'uses'=>"PreferenciasController@find_matching"]);
    Route::get('/chat/{id}', ['as'=>'chat', 'uses'=>'MensagemController@index']);

});

