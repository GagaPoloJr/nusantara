<?php
use Modules\Dictionary\Http\Controllers\DictionaryController;
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
    Route::resource('dictionary',DictionaryController::class);
});

Route::prefix('dictionary/datatable')->group(function() {
    Route::get('/all', [DictionaryController::class,'all'])->name('dictionary.datatable.all');
});
