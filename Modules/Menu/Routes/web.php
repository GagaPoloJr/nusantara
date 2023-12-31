<?php
use Modules\Menu\Http\Controllers\MenuController;

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
    Route::resource('menu',MenuController::class);
});

Route::prefix('menu/datatable')->group(function() {
    Route::get('/all', [MenuController::class,'all'])->name('menu.datatable.all');
});
