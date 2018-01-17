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

Route::get('/','SubirArchivo@index')->name('inicio');
Route::post('/','SubirArchivo@subir');

Route::get('imagen','SubirArchivo@imagen')->name('imagen');
Route::get('imagen2','SubirArchivo@imagen2')->name('imagen2');
Route::get('imagen3','SubirArchivo@imagen3')->name('imagen3');


Route::get('elegir','SubirArchivo@elegir')->name('elegir');
Route::post('elegir','SubirArchivo@procesarCambio');
Route::get('elegir/{x}/{y}','SubirArchivo@colorPix');

Route::get('cambiar','SubirArchivo@cambiar')->name('cambiar');
Route::post('cambiar','SubirArchivo@subirMontado');


Route::get('resultado','SubirArchivo@resultado')->name('resultado');
