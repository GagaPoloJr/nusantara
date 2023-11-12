<?php
use Modules\Vehicles\Http\Controllers\VehiclesController;

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
    Route::resource('vehicles',VehiclesController::class);
});

Route::prefix('vehicles/datatable')->group(function() {
    Route::get('/all', [VehiclesController::class,'all'])->name('vehicles.datatable.all');
});