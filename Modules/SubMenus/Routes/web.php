<?php
use Modules\SubMenus\Http\Controllers\SubMenusController;

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
    Route::resource('submenu',SubMenusController::class);
});

Route::prefix('submenu/datatable')->group(function() {
    Route::get('/all', [SubMenusController::class,'all'])->name('submenu.datatable.all');
});
