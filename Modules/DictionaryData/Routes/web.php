<?php
use Modules\DictionaryData\Http\Controllers\DictionaryDataController;
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

Route::middleware('auth')->group(function(){
    Route::resource('dictionarydata',DictionaryDataController::class);
});

Route::prefix('dictionarydata/datatable')->group(function() {
    Route::get('/all', [DictionaryDataController::class,'all'])->name('dictionarydata.datatable.all');
});
