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

Route::get('/', function () {
    return redirect('candidatos');
});

Route::get('/candidatos', 'CandidatoController@index')->name('candidatos');//->middleware('auth');

Route::get('/candidatos/{candidato}', 'CandidatoController@show')
		->where('candidato', '[0-9]+')
		->name('candidatos.show');//->middleware('auth');

Route::get('/candidatos/nuevo', 'CandidatoController@crearCandidato')->name('candidatos.create');

//Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');

Route::post('/candidatos', 'CandidatoController@store');

Route::put('/candidatos/{candidato}', 'CandidatoController@update');//->middleware('auth');

Route::delete('/candidatos/{candidato}', 'CandidatoController@destroy')->name('candidatos.destroy');//->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/download/{file}' , 'CandidatoController@downloadFile');

