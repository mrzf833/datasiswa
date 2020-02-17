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
use App\siswa;
use App\kela;
use App\matapelajaran;
use App\User;

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth:web')->group(function () {
    Route::get('/', function () {
        $kelass = kela::all();
        return view('home')->with([
            'kelass' => $kelass
        ]);
    });
    Route::resource('/siswa', 'crudSiswa');
    Route::resource('/nilai_siswa','crudNilaiSiswa');
    Route::resource('/ranking','crudRanking');
    Route::resource('/kelas','crudKelas');
    Route::resource('/mapel','crudMatapelajaran');
});