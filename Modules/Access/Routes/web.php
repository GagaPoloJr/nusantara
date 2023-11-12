<?php
use Modules\Access\Http\Controllers\AccessController;
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
    Route::resource('access',AccessController::class);
});

Route::prefix('access/datatable')->group(function() {
    Route::get('/all', [AccessController::class,'all'])->name('access.datatable.all');
});
