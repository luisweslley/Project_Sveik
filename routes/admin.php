<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['admin']], function () {

    //Home
    Route::get('/home', 'AdminControllers\HomeController@index')->name('home');

    //Duvidas
    Route::get('/duvidas','AdminControllers\DuvidasController@index')->name('duvidas.index');
    Route::get('/duvidas/{id}', 'AdminControllers\DuvidasController@DetalhesDuvidas')->name('duvidas.DetalhesDuvidas');
    Route::get('/duvidas/usuario/{id}', 'AdminControllers\DuvidasController@DuvidasUser')->name('duvidas.DuvidasUser');
    Route::post('/duvidas/{id}','AdminControllers\DuvidasController@EnviarResposta')->name('duvidas.EnviarResposta');
    Route::delete('/duvidas/delete/{id}','AdminControllers\DuvidasController@Destroy')->name('duvidas.delete.Destroy');

    //feed
    Route::get('/feed','AdminControllers\FeedController@index')->name('feed.index');
    Route::get('/feed/create','AdminControllers\FeedController@create')->name('feed.create');
    Route::post('/feed/create/criar-feed','AdminControllers\FeedController@CriarFeed')->name('feed.create.CriarFeed');
    Route::post('/feed/curtir/{id}','AdminControllers\FeedController@Curtir')->name('feed.Curtir');
    Route::post('/feed/comentar/{id}','AdminControllers\FeedController@Comentar')->name('feed.Comentar');
    Route::delete('/feed/deletar/{id}','AdminControllers\FeedController@destroy')->name('feed.Delete');
    Route::delete('/feed/deletar-comentario/{id}','AdminControllers\FeedController@destroyComentario')->name('feed.DeleteComentario');

    //Modulo
    Route::get('/modulo','AdminControllers\ModuloController@index')->name('modulo.index');
    Route::get('/modulo/detalhes/{id}','AdminControllers\ModuloController@moduloDetalhes')->name('modulo.moduloDetalhes');
    Route::get('/modulo/detalhes/download/{id}','AdminControllers\ModuloController@Download')->name('modulo.detalhes.Download');
    Route::get('/modulo/detalhes/download-correcao/{id}','AdminControllers\ModuloController@DownloadCorrecao')->name('modulo.detalhes.DownloadCorrecao');

    Route::get('/modulo/criar-aula/{id}','AdminControllers\ModuloController@AulaCriar')->name('modulo.AulaCriar');

    Route::get('/modulo/criar-exercicio/{id}','AdminControllers\ModuloController@ExercicioCriar')->name('modulo.ExercicioCriar');
    Route::get('/modulo/editar-exercicio/{id}','AdminControllers\ModuloController@ExercicioEditar')->name('modulo.ExercicioEditar');

    Route::get('/modulo/criar-correcao/{id}','AdminControllers\ModuloController@CorrecaoCriar')->name('modulo.CorrecaoCriar');

    Route::post('/modulo/criar-correcao/{id}','AdminControllers\ModuloController@AddCorrecao')->name('modulo.AddCorrecao');
    Route::delete('/modulo/delete-correcao/{id}','AdminControllers\ModuloController@DeleteCorrecao')->name('modulo.DeleteCorrecao');

    Route::post('/modulo','AdminControllers\ModuloController@CreateModulo')->name('modulo.CreateModulo');
    Route::delete('/modulo/{id}','AdminControllers\ModuloController@DeleteModulo')->name('modulo.DeleteModulo');

    Route::post('/modulo/criar-aula/{id}','AdminControllers\ModuloController@CreateAula')->name('modulo.CreateAula');
    Route::post('/modulo/editar-aula/{id}','AdminControllers\ModuloController@UpdateNomeAula')->name('modulo.UpdateNomeAula');
    Route::delete('/modulo/deletar-aula/{id}','AdminControllers\ModuloController@DeleteAula')->name('modulo.DeleteAula');

    Route::post('/modulo/criar-exercicio/{id}','AdminControllers\ModuloController@AddExercicio')->name('modulo.AddExercicio');
    Route::post('/modulo/editar-exercicio/{id}','AdminControllers\ModuloController@UpdateExercicio')->name('modulo.UpdateExercicio');
    Route::delete('/modulo/deletar-exercicio/{id}','AdminControllers\ModuloController@DeleteExercicio')->name('modulo.DeleteExercicio');



    // adicionar o resto das rotas conforme o layout

    //Perfil
    Route::get('/perfil','AdminControllers\PerfilController@index')->name('perfil.index');
    Route::post('/perfil','AdminControllers\PerfilController@UpdatePerfil')->name('perfil.UpdatePerfil');

    //Usuarios
    Route::get('/usuarios','AdminControllers\UsuariosController@index')->name('usuarios.index');
    Route::get('/usuarios/detalhes-usuario/{id}','AdminControllers\UsuariosController@detalhesUser')->name('usuarios.detalhesUser');
    Route::post('/usuarios/detalhes-usuario/{id}','AdminControllers\UsuariosController@liberarAcesso')->name('usuarios.detalhesUser.LiberarAcesso');
    Route::post('/usuarios/liberar-usuario/{id}','AdminControllers\UsuariosController@LiberarEntrada')->name('usuarios.LiberarEntrada');
    Route::post('/usuarios/bloquear-usuario/{id}','AdminControllers\UsuariosController@BloquearEntrada')->name('usuarios.BloquearEntrada');
    Route::delete('/usuarios/detalhes-usuario/{id}/{user}','AdminControllers\UsuariosController@BloquearAcesso')->name('usuarios.detalhesUser.BloquearAcesso');
    Route::delete('/usuarios/{id}','AdminControllers\UsuariosController@ExcluirUser')->name('usuarios.ExcluirUser');

    //adicionar o resto das rotas conforme o layout
    });
