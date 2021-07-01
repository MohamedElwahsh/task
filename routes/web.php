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


Route::get('/landing', function () {
    return view('landing');
});


Route::get('/dashboard', function () {
    return 'You Are Not Allowed';
}) -> name('dashboard');


Auth::routes([ 'verify' => true ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



Route::get('fillable', 'App\Http\Controllers\CrudController@getOffers');

Route::group(['prefix' => LaravelLocalization::setLocale(),
              'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
             ], function(){
//   Route::get('store', 'App\Http\Controllers\CrudController@store');
    Route::group(['prefix' => 'offers' , 'namespace' => 'App\Http\Controllers'], function(){
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store') -> name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer') -> name('offers.update');

        Route::get('delete/{offer_id}', 'CrudController@deleteOffer');


        Route::get('all', 'CrudController@getAllOffers');
        });
    Route::get('youtube', 'App\Http\Controllers\CrudController@getVideo')-> middleware('auth:web');
});

################## Begin AJAX Routes ##################
Route::group(['prefix' => 'ajax-offers'], function() {
    Route::get('/create', 'App\Http\Controllers\OfferController@create');
    Route::post('store', 'App\Http\Controllers\OfferController@store') -> name('ajax.offers.store');
    Route::get('all', 'App\Http\Controllers\OfferController@all') -> name('ajax.offers.all');
    Route::post('delete', 'App\Http\Controllers\OfferController@delete') -> name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'App\Http\Controllers\OfferController@edit') -> name('ajax.offers.edit');
    Route::post('update', 'App\Http\Controllers\OfferController@update') -> name('ajax.offers.update');
});
##################### End AJAX Routes ################

#################### Begin Authentsation & Guards #############
Route::group(['namespace'=> 'App\Http\Controllers\Auth' , 'middleware' => 'CheckAge'], function (){
    Route::get('adult', 'customAuthController@adult') -> name('adult');
});
Route::group(['namespace'=> 'App\Http\Controllers\Auth'], function (){
    Route::get('site', 'customAuthController@site') -> middleware('auth:web') -> name('site');
    Route::get('admin', 'customAuthController@admin') -> middleware('auth:admin') -> name('admin');
    Route::get('admin/login', 'customAuthController@adminLogin') -> name('admin.login');
    Route::post('admin/login', 'customAuthController@checkAdminLogin') -> name('save.admin.login');
});
#################### End Authentsation & Guards #############

########################## Begin Of Relations ############################
Route::get('has-one', 'App\Http\Controllers\Relations\RelationsController@hasOneRelation');
Route::get('has-one-reverse', 'App\Http\Controllers\Relations\RelationsController@hasOneRelationReverse');
Route::get('get-user-has-phone', 'App\Http\Controllers\Relations\RelationsController@getUserHasPhone');
Route::get('get-user-not-has-phone', 'App\Http\Controllers\Relations\RelationsController@getUserNotHasPhone');
############################ One To Many Relationship ##################
Route::get('hospital-has-many', 'App\Http\Controllers\Relations\RelationsController@getHospitalDoctors');
Route::get('hospitals', 'App\Http\Controllers\Relations\RelationsController@getAllHospitals');
Route::get('delete/hospital/{id}', 'App\Http\Controllers\Relations\RelationsController@deleteHospital');
Route::get('doctors/{hospital_id}', 'App\Http\Controllers\Relations\RelationsController@getAllDoctors');
Route::get('delete/doctor/{doctor_id}', 'App\Http\Controllers\Relations\RelationsController@deleteDoctor');
Route::get('hospitals-has-doctors', 'App\Http\Controllers\Relations\RelationsController@hospitalsHasDoctors');
Route::get('hospitals-has-male-doctors', 'App\Http\Controllers\Relations\RelationsController@hospitalsHasMaleDoctors');
Route::get('hospitals-not-has-doctors', 'App\Http\Controllers\Relations\RelationsController@hospitalsNotHasDoctors');


########################## End Of Relations ############################
