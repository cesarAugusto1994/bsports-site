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

Auth::routes();

Route::middleware('loadCache')->group(function() {

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/', 'HomeController@index')->name('home_2');
  Route::get('/contato', 'HomeController@contato')->name('contato');
  Route::get('/classificacao', 'HomeController@classificacao')->name('classificacao');

  Route::get('/jogador/{slug}/{id}', 'JogadoresController@show')->name('jogador');

  Route::get('/pagina/{slug}/{id}', 'PaginasController@show')->name('pagina');
  Route::get('/paginas', 'PaginasController@index')->name('paginas');

  Route::get('/resultados', 'ResultadosController@index')->name('resultados');
  Route::get('/calendario', 'CalendarioJogosController@index')->name('calendario');

  Route::get('/import-jogadores', 'HomeController@importJogadores')->name('import_jogadores');
  Route::get('/import-partidas', 'HomeController@importPartidas')->name('import_partidas');

  Route::group(['prefix' => 'admin'], function () {
      Voyager::routes();

      Route::get('/appointment', 'HomeController@agendamento')->name('agendar_partida');

  });

});

Route::get('jogadores/get-ajax', 'JogadoresController@toAjax')->name('jogadores_ajax');
