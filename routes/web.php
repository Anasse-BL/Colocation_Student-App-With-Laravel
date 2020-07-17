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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::get('/rooms', function () {
    return view('index');
});
//Route::get('inscription','Controller@inscrire');

//Route::get('/inscription', function () {
    //return view('inscription');
//});
Route::get('/inscription','InscriptionController@index')->name('inscription.index');
Route::post('inscription','InscriptionController@store')->name('inscription.store');


Route::get('/room','RoomController@index')->name('room.index');
Route::post('room','RoomController@store')->name('room.store');

Route::get('/roomfile','RoomController@create')->name('rooms.create');

Route::get('/hello','InscriptionController@create')->name('inscription.create');


//Route::get('/panier','CartController@index')->name('cart.index');
//Route::post('/panier/ajouter','CartController@store')->name('cart.store');
//Route::get('/paiement','PaiementController@index')->name('paiement.index');

//Route::post('paiement','PaiementController@store')->name('paiement.store');