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





Route::group(['prefix'=>'/home','middleware'=>['auth','roles'],'roles'=>["Ambulans Gorevlisi","Gorevli","Rutbeli","Admin"]],function(){ //roller ile ilgili örnek

    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix'=>'hasta','middleware'=>'roles','roles'=>["Rutbeli","Admin"]],function(){
        Route::get('sil/{id}','HastaController@sil');
    });

    Route::get('ajax_hastane_bilgisini_ver','Duzenleme\HastanelerController@ajax_hastane_bilgisini_ver');
    Route::get('ajax_ambulans_bilgisini_ver','Duzenleme\AmbulanslarController@ajax_ambulans_bilgisini_ver');
    Route::get('ajax_hastanin_gidecegi_yeri_getir','HastaController@ajax_hastanin_gidecegi_yeri_getir');
    Route::post('ajax_yeni_hasta_ekle','HastaController@ajax_yeni_hasta_ekle');

    Route::group(['prefix'=>'duzenleme','middleware'=>'roles','roles'=>["Admin"]],function(){

        Route::group(['prefix'=>'hastaneler'],function(){
            Route::get('/','Duzenleme\HastanelerController@index');
            Route::post('ekle','Duzenleme\HastanelerController@ekle');
            Route::get('sil/{id}','Duzenleme\HastanelerController@sil');
        });

        Route::group(['prefix'=>'istasyonlar'],function(){
            Route::get('/','Duzenleme\IstasyonlarController@index');
            Route::post('ekle','Duzenleme\IstasyonlarController@ekle');
            Route::get('sil/{id}','Duzenleme\IstasyonlarController@sil');
        });

        Route::group(['prefix'=>'ambulanslar'],function(){
            Route::get('/','Duzenleme\AmbulanslarController@index');
            Route::post('ekle','Duzenleme\AmbulanslarController@ekle');
            Route::post('guncelle','Duzenleme\AmbulanslarController@guncelle');
            Route::get('sil/{id}','Duzenleme\AmbulanslarController@sil');
        });

    });

});





Route::get('mail/kullanici-aktif-et/{kod}','MailController@mailKullaniciAktifEt')->middleware('auth');

Auth::routes();