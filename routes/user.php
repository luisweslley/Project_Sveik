<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['user']], function () {

//Home
Route::get('/home', 'UserControllers\HomeController@index')->name('home');
// app\Http\Controllers\UserControllers\HomeController.php

//Duvidas
Route::get('/duvidas','UserControllers\DuvidasController@index')->name('duvidas.index');
Route::get('/duvidas/criar-duvida', 'UserControllers\DuvidasController@create')->name('duvidas.create');
Route::post('/duvidas','UserControllers\DuvidasController@enviarDuvida')->name('duvidas.enviarDuvida');

//feed
Route::get('/feed','UserControllers\FeedController@index')->name('feed.index');
Route::get('/feed/create','UserControllers\FeedController@create')->name('feed.create');
Route::post('/feed/create/criar-feed','UserControllers\FeedController@CriarFeed')->name('feed.create.CriarFeed');
Route::post('/feed/comentar/{id}','UserControllers\FeedController@Comentar')->name('feed.Comentar');
Route::post('/feed/curtir/{id}','UserControllers\FeedController@Curtir')->name('feed.Curtir');
// Route::delete('/feed/deletar/{id}','AdminControllers\FeedController@destroy')->name('feed.Delete');

//Modulo
Route::get('/modulo','UserControllers\ModuloController@index')->name('modulo.index');
Route::get('/modulo/detalhes/{id}','UserControllers\ModuloController@ModuloDetalhes')->name('modulo.detalhes.ModuloDetalhes');
Route::get('/modulo/detalhes/download/{id}','UserControllers\ModuloController@Download')->name('modulo.detalhes.Download');
Route::get('/modulo/detalhes/download-correcao/{id}','UserControllers\ModuloController@DownloadCorrecao')->name('modulo.detalhes.DownloadCorrecao');
Route::post('/modulo/detalhes/{id}','UserControllers\ModuloController@ModuloFinalizado')->name('modulo.detalhes.ModuloFinalizo');


//Perfil
Route::get('/perfil','UserControllers\PerfilController@index')->name('perfil.index');
Route::post('/perfil','UserControllers\PerfilController@UpdatePerfil')->name('perfil.UpdatePerfil');
});
