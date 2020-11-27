<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('pagina-inicial');
//Login e Registro Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuthControllers\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuthControllers\LoginController@login');
    Route::post('/logout', 'AdminAuthControllers\LoginController@logout')->name('logoutA');

    Route::get('/register', 'AdminAuthControllers\RegisterController@showRegistrationForm')->name('registerAdmin');
    Route::post('/register', 'AdminAuthControllers\RegisterController@create');

    // Route::post('/password/email', 'AdminAuthControllers\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    // Route::post('/password/reset', 'AdminAuthControllers\ResetPasswordController@reset')->name('password.email');
    // Route::get('/password/reset', 'AdminAuthControllers\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    // Route::get('/password/reset/{token}', 'AdminAuthControllers\ResetPasswordController@showResetForm');
  });

//Login e Registro User
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'UserAuthControllers\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'UserAuthControllers\LoginController@login');
    Route::get('/logout', 'UserAuthControllers\LoginController@logout')->name('logout');

    Route::get('/register', 'UserAuthControllers\RegisterController@showRegistrationForm')->name('registerUser');
    Route::post('/register', 'UserAuthControllers\RegisterController@create')->name('user.register');
    Route::get('/confirmar/{token}', 'UserAuthControllers\RegisterController@ConfirmarEmailView');
    Route::post('/confirmar/{token}', 'UserAuthControllers\RegisterController@ConfirmacaoEmail')->name('user.confirmar');

    Route::post('/password/email', 'UserAuthControllers\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'UserAuthControllers\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'UserAuthControllers\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'UserAuthControllers\ResetPasswordController@showResetForm');
  });


