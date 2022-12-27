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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('admin','AdminController@index')->name('admin');
Route::post('admin/create/', 'AdminController@create');
Route::get('admin/edit/{id}', 'AdminController@edit');
Route::post('admin/update/{id}', 'AdminController@update');
Route::get('admin/destroy/{id}', 'AdminController@destroy');
Route::resource('/admin','AdminController');

Route::get('anggota','AnggotaController@index')->name('anggota');
Route::post('anggota/create/', 'AnggotaController@create');
Route::get('anggota/edit/{id}', 'AnggotaController@edit');
Route::post('anggota/update/{id}', 'AnggotaController@update');
Route::resource('/anggota','AnggotaController');

Route::get('buku','BukuController@index')->name('buku');
Route::post('buku/create','BukuController@create');
Route::get('buku/edit/{id}','BukuController@edit');
Route::post('buku/update/{id}','BukuController@update');
Route::resource('/buku','BukuController');

Route::get('peminjaman','TransaksiController@index')->name('peminjaman');
Route::post('peminjaman/create','TransaksiController@create');
Route::get('peminjaman/setujui/{id}','TransaksiController@setujui');
Route::get('peminjaman/tolak/{id}','TransaksiController@tolak');
Route::get('peminjaman/perpanjang/{id}','TransaksiController@perpanjang');
Route::resource('/peminjaman','TransaksiController');

Route::get('pengembalian','PengembalianController@index')->name('pengembalian');
Route::get('pengembalian/kembali/{id}', 'PengembalianController@kembalikan');
Route::match(['get', 'post'], 'pengembalian/rusak/{id}', 'PengembalianController@rusak');
Route::match(['get', 'post'], 'pengembalian/hilang/{id}', 'PengembalianController@hilang');
Route::resource('/pengembalian','PengembalianController');

Route::get('/denda', 'DendaController@index')->name('denda');
Route::get('/denda/lunasi/{id}', 'DendaController@bayar');
Route::get('/denda/kwitansi/{id}', 'DendaController@kwitansi');
Route::resource('/denda','DendaController');
