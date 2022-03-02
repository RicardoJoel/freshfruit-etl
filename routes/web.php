<?php

use Illuminate\Support\Facades\Route;
use App\DocumentType;
use App\Country;
use App\User;

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

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', function () { return view('auth.login'); });
    Route::get('verify', function () { return view('auth.verify'); });  
    Route::get('activate/{code}', 'UserController@activate');
    Route::post('complete/{id}', 'UserController@complete');  
});

Route::group([
    'middleware' => 'verified',
], function () {
    Route::get('profile', function () { return view('auth.profile'); })->name('profile');
    Route::get('password', function () { return view('auth.passwords.update'); })->name('password');
    Route::post('updateAccount', 'UserController@updateAccount')->name('updateAccount');
    Route::post('changePassword', 'Auth\ChangePasswordController@store')->name('changePassword');
    Route::get('consolidado.load','ConsolidadoController@loadData')->name('consolidado.load');
    Route::get('manifiestos/carga', 'ManifestController@index')->name('manifests.index');
    Route::get('manifiestos/reporte', 'ManifestController@report')->name('manifests.report');
    //Route::get('manifiestos/generar', 'ManifestController@generate')->name('manifests.generate');
    Route::get('manifiestos/descarga', 'ManifestController@download')->name('manifests.download');
});

Route::group([
    'middleware' => 'isnt_admin',
], function () {
    Route::get('home', 'HomeController@home')->name('home');
});

Route::group([
    'middleware' => 'is_admin',
    'prefix' => 'admin'
], function () {
    Route::resource('users', 'UserController');
    Route::resource('dependents', 'DependentController');
    Route::resource('variations', 'VariationController');
    Route::resource('parameters', 'ParameterController');
    Route::get('profilesByType/{type}', function ($type) { return Profile::where('type',$type)->get(); });    
    Route::get('documentType/{id}', function ($id) { return DocumentType::find($id); });
    Route::get('country/{id}', function ($id) { return Country::find($id); });
    Route::get('user/{id}', function ($id) { return User::find($id); });
    Route::get('home', 'HomeController@adminHome')->name('home');
    Route::get('aereo.load','AereoController@loadData')->name('aereo.load');
    Route::get('maritimo.load','MaritimoController@loadData')->name('maritimo.load');
    Route::get('provincia.load','ProvinciaController@loadData')->name('provincia.load');
});