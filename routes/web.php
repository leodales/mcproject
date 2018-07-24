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
Route::get('/',function(){
    return view('index');
});


//routes for production import
Route::get('/import', 'ProductionController@index')->name('index');
Route::post('import', 'ProductionController@import')->name('import');

//routes for finance import
Route::get('/import2','FinanceController@index')->name('index2');
Route::post('/import2','FinanceController@import')->name('import2');

//routes for inserts of data
Route::get('/insert','InsertController@index')->name('insert'); 
Route::post('/confirmInsert','InsertController@confirmation')->name('confirmInsert');
Route::post('/insertDatabase','InsertController@insert')->name('insertDatabase');
Route::post('/massiveInsert','InsertController@massiveInsert')->name('massiveInsert');

//routes for deleting records 
Route::get('/delete','deleteController@index')->name('delete');

//routes for financial delete
Route::get('/finDelete','deleteController@finDelete')->name('finDelete');
Route::post('/finRetrieval','deleteController@finRetrieval')->name('finRetreive');
Route::post('/finDeleteProcess','deleteController@finDeleteProcess')->name('finDeleteProcess');

//routes for production delete
Route::get('/prodDelete','deleteController@prodDelete')->name('prodDelete');
Route::post('/prodRetrieval','deleteController@prodRetrieval')->name('prodRetreive');
Route::post('/prodDeleteProcess','deleteController@prodDeleteProcess')->name('prodDeleteProcess');


//routes for searching feature
Route::get('/search','SearchController@index')->name('search');
Route::get('/singleSearch','SearchController@singleSearch')->name('singleSearch');
Route::post('/ssSearch', 'SearchController@ssSearch')->name('ssSearch');

Route::get('/titleSearch', 'SearchController@titleSearch')->name('titleSearch');
Route::get('/ttSearch', 'SearchController@ttSearch')->name('ttSearch');
Route::get('/isbnSearch', 'SearchController@isbnSearch')->name('isbnSearch');
Route::get('/iSearch', 'SearchController@iSearch')->name('iSearch');


//routes for exporting data
Route::post('/pbosearch','searchController@searchPBO')->name('pbosearch');
Route::post('/export','searchController@export')->name('export');

//Authorization routes
Auth::routes();

//routes for user acces
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
